<?php

class CategoriesModel extends BaseModel{
    public function getAll(){
        $statement = self::$db->query("SELECT text FROM categories order by id;");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
}