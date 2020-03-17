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
$tipo_gastos_view = new tipo_gastos_view();

// Run the page
$tipo_gastos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tipo_gastos_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tipo_gastos_view->isExport()) { ?>
<script>
var ftipo_gastosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftipo_gastosview = currentForm = new ew.Form("ftipo_gastosview", "view");
	loadjs.done("ftipo_gastosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tipo_gastos_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tipo_gastos_view->ExportOptions->render("body") ?>
<?php $tipo_gastos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tipo_gastos_view->showPageHeader(); ?>
<?php
$tipo_gastos_view->showMessage();
?>
<form name="ftipo_gastosview" id="ftipo_gastosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tipo_gastos">
<input type="hidden" name="modal" value="<?php echo (int)$tipo_gastos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tipo_gastos_view->id_tipo_gasto->Visible) { // id_tipo_gasto ?>
	<tr id="r_id_tipo_gasto">
		<td class="<?php echo $tipo_gastos_view->TableLeftColumnClass ?>"><span id="elh_tipo_gastos_id_tipo_gasto"><?php echo $tipo_gastos_view->id_tipo_gasto->caption() ?></span></td>
		<td data-name="id_tipo_gasto" <?php echo $tipo_gastos_view->id_tipo_gasto->cellAttributes() ?>>
<span id="el_tipo_gastos_id_tipo_gasto">
<span<?php echo $tipo_gastos_view->id_tipo_gasto->viewAttributes() ?>><?php echo $tipo_gastos_view->id_tipo_gasto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tipo_gastos_view->nombre->Visible) { // nombre ?>
	<tr id="r_nombre">
		<td class="<?php echo $tipo_gastos_view->TableLeftColumnClass ?>"><span id="elh_tipo_gastos_nombre"><?php echo $tipo_gastos_view->nombre->caption() ?></span></td>
		<td data-name="nombre" <?php echo $tipo_gastos_view->nombre->cellAttributes() ?>>
<span id="el_tipo_gastos_nombre">
<span<?php echo $tipo_gastos_view->nombre->viewAttributes() ?>><?php echo $tipo_gastos_view->nombre->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tipo_gastos_view->tipo_gasto->Visible) { // tipo_gasto ?>
	<tr id="r_tipo_gasto">
		<td class="<?php echo $tipo_gastos_view->TableLeftColumnClass ?>"><span id="elh_tipo_gastos_tipo_gasto"><?php echo $tipo_gastos_view->tipo_gasto->caption() ?></span></td>
		<td data-name="tipo_gasto" <?php echo $tipo_gastos_view->tipo_gasto->cellAttributes() ?>>
<span id="el_tipo_gastos_tipo_gasto">
<span<?php echo $tipo_gastos_view->tipo_gasto->viewAttributes() ?>><?php echo $tipo_gastos_view->tipo_gasto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tipo_gastos_view->operacion->Visible) { // operacion ?>
	<tr id="r_operacion">
		<td class="<?php echo $tipo_gastos_view->TableLeftColumnClass ?>"><span id="elh_tipo_gastos_operacion"><?php echo $tipo_gastos_view->operacion->caption() ?></span></td>
		<td data-name="operacion" <?php echo $tipo_gastos_view->operacion->cellAttributes() ?>>
<span id="el_tipo_gastos_operacion">
<span<?php echo $tipo_gastos_view->operacion->viewAttributes() ?>><?php echo $tipo_gastos_view->operacion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$tipo_gastos_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tipo_gastos_view->isExport()) { ?>
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
$tipo_gastos_view->terminate();
?>