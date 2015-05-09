<?php

class CommentsController  extends BaseController{
    private $db;

    public function onInit(){
        $this->title = "Comments";
        $this->db = new CommentsModel();
    }

    public function commentQuestion($id){
        $_SESSION['commentId'] = $id;
        $this->authorize();
        if($this->isPost){
            $content = $_POST['comment_content'];
            $userId = $this->db->getCurrentUserId();
            if(strlen($content) <= 5){
                $this->addErrorMessage("The comment content symbols should be greater than 5");
                return $this->renderView(__FUNCTION__);
            }
            if($this->db->commentQuestion($content, $id, $userId)){
                $this->addInfoMessage("Answer created.");
                unset($_SESSION['commentId']);
                $this->redirectToUrl('questions/viewQuestionInfo/' . $id);
            } else{
                $this->addErrorMessage("Error creating answer.");
            }
        }

        $this->renderView(__FUNCTION__);
    }

    public function delete($id){
        $this->authorize();
        $question_id = $this->db->getQuestionIdByCommentId($id);
        if($this->db->deleteComment($id)){
            $this->addInfoMessage("Comment deleted.");
        } else {
            $this->addErrorMessage("Error deleting comment.");
        }
        $this->redirectToUrl('questions/viewQuestionInfo/' . $question_id);
    }
}