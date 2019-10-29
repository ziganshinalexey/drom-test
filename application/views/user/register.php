<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>sign up</title>
    <link rel="stylesheet" href="/assets/todomvc-app-css/index.css">
</head>
<body>
<section class="todoapp">
    <h1>Sign Up</h1>
    <form action="/user/register" method="post" class="form">
        <input name="login" class="edit" placeholder="Login" autofocus>
        <input name="password" class="edit" type="password" placeholder="Password">
        <input name="firstName" class="edit" placeholder="First name">
        <input name="lastName" class="edit" placeholder="Last name">
        <button class="edit" type="submit">Send</button>
    </form>
</section>
<footer class="info">
    <p><a href="/user/login">Sign In</a></p>
    <p>Created by <a href="https://vk.com/alexey_ziganshin">Ziganshin Alexey</a></p>
</footer>
</body>
</html>
