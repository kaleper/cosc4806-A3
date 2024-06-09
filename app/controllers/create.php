<?php

class Create extends Controller {

    public function index() {		
	    $this->view('create/index');
    }

    public function newAcc(){
      $username = $_REQUEST['username'];
      $password = $_REQUEST['password'];

      echo $username;
  
      $user = $this->model('User');
      $user->authenticate($username, $password); 
    }
}
