<?php

require 'row.php';

class Table
{
    private $row;
    private $column_count;


    public function __construct()
    {
        $this->row = [];
    }

    public function addTableRows(Row $row){
        $this->row[] = $row;
        $this->column_count =  $row->getColumnCount();
    }


    public function drawHeader(){
        echo '<tr>';
        for($i=0; $i<$this->column_count; $i++){
            echo '<th>'.($i+1).'x</th>';
        }
        echo '</tr>';
    }

    public function drawTable(){
        echo '<table class="table  table-striped">';
        $this->drawHeader();
            foreach ($this->row as $row){
                $row->draw();
            }
        echo '</table>';
    }
}
?>