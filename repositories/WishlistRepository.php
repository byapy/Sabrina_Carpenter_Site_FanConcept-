<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

final class WishlistRepository
{
    public function __construct(private readonly PDO $connection)
    {
    }

    public static function create(): self
    {
        return new self(databaseConnection());
    }

    public function add(int $userId, int $productId): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO lista_deseados (usuario_id, producto_id, fecha_agregado)
             VALUES (:usuario_id, :producto_id, NOW())
             ON DUPLICATE KEY UPDATE fecha_agregado = fecha_agregado'
        );
        $statement->execute(['usuario_id' => $userId, 'producto_id' => $productId]);
    }

    public function remove(int $userId, int $productId): void
    {
        $statement = $this->connection->prepare(
            'DELETE FROM lista_deseados WHERE usuario_id = :usuario_id AND producto_id = :producto_id'
        );
        $statement->execute(['usuario_id' => $userId, 'producto_id' => $productId]);
    }

    /** @return array<int, array<string, mixed>> */
    public function findByUserId(int $userId): array
    {
        $statement = $this->connection->prepare(
            'SELECT p.producto_id, p.nombre, p.imagen_front, c.nombre AS categoria_nombre, ld.fecha_agregado
             FROM lista_deseados AS ld
             INNER JOIN productos AS p ON p.producto_id = ld.producto_id
             INNER JOIN categorias AS c ON c.categoria_id = p.categoria_id
             WHERE ld.usuario_id = :usuario_id AND p.estado_id <> 103
             ORDER BY ld.fecha_agregado DESC, ld.producto_id DESC'
        );
        $statement->execute(['usuario_id' => $userId]);
        return $statement->fetchAll();
    }
}
