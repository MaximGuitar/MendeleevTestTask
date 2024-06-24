<?php
  namespace Placestart;

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  use Placestart\Utils;

  Class Mailer{
    public static function send($tpl_name, $params, $subject, $file_key = false){
      $result = ['status' => 'success'];

      try{
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = $_ENV['MAILER_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['MAILER_USER'];
        $mail->Password   = $_ENV['MAILER_PASS'];
        $mail->Port = $_ENV['MAILER_PORT'];
        $mail->CharSet = 'UTF-8';
        $mail->isHTML();
        $mail->setFrom($_ENV['MAILER_SENDER'], $_ENV['MAILER_SENDER_NAME']);
        $mail->addBCC($_ENV['MAILER_BCC']);

        $feedback_mail = Utils::getSiteOption('site_feedback_mail');
        if ($feedback_mail){
          $mails = explode(',', $feedback_mail);
          foreach ($mails as $address){
            $mail->addAddress(trim($address));
          }
        }

        if ($file_key && isset($_FILES[$file_key])){
          if ($_FILES[$file_key]['error'] == 0)
            $mail->addAttachment($_FILES[$file_key]['tmp_name'], $_FILES[$file_key]['name']);
        }

        $body = self::createMailTemplate($tpl_name, $params);
        $footer = self::createMailTemplate('mail-footer', [
          'ip' => $_SERVER['REMOTE_ADDR'],
          'info' => $_SERVER['HTTP_USER_AGENT'],
          'link' => $_SERVER['HTTP_REFERER'],
          'date' => date('d.m.Y'),
          'time' => date('G:i')
        ]);
        
        $mail->Subject = $subject;
        $mail->Body = $body.$footer;
        $mail->send();
      }
      catch(Exception $e){
        $result['status'] = "mail-not-sent";
        $result['message'] = $mail->ErrorInfo;
      }
      
      return $result;
    }

    private static function createMailTemplate($tpl_name, $params){
      $html = tpl("mail/$tpl_name", $params, false);
		  return $html;
    }
  }
?>