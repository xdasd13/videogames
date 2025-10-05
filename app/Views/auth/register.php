<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-center">
                <h4>Registro de Usuario</h4>
            </div>
            <div class="card-body">
                <form action="<?= site_url('register/create') ?>" method="post">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required value="<?= old('nombre') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required value="<?= old('apellido') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="username" name="username" required value="<?= old('username') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="claveacceso" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="claveacceso" name="claveacceso" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <p>¿Ya tienes una cuenta? <a href="<?= site_url('login') ?>">Inicia sesión aquí</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>