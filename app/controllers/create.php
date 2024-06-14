<?php

class Create extends Controller {

    public function index() {		
	    $this->view('create/index');
    }

    public function newAcc(){
      $username = $_REQUEST['username'];
      $password = $_REQUEST['password'];
  
      $user = $this->model('CreateUser');
      $user->register($username, $password); 
    }
}
