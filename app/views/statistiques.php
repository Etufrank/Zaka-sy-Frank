<?php 
$title = 'Statistiques des ventes';
require_once __DIR__ . '/templates/header.php'; 
?>

<div class="row">
    
    <div class="col-md-12 mb-4">
        <div class="card bg-gradient-primary text-white shadow-lg">
            <div class="card-body text-center">
                <h3 class="mb-0">
                    <i class="fas fa-chart-line"></i> Montant total des ventes
                </h3>
                <h1 class="display-4 mt-2">
                    <?php echo number_format($totalVentes, 0, ',', ' '); ?> FCFA
                </h1>
                <p class="mb-0">Toutes caisses confondues</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card shadow-lg h-100">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">
                    <i class="fas fa-box"></i> Ventes par article
                </h4>
            </div>
            <div class="card-body">
                <?php if(empty($ventesParArticle)): ?>
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> Aucune vente enregistrée
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Produit</th>
                                    <th class="text-center">Qté vendue</th>
                                    <th class="text-end">Montant total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($ventesParArticle as $vente): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo $vente['designation']; ?></strong>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-info">
                                                <?php echo $vente['quantite_vendue']; ?>
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <?php echo number_format($vente['total_vente'], 0, ',', ' '); ?> FCFA
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-4">
        <div class="card shadow-lg h-100">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">
                    <i class="fas fa-calendar-day"></i> Ventes par jour
                </h4>
            </div>
            <div class="card-body">
                <?php if(empty($ventesParJour)): ?>
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> Aucune vente enregistrée
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th class="text-center">Nombre d'achats</th>
                                    <th class="text-end">Total ventes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($ventesParJour as $vente): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo date('d/m/Y', strtotime($vente['jour'])); ?></strong>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-secondary">
                                                <?php echo $vente['nombre_achats']; ?> clients
                                            </span>
                                        </td>
                                        <td class="text-end text-success fw-bold">
                                            <?php echo number_format($vente['total_ventes'], 0, ',', ' '); ?> FCFA
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/templates/footer.php'; ?>