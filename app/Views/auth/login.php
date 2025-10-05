<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-center">
                <h4>Iniciar Sesión</h4>
            </div>
            <div class="card-body">
                <form action="<?= site_url('auth') ?>" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="username" name="username" required value="<?= old('username') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <p>¿No tienes una cuenta? <a href="<?= site_url('register') ?>">Regístrate aquí</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>