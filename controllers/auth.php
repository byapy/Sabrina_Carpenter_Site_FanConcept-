<?php
declare(strict_types=1);

require_once __DIR__ . '/../repositories/UserRepository.php';

session_start();

$loginError = '';
$registerError = '';
$showRegistrationForm = is_string($_GET['form'] ?? null) && $_GET['form'] === 'register';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/** Guarda únicamente la información necesaria del usuario en la sesión. */
function startUserSession(array $user): void
{
    session_regenerate_id(true);
    $_SESSION['user'] = [
        'id' => (int) $user['id'],
        'name' => $user['name'],
        'last_name' => $user['last_name'],
        'email' => $user['email'],
        'role_id' => (int) $user['role_id'],
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_submit'])) {
    $csrfToken = $_POST['csrf_token'] ?? '';
    $email = filter_input(INPUT_POST, 'eml_email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['pwd_password'] ?? '';

    if (!is_string($csrfToken) || !hash_equals($_SESSION['csrf_token'], $csrfToken)) {
        $loginError = 'La solicitud no es válida. Inténtalo de nuevo.';
    } elseif ($email === false || !is_string($password) || $password === '') {
        $loginError = 'Ingresa un correo electrónico y contraseña válidos.';
    } else {
        try {
            $user = UserRepository::create()->findActiveByEmail($email);

            if ($user && password_verify($password, $user['contrasena'])) {
                startUserSession([
                    'id' => $user['usuario_id'],
                    'name' => $user['nombre'],
                    'last_name' => $user['apellido'],
                    'email' => $user['correo'],
                    'role_id' => $user['rol_id'],
                ]);
                header('Location: index.php');
                exit;
            }

            $loginError = 'Correo o contraseña incorrectos.';
        } catch (PDOException $exception) {
            error_log('No fue posible iniciar sesión: ' . $exception->getMessage());
            $loginError = 'No se pudo conectar con el servicio de inicio de sesión.';
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_submit'])) {
    $csrfToken = $_POST['csrf_token'] ?? '';
    $name = is_string($_POST['txt_name'] ?? null) ? trim($_POST['txt_name']) : '';
    $lastName = is_string($_POST['txt_apellido'] ?? null) ? trim($_POST['txt_apellido']) : '';
    $emailInput = is_string($_POST['eml_email_register'] ?? null) ? $_POST['eml_email_register'] : '';
    $email = filter_var($emailInput, FILTER_VALIDATE_EMAIL);
    $address = is_string($_POST['txt_direccion'] ?? null) ? trim($_POST['txt_direccion']) : '';
    $password = $_POST['pwd_register'] ?? '';
    $passwordConfirmation = $_POST['pwd_register_confirmation'] ?? '';

    if (!is_string($csrfToken) || !hash_equals($_SESSION['csrf_token'], $csrfToken)) {
        $registerError = 'La solicitud no es válida. Inténtalo de nuevo.';
    } elseif ($name === '' || strlen($name) > 60 || $lastName === '' || strlen($lastName) > 60) {
        $registerError = 'Ingresa un nombre y apellido de hasta 60 caracteres.';
    } elseif ($email === false) {
        $registerError = 'Ingresa un correo electrónico válido.';
    } elseif (strlen($address) > 300) {
        $registerError = 'La dirección no puede superar los 300 caracteres.';
    } elseif (!is_string($password) || strlen($password) < 8) {
        $registerError = 'La contraseña debe tener al menos 8 caracteres.';
    } elseif (!is_string($passwordConfirmation) || !hash_equals($password, $passwordConfirmation)) {
        $registerError = 'Las contraseñas no coinciden.';
    } else {
        try {
            $userId = UserRepository::create()->createCustomer(
                $name,
                $lastName,
                $email,
                $address === '' ? null : $address,
                password_hash($password, PASSWORD_DEFAULT)
            );

            startUserSession([
                'id' => $userId,
                'name' => $name,
                'last_name' => $lastName,
                'email' => $email,
                'role_id' => 2,
            ]);
            header('Location: index.php');
            exit;
        } catch (PDOException $exception) {
            error_log('No fue posible registrar al usuario: ' . $exception->getMessage());
            $registerError = $exception->getCode() === '23000'
                ? 'Ya existe una cuenta registrada con ese correo electrónico.'
                : 'No se pudo crear la cuenta. Inténtalo de nuevo.';
        }
    }
}

$showRegistrationForm = $showRegistrationForm || $registerError !== '';
