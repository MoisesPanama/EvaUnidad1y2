<?php
declare(strict_types=1);

namespace App\Dao;

use PDO;

class UsuarioDao
{
    public function __construct(private PDO $pdo) {}

    public function buscarPorUsername(string $username): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }
}