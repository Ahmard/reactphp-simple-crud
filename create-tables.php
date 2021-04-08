<?php
date_default_timezone_set('America/Sao_Paulo');
error_reporting(E_ALL);

use Crud\User;
use React\EventLoop\Factory;

require dirname(__DIR__, 1) . '/vendor/autoload.php';

$loop = Factory::create();

$conn = (new User($loop))->getConnection();

$conn->query('
    CREATE TABLE IF NOT EXISTS users(
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
        username VARCHAR(200) NOT NULL ,
        userCode VARCHAR(100) NOT NULL ,
        time TIMESTAMP(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
    );
')->then(
    function () use ($conn){
        var_dump('Database table created');
        $conn->close();
    },
    function (Throwable $exception) {
        echo $exception;
    }
);

$loop->run();