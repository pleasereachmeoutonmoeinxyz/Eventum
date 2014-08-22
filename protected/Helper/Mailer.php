<?php
namespace Helper;
class Mailer{
    public static function settingMailUrl($email,$id,$code){
        $subject            = \EventMail::t('mailer.setting_subject');
        $body               = \EventMail::render('mailer/setting.html', array(
            'header'            =>  $subject,
            'id'                =>  $id,
            'code'              =>  $code
        ));
        return self::sendHTMLMail($email, $subject, $body);
    }
    
    public static function eventUrl($email,$id,$code){
        $subject                 = \EventMail::t('mailer.event_subject');
        // generate mail body
        $body               = \EventMail::render('mailer/event.html', array(
            'header'            =>  $subject,
            'id'                =>  $id,
            'code'              =>  $code
        ));
        // send mail
        return self::sendHTMLMail($email, $subject, $body);        
    }

    private static function sendHTMLMail($email,$subject,$body,$smtp = true)
    {
        if ($smtp){
            return self::sendHTMLMailBySMTP($email, $subject, $body);
        }
            
        $sender_n    = \EventMail::t('mailer.sender_name');
        $sender_m    = \EventMail::config('mailer.sender_mail');
        
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= "To: {$email}". "\r\n";
        $headers .= "From: {$sender_n} <{$sender_m}>" . "\r\n";
        
        return mail($email, $subject, $body, $headers);
    }
    
    private static function sendHTMLMailBySMTP($email,$subject,$body){
        $mail   =   new \PHPMailer();
        $mail->isSMTP();
        $mail->Host =   \EventMail::config('mailer.smtp_host');
        $mail->Port =   \EventMail::config('mailer.smtp_port');
        $mail->SMTPAuth   = true;
        $mail->Subject  =   $subject;
        $mail->Username =   \EventMail::config('mailer.smtp_username');
        $mail->Password =   \EventMail::config('mailer.smtp_password');
        $mail->setFrom(\EventMail::config('mailer.sender_mail'), \EventMail::t('mailer.sender_name'));
        $mail->addReplyTo(\EventMail::config('mailer.reply_mail'));
        $mail->msgHTML($body);
        $mail->addAddress($email);
        try{
            return $mail->send();
        } catch (\phpmailerException $ex) {
            \Rollbar::report_exception($ex);
            return false;
        }
    }
}