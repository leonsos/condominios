<?php
namespace PHPMaker2020\condominios;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(16, "mci_Configuracion", $MenuLanguage->MenuPhrase("16", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fas fa-cogs", "", FALSE);
$sideMenu->addMenuItem(13, "mi_residencias", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "residenciaslist.php", 16, "", IsLoggedIn() || AllowListMenu('{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}residencias'), FALSE, FALSE, "fas fa-hotel", "", FALSE);
$sideMenu->addMenuItem(3, "mi_edificios", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "edificioslist.php?cmd=resetall", 16, "", IsLoggedIn() || AllowListMenu('{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}edificios'), FALSE, FALSE, "fas fa-building", "", FALSE);
$sideMenu->addMenuItem(10, "mi_pisos", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "pisoslist.php", 16, "", IsLoggedIn() || AllowListMenu('{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}pisos'), FALSE, FALSE, "fas fa-bars", "", FALSE);
$sideMenu->addMenuItem(1, "mi_apartamentos", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "apartamentoslist.php", 16, "", IsLoggedIn() || AllowListMenu('{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}apartamentos'), FALSE, FALSE, "fas fa-home", "", FALSE);
$sideMenu->addMenuItem(15, "mi_usuarios", $MenuLanguage->MenuPhrase("15", "MenuText"), $MenuRelativePath . "usuarioslist.php", -1, "", IsLoggedIn() || AllowListMenu('{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}usuarios'), FALSE, FALSE, "fas fa-users", "", FALSE);
$sideMenu->addMenuItem(2, "mi_condo_mensual", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "condo_mensuallist.php", -1, "", IsLoggedIn() || AllowListMenu('{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}condo_mensual'), FALSE, FALSE, "fas fa-calculator", "", FALSE);
$sideMenu->addMenuItem(4, "mi_estacionamientos", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "estacionamientoslist.php", -1, "", IsLoggedIn() || AllowListMenu('{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}estacionamientos'), FALSE, FALSE, "fas fa-car-side", "", FALSE);
$sideMenu->addMenuItem(5, "mi_gastos", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "gastoslist.php?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}gastos'), FALSE, FALSE, "fas fa-comments-dollar", "", FALSE);
$sideMenu->addMenuItem(6, "mi_gastos_ind", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "gastos_indlist.php", -1, "", IsLoggedIn() || AllowListMenu('{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}gastos_ind'), FALSE, FALSE, "fas fa-comment-dollar", "", FALSE);
$sideMenu->addMenuItem(7, "mi_maleteros", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "maleteroslist.php", -1, "", IsLoggedIn() || AllowListMenu('{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}maleteros'), FALSE, FALSE, "fas fa-luggage-cart", "", FALSE);
$sideMenu->addMenuItem(8, "mi_pagos", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "pagoslist.php", -1, "", IsLoggedIn() || AllowListMenu('{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}pagos'), FALSE, FALSE, "fas fa-money-check-alt", "", FALSE);
$sideMenu->addMenuItem(9, "mi_pagos_recibos", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "pagos_reciboslist.php", -1, "", IsLoggedIn() || AllowListMenu('{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}pagos_recibos'), FALSE, FALSE, "fas fa-file-invoice-dollar", "", FALSE);
$sideMenu->addMenuItem(11, "mi_propietarios", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "propietarioslist.php", -1, "", IsLoggedIn() || AllowListMenu('{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}propietarios'), FALSE, FALSE, "fas fa-address-book", "", FALSE);
$sideMenu->addMenuItem(12, "mi_recibos", $MenuLanguage->MenuPhrase("12", "MenuText"), $MenuRelativePath . "reciboslist.php", -1, "", IsLoggedIn() || AllowListMenu('{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}recibos'), FALSE, FALSE, "fas fa-file", "", FALSE);
$sideMenu->addMenuItem(14, "mi_tipo_gastos", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "tipo_gastoslist.php", -1, "", IsLoggedIn() || AllowListMenu('{ADBDD478-1F96-44BD-9F21-FE9B46199DE2}tipo_gastos'), FALSE, FALSE, "far fa-copy", "", FALSE);
echo $sideMenu->toScript();
?>