<?php

class AuthUser {

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {
        
    }

    public function test () {
      $db = db_connect();
      $statement = $db->prepare("select * from users;");
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function authenticate($username, $password) {
        
		$username = strtolower($username);
		$db = db_connect();
        $statement = $db->prepare("select * from users WHERE username = :name;");
        $statement->bindValue(':name', $username);
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
		
		if (password_verify($password, $rows['password'])) {
			$_SESSION['auth'] = 1;
			$_SESSION['username'] = ucwords($username);
			unset($_SESSION['failedAuth']);

      //Add attempt to database
      $statement2 = $db->prepare("INSERT INTO login_log(username, successful_attempt, time) VALUES (:name, 1, NOW());");
      $statement2->bindValue(':name', $username);
      $statement2 ->execute();

    return true;
      // Handle in controller? 
      //header('Location: /home');
			//die;
		} else {

      //Lock account if 3 failed login attempts
      if ($_SESSION['failedAuth'] == 3) {
        
      }
      
			if(isset($_SESSION['failedAuth'])) {
				$_SESSION['failedAuth'] ++; //increment
			} else {
				$_SESSION['failedAuth'] = 1;
			}

      //Add attempt to database
      $statement3 = $db->prepare("INSERT INTO login_log(username, successful_attempt, time) VALUES (:name, 0, NOW());");

      $statement3->bindValue(':name', $username);
      $statement3->execute();
			
      return false;
      // Handle in controller?
      //header('Location: /login');
			//die;
		}
    }

}
