<?php

declare(strict_types = 1);

use Autoload\AutoLoader;

require_once __DIR__ . '/autoload/AutoLoader.php';

$autoloader = new AutoLoader();

$namespaceMap = require_once __DIR__ . '/namespaces.php';
if (is_array($namespaceMap)) {
    $autoloader->setNamespaceMap($namespaceMap);
}

$callable = [
    $autoloader,
    'includeClass',
];
spl_autoload_register($callable, true, true);
