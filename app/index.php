<?php declare(strict_types=1);

require __DIR__ . '/core/init.php';

$app = new app\controller\AppController;
$app->router();


