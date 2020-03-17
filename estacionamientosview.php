<?php
namespace PHPMaker2020\condominios;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$estacionamientos_view = new estacionamientos_view();

// Run the page
$estacionamientos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$estacionamientos_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$estacionamientos_view->isExport()) { ?>
<script>
var festacionamientosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	festacionamientosview = currentForm = new ew.Form("festacionamientosview", "view");
	loadjs.done("festacionamientosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$estacionamientos_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $estacionamientos_view->ExportOptions->render("body") ?>
<?php $estacionamientos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $estacionamientos_view->showPageHeader(); ?>
<?php
$estacionamientos_view->showMessage();
?>
<form name="festacionamientosview" id="festacionamientosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="estacionamientos">
<input type="hidden" name="modal" value="<?php echo (int)$estacionamientos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($estacionamientos_view->id_estacionamiento->Visible) { // id_estacionamiento ?>
	<tr id="r_id_estacionamiento">
		<td class="<?php echo $estacionamientos_view->TableLeftColumnClass ?>"><span id="elh_estacionamientos_id_estacionamiento"><?php echo $estacionamientos_view->id_estacionamiento->caption() ?></span></td>
		<td data-name="id_estacionamiento" <?php echo $estacionamientos_view->id_estacionamiento->cellAttributes() ?>>
<span id="el_estacionamientos_id_estacionamiento">
<span<?php echo $estacionamientos_view->id_estacionamiento->viewAttributes() ?>><?php echo $estacionamientos_view->id_estacionamiento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($estacionamientos_view->nombre->Visible) { // nombre ?>
	<tr id="r_nombre">
		<td class="<?php echo $estacionamientos_view->TableLeftColumnClass ?>"><span id="elh_estacionamientos_nombre"><?php echo $estacionamientos_view->nombre->caption() ?></span></td>
		<td data-name="nombre" <?php echo $estacionamientos_view->nombre->cellAttributes() ?>>
<span id="el_estacionamientos_nombre">
<span<?php echo $estacionamientos_view->nombre->viewAttributes() ?>><?php echo $estacionamientos_view->nombre->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($estacionamientos_view->apartamento_id->Visible) { // apartamento_id ?>
	<tr id="r_apartamento_id">
		<td class="<?php echo $estacionamientos_view->TableLeftColumnClass ?>"><span id="elh_estacionamientos_apartamento_id"><?php echo $estacionamientos_view->apartamento_id->caption() ?></span></td>
		<td data-name="apartamento_id" <?php echo $estacionamientos_view->apartamento_id->cellAttributes() ?>>
<span id="el_estacionamientos_apartamento_id">
<span<?php echo $estacionamientos_view->apartamento_id->viewAttributes() ?>><?php echo $estacionamientos_view->apartamento_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$estacionamientos_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$estacionamientos_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$estacionamientos_view->terminate();
?>