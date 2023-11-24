<?php
require __DIR__ . "/../../vendor/autoload.php";

use Framework\App;
use App\Controllers\HomeController;

$app = new App();

$app->get("/", [HomeController::class, "home"]);


return $app;
