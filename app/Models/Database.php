<?php

namespace App\Models;

use PDO;
use PDOStatement;
use PDOException;

class Database {
    private string $host = 'localhost';
    private string $databaseName = 'polyroid';
    private string $charset = 'utf8mb4';
    private string $username = 'root';
    private string $password = 'root';

    private PDO $pdo;
    private PDOStatement $statement;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->databaseName};charset={$this->charset}",
                $this->username,
                $this->password,
                [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query(string $sql, array $values = [])
    {
        $this->statement = $this->pdo->prepare($sql);
        $this->statement->execute($values);

        return $this;
    }

    public function count(): int
    {
        return $this->statement->rowCount();
    }

    public function results(): array
    {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }
}