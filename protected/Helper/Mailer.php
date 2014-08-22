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
        if (\EventMail::config('mailer.smtp')){
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
    
    private static function sendHTMLMailBySMTP($to,$subject,$body){
        $transport = \Swift_SmtpTransport::newInstance(\EventMail::config('mailer.smtp_host'), \EventMail::config('mailer.smtp_port'))
            ->setUsername(\EventMail::config('mailer.smtp_username'))
            ->setPassword(\EventMail::config('mailer.smtp_password'));        
        
        $mailer = \Swift_Mailer::newInstance($transport);
        $message = \Swift_Message::newInstance($subject)
            ->setFrom(array(\EventMail::config('mailer.sender_mail') => \EventMail::t('mailer.sender_name')))
            ->setReplyTo(\EventMail::config('mailer.reply_mail'))
            ->setTo(array($to))
            ->setBody($body,'text/html','UTF-8');
        
        return (bool)$mailer->send($message);    
    }
}