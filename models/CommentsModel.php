<?php

class CommentsModel extends  BaseModel{

    public function getCurrentUserId(){
        $username = $_SESSION['username'];
        $statement = self::$db->prepare("SELECT id FROM users where username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result['id'];
    }

    public function commentQuestion($text, $question_id, $user_id){
        if ($text == '') {
            return false;
        }

        $statement = self::$db->prepare("INSERT INTO comments(id, text, question_id, user_id) VALUES(NULL, ?, ?, ?)");
        $statement->bind_param("sii", $text, $question_id, $user_id);
        $statement->execute();
        var_dump($statement->affected_rows);
        return $statement->affected_rows > 0;
    }

    public function deleteComment($id) {
        $statement = self::$db->prepare("DELETE FROM comments WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function getQuestionIdByCommentId($id){
        $statement = self::$db->prepare("SELECT question_id FROM comments WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result['question_id'];
    }

    public function getUserIdByQuestionId($id){
        $statement = self::$db->prepare("SELECT user_id FROM forum.questions where id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        return $result['user_id'];
    }
}