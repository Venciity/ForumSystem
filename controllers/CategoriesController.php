<?php

class CategoriesController extends BaseController{
    private $db;

    public function onInit(){
        $this->title = "Categories";
        $this->db = new CategoriesModel();
    }

    public function index(){
        $this->authorize();
        $this->categories = $this->db->getAll();
        $this->renderView();
    }

    public function getCategories(){
        $this->categories = $this->db->getAll();
        $this->renderView(__FUNCTION__, false);
    }

}