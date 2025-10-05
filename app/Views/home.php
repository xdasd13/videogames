<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <h1 class="text-center mb-4">Bienvenido al Portal de VideoGames</h1>
    
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card h-100">
                <img src="<?= base_url('images/games/Jdestacado.jpg') ?>" class="card-img-top" alt="Featured Games">
                <div class="card-body">
                    <h5 class="card-title">Juegos Destacados</h5>
                    <p class="card-text">Descubre los juegos más populares del momento.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <img src="<?= base_url('images/games/Planzamineto.jpg') ?>" class="card-img-top" alt="Upcoming Games">
                <div class="card-body">
                    <h5 class="card-title">Próximos Lanzamientos</h5>
                    <p class="card-text">Mantente al día con los próximos lanzamientos.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <img src="<?= base_url('images/games/reseña.jpg') ?>" class="card-img-top" alt="Game Reviews">
                <div class="card-body">
                    <h5 class="card-title">Reseñas</h5>
                    <p class="card-text">Lee las últimas reseñas de la comunidad.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>