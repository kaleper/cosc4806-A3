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
		
		// Checks if credentials are valid and session is not currenty locked to authorize user and pass username into   session variable
      if (password_verify($password, $rows['password']) && !isset($_SESSION['timeLocked'])) {
			$_SESSION['auth'] = 1;
			$_SESSION['username'] = ucwords($username);
			unset($_SESSION['failedAuth']);

      //Add attempt to database
      $statement2 = $db->prepare("INSERT INTO login_log(username, successful_attempt, time) VALUES (:name, 1, NOW());");
      $statement2->bindValue(':name', $username);
      $statement2 ->execute();

      return true;  
      
		} else {

      //If currenty locked, prevent user from attempting any logins even if correct
      if(isset($_SESSION['timeLocked'])) {
        // Set locked message to be displayed 
        $_SESSION['lockedMsg'] = " ";

          // Time still remaining in locked period, return false
         if (time() < $_SESSION['timeUnlocked']) {
           
          // Auth ends until unlocked
          return false;
           // Locked period over, unset failed auth and lock session variables
         } else {
           // Unlock account by unsetting session variables

           unset($_SESSION['timeLocked']);
           unset($_SESSION['timeUnlocked']);
           unset($_SESSION['failedAuth']);
         }
        }
      }

			if(isset($_SESSION['failedAuth'])) {

        //Lock account if 3 failed login attempts
        if ($_SESSION['failedAuth'] == 2) {

          // Get starting time that user will be locked out
          $timeLocked = time();

          // Set session variable to display message
          $_SESSION['lockedMsg'] = " ";;
          
          // Lockout period is 60s; get the remaining time before unlocked
          $timeUnlocked = $timeLocked + 60;

          // Track times in session variables
          $_SESSION['timeLocked'] = $timeLocked;
          $_SESSION['timeUnlocked'] = $timeUnlocked;
          $_SESSION['failedAuth'] ++; 

        } else {
          // Increment failed auth amount and set message variable 
				  $_SESSION['failedAuth'] ++; 
          $_SESSION['failedAuthMsg'] = " ";;
        }
			} else {
        // Not set, set failed auth to 1 and set message variable 
				$_SESSION['failedAuth'] = 1;
        $_SESSION['failedAuthMsg'] = " ";;
			}

      //Add attempt to database
      $statement3 = $db->prepare("INSERT INTO login_log(username, successful_attempt, time) VALUES (:name, 0, NOW());");

      $statement3->bindValue(':name', $username);
      $statement3->execute();
			
      return false;
     
  }
}
