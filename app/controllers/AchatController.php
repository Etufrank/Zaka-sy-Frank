<?php
class AchatController {
    private $achatModel;
    private $ligneModel;
    private $produitModel;

    public function __construct($pdo) {
        $this->achatModel = new Achat($pdo);
        $this->ligneModel = new LigneAchat($pdo);
        $this->produitModel = new Produit($pdo);
    }

    public function afficherSaisie() {
        if (!isset($_SESSION['caisse_id'])) {
            Flight::redirect('/choix-caisse');
            return;
        }

        $caisseId = $_SESSION['caisse_id'];
        $achatEnCours = $this->achatModel->getCurrentAchat($caisseId);
        
        $lignes = [];
        $total = 0;
        
        if ($achatEnCours) {
            $lignes = $this->ligneModel->getByAchat($achatEnCours['id']);
            $total = $achatEnCours['montant_total'];
        }

        $produits = $this->produitModel->getAll();
        
        Flight::render('saisie_achat', [
            'achat' => $achatEnCours,
            'lignes' => $lignes,
            'produits' => $produits,
            'total' => $total,
            'caisse_id' => $_SESSION['numero_caisse']
        ]);
    }

    public function ajouterLigne() {
        $caisseId = $_SESSION['caisse_id'];
        $utilisateurId = $_SESSION['user_id'] ?? 1;
        $produitId = Flight::request()->data->produit_id;
        $quantite = Flight::request()->data->quantite;

        $achatEnCours = $this->achatModel->getCurrentAchat($caisseId);
        if (!$achatEnCours) {
            $idAchat = $this->achatModel->create($caisseId, $utilisateurId);
            $achatEnCours = ['id' => $idAchat];
        }

        $produit = $this->produitModel->getById($produitId);
        if ($produit && $produit['quantite_stock'] >= $quantite) {
            $this->ligneModel->add($achatEnCours['id'], $produitId, $quantite, $produit['prix_unitaire']);
            $this->produitModel->updateStock($produitId, $quantite);
            
            $lignes = $this->ligneModel->getByAchat($achatEnCours['id']);
            $nouveauTotal = 0;
            foreach ($lignes as $ligne) {
                $nouveauTotal += $ligne['montant_ligne'];
            }
            $this->achatModel->updateTotal($achatEnCours['id'], $nouveauTotal);
        }

        Flight::redirect('/saisie-achat');
    }

    public function validerAchat() {
        $achatId = Flight::request()->data->achat_id;
        if ($achatId) {
            $this->achatModel->cloturer($achatId);
        }
        Flight::redirect('/saisie-achat');
    }
}