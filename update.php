<?php

use Crud\User;
use React\EventLoop\Factory;

require 'vendor/autoload.php';

$loop = Factory::create();

$user = new User($loop);

$user->update(1, 'Carliedu_01', 'cld.001')
    ->then(function () use ($user) {
        echo("\nUser information updated successfully.\n");
        $user->getConnection()->close();
    })
    ->otherwise(function (Throwable $exception) {
        echo $exception;
    });

$loop->run();