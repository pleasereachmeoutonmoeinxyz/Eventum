<?php

class mailHelper{
    private static $instance    =   null;
    public $twig;
    public $config;
    /**
     * construct mailHelper class
     */
    public function __construct() {
        $loader = new Twig_Loader_Filesystem(dirname(__FILE__)."/views");
        $this->twig = new Twig_Environment($loader, array(
            'cache' => dirname(__FILE__)."/runtime/cache",
        ));
        $this->config   = include (dirname(__FILE__))."/config.php";
    }
    
    /**
     * single instance of mailHelper
     * @return mailHelper
     */
    private static function getInstance(){
        if (!isset(self::$instance))
            self::$instance    =   new self();
        return self::$instance;
    }
    
    /**
     * return email content
     * @param mixed $data
     * @param string $ref
     * @return string
     */
    public static function generateContent($data = array(),$ref = ''){
        $helper =   self::getInstance();
        return $helper->twig->render($ref,$data);
    }

    public static function generateUnsubscribeLink($id,$code){
        $helper =   self::getInstance();
        return $helper->config['URL_DEACTIVE_BASE'].'/'.$id.'/'.$code;
    }
    
    public static function generateSubscribeLink($id,$code){
        $helper =   self::getInstance();
        return $helper->config['URL_SETTING_BASE'].'/'.$id.'/'.$code;        
    }
    
    public static function generateEventUrl($id){
        $helper =   self::getInstance();
        return $helper->config['EVENT_VIEW_BASE'].'/'.$id;                
    }

    /**
     * return json of email
     * @param string $to
     * @param string $subject
     * @param string $body
     * @return mixed
     */
    public static function generateEmailJSON($to,$subject,$body){
        $helper =   self::getInstance();
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "{$helper->config['HEADER_FROM']}" . "\r\n";
        $headers .= "{$helper->config['HEADER_RETURN_PATH']}" . "\r\n";
        $headers .= "To: {$to}" . "\r\n";

        $data   =   array(
            'to'        =>  $to,
            'subject'   =>  $subject,
            'body'      =>  $body,
            'headers'   =>  $headers
        );

        return json_encode($data);
    }
}
?>