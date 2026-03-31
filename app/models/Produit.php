<?php
class Produit {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM produit ORDER BY designation");
        return $stmt->fetchAll();
    }
    
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM produit WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function updateStock($id, $quantite) {
        $stmt = $this->pdo->prepare("UPDATE produit SET quantite_stock = quantite_stock - ? WHERE id = ?");
        return $stmt->execute([$quantite, $id]);
    }
}
?>