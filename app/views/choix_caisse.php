<?php 
$title = 'Choix de la caisse';
require_once __DIR__ . '/templates/header.php'; 
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg">
            <div class="card-header bg-success text-white text-center">
                <h3 class="mb-0">
                    <i class="fas fa-cash-register"></i> Sélectionnez votre caisse
                </h3>
            </div>
            <div class="card-body">
                <p class="text-muted text-center mb-4">
                    Bonjour <strong><?php echo $_SESSION['user_name']; ?></strong>, veuillez choisir une caisse pour commencer
                </p>
                
                <div class="row">
                    <?php foreach($caisses as $caisse): ?>
                        <div class="col-md-6 mb-3">
                            <form action="/select_caisse" method="POST" class="h-100">
                                <input type="hidden" name="caisse_id" value="<?php echo $caisse['id']; ?>">
                                <button type="submit" class="btn btn-outline-primary btn-caisse w-100 h-100 py-4">
                                    <i class="fas fa-cash-register fa-3x mb-2"></i>
                                    <h4>Caisse n°<?php echo $caisse['numero_caisse']; ?></h4>
                                    <span class="badge bg-success">Disponible</span>
                                </button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/templates/footer.php'; ?>