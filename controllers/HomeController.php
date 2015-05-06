<?php

class HomeController extends BaseController{
    public function onInit(){
        $this->title = "Welcome To Home.";
    }

    public function index() {
        $this->renderView(__FUNCTION__);
    }
}