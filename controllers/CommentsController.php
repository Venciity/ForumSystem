<?php

class CommentsController  extends BaseController{
    private $db;

    public function onInit(){
        $this->title = "Comments";
        $this->db = new CommentsModel();
    }

    public function commentQuestion($id){
        echo "$id";
        $_SESSION['commentId'] = $id;
        $this->authorize();
        if($this->isPost){
            $content = $_POST['comment_content'];
            $userId = $this->db->getCurrentUserId();
            if(strlen($content) <= 5){
                $this->addFieldValue('comment_content', $content);
                $this->addValidationError('comment_content', 'The comment content symbols should be greater than 5');
                return $this->renderView(__FUNCTION__);
            }
            if($this->db->commentQuestion($content, $id, $userId)){
                $this->addInfoMessage("Answer created.");
                unset($_SESSION['commentId']);
                $this->redirect('questions');
            } else{
                $this->addErrorMessage("Error creating answer.");
            }
        }

        $this->renderView(__FUNCTION__);
    }
}