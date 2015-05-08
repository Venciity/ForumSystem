<?php

class CategoriesModel extends BaseModel{
    public function getAll(){
        $statement = self::$db->query("SELECT text FROM categories order by id;");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getQuestionsInfoByCategory($text){

    }

    public function getAllCategories(){
        $statement = self::$db->query("SELECT text FROM categories order by id;");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategoryIdByText($text){
        $statement = self::$db->prepare("SELECT id FROM categories where text = ?");
        $statement->bind_param("s", $text);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result['id'];
    }
}