<?php

use Crud\User;
use React\EventLoop\Factory;

require 'vendor/autoload.php';

$loop = Factory::create();

$user = new User($loop);

$user->delete(1)
    ->then(function () use ($user) {
        echo("\nUser has been deleted successfully.\n");
        $user->getConnection()->close();
    })
    ->otherwise(function (Throwable $exception) {
        echo $exception;
    });

$loop->run();