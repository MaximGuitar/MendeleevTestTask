<?php
namespace Placestart\Settings\Controllers;

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Mail\Event;
use Bitrix\Main\Loader;
use \Valitron\Validator;
use \Bitrix\Main\HttpResponse;

Loader::includeModule("iblock");

class FeedbackApi extends Controller
{
    public function configureActions()
    {
        return [
            'sendReview' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(
                        [ActionFilter\HttpMethod::METHOD_POST]
                    ),
                    new ActionFilter\Authentication(),
                ],
                'postfilters' => []
            ],
            'supportRequest' => [
                'prefilters' => [
                    new ActionFilter\Csrf(),
                    new ActionFilter\HttpMethod(
                        [ActionFilter\HttpMethod::METHOD_POST]
                    ),
                    new ActionFilter\Authentication(),
                ],
                'postfilters' => []
            ],
            'emailSubscribe' => [
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

    // placestart:settings.api.FeedbackApi.sendReview
    public function sendReviewAction(string $text, int $score, int $product_id): HttpResponse
    {
        global $USER;

        $result = ["status" => "success"];
        $data = [
            "text" => $text,
            "score" => $score,
            "product_id" => $product_id
        ];
        $response = new HttpResponse();
        $response->addHeader("Content-Type", "text/html; charset=UTF-8");

        Validator::lang("ru");

        $v = new Validator($data);
        $v->setPrependLabels(false);
        $v->rule("required", ["score", "text", "product_id"]);
        $v->rule("integer", ["score", "product_id"]);
        $v->rule("min", "score", 1);
        $v->rule("max", "score", 5);

        if (!$v->validate()) {
            $result = [
                "status" => "not_valid",
                "errors" => $v->errors()
            ];

            $response->setContent(tpl("forms/review-form", array_merge($result, $data)));
            return $response;
        }

        $rsElement = new \CIBlockElement;
        $dctFields = array(
            'ACTIVE' => 'N',
            'NAME' => $USER->GetFullName(),
            "PREVIEW_TEXT" => $data["text"],
            "IBLOCK_ID" => REVIEWS_IBLOCK,
            'PROPERTY_VALUES' => array(
                "PRODUCT_ID" => $product_id,
                "SCORE" => $data["score"]
            )
        );

        if (!$id = $rsElement->Add($dctFields)) {
            $result = [
                "status" => "iblock_error",
                "error" => $rsElement->LAST_ERROR
            ];
        }

        $response->setContent(tpl("forms/review-form", array_merge($result, $data)));

        return $response;
    }

    // placestart:settings.api.FeedbackApi.supportRequest
    public function supportRequestAction(string $phone): HttpResponse
    {
        $result = [
            "status" => "success",
            "phone" => $phone
        ];
        $response = new HttpResponse();
        $response->addHeader("Content-Type", "text/html; charset=UTF-8");

        $v = new Validator($result);
        $v->rule("required", "phone");
        if (!$v->validate()) {
            $result["status"] = "not_valid";
            $result["errors"] = $v->errors();

            $response->setContent(tpl("forms/support-form", $result));
            return $response;
        }

        $event = Event::send([
            "EVENT_NAME" => "SUPPORT_REQUEST",
            "LID" => "s1",
            "C_FIELDS" => [
                "PHONE" => $result["phone"]
            ],
        ]);

        if (!$event->isSuccess()) {
            $result["status"] = "event_error";
            $result["errors"] = $event->getErrorMessages();
        }

        $response->setContent(tpl("forms/support-form", $result));
        return $response;
    }

    // placestart:settings.api.FeedbackApi.emailSubscribe
    public function emailSubscribeAction(string $email): HttpResponse
    {
        $result = [
            "status" => "success",
            "email" => $email
        ];
        $response = new HttpResponse();
        $response->addHeader("Content-Type", "text/html; charset=UTF-8");

        $v = new Validator($result);
        $v->rule("required", "email");
        $v->rule("email", "email");

        if (!$v->validate()) {
            $result["status"] = "not_valid";
            $result["errors"] = $v->errors();

            $response->setContent(tpl("forms/footer-subscribe", $result));
            return $response;
        }

        global $USER;

        $rsElement = new \CIBlockElement;
        $dctFields = [
            'ACTIVE' => 'Y',
            'NAME' => $result["email"],
            "IBLOCK_ID" => SUBSCRIPTIONS_IBLOCK,
        ];

        if (!$id = $rsElement->Add($dctFields)) {
            $result["status"] = "iblock_error";
            $result["error"] = $rsElement->LAST_ERROR;

            $response->addHeader("HX-Trigger", "show-notify");
            $message = tpl("forms/modal-notify-success-message", [
                "message" => $rsElement->LAST_ERROR
            ]);

            return $response;
        }


        $response->addHeader("HX-Trigger", "show-notify");
        $message = tpl("forms/modal-notify-success-message", [
            "message" => "Заявка успешно отправлена"
        ]);
        $response->setContent($message . tpl("forms/footer-subscribe", $result));
        return $response;
    }
}
