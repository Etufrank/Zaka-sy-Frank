<?php
// Point d'entrée minimal pour l'application (sans CSS)
// Démarre Flight, charge la DB, les models et controllers, et définit les routes principales.

require_once __DIR__ . '/../vendor/autoload.php';
session_start();

// Charger la connexion PDO
$pdo = require __DIR__ . '/../app/config/database.php';

// Charger models et controllers (fichiers du projet)
foreach (glob(__DIR__ . '/../app/models/*.php') as $file) {
	require_once $file;
}
foreach (glob(__DIR__ . '/../app/controllers/*.php') as $file) {
	require_once $file;
}

// Configurer le chemin des vues pour Flight
Flight::set('flight.views.path', __DIR__ . '/../app/views');

// Routes principales
Flight::route('/', function() {
	Flight::redirect('/choix-caisse');
});

Flight::route('/choix-caisse', function() use ($pdo) {
	$ctrl = new CaisseController($pdo);
	$ctrl->afficherChoix();
});

Flight::route('POST /choix-caisse/select', function() use ($pdo) {
	$ctrl = new CaisseController($pdo);
	$ctrl->selectionner();
});

Flight::route('/saisie-achat', function() use ($pdo) {
	$ctrl = new AchatController($pdo);
	$ctrl->afficherSaisie();
});

Flight::route('POST /saisie-achat/ajouter', function() use ($pdo) {
	$ctrl = new AchatController($pdo);
	$ctrl->ajouterLigne();
});

Flight::route('POST /saisie-achat/valider', function() use ($pdo) {
	$ctrl = new AchatController($pdo);
	$ctrl->validerAchat();
});

Flight::route('/statistiques', function() use ($pdo) {
	$ctrl = new StatistiqueController($pdo);
	$ctrl->afficherDashboard();
});

Flight::route('/produits', function() use ($pdo) {
	$ctrl = new ProduitController($pdo);
	$ctrl->liste();
});

Flight::route('/produit/@id', function($id) use ($pdo) {
	$ctrl = new ProduitController($pdo);
	$ctrl->details($id);
});

// Démarrer Flight
Flight::start();
