<?php
class ProduitController {
    private $produitModel;

    public function __construct($pdo) {
        $this->produitModel = new Produit($pdo);
    }

    public function liste() {
        $produits = $this->produitModel->getAll();
        Flight::json($produits);
    }

    public function details($id) {
        $produit = $this->produitModel->getById($id);
        Flight::json($produit);
    }
}