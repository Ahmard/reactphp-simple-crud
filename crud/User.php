<?php

namespace Crud;

use Dotenv\Dotenv;
use React\EventLoop\LoopInterface;
use React\MySQL\ConnectionInterface;
use React\MySQL\Factory;
use React\Promise\PromiseInterface;

class User
{
    protected static ConnectionInterface $connection;

    public static function createConnection(LoopInterface $loop): ConnectionInterface
    {
        if (isset(self::$connection)) {
            return self::$connection;
        }

        $uri = $_ENV['DB_USER']
            . ':' . rawurlencode($_ENV['DB_PASS'])
            . '@' . $_ENV['DB_HOST']
            . '/' . $_ENV['DB_NAME'];

        self::$connection = (new Factory($loop))->createLazyConnection($uri);
        return self::$connection;
    }

    /**
     * @return ConnectionInterface
     */
    public function getConnection(): ConnectionInterface
    {
        return self::$connection;
    }

    public function __construct(LoopInterface $loop)
    {
        // Load environment variables
        $env = Dotenv::createImmutable(dirname(__DIR__, 1));
        $env->load();

        // Create database connection
        self::createConnection($loop);
    }

    /**
     * Create user
     *
     * @param string $username
     * @param string $userCode
     * @return PromiseInterface
     */
    public function create(string $username, string $userCode): PromiseInterface
    {
        return self::getConnection()
            ->query('INSERT INTO users(username, userCode) VALUE (?, ?)', [$username, $userCode]);
    }

    /**
     * Read user information
     *
     * @param int $userId
     * @return PromiseInterface
     */
    public function read(int $userId): PromiseInterface
    {
        return $this->getConnection()
            ->query('SELECT * FROM users WHERE id = ?', [$userId]);
    }

    /**
     * Update/Alter user information
     *
     * @param int $userId
     * @param string $username
     * @param string $userCode
     * @return PromiseInterface
     */
    public function update(int $userId, string $username, string $userCode): PromiseInterface
    {
        return $this->getConnection()
            ->query(
                'UPDATE users SET username = ?, userCode = ? WHERE id = ?',
                [$username, $userCode, $userId]
            );
    }

    /**
     * Delete specific user
     *
     * @param int $userId
     * @return PromiseInterface
     */
    public function delete(int $userId): PromiseInterface
    {
        return $this->getConnection()
            ->query('DELETE FROM users WHERE id = ?', [$userId]);
    }

    /**
     * List all users in the table
     *
     * @return PromiseInterface
     */
    public function list(): PromiseInterface
    {
        return $this->getConnection()
            ->query('SELECT * FROM users');
    }
}