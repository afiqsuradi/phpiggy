<?php
require __DIR__ . "/../../vendor/autoload.php";

use Framework\App;
use App\Config\Paths;
use function App\Config\{registerRoutes, registerMiddleware};

$app = new App(Paths::SOURCE . "/container-definitions.php");

registerRoutes($app);
registerMiddleware($app);


return $app;
