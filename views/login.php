<?php if (empty($_SESSION['csrf_token'])) { $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); } ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Materias</title>
</head>
<body>
    <h1>Iniciar sesion</h1>
    <?php if (isset($_GET['error'])): ?>
        <p style="color:red;">Usuario o contrasena incorrectos.</p>
    <?php endif; ?>
    <form method="POST" action="/login">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
        <label>Usuario: <input type="text" name="username" required minlength="3" maxlength="50"></label><br>
        <label>Contrasena: <input type="password" name="password" required minlength="6"></label><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>