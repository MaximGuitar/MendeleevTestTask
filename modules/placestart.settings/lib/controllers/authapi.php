<?php
namespace Placestart\Settings\Controllers;

use Bitrix\Main\Context;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\ErrorCollection;
use Placestart\HtmlResponse;
use \Valitron\Validator;
use \Bitrix\Main\HttpResponse;
use Bitrix\Main\UserTable;

class AuthApi extends Controller
{
    public function configureActions()
    {
        return [
            'login' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(
                        [ActionFilter\HttpMethod::METHOD_POST]
                    ),
                ],
                'postfilters' => []
            ],
            'initRegister' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(
                        [ActionFilter\HttpMethod::METHOD_POST]
                    ),
                ],
                'postfilters' => []
            ],
            'verifyRegister' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(
                        [ActionFilter\HttpMethod::METHOD_POST]
                    ),
                ],
                'postfilters' => []
            ],
        ];
    }

    public function loginAction(string $phone, string $password, string $remember = "N")
    {
        $phone = preg_replace("/\D/i", "", $phone);
        $result = [
            "status" => "success",
            "phone" => $phone,
            "password" => $password,
            "remember" => $remember,
        ];

        Validator::lang("ru");
        $v = new Validator($result);
        $v->setPrependLabels(false);
        $v->rule("required", ["phone", "password"]);

        if (!$v->validate()) {
            $result["status"] = "not_valid";
            $result["errors"] = $v->errors();

            return new HtmlResponse(tpl("forms/login-form", $result));
        }

        $user = new \CUser();
        $login_result = $user->Login($phone, $password, $remember);

        if ($login_result !== true) {
            $result["status"] = "login_error";
        }

        $result["login_result"] = $login_result;

        $response = new HttpResponse();
        $response->addHeader("HX-Refresh", "true");
        return $response;
    }

    public function initRegisterAction(string $phone, string $email, string $password, string $confirm_password)
    {
        $phone = preg_replace("/\D/i", "", $phone);
        $result = [
            "phone" => $phone,
            "email" => $email,
            "status" => "success"
        ];

        $user = UserTable::getList([
            "select" => ["ID", "LOGIN", "EMAIL"],
            "filter" => [
                "LOGIN" => $phone,
            ]
        ])->fetchObject();


        if ($user) {
            $result["status"] = "user_already_registered";
            return new HtmlResponse(tpl("forms/register-form", $result));
        }

        $data = [
            "phone" => $phone,
            "email" => $email,
            "password" => $password,
            "confirm_password" => $confirm_password
        ];

        Validator::lang("ru");
        $v = new Validator($data);
        $v->setPrependLabels(false);
        $v->rule("required", ["phone", "email", "password", "confirm_password"]);
        $v->rule("email", "email");
        $v->rule("length", "phone", 11);
        $v->rule("equals", "password", "confirm_password");

        if (!$v->validate()) {
            $result["status"] = "not_valid";
            $result["errors"] = $v->errors();

            return new HtmlResponse(tpl("forms/register-form", $result));
        }

        $user = new \CUser();
        $user_ID = $user->Add([
            "ACTIVE" => "N",
            "LOGIN" => $phone,
            "EMAIL" => $email,
            "PASSWORD" => $password,
            "CONFIRM_PASSWORD" => $confirm_password
        ]);

        $user_ID = intval($user_ID);
        if ($user_ID <= 0) {
            $result["status"] = "register_error";
            $result["register_error"] = $user->LAST_ERROR;

            return new HtmlResponse(tpl("forms/register-form", $result));
        }

        $server = Context::getCurrent()->getServer();

        $ch = curl_init("https://sms.ru/code/call");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            http_build_query(
                [
                    "phone" => $phone, // номер телефона пользователя
                    "ip" => $server->get("REMOTE_ADDR"), // ip адрес пользователя
                    "api_id" => "83F5DE02-AD9C-635F-7AB0-26D2CAA24DC4"
                ]
            )
        );
        $body = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($body);
        if ($json->status !== "OK") {
            $result["status"] = "sms_error";
            $result["error"] = $json->status_text;
        }

        $session = \Bitrix\Main\Application::getInstance()->getSession();
        $session->set("code", $json->code);
        $session->set("new_user_id", $user_ID);

        $result["status"] = "init";
        return new HtmlResponse(tpl("forms/verify-register-form", $result));
    }

    public function verifyRegisterAction(string $code)
    {
        $session = \Bitrix\Main\Application::getInstance()->getSession();
        $correct_code = $session->get("code");
        $new_user_id = $session->get("new_user_id");

        $result = [
            "status" => "succes"
        ];

        if ($correct_code === null || $new_user_id === null) {
            $result["status"] = "no_info";
            return new HtmlResponse(tpl("forms/verify-register-form", $result));
        }

        $result = [
            "code" => $code,
            "status" => "success"
        ];

        if ($code != $correct_code) {
            $result["status"] = "incorrect_code";
            return new HtmlResponse(tpl("forms/verify-register-form", $result));
        }

        $user = new \CUser;
        $update_res = $user->Update($new_user_id, [
            "ACTIVE" => "Y"
        ]);
        if (!$update_res) {
            $result["status"] = "user_update_error";
            $result["error"] = $user->LAST_ERROR;
            return new HtmlResponse(tpl("forms/verify-register-form", $result));
        }

        $session->delete("code");
        $session->delete("new_user_id");

        $response = new HttpResponse();
        $response->addHeader("HX-Refresh", "true");
        return $response;
    }
}
