<?php
require __DIR__ . "/../../vendor/autoload.php";

use Framework\App;
use App\Config\Paths;
use function App\Config\registerRoutes;

$app = new App(Paths::SOURCE . "/container-definitions.php");

registerRoutes($app);


return $app;
