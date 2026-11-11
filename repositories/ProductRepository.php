<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

/** Consulta el catálogo público de productos. */
final class ProductRepository
{
    public function __construct(private readonly PDO $connection)
    {
    }

    public static function create(): self
    {
        return new self(databaseConnection());
    }

    /** @return array<int, array<string, mixed>> */
    public function findPublicCatalog(): array
    {
        $statement = $this->connection->query(
            'SELECT p.producto_id, p.categoria_id, p.nombre, p.precio, p.stock, p.imagen_front, p.imagen_alt,
                    c.nombre AS categoria_nombre, ep.nombre AS estado_nombre
             FROM productos AS p
             INNER JOIN categorias AS c ON c.categoria_id = p.categoria_id
             INNER JOIN estados_productos AS ep ON ep.estado_id = p.estado_id
             WHERE p.estado_id <> 103
             ORDER BY c.categoria_id, p.producto_id'
        );

        return $statement->fetchAll();
    }

    /** Obtiene un producto visible del catálogo por su ID. */
    public function findPublicProductById(int $productId): ?array
    {
        $statement = $this->connection->prepare(
            'SELECT p.producto_id, p.categoria_id, p.nombre, p.precio, p.stock, p.imagen_front, p.imagen_alt,
                    c.nombre AS categoria_nombre, ep.nombre AS estado_nombre
             FROM productos AS p
             INNER JOIN categorias AS c ON c.categoria_id = p.categoria_id
             INNER JOIN estados_productos AS ep ON ep.estado_id = p.estado_id
             WHERE p.producto_id = :producto_id AND p.estado_id <> 103
             LIMIT 1'
        );
        $statement->execute(['producto_id' => $productId]);

        $product = $statement->fetch();
        return $product ?: null;
    }
}
