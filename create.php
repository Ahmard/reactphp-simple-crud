<?php

use Crud\User;
use React\EventLoop\Factory;
use React\MySQL\QueryResult;

require 'vendor/autoload.php';

$loop = Factory::create();

$user = new User($loop);

$user->create('Carliedu', 'clu.123')
    ->then(function (QueryResult $queryResult) use ($user) {
        echo("\nUser created successfully\nUserID: {$queryResult->insertId}.\n");
        $user->getConnection()->close();
    })
    ->otherwise(function (Throwable $exception) {
        echo $exception;
    });

$loop->run();