<?php
class Caisse {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM caisse WHERE statut = 'ouverte' ORDER BY numero_caisse");
        return $stmt->fetchAll();
    }
    
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM caisse WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
?>