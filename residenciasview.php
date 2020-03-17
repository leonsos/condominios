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
$residencias_view = new residencias_view();

// Run the page
$residencias_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$residencias_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$residencias_view->isExport()) { ?>
<script>
var fresidenciasview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fresidenciasview = currentForm = new ew.Form("fresidenciasview", "view");
	loadjs.done("fresidenciasview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$residencias_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $residencias_view->ExportOptions->render("body") ?>
<?php $residencias_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $residencias_view->showPageHeader(); ?>
<?php
$residencias_view->showMessage();
?>
<form name="fresidenciasview" id="fresidenciasview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="residencias">
<input type="hidden" name="modal" value="<?php echo (int)$residencias_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($residencias_view->id_residencia->Visible) { // id_residencia ?>
	<tr id="r_id_residencia">
		<td class="<?php echo $residencias_view->TableLeftColumnClass ?>"><span id="elh_residencias_id_residencia"><?php echo $residencias_view->id_residencia->caption() ?></span></td>
		<td data-name="id_residencia" <?php echo $residencias_view->id_residencia->cellAttributes() ?>>
<span id="el_residencias_id_residencia">
<span<?php echo $residencias_view->id_residencia->viewAttributes() ?>><?php echo $residencias_view->id_residencia->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($residencias_view->nombre->Visible) { // nombre ?>
	<tr id="r_nombre">
		<td class="<?php echo $residencias_view->TableLeftColumnClass ?>"><span id="elh_residencias_nombre"><?php echo $residencias_view->nombre->caption() ?></span></td>
		<td data-name="nombre" <?php echo $residencias_view->nombre->cellAttributes() ?>>
<span id="el_residencias_nombre">
<span<?php echo $residencias_view->nombre->viewAttributes() ?>><?php echo $residencias_view->nombre->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($residencias_view->direccion->Visible) { // direccion ?>
	<tr id="r_direccion">
		<td class="<?php echo $residencias_view->TableLeftColumnClass ?>"><span id="elh_residencias_direccion"><?php echo $residencias_view->direccion->caption() ?></span></td>
		<td data-name="direccion" <?php echo $residencias_view->direccion->cellAttributes() ?>>
<span id="el_residencias_direccion">
<span<?php echo $residencias_view->direccion->viewAttributes() ?>><?php echo $residencias_view->direccion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($residencias_view->presidente->Visible) { // presidente ?>
	<tr id="r_presidente">
		<td class="<?php echo $residencias_view->TableLeftColumnClass ?>"><span id="elh_residencias_presidente"><?php echo $residencias_view->presidente->caption() ?></span></td>
		<td data-name="presidente" <?php echo $residencias_view->presidente->cellAttributes() ?>>
<span id="el_residencias_presidente">
<span<?php echo $residencias_view->presidente->viewAttributes() ?>><?php echo $residencias_view->presidente->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($residencias_view->presidente_telefono->Visible) { // presidente_telefono ?>
	<tr id="r_presidente_telefono">
		<td class="<?php echo $residencias_view->TableLeftColumnClass ?>"><span id="elh_residencias_presidente_telefono"><?php echo $residencias_view->presidente_telefono->caption() ?></span></td>
		<td data-name="presidente_telefono" <?php echo $residencias_view->presidente_telefono->cellAttributes() ?>>
<span id="el_residencias_presidente_telefono">
<span<?php echo $residencias_view->presidente_telefono->viewAttributes() ?>><?php echo $residencias_view->presidente_telefono->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($residencias_view->consecutivo_recibo->Visible) { // consecutivo_recibo ?>
	<tr id="r_consecutivo_recibo">
		<td class="<?php echo $residencias_view->TableLeftColumnClass ?>"><span id="elh_residencias_consecutivo_recibo"><?php echo $residencias_view->consecutivo_recibo->caption() ?></span></td>
		<td data-name="consecutivo_recibo" <?php echo $residencias_view->consecutivo_recibo->cellAttributes() ?>>
<span id="el_residencias_consecutivo_recibo">
<span<?php echo $residencias_view->consecutivo_recibo->viewAttributes() ?>><?php echo $residencias_view->consecutivo_recibo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("edificios", explode(",", $residencias->getCurrentDetailTable())) && $edificios->DetailView) {
?>
<?php if ($residencias->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("edificios", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "edificiosgrid.php" ?>
<?php } ?>
</form>
<?php
$residencias_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$residencias_view->isExport()) { ?>
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
$residencias_view->terminate();
?>