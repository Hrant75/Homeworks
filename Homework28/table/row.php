<?php

class Row
{
    private $content;
    
    public function __construct()
    {
        $this->content = [];
    }

    public function setContent($content){
        for($i=0; $i<count($content); $i++){
            $this->content[] = $content[$i];
        }
    }

    public function getColumnCount(){
        return count($this->content);
    }
    
    public function draw(){
        echo '<tr>';
        for($i=0; $i<count($this->content); $i++){
            echo '<td>'.$this->content[$i].'</td>';
        }
        echo '</tr>';
    }
}

?>