<?php
namespace Helper;
class Mailer{
    public static function settingMailUrl($email,$id,$secure_code){
        
        // generate urls
        $settingUrl         = \EventMail::url('setting',array('id'=>$id,'code'=>$secure_code));
        $unsubscribeUrl     = \EventMail::url('unsubscribe',array('id'=>$id,'code'=>$secure_code));
        // generate subject
        $subject            = \EventMail::t('mailer.setting_subject');
        // generate mail body
        $body               = \EventMail::render('mailer/setting', array(
            'header'            =>  $subject,
            'setting_url'       =>  $settingUrl,
            'unsubscribe_url'   =>  $unsubscribeUrl
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