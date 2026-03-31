<?php 
$title = 'Connexion';
require_once __DIR__ . '/templates/header.php'; 
?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="mb-0">
                    <i class="fas fa-lock"></i> Connexion Caissier
                </h3>
            </div>
            <div class="card-body">
                <form action="/login" method="POST">
                    <div class="mb-3">
                        <label for="code_employe" class="form-label">
                            <i class="fas fa-id-card"></i> Code Employé
                        </label>
                        <input type="text" 
                               class="form-control form-control-lg" 
                               id="code_employe" 
                               name="code_employe" 
                               placeholder="Ex: EMP001, EMP002, EMP003"
                               required 
                               autofocus>
                        <div class="form-text">
                            Utilisez un code parmi : EMP001, EMP002, EMP003
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="fas fa-sign-in-alt"></i> Se connecter
                    </button>
                </form>
            </div>
            <div class="card-footer text-muted text-center">
                <small>Accès réservé aux employés du supermarché</small>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/templates/footer.php'; ?>