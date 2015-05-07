<?php

class QuestionsModel extends BaseModel{
    public function getAll(){
        $statement = self::$db->query(
            "SELECT q.id, q.text, q.content, c.text as category, u.username as user
             FROM questions as q
               JOIN categories as c ON q.category_id = c.id
               JOIN users as u ON q.user_id = u.id ORDER BY id");
        return $statement->fetch_all(MYSQLI_ASSOC);
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

    public function getCurrentUserId(){
        $username = $_SESSION['username'];
        $statement = self::$db->prepare("SELECT id FROM users where username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result['id'];
    }

    public function createQuestion($text, $userId, $categoryId) {
        if ($text == '') {
            return false;
        }

        $statement = self::$db->prepare("INSERT INTO questions VALUES(NULL, ?, ?, ?)");
        $statement->bind_param("sii", $text, $userId, $categoryId);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function deleteQuestion($id) {
        $statement = self::$db->prepare("DELETE FROM questions WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}