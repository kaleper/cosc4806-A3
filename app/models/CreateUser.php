<?php

class CreateUser {

    public $username;
    public $password;
    public $uniqueLogin = false;

    public function __construct() {
        
    }

    public function test () {
      $db = db_connect();
      $statement = $db->prepare("select * from users;");
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function register($username, $password) {
        
		$username = strtolower($username);
		$db = db_connect();
        
        // Transforms password into non-plain text for security reasons
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepared statement for MariaDB to get username if exists
        $statement = $db->prepare("SELECT username FROM users WHERE username = :username");

         // Binds parameters from login attempt
        $statement->bindParam(':username', $username);

        // Executes on the filess.io end
        $statement->execute();

        // Retrieves credentials from filess.io database
        $usernameExists = $statement->fetch(PDO::FETCH_ASSOC);

        // Checks if a username exists already
        if ($usernameExists) {

          // Create session variable message to be displayed on register
          $_SESSION['taken_username_message'] = "Username already exists, please enter a different username.";
          header('location: /create');
          exit;

        // Unique username, add to database 
        } else {

          // Connect to database
          $db = db_connect();

          // Prepared statement to insert username and hashed password into database
          $statement = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :hashedPassword)");

          // Binds parameters from registration
          $statement->bindParam(':username', $username);
          $statement->bindParam(':hashedPassword', $hashedPassword);

          // Executes the statement
          $statement->execute();

          // Set session varviable to be displayed on login view 
          $_SESSION['successful_registration'] = "Account created successfully! Please login.";

          //Redirect back to login page
          header('location: /login');
          exit;
          
		}
  }
}
