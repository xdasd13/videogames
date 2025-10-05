<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Mi Perfil</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="<?= base_url($usuario['avatar']) ?>" alt="Avatar" class="img-fluid rounded-circle mb-3" style="max-width: 200px;">
                        <form action="<?= site_url('profile/update-avatar') ?>" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="avatar" class="form-label">Cambiar Avatar</label>
                                <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar Avatar</button>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <table class="table">
                            <tr>
                                <th>Nombre:</th>
                                <td><?= esc($usuario['nombre']) ?></td>
                            </tr>
                            <tr>
                                <th>Apellido:</th>
                                <td><?= esc($usuario['apellido']) ?></td>
                            </tr>
                            <tr>
                                <th>Usuario:</th>
                                <td><?= esc($usuario['username']) ?></td>
                            </tr>
                            <tr>
                                <th>Rol:</th>
                                <td><span class="badge bg-<?= $usuario['rol'] === 'admin' ? 'danger' : 'primary' ?>"><?= ucfirst(esc($usuario['rol'])) ?></span></td>
                            </tr>
                            <tr>
                                <th>Miembro desde:</th>
                                <td><?= date('d/m/Y', strtotime($usuario['created_at'])) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>