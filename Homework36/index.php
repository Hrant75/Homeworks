<!--/**
* Created by PhpStorm.
* User: hrant
* Date: 8/11/16
* Time: 1:09 PM
    Consumer Key: hhro155
    Consumer Secret: b1c5f3dd66b94e00
    Oauth Token : S=s1:U=92cfb:E=15ddc072078:C=1568455f100:P=185:A=hhro155:V=2:H=7a953a1c1c10e4f2f70525ee3621fee7
    oauth_token=hhro155.1568455EA91.687474703A2F2F687474703A2F2F6C6F63616C686F73742F44726F70626F782F486F6D65776F726B732F486F6D65776F726B33362F696E6465782E706870.2B089371BCFC2B2B13852156746A4891&oauth_verifier=EE2D093590625C1776AB58DF354B4E0D&sandbox_lnb=false
    notebooks : Name : First Notebook Guid : e4fa0c45-4bff-4f4f-807e-690a2e9b4ec8 Is Business : N Is Default : Y Is Linked : N Name : Sample Notebook Guid : cbe23c75-2b65-4f76-9e7b-3f61f58061c4 Is Business : N Is Default : N Is Linked : N
*/-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>simple-usage-of-github-gists-api-using-guzzle</title>
    <link href="main.css" rel="stylesheet">
<!--    <link href="bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Home Page</a>
        </div>
        <button type="button" class="btn btn-default navbar-btn"  data-toggle="modal" data-target="#addModal">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
    </div>
</nav>

<div class="container">
    <div class="row">

        <?php

        require_once 'vendor/autoload.php';

        $token = 'S=s1:U=92cfb:E=15ddc072078:C=1568455f100:P=185:A=hhro155:V=2:H=7a953a1c1c10e4f2f70525ee3621fee7';
        $sandbox = true;
        $china   = false;
        $client = new \Evernote\Client($token, $sandbox, null, null, $china);

        if(isset($_GET['delete'])){
            $note = new \Evernote\Model\Note();
            $note->guid = $_GET['delete'];
            $client->deleteNote($note);
        }
        if(isset($_POST['add'])){
            $note         = new \Evernote\Model\Note();
            $note->title  = $_POST['title'];
            $note->content = new \Evernote\Model\PlainTextNoteContent($_POST['content']);
            $client->uploadNote($note);
        }


        $notebooks = $client->listNotebooks();
        $search = new \Evernote\Model\Search('*');
        $notebook =  new \Evernote\Model\Notebook();//null;
        $notebook->notebookGuid='$notebooks[1]->guid';
        $scope = \Evernote\Client::SEARCH_SCOPE_ALL;
        $order = \Evernote\Client::SORT_ORDER_RECENTLY_CREATED;
        $results = $client->findNotesWithSearch($search, $notebook, $scope, $order);

        $notes = [];
        foreach ($results as $result){
            $note = $client->getNote($result->guid);
            $notes[] = array('guid'=>$note->guid, 'title'=>$note->title, 'content'=>$note->content,
                'created'=>$note->created, 'notebookGuide'=>$note->notebookGuid );
        }
        $i = 0;
        foreach ($notes as $note){
            echo '<div class="notes">
                    <input type="radio" name="notes" value="'.$note["guid"].'"
                id="'.$i.'">
                        <div class="note" id="'.$note["guid"].'">'.$note["content"].'</div>
                  </input>
                    <label for="'.$i.'"> '.$note["title"].' <br>
                        <span class="created">Created on '.time_elapsed_string($note["created"]).' ago</span>
                        <a class="deleteIcon" href="index.php?delete='.$note["guid"].'">
                            <span class="glyphicon glyphicon-scissors"></span>
                        </a></label>
                    <br></div><br> ';
            echo '';
            $i++;
        }
        require_once 'add.php';
        ?>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>


<?php
function time_elapsed_string($ptime)
{
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'year',
        30 * 24 * 60 * 60  =>  'month',
        24 * 60 * 60  =>  'day',
        60 * 60  =>  'hour',
        60  =>  'minute',
        1  =>  'second'
    );
    $a_plural = array( 'year'   => 'years',
        'month'  => 'months',
        'day'    => 'days',
        'hour'   => 'hours',
        'minute' => 'minutes',
        'second' => 'seconds'
    );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
}
?>