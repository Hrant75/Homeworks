<?php

/**
 * Created by PhpStorm.
 * User: hrant
 * Date: 8/11/16
 * Time: 1:16 PM
 */

require_once "UserNameModel.php";

class UserNameView
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function output()
    {
        if( is_null($this->model->getError()) ){
            echo '
            <form action="index.php">
                <div class="form-group">
                     <label for="inputUserName">User Name</label>
                    <input type="text" class="form-control" name="username" id="inputUserName" placeholder="User Name">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form> ';
        } elseif (!$this->model->getError()){
            echo 'no such user';
        } elseif($this->model->getError()) {
            $this->niceOutput();
        }
    }

    private function niceOutput(){
        $gistsData = $this->model->getData();
        $usersData = $this->model->getUserData();

        echo '<div class="container">
                <div class="row">
                    <div class="col-md-1 text-left" style="padding-top: 10px">
                        <span>
                            <img src="'.$usersData->avatar_url.'" height="60">
                        </span>
                    </div>
                    <div class="col-md-4 text-left">
                                    <span>
                                        <span style="font-size:2em">'.$usersData->name.'</span><br>
                                        <span style="color:gray">'.$usersData->login.'</span>
                                    </span>
                    </div>
                    <div class="col-md-6 text-right" style="padding-top: 10px">
                        <a class="btn btn-info" href="'.$usersData->html_url.'">View '.$usersData->login.' on github</a>
                    </div>
                </div>
            </div><hr>';

            foreach ($gistsData as $key => $value){
                echo '
                    <div class="container" style="padding-top: 30px">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-1 text-left" style="padding-top: 10px">
                                <span>
                                    <img src="'.$usersData->avatar_url.'" height="30">
                                </span>
                            </div>
                            <div class="col-md-6 text-left">
                                <span>
                                    <span><b>'.$value->owner->login.'</span><br>
                                    <span>\\'.$value->description.'</b></span><br>
                                    <span>Created on <b>'.substr($value->created_at,0,-10).'</b></span><br>                                        
                                </span>
                            </div>
                            <div class="col-md-2 text-right" style="padding-top: 10px">
                                <span>'.count(get_object_vars( $value->files )).'files</span>
                                <a href="'.$value->comments_url.'">'.$value->comments.' comments</a></span>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                            
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-11"><br>';

                foreach ($value->files as $fileKey => $fileValue){
                    echo '<b>'.$fileValue->filename.'</b><br>';
                    $raw_url = file_get_contents($fileValue->raw_url);
                    echo '<textarea style="
                        width:80%;
                        display:block;
                        max-width:100%;
                        line-height:1.5;
                        padding:15px 15px 30px;
                        border-radius:3px;
                        border:1px solid rgba(247, 233, 141, 0.18);
                        font:13px Tahoma, cursive;
                        transition:box-shadow 0.5s ease;
                        box-shadow:0 4px 6px rgba(0,0,0,0.1);
                        font-smoothing:subpixel-antialiased;
                        background:rgba(247, 233, 141, 0.18);

                    " rows="7">' .$raw_url.'</textarea><br>';
                }
                echo '</div></div></div></div>';
            }

    }

//    private function outputData(){
//        $data = $this->model->getData();
//        echo count($data).' count data in view->outputData()<br>';
//        $username = $this->model->getUserName();
//
//        if(empty($data)) {
//            echo $username.' has no any gists<br>';
//        } else {
//            echo "<pre>";
//            print_r($data);
//            echo "</pre>";
//
//            echo '<br><br>';
//            $this->recursiveOutput($data);
//        }
//    }
//
//    private function recursiveOutput($data)
//    {
//        foreach ($data as $a => $b) {
//            if(!is_object($b)){
//                echo $a . ' => ';
//                if($a == 'raw_url'){
//                    echo '<b>'.$b.'</b>';
//                    $raw_url = file_get_contents($b);
//                     echo '<textarea style="
//                        width:80%;
//                        display:block;
//                        max-width:100%;
//                        line-height:1.5;
//                        padding:15px 15px 30px;
//                        border-radius:3px;
//                        border:1px solid rgba(247, 233, 141, 0.18);
//                        font:13px Tahoma, cursive;
//                        transition:box-shadow 0.5s ease;
//                        box-shadow:0 4px 6px rgba(0,0,0,0.1);
//                        font-smoothing:subpixel-antialiased;
//                        background:rgba(247, 233, 141, 0.18);
//
//                    " rows="7">' .$raw_url.'</textarea>';
////                    echo '<samp>'.$raw_url.'</samp>';
//
//                } else {
//                    echo $b . '<br>';
//                }
//            } else {
//                echo $a.' => ';
//                $this -> recursiveOutput($b);
//
//            }
//        }
//     }
}