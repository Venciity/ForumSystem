<?php

class HomeController extends BaseController{
    public function onInit(){
        $this->title = "Welcome To Home.";
        if($this->isLoggedIn){
            $this->redirectToUrl("questions");
        }
    }

    public function index() {
        $this->renderView(__FUNCTION__);
    }
}