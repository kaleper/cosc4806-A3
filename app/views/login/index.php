<?php

// Displays invalid login attempts, if any & if failed auths < 3
if (isset($_SESSION['failedAuth']) && $_SESSION['failedAuth'] < 3 && isset($_SESSION['failedAuthMsg'])) {
		// Displays below message if failed auths < 3
		
			echo "<p id='invalid-attempt'>
							INVALID CREDENTIALS ENTERED <br>
							Number of failed login attempts: " . $_SESSION['failedAuth'] . 
							" <br> Number of attempts remaining before account locked: " . (3 - $_SESSION['failedAuth']);
						"</p>";

	unset($_SESSION['failedAuthMsg']);
		
	}; 

	// Displays lockout time, if any
if ($_SESSION['timeUnlocked'] - time() > 0 && isset($_SESSION['lockedMsg'])) {
	echo "<p id= 'account-locked'> 
					Account locked due to too many failed login attempts. <br>
					Try again in " . ($_SESSION['timeUnlocked'] - time()) 
					. " seconds.
				</p>";

	unset($_SESSION['lockedMsg']);
}

	if  (isset($_SESSION['successful_registration'])) {
				echo "<p id = 'successful-registration'>" . $_SESSION['successful_registration'] . 
							"</p>";
							
				// Unset session variable to only display message once 
				unset($_SESSION['successful_registration']);
	}
?>



<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login</title>
		<link rel="stylesheet" href="/app/views/css/login.css">
</head>
	
<main role="main" class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>You are not logged in</h1>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-sm-auto">
		<form action="/login/verify" method="post" >
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
		    <button type="submit" class="btn btn-primary">Login</button>
				<a href="/create">Sign Up</a>
			</div>

			
		
			
		</fieldset>
		</form> 
	</div>
</div>
