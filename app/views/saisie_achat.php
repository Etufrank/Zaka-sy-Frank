<?php 
$title = 'Saisie des achats';
require_once __DIR__ . '/templates/header.php'; 
?>

<div class="row">
    
    <div class="col-md-5 mb-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="fas fa-boxes"></i> Produits disponibles
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach($produits as $produit): ?>
                        <div class="col-md-12 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <h5 class="card-title mb-1"><?php echo $produit['designation']; ?></h5>
                                            <p class="card-text text-muted small">
                                                <i class="fas fa-tag"></i> <?php echo number_format($produit['prix_unitaire'], 0, ',', ' '); ?> FCFA
                                                <br>
                                                <i class="fas fa-database"></i> Stock: <?php echo $produit['quantite_stock']; ?>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <form action="/add_product" method="POST" class="row g-2">
                                                <input type="hidden" name="produit_id" value="<?php echo $produit['id']; ?>">
                                                <div class="col-7">
                                                    <input type="number" 
                                                           name="quantite" 
                                                           class="form-control form-control-sm" 
                                                           value="1" 
                                                           min="1" 
                                                           max="<?php echo $produit['quantite_stock']; ?>"
                                                           required>
                                                </div>
                                                <div class="col-5">
                                                    <button type="submit" class="btn btn-primary btn-sm w-100">
                                                        <i class="fas fa-cart-plus"></i> Ajouter
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Section panier - Partie en bas -->
    <div class="col-md-7 mb-4">
        <div class="card shadow-lg">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">
                    <i class="fas fa-shopping-cart"></i> Panier en cours
                </h4>
            </div>
            <div class="card-body">
                <?php if(empty($lignes)): ?>
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> Aucun produit dans le panier
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Produit</th>
                                    <th class="text-center">Prix Unit.</th>
                                    <th class="text-center">Qté</th>
                                    <th class="text-end">Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($lignes as $ligne): ?>
                                    <tr>
                                        <td><?php echo $ligne['designation']; ?></td>
                                        <td class="text-center">
                                            <?php echo number_format($ligne['prix_unitaire_au_moment'], 0, ',', ' '); ?> FCFA
                                        </td>
                                        <td class="text-center"><?php echo $ligne['quantite']; ?></td>
                                        <td class="text-end">
                                            <?php echo number_format($ligne['montant_ligne'], 0, ',', ' '); ?> FCFA
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="table-dark">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">TOTAL :</td>
                                    <td class="text-end fw-bold">
                                        <?php echo number_format($total, 0, ',', ' '); ?> FCFA
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-3">
                        <a href="/choix_caisse" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Changer de caisse
                        </a>
                        <form action="/cloturer_achat" method="POST">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-check-circle"></i> Clôturer l'achat
                            </button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/templates/footer.php'; ?>