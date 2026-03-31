<?php

require_once __DIR__ . '/../vendor/autoload.php';
session_start();

$pdo = require __DIR__ . '/../app/config/database.php';

foreach (glob(__DIR__ . '/../app/models/*.php') as $file) {
	require_once $file;
}
foreach (glob(__DIR__ . '/../app/controllers/*.php') as $file) {
	require_once $file;
}

Flight::set('flight.views.path', __DIR__ . '/../app/views');

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

Flight::route('/choix_caisse', function() use ($pdo) {
	$ctrl = new CaisseController($pdo);
	$ctrl->afficherChoix();
});

Flight::route('POST /select_caisse', function() use ($pdo) {
	$ctrl = new CaisseController($pdo);
	$ctrl->selectionner();
});

Flight::route('/saisie_achat', function() use ($pdo) {
	$ctrl = new AchatController($pdo);
	$ctrl->afficherSaisie();
});

Flight::route('POST /add_product', function() use ($pdo) {
	$ctrl = new AchatController($pdo);
	$ctrl->ajouterLigne();
});

Flight::route('POST /cloturer_achat', function() use ($pdo) {
	$ctrl = new AchatController($pdo);
	$ctrl->validerAchat();
});

Flight::start();
