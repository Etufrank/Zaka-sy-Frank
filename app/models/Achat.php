<?php
class Achat {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function create($caisseId, $utilisateurId) {
        $stmt = $this->pdo->prepare("INSERT INTO achat (caisse_id, utilisateur_id, statut) VALUES (?, ?, 'en_cours')");
        $stmt->execute([$caisseId, $utilisateurId]);
        return $this->pdo->lastInsertId();
    }
    
    public function getCurrentAchat($caisseId) {
        $stmt = $this->pdo->prepare("SELECT * FROM achat WHERE caisse_id = ? AND statut = 'en_cours' ORDER BY id DESC LIMIT 1");
        $stmt->execute([$caisseId]);
        return $stmt->fetch();
    }
    
    public function updateTotal($achatId, $montant) {
        $stmt = $this->pdo->prepare("UPDATE achat SET montant_total = ? WHERE id = ?");
        return $stmt->execute([$montant, $achatId]);
    }
    
    public function cloturer($achatId) {
        $stmt = $this->pdo->prepare("UPDATE achat SET statut = 'cloture' WHERE id = ?");
        return $stmt->execute([$achatId]);
    }
    
    public function getTotalVentes() {
        $stmt = $this->pdo->query("SELECT SUM(montant_total) as total FROM achat WHERE statut = 'cloture'");
        return $stmt->fetch()['total'] ?? 0;
    }
    
    public function getVentesParArticle() {
        $stmt = $this->pdo->query("
            SELECT p.designation, SUM(la.quantite) as quantite_vendue, SUM(la.montant_ligne) as total_vente
            FROM ligne_achat la
            JOIN produit p ON la.produit_id = p.id
            JOIN achat a ON la.achat_id = a.id
            WHERE a.statut = 'cloture'
            GROUP BY la.produit_id, p.designation
            ORDER BY total_vente DESC
        ");
        return $stmt->fetchAll();
    }
    
    public function getVentesParJour() {
        $stmt = $this->pdo->query("
            SELECT DATE(date_achat) as jour, SUM(montant_total) as total_ventes, COUNT(*) as nombre_achats
            FROM achat
            WHERE statut = 'cloture'
            GROUP BY DATE(date_achat)
            ORDER BY jour DESC
        ");
        return $stmt->fetchAll();
    }
}
?>