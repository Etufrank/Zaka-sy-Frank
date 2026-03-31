<?php
class StatistiqueController {
    private $achatModel;

    public function __construct($pdo) {
        $this->achatModel = new Achat($pdo);
    }

    public function afficherDashboard() {
        $totalVentes = $this->achatModel->getTotalVentes();
        $ventesParArticle = $this->achatModel->getVentesParArticle();
        $ventesParJour = $this->achatModel->getVentesParJour();

        Flight::render('statistiques', [
            'totalVentes' => $totalVentes,
            'ventesParArticle' => $ventesParArticle,
            'ventesParJour' => $ventesParJour
        ]);
    }
}