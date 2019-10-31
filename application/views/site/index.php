<?php
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Template • TodoMVC</title>
    <link rel="stylesheet" href="/assets/todomvc-common/base.css">
    <link rel="stylesheet" href="/assets/todomvc-app-css/index.css">
    <!-- CSS overrides - remove if you don't need it -->
    <link rel="stylesheet" href="/assets/application/css/app.css">
</head>
<body>
<section class="todoapp">
    <header class="header">
        <h1>todos</h1>
        <input class="new-todo" placeholder="What needs to be done?" autofocus>
    </header>
    <!-- This section should be hidden by default and shown when there are todos -->
    <section class="main">
        <input id="toggle-all" class="toggle-all" type="checkbox">
        <label for="toggle-all">Mark all as complete</label>
        <ul class="todo-list">
        </ul>
    </section>
    <!-- This footer should hidden by default and shown when there are todos -->
    <footer class="footer">
        <!-- This should be `0 items left` by default -->
        <div class="todo-count"><strong></strong> item left</div>
        <!-- Remove this if you don't implement routing -->
        <ul class="filters">
            <li>
                <button class="filter selected">All</button>
            </li>
            <li>
                <button class="filter" value="0">Active</button>
            </li>
            <li>
                <button class="filter" value="1">Completed</button>
            </li>
        </ul>
        <!-- Hidden if no completed items are left ↓ -->
        <div>
            <button class="clear-completed">Clear completed</button>
        </div>
    </footer>
</section>
<footer class="info">
    <p>Double-click to edit a todo</p>
    <p>Created by <a href="https://vk.com/alexey_ziganshin">Ziganshin Alexey</a></p>
</footer>
<script src="/assets/jquery/jquery.min.js"></script>
<script src="/assets/todomvc-common/base.js"></script>
<script src="/assets/application/js/todo.js"></script>
</body>
</html>
