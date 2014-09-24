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
    
    /**
     * 
     * @param string $to
     * @param string $subject
     * @param string $body
     * @param string $header
     * @return type
     */
    public static function sendByPHP($to,$subject,$body,$header = null){
        return mail($to,$subject,$body,$header);
    }
    
    /**
     * 
     * @param string $to
     * @param string $subject
     * @param string $body
     * @return boolean
     */
    public static function sendBySMTP($email,$subject='',$body=''){
        $transport = \Swift_SmtpTransport::newInstance(self::getInstance()->config['SMTP_HOST'], self::getInstance()->config['SMTP_PORT'])
            ->setUsername(self::getInstance()->config['SMTP_USERNAME'])
            ->setPassword(self::getInstance()->config['SMTP_PASSWORD']);        
        
        $mailer = \Swift_Mailer::newInstance($transport);
        $message = \Swift_Message::newInstance($subject)
            ->setFrom(array(self::getInstance()->config['SENDER_MAIL'] => self::getInstance()->config['SENDER_NAME']))
            ->setReplyTo(self::getInstance()->config['REPLY_MAIL'])
            ->setTo(array($email))
            ->setBody($body,'text/html','UTF-8');
        return (bool) $mailer->send($message);
    }
}
?>