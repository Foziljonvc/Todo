<?php

namespace src;

use PDO;

class ToDo
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function create(string $todo): bool
    {
        $query = "INSERT INTO todo (text)
                  VALUES (:text)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':text', $todo);
        return $stmt->execute();
    }

    public function read(): false|array
    {
        $query = "SELECT * FROM todo";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function update(int $id, string $text): bool
    {
        $query = "UPDATE todo SET text = :text WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $query = "DELETE FROM todo WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}