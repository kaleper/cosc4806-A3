<?php require_once 'app/views/templates/headerPublic.php'; ?>

<?php

// Displays invalid login attempts, if any & if failed auths < 3
if (isset($_SESSION['failedAuth']) && $_SESSION['failedAuth'] < 3) {
		// Displays below message if failed auths < 3
		
			echo "<p>
							Invalid credentials entered. 
							Number of failed login attempts: " . $_SESSION['failedAuth'] . ". Number of attempts remaining before account locked:" . (3 - $_SESSION['failedAuth']);
						"</p>";
		
	}; 

	// Displays lockout time, if any
if ($_SESSION['timeUnlocked'] - time() > 0) {
	echo "Account locked due to too many failed login attempts. Try again in " . ($_SESSION['timeUnlocked'] - time()) . " seconds.";
}
?>
	
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
				<label for="username">Username</label>
				<input required type="text" class="form-control" name="username">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input required type="password" class="form-control" name="password">
			</div>
            <br>
		    <button type="submit" class="btn btn-primary">Login</button>
				<a href="/create">Sign Up</a>
		</fieldset>
		</form> 
	</div>
</div>
    <?php require_once 'app/views/templates/footer.php' ?>
