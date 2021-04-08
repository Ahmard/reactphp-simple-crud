<?php

use Crud\User;
use React\EventLoop\Factory;
use React\MySQL\QueryResult;

require 'vendor/autoload.php';

$loop = Factory::create();

$user = new User($loop);

$user->read(1)
    ->then(function (QueryResult $queryResult) use ($user) {
        var_dump($queryResult->resultRows);
        $user->getConnection()->close();
    })
    ->otherwise(function (Throwable $exception) {
        echo $exception;
    });

$loop->run();