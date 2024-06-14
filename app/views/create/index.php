<?php

    // Displays username taken message
    if ($_SESSION['taken_username_message']) {
         
        echo "<p id='invalid-registration'>" . 
              $_SESSION['taken_username_message'] .
              "</p>";
    
        unset($_SESSION['taken_username_message']);
        
    }; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="/app/views/css/create.css">
</head>

<main role="main" class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>Sign Up</h1>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-sm-auto">
    <form action="/create/newAcc" method="post" >
    <fieldset>
        <div id ="main-form">
              <div class="form-group">
                  <div id="label-and-input">
                    <label for="username">Username: </label>
                      <!-- Uses regular expression, username must have at least 3 characters -->
                    <input required type="text" class="form-control" name="username" pattern=".{3,}" required>
                  </div>
                  
              </div>
               
              <div class="form-group">
                  <div id="label-and-input">
                        <label for="password">Password: </label>
                       <!-- Uses regular expression, password must have at least one number, one uppercase and lowercase letter, one symbol and a length of 8 characters -->
                        <input required type="password" class="form-control" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w\d\s]).{8,}" required>
                  </div>
                
              </div>
                    <br>
            <div id= "button-container">
                <button type="submit" class="btn btn-primary">Create Account</button>
                <a href="/login/index">Login</a>
            </div>
        </div>
    <div id="credential-requirements">
        <div id="username-requirements">Minimum 3 characters</div>
        <div id="password-requirements">Minimum one number, one uppercase and lower case letter, one symbol and a length of 8 characters</div>
    </div>
    </fieldset>
    </form> 
  </div>
</div>