<?php

declare(strict_types=1);

use MamadouAlySy\SimpleFramework\Kernel;
use MamadouAlySy\SimpleFramework\Http\Request;

require_once '../vendor/autoload.php';

$kernel = new Kernel(__DIR__);
$response = $kernel->handle(Request::createFromGlobals());
$response->send();