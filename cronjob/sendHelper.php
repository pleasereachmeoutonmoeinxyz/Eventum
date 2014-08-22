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
        $mail->Host         =   self::getInstance()->config('SMTP_HOST');
        $mail->Port         =   self::getInstance()->config('SMTP_PORT');
        $mail->SMTPAuth     =   true;
        $mail->Subject      =   $subject;
        $mail->Username     =   self::getInstance()->config('SMTP_USERNAME');;
        $mail->Password     =   self::getInstance()->config('SMTP_PASSWORD');
        $mail->setFrom(self::getInstance()->config('SENDER_MAIL'), self::getInstance()->config('SENDER_NAME'));
        $mail->addReplyTo(self::getInstance()->config('REPLY_MAIL'));
        $mail->msgHTML($body);
        $mail->addAddress($to);
        return $mail->send();    
    }
}
?>