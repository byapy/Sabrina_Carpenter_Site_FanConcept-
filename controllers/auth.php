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
        $loginError = 'Invalid request. Please try again.';
    } elseif ($email === false || !is_string($password) || $password === '') {
        $loginError = 'Please enter a valid email address and password.';
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

            $loginError = 'Incorrect email or password. Please try again.';
        } catch (PDOException $exception) {
            error_log('Unable to log in: ' . $exception->getMessage());
            $loginError = 'We couldn’t connect to the login service. Please try again later';
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
        $registerError = 'Invalid request. Please try again.';
    } elseif ($name === '' || strlen($name) > 60 || $lastName === '' || strlen($lastName) > 60) {
        $registerError = 'Please enter a first and last name ';
    } elseif ($email === false) {
        $registerError = 'Please enter a valid email address.';
    } elseif (strlen($address) > 300) {
        $registerError = 'Your address cannot exceed 300 characters.';
    } elseif (!is_string($password) || strlen($password) < 8) {
        $registerError = 'Your password must be at least 8 characters long.';
    } elseif (!is_string($passwordConfirmation) || !hash_equals($password, $passwordConfirmation)) {
        $registerError = 'Your passwords do not match.';
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
            error_log('Unable to register user: ' . $exception->getMessage());
            $registerError = $exception->getCode() === '23000'
                ? 'An account with this email address already exists.'
                : 'We couldn’t create your account. Please try again.';
        }
    }
}

$showRegistrationForm = $showRegistrationForm || $registerError !== '';
