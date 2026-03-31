<?php
class CaisseController {
    private $caisseModel;

    public function __construct($pdo) {
        $this->caisseModel = new Caisse($pdo);
    }

    public function afficherChoix() {
        $caisses = $this->caisseModel->getAll();
        Flight::render('choix_caisse', ['caisses' => $caisses]);
    }

    public function selectionner() {
        $id = Flight::request()->data->caisse_id;
        $caisse = $this->caisseModel->getById($id);
        
        if ($caisse) {
            $_SESSION['caisse_id'] = $caisse['id'];
            $_SESSION['numero_caisse'] = $caisse['numero_caisse'];
            Flight::redirect('/saisie-achat');
        } else {
            Flight::redirect('/choix-caisse');
        }
    }
}