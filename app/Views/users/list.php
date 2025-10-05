<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4>Lista de Usuarios</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th style="width: 80px;">Avatar</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Fecha de Registro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td class="text-center">
                                <?php 
                                $avatarPath = $usuario['avatar'];
                                // Asegurarse de que la ruta comienza con /
                                if (strpos($avatarPath, 'public/') === 0) {
                                    $avatarPath = substr($avatarPath, 6); // Remover 'public'
                                }
                                if (strpos($avatarPath, '/') !== 0) {
                                    $avatarPath = '/' . $avatarPath;
                                }
                                ?>
                                <img src="<?= base_url($avatarPath) ?>" 
                                     alt="Avatar de <?= esc($usuario['username']) ?>" 
                                     class="rounded-circle shadow-sm" 
                                     style="width: 50px; height: 50px; object-fit: cover; border: 2px solid #dee2e6;">
                            </td>
                            <td>
                                <div class="fw-semibold"><?= esc($usuario['nombre']) ?> <?= esc($usuario['apellido']) ?></div>
                            </td>
                            <td><?= esc($usuario['username']) ?></td>
                            <td>
                                <span class="badge bg-<?= $usuario['rol'] === 'admin' ? 'danger' : 'primary' ?>">
                                    <?= ucfirst(esc($usuario['rol'])) ?>
                                </span>
                            </td>
                            <td><?= date('d/m/Y', strtotime($usuario['created_at'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .table img.rounded-circle {
        transition: transform 0.2s ease-in-out;
    }
    .table img.rounded-circle:hover {
        transform: scale(1.1);
    }
</style>
<?= $this->endSection() ?>