<?php

class sendHelper{
    private static $instance    =   null;
    public $mandrill;
    public $config;
    
    public function __construct() {
        $this->config       = include (dirname(__FILE__))."/config.php";
    }
    
    /**
     * single instance of sendHelper
     * @return sendHelper
     */
    private static function getInstance(){
        if (!isset(self::$instance))
            self::$instance    =   new self();
        return self::$instance;
    }
    
    public static function sendByPHP($to,$subject,$body,$header){
        return mail($to,$subject,$body,$header);
    }
    
    public static function sendBySMTP($to,$subject,$body){
        $mail               =   new \PHPMailer();
        $mail->isSMTP();
        $mail->Host         =   self::getInstance()->config('mailer.smtp_host');
        $mail->Port         =   self::getInstance()->config('mailer.smtp_port');
        $mail->SMTPAuth     =   true;
        $mail->Subject      =   $subject;
        $mail->Username     =   self::getInstance()->config('mailer.smtp_username');;
        $mail->Password     =   self::getInstance()->config('mailer.smtp_password');
        $mail->setFrom(self::getInstance()->config('mailer.sender_mail'), self::getInstance()->config('mailer.sender_name'));
        $mail->addReplyTo(self::getInstance()->config('mailer.reply_mail'));
        $mail->msgHTML($body);
        $mail->addAddress($to);
        return $mail->send();    
    }
}
?>