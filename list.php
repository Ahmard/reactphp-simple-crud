<?php

use Crud\User;
use React\EventLoop\Factory;
use React\MySQL\QueryResult;

require 'vendor/autoload.php';

$loop = Factory::create();

$user = new User($loop);

$user->list()->then(function (QueryResult $queryResult) use ($user) {
    foreach ($queryResult->resultRows as $resultRow) {
        echo "
            ID: {$resultRow['id']} 
            Name: {$resultRow['username']}, 
            Code: {$resultRow['userCode']}
            Time: {$resultRow['time']} 
        ";
    }
})
    ->otherwise(function (Throwable $exception) {
        echo $exception;
    });

$loop->run();