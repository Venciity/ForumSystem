<?php

class QuestionsModel extends BaseModel{
    public function getAll(){
        $statement = self::$db->query(
            "SELECT q.id, q.text, q.content, q.visits_count, c.text as category, u.username as user
             FROM questions as q LIMIT ?, ?
               JOIN categories as c ON q.category_id = c.id
               JOIN users as u ON q.user_id = u.id ORDER DESC BY id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getFilteredQuestions($from, $size){
        $statement = self::$db->prepare("SELECT q.id, q.text, q.content, q.visits_count, c.text as category, u.username as user
             FROM questions as q
               JOIN categories as c ON q.category_id = c.id
               JOIN users as u ON q.user_id = u.id ORDER BY id DESC LIMIT ?, ?");
        $statement->bind_param("ii", $from, $size);
        $statement->execute();
        $result = $statement->get_result()->fetch_all();
        return $result;
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

    public function getAllComments($id){
        $statement = self::$db->query(
            "SELECT c.id, c.text, u.username as user
             FROM questions as q
               JOIN comments as c on q.id = c.question_id
               JOIN users as u on u.id = c.user_id
               where q.id = $id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function createQuestion($text, $content, $userId, $categoryId, $tags) {
        if (!isset($_POST['formToken']) || $_POST['formToken'] != $_SESSION['formToken']) {
            echo "Warning: CSRF!";
            exit;
        }
        if ($text == '') {
            return false;
        }

        $statement = self::$db->prepare("INSERT INTO questions(id, text, content, user_id, category_id) VALUES(NULL, ?, ?, ?, ?)");
        $statement->bind_param("ssii", $text, $content, $userId, $categoryId);
        $statement->execute();

        foreach ($tags as $tag){
            $tagId = $this->getTagIdByText($tag);
            $lastQuestionId = $this->getLastQuestionId();
            if($tagId != null){
                $this->insertTagForQuestion($lastQuestionId, $tagId);
            } else {
                $this->insertTag($tag);
                $lastTagId = $this->getLatTagId();
                $this->insertTagForQuestion($lastQuestionId, $lastTagId);
            }
        }

        return $statement->affected_rows > 0;
    }

    public function getLatTagId(){
        $statementGetLastTagId = self::$db->prepare("SELECT id FROM tags order by id desc LIMIT 1;");
        $statementGetLastTagId->execute();
        $result = $statementGetLastTagId->get_result()->fetch_assoc();
        return $result['id'];
    }

    public function insertTag($text){
        $statementInsertTag = self::$db->prepare("INSERT INTO tags(text) VALUES(?)");
        $statementInsertTag->bind_param("s", $text);
        $statementInsertTag->execute();
    }

    public function getLastQuestionId(){
        $statementLastQuestionId = self::$db->prepare("SELECT id FROM questions order by id desc LIMIT 1;");
        $statementLastQuestionId->execute();
        $result = $statementLastQuestionId->get_result()->fetch_assoc();
        return $result['id'];
    }

    public function insertTagForQuestion($question_id, $tag_id){
        $statement = self::$db->prepare("INSERT INTO questions_tags(question_id, tag_id) VALUES(?, ?)");
        $statement->bind_param("ii", $question_id, $tag_id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function getTagIdByText($text){
        $statement = self::$db->prepare("SELECT id FROM forum.tags where text = ? ");
        $statement->bind_param("s", $text);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result['id'];
    }

    public function deleteQuestion($id) {
        $statement = self::$db->prepare("DELETE FROM questions WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function getUserIdByQuestionId($id){
        $statement = self::$db->prepare("SELECT user_id FROM forum.questions where id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result['user_id'];
    }
}
?>