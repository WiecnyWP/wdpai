<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('add', 'DefaultController');
Routing::get('hau', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::get('register', 'DefaultController');
Routing::get('search', 'DefaultController');
Routing::get('workofart', 'DefaultController');

Routing::run($path);