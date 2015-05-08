<?php

class QuestionsController extends BaseController {
    private $db;

    public function onInit(){
        $this->title = "Questions";
        $this->db = new QuestionsModel();
    }

    public function index($page = 0, $pageSize = 10){
        $this->authorize();
        $from = $page * $pageSize;
        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->questions = $this->db->getFilteredQuestions($from, $pageSize);
        $this->renderView();
    }

    public function create(){
        $this->categories = $this->db->getAllCategories();
        $this->authorize();
        if($this->isPost){
            $text = $_POST['question_text'];
            $content = $_POST['question_content'];
            $categoryText = $_POST['question_category'];
            $categoryId = $this->db->getCategoryIdByText($categoryText);
            $userId = $this->db->getCurrentUserId();
            if(strlen($text) <= 5){
                $this->addFieldValue('question_text', $text);
                $this->addValidationError('question_text', 'The question text symbols should be greater than 5');
                return $this->renderView(__FUNCTION__);
            }
            if($this->db->createQuestion($text, $content, $userId, $categoryId)){
                $this->addInfoMessage("Question created.");
                $this->redirect('questions');
            } else{
                $this->addErrorMessage("Error creating question.");
            }
        }

        $this->renderView(__FUNCTION__);
    }

    public function viewQuestionInfo($id){
        $this->questionInfo = $this->db->getQuestionInfo($id);
        $this->comments = $this->db->getAllComments($id);
        $this->tags = $this->db->getQuestionTagsByQuestionId($id);
        $this->authorize();
        $this->renderView(__FUNCTION__);
    }

    public function delete($id){
        $this->authorize();
        if($this->db->deleteQuestion($id)){
            $this->addInfoMessage("Question deleted.");
        } else {
            $this->addErrorMessage("Error deleting question.");
        }
        $this->redirect('questions');
    }
}