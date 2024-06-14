<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link rel="stylesheet" href="/app/views/css/home.css">
</head>

<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12">
                <h1>Welcome, <?=$_SESSION['username']?></h1>
                <p id="date"> <span id ="date-label">Today's Date:</span> <?= date("F jS, Y"); ?></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="logout">
            <p> <a href="/logout">Click here to logout</a></p>
        </div>
    </div>
