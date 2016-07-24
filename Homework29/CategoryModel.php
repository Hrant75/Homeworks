<?php
require_once "DbConnection.php";
require_once "CategoryRow.php";

class CategoryModel
{
//    private $dbTable;


    public function __construct()
    {
//        $this->dbTable = 'student';
        $this->dbConnection = new DbConnection();
    }

    public function getCategories()
    {
        $statement = $this->dbConnection->getConnection()->prepare("SELECT id, category FROM categories ORDER BY id ASC");
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll();

        $categories = [];
        foreach ($result as $item) {
            $category = new CategoryRow();
            $category->setID($item['id']);
            $category->setCategory($item['category']);
            $categories[] = $category;
        }
        return $categories;
    }
        
    public function getCategoryNameByID($id)  
    {
        $statement = $this->dbConnection->getConnection()->prepare("SELECT id, category FROM categories WHERE id=".$id);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll();
        
        $categoryName = $result[0]['category'];
        return $categoryName;
    }

    public function deleteCategory($categoryID)
    {
        $statement = $this->dbConnection->getConnection()->prepare("DELETE FROM categories WHERE id=".$categoryID);
        $statement->execute();
    }

    public function saveCategory(CategoryRow $category)
    {
        if( is_null($category->getID()) ){
            // insert enq anum
            $sql = "INSERT INTO categories (category) VALUES ('".$category->getCategory()."')";
            $statement = $this->dbConnection->getConnection()->prepare($sql);
            $statement->execute();
        } else {
            // update enq anum
            $sql = "UPDATE categories SET category='".$category->getCategory()."' WHERE id=".getID();
            $statement = $this->dbConnection->getConnection()->prepare($sql);
            $statement->execute();
        }
    }
    
}
