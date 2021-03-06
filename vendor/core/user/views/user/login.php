<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>sign in</title>
    <link rel="stylesheet" href="/assets/todomvc-app-css/index.css">
</head>
<body>
<section class="todoapp">
    <h1>Sign In</h1>
    <form id="login-form" action="/user/login" method="post" class="form">
        <input name="login" class="login edit" placeholder="Login" autofocus>
        <input name="password" class="password edit" type="password" placeholder="Password">
        <button class="edit" type="submit">Send</button>
    </form>
</section>
<footer class="info">
    <p><a href="/user/register">Sign Up</a></p>
    <p>Created by <a href="https://vk.com/alexey_ziganshin">Ziganshin Alexey</a></p>
</footer>
<script src="/assets/jquery/jquery.min.js"></script>
<script src="/assets/application/js/login.js"></script>
</body>
</html>
