<?php

class AccountsController extends  BaseController{
    private $db;

    public function onInit(){
        $this->db = new AccountsModel();
    }

    public function register(){
        if($this->isPost){
            $username = $_POST['username'];
            if($username == null || strlen($username) < 3){
               $this->addErrorMessage("Username is invalid.");
                return $this->redirect("accounts", "register");
            }
            $password = $_POST['password'];
            $isRegistered = $this->db->register($username, $password);
            if($isRegistered){
                $_SESSION['username'] = $username;
                $this->addInfoMessage("Successfully register.");
                return $this->redirect("home");
            } else {$this->addErrorMessage("Register account failed.");
                return $this->redirect("home");
            }
        }

        $this->renderView(__FUNCTION__);
    }

    public function login(){
        if($this->isPost){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $isLoggedIn = $this->db->login($username, $password);
            if($isLoggedIn){
                $_SESSION['username'] = $username;
                $this->addInfoMessage("Successfully login.");
                return $this->redirect("home");
            } else {
                $this->addErrorMessage("Login error.");
            }
        }

        $this->renderView(__FUNCTION__);
    }

    public function logout(){
        $this->authorize();
        unset($_SESSION['username']);
        $this->addInfoMessage("Successfully logout");
        $this->redirectToUrl("");
    }
}