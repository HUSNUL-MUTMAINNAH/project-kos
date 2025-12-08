<?php
require_once __DIR__ . "/../app/Core/Router.php";

$route = $_GET['r'] ?? 'login';
Router::dispatch($route);
