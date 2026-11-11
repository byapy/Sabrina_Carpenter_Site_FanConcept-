<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

/** Gestiona las operaciones de persistencia de la tabla usuarios. */
final class UserRepository
{
    public function __construct(private readonly PDO $connection)
    {
    }

    public static function create(): self
    {
        return new self(databaseConnection());
    }

    /** Obtiene un usuario habilitado para iniciar sesión por su correo. */
    public function findActiveByEmail(string $email): ?array
    {
        $statement = $this->connection->prepare(
            'SELECT usuario_id, nombre, apellido, correo, rol_id, contrasena
             FROM usuarios
             WHERE correo = :correo AND estado_id = 1
             LIMIT 1'
        );
        $statement->execute(['correo' => $email]);

        $user = $statement->fetch();
        return $user ?: null;
    }

    /** Crea un cliente activo. */
    public function createCustomer(
        string $name,
        string $lastName,
        string $email,
        ?string $address,
        ?string $phone,
        string $passwordHash
    ): int {
        $statement = $this->connection->prepare(
            'INSERT INTO usuarios (nombre, apellido, rol_id, contrasena, correo, direccion, telefono, estado_id, fecha_registro)
             VALUES (:nombre, :apellido, 2, :contrasena, :correo, :direccion, :telefono, 1, NOW())'
        );
        $statement->execute([
            'nombre' => $name,
            'apellido' => $lastName,
            'contrasena' => $passwordHash,
            'correo' => $email,
            'direccion' => $address,
            'telefono' => $phone,
        ]);

        return (int) $this->connection->lastInsertId();
    }
}
