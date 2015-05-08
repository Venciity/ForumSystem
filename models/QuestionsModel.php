<?php

include_once("CategoriesModel.php");

class QuestionsModel extends BaseModel{
    public function getAll(){
        $statement = self::$db->query(
            "SELECT q.id, q.text, q.content, q.visits_count, c.text as category, u.username as user
             FROM questions as q
               JOIN categories as c ON q.category_id = c.id
               JOIN users as u ON q.user_id = u.id ORDER BY id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getQuestionInfo($id){
        $statement = self::$db->prepare("UPDATE questions SET visits_count = visits_count + 1 WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();

        $statement = self::$db->query(
            "SELECT q.id, q.text, q.content, q.visits_count, c.text as category, u.username as user
             FROM questions as q
               JOIN categories as c ON q.category_id = c.id
               JOIN users as u ON q.user_id = u.id WHERE q.id = $id ORDER BY q.id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getQuestionTagsByQuestionId($id){
        $statement = self::$db->query("SELECT t.text
             FROM questions as q
               JOIN categories as c ON q.category_id = c.id
               JOIN questions_tags qt ON q.id = qt.question_id
               JOIN tags t ON t.id = qt.tag_id
               WHERE q.id = $id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    // TODO: move this later ------------------------
    public function getAllCategories(){
        $statement = self::$db->query("SELECT text FROM categories order by id;");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    // TODO: move this later ------------------------
    public function getCategoryIdByText($text){
        $statement = self::$db->prepare("SELECT id FROM categories where text = ?");
        $statement->bind_param("s", $text);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result['id'];
    }

    // TODO: move this later ------------------------
    public function getCurrentUserId(){
        $username = $_SESSION['username'];
        $statement = self::$db->prepare("SELECT id FROM users where username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result['id'];
    }

    // TODO: move this later ------------------------
    public function getAllComments($id){
        $statement = self::$db->query(
            "SELECT c.id, c.text, u.username as user
             FROM questions as q
               JOIN comments as c on q.id = c.question_id
               JOIN users as u on u.id = c.user_id
               where q.id = $id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function createQuestion($text, $content, $userId, $categoryId) {
        if ($text == '') {
            return false;
        }

        $statement = self::$db->prepare("INSERT INTO questions(id, text, content, user_id, category_id) VALUES(NULL, ?, ?, ?, ?)");
        $statement->bind_param("ssii", $text, $content, $userId, $categoryId);
        $statement->execute();
        var_dump($statement->affected_rows);
        return $statement->affected_rows > 0;
    }

    public function deleteQuestion($id) {
        $statement = self::$db->prepare("DELETE FROM questions WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}