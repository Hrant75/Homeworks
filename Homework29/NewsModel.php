<?php
require_once "DbConnection.php";
require_once "NewsRow.php";

class NewsModel
{

    public function __construct()
    {
        $this->dbConnection = new DbConnection();
    }

    public function getData($categoryID)
    {
        $sql = "
            SELECT
                `news`.`id`,
                `news`.`date`,
                `news`.`title`,
                `news`.`content`,
                `categories`.`category`,
                `news`.`media`
            FROM `news`
            JOIN `categories` ON `news`.`category_id` = `categories`.`id`
            ORDER BY `news`.`id` ASC
            ";
        if(!is_null($categoryID)){
            $sql .= " WHERE `category_id` ='".$categoryID."'";
        }

        $statement = $this->dbConnection->getConnection()->prepare($sql);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll();

        $allData = [];
        foreach ($result as $item) {
            $newsRow = new NewsRow();
            $newsRow->setID($item['id']);
            $newsRow->setDate($item['date']);
            $newsRow->setTitle($item['title']);
            $newsRow->setContent($item['content']);
            $newsRow->setCategory($item['category']);
            $newsRow->setMedia($item['media']);

            $allData[] = $newsRow;
        }
        return $allData;
    }

    public function deleteNews($newsID)
    {
        $statement = $this->dbConnection->getConnection()->prepare("DELETE FROM news WHERE id=".$newsID);
        $statement->execute();
    }

    public function saveNews(NewsRow $news)
    {
        if( is_null($news->getID()) ){
            // insert enq anum
            $sql = "INSERT INTO news (title, content, category_id) VALUES ('".$news->getTitle()."','".$news->getContent()."','".$news->getCategory()."')";
            $statement = $this->dbConnection->getConnection()->prepare($sql);
            $statement->execute();
        } else {
            // update enq anum
//            $sql = "UPDATE news SET category='".$category->getCategory()."' WHERE id=".getID();
//            $statement = $this->dbConnection->getConnection()->prepare($sql);
//            $statement->execute();
        }
    }
}