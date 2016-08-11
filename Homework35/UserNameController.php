<?php

/**
 * Created by PhpStorm.
 * User: hrant
 * Date: 8/11/16
 * Time: 1:15 PM
 */
require_once 'vendor/autoload.php';
require_once "UserNameModel.php";
use GuzzleHttp\Client;

class UserNameController
{
    private $username;
    private $model;
    
    public function __construct($model)
    {
        $this->model  = $model;
    }

    public function setUserName($username){
        $this->username = $username;
        $isUserNameExist = $this->checkUserName();

       if(!$isUserNameExist){
           $this->model->setError($isUserNameExist);
       } else {
           $this->model->setUserName($this->username);
           $this->model->setError($this->username);
       }
    }

    public function checkUserName(){

        $response = NULL;
        $client = new Client(["base_uri" => "https://api.github.com"]);
        try {
            $response = $client->get('/users/'.$this->username);
            $body = $response->getBody();
            $content = json_decode($body->getContents());

            if(isset($content->login)){
                $this->model->setUserData($content);
                return true;
            } else {
                return false;
            }
            return false;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return false;
        }
        return false;
    }
}