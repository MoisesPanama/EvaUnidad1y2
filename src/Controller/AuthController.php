<?php
declare(strict_types=1);

namespace App\Controller;

use App\Dao\UsuarioDao;

class AuthController
{
    public function __construct(private UsuarioDao $dao) {}

    public function mostrarLogin(): void
    {
        require __DIR__ . '/../../views/login.php';
    }

    public function procesarLogin(): void
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $usuario = $this->dao->buscarPorUsername($username);

        if ($usuario && password_verify($password, $usuario['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $usuario['id'];
            header('Location: /materias', true, 302);
            exit;
        }

        header('Location: /login?error=1', true, 302);
        exit;
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        header('Location: /login', true, 302);
        exit;
    }
}