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

    private static function sendHTMLMail($email,$subject,$body)
    {
        $sender_n    = \EventMail::t('mailer.sender_name');
        $sender_m    = \EventMail::config('mailer.sender_mail');
        
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= "To: {$email}". "\r\n";
        $headers .= "From: {$sender_n} <{$sender_m}>" . "\r\n";
        
        return mail($email, $subject, $body, $headers);
    }
}