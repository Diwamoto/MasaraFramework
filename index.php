<?php
declare(strict_types=1);
require_once __DIR__ . "/lib/Core/basics.php";
require_once __DIR__ . "/vendor/autoload.php";

$Application = new \App\Application();
$Application->launch();
