<?php

class CommentsModel extends  BaseModel{
//    public function getAllComments($id){
//        $statement = self::$db->query(
//            "SELECT c.text
//             FROM questions as q
//               JOIN comments as c on q.id = c.question_id
//               where q.id = $id");
//        return $statement->fetch_all(MYSQLI_ASSOC);
//    }

    // TODO: move this later ------------------------
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
}