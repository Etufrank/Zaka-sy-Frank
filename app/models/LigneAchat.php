<?php
class LigneAchat {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function add($achatId, $produitId, $quantite, $prixUnitaire) {
        $montantLigne = $quantite * $prixUnitaire;
        $stmt = $this->pdo->prepare("
            INSERT INTO ligne_achat (achat_id, produit_id, quantite, prix_unitaire_au_moment, montant_ligne) 
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$achatId, $produitId, $quantite, $prixUnitaire, $montantLigne]);
    }
    
    public function getByAchat($achatId) {
        $stmt = $this->pdo->prepare("
            SELECT la.*, p.designation 
            FROM ligne_achat la
            JOIN produit p ON la.produit_id = p.id
            WHERE la.achat_id = ?
            ORDER BY la.id
        ");
        $stmt->execute([$achatId]);
        return $stmt->fetchAll();
    }
    
    public function clearByAchat($achatId) {
        $stmt = $this->pdo->prepare("DELETE FROM ligne_achat WHERE achat_id = ?");
        return $stmt->execute([$achatId]);
    }
}
?>