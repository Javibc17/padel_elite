<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($usuario) ? 'Editar Usuario' : 'Crear Usuario' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center"><?= isset($usuario) ? 'Editar Usuario' : 'Crear Usuario' ?></h1>

    <!-- Mostrar errores de validación -->
    <?php if (isset($validation)): ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <!-- Formulario -->
    <form action="<?= isset($usuario) ? base_url('users/save/') . $usuario['id'] : base_url('users/save') ?>" method="post">
        <?= csrf_field(); ?>
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" 
                   value="<?= isset($usuario) ? esc($usuario['nombre']) : '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" 
                   value="<?= isset($usuario) ? esc($usuario['email']) : '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="tel" class="form-label">Teléfono</label>
            <input type="tel" name="tel" id="tel" class="form-control" 
                   value="<?= isset($usuario) ? esc($usuario['telefono']) : '' ?>" required>
        </div>
        <button type="submit" class="btn btn-success"><?= isset($usuario) ? 'Actualizar' : 'Guardar' ?></button>
        <a href="<?= base_url('users') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
