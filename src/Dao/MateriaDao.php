<?php
declare(strict_types=1);

namespace App\Dao;

use PDO;

class MateriaDao
{
    public function __construct(private PDO $pdo) {}

    public function listar(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM materias WHERE activa = TRUE ORDER BY id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear(string $codigo, string $nombre, int $creditos, int $semestre): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO materias (codigo, nombre, creditos, semestre) VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$codigo, $nombre, $creditos, $semestre]);
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM materias WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function actualizar(int $id, string $nombre, int $creditos, int $semestre): void
    {
        $stmt = $this->pdo->prepare(
            "UPDATE materias SET nombre = ?, creditos = ?, semestre = ? WHERE id = ?"
        );
        $stmt->execute([$nombre, $creditos, $semestre, $id]);
    }

    public function eliminarLogico(int $id): void
    {
        $stmt = $this->pdo->prepare("UPDATE materias SET activa = FALSE WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function existeCodigo(string $codigo): bool
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM materias WHERE codigo = ?");
        $stmt->execute([$codigo]);
        return (int) $stmt->fetchColumn() > 0;
    }
}