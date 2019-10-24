<?php

use Core\Core;

require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/../application/configs/web.php';

/* @noinspection PhpUnhandledExceptionInspection */
Core::init($config);
/* @noinspection PhpUnhandledExceptionInspection */
Core::getApplication()->run();
