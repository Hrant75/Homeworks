<?php

/**
 * Created by PhpStorm.
 * User: hrant
 * Date: 8/11/16
 * Time: 1:15 PM
 */

require_once 'vendor/autoload.php';
use GuzzleHttp\Client;

class UserNameModel
{
    private $userName;
    private $error;
    private $gistsData;
    private $userData;
        
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
    
    public function getUserName()
    {
        return $this->userName;
    }
    
    public function getData()
    {
        $client = new Client(["base_uri" => "https://api.github.com"]);

        $response = $client->get('/users/'.$this->userName.'/gists');

        $body = $response->getBody();

        $content = json_decode($body->getContents());

        $this->setGistsData($content);
        return $content;
    }
    
    public function setError($error)
    {
        $this->error = $error;
    }
    
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return mixed
     */
    public function getGistsData()
    {
        return $this->gistsData;
    }

    /**
     * @param mixed $gistsData
     */
    public function setGistsData($gistsData)
    {
        $this->gistsData = $gistsData;
    }

    /**
     * @return mixed
     */
    public function getUserData()
    {
        return $this->userData;
    }

    /**
     * @param mixed $userData
     */
    public function setUserData($userData)
    {
        $this->userData = $userData;
    }
}