<?php

/**
 * Created by PhpStorm.
 * User: nemanja
 * Date: 18.4.16.
 * Time: 19.56
 */
class gcm_push
{

    // push message title
    private $title;

    // push message payload
    private $data;

    // flag indicating background task on push received
    private $is_background;

    // flag to indicate the type of notification
    private $flag;

    function __construct() {

    }

    /*
     * Notification */
    public function setNotifyTitle($notifyTitle){
        $this->notifyTitle = $notifyTitle;
    }
    public function setNotifyBody($notifyBody){
        $this->notifyBody = $notifyBody;
    }
    public function setNotifyIcon($notifyIcon){
        $this->notifyIcon = $notifyIcon;
    }
    public function setNotifyColor($notifyColor){
        $this->notifyColor = $notifyColor;
    }
    public function setNotifySound($notifySound){
        $this->notifySound = $notifySound;
    }

    public function getPushNotify(){
        $res = array();
        $res['title'] = $this->notifyTitle;
        $res['body'] = $this->notifyBody;
        $res['icon'] = $this->notifyIcon;
        $res['color'] = $this->notifyColor;
        $res['sound'] = $this->notifySound;
        return $res;
    }

    /*
     * Data
     * */
    public function setMessage($message){
        $this->message = $message;
    }

    public function getPushData(){
        /*$res = array();
        $res['data'] = $this->data;
        return $res;*/
        return $this->data;
    }


    /*
     * ORG
     * */
    public function setTitle($title){
        $this->title = $title;
    }

    public function setData($data){
        $this->data = $data;
    }

    public function setIsBackground($is_background){
        $this->is_background = $is_background;
    }

    public function setFlag($flag){
        $this->flag = $flag;
    }

    public function getPush(){
        $res = array();
        $res['title'] = $this->title;
        $res['is_background'] = $this->is_background;
        $res['flag'] = $this->flag;
        $res['data'] = $this->data;

        return $res;
    }


}