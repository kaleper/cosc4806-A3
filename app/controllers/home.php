<?php

class Home extends Controller {

    public function index() {
      $user = $this->model('AuthUser');
      $data = $user->test();
			
	    $this->view('home/index');
	    die;
    }

}
