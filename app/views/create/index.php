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
      <div class="form-group">
        <label for="username">Username: </label>
        <input required type="text" class="form-control" name="username">
      </div>
      <div class="form-group">
        <label for="password">Password: </label>
        <input required type="password" class="form-control" name="password">
      </div>
            <br>
    <div id= "button-container">
        <button type="submit" class="btn btn-primary">Create Account</button>
        <a href="/login/index">Login</a>
    </div>
    </fieldset>
    </form> 
  </div>
</div>

