<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('add', 'DefaultController');
Routing::get('hau', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::post('add', 'ArtController');
Routing::get('register', 'DefaultController');
Routing::post('registerAdd', 'SecurityController');
Routing::get('search', 'ArtController');
Routing::post('searchArt', 'ArtController');
Routing::get('workofart', 'DefaultController');
Routing::post('saveRate', 'ArtController');
Routing::post('checkRateIsset', 'ArtController');

Routing::run($path);