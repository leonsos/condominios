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
$recibo_detalle_view = new recibo_detalle_view();

// Run the page
$recibo_detalle_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$recibo_detalle_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$recibo_detalle_view->isExport()) { ?>
<script>
var frecibo_detalleview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	frecibo_detalleview = currentForm = new ew.Form("frecibo_detalleview", "view");
	loadjs.done("frecibo_detalleview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$recibo_detalle_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $recibo_detalle_view->ExportOptions->render("body") ?>
<?php $recibo_detalle_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $recibo_detalle_view->showPageHeader(); ?>
<?php
$recibo_detalle_view->showMessage();
?>
<form name="frecibo_detalleview" id="frecibo_detalleview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="recibo_detalle">
<input type="hidden" name="modal" value="<?php echo (int)$recibo_detalle_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($recibo_detalle_view->id_recibo_detalle->Visible) { // id_recibo_detalle ?>
	<tr id="r_id_recibo_detalle">
		<td class="<?php echo $recibo_detalle_view->TableLeftColumnClass ?>"><span id="elh_recibo_detalle_id_recibo_detalle"><?php echo $recibo_detalle_view->id_recibo_detalle->caption() ?></span></td>
		<td data-name="id_recibo_detalle" <?php echo $recibo_detalle_view->id_recibo_detalle->cellAttributes() ?>>
<span id="el_recibo_detalle_id_recibo_detalle">
<span<?php echo $recibo_detalle_view->id_recibo_detalle->viewAttributes() ?>><?php echo $recibo_detalle_view->id_recibo_detalle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($recibo_detalle_view->recibo_id->Visible) { // recibo_id ?>
	<tr id="r_recibo_id">
		<td class="<?php echo $recibo_detalle_view->TableLeftColumnClass ?>"><span id="elh_recibo_detalle_recibo_id"><?php echo $recibo_detalle_view->recibo_id->caption() ?></span></td>
		<td data-name="recibo_id" <?php echo $recibo_detalle_view->recibo_id->cellAttributes() ?>>
<span id="el_recibo_detalle_recibo_id">
<span<?php echo $recibo_detalle_view->recibo_id->viewAttributes() ?>><?php echo $recibo_detalle_view->recibo_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($recibo_detalle_view->gastos_id->Visible) { // gastos_id ?>
	<tr id="r_gastos_id">
		<td class="<?php echo $recibo_detalle_view->TableLeftColumnClass ?>"><span id="elh_recibo_detalle_gastos_id"><?php echo $recibo_detalle_view->gastos_id->caption() ?></span></td>
		<td data-name="gastos_id" <?php echo $recibo_detalle_view->gastos_id->cellAttributes() ?>>
<span id="el_recibo_detalle_gastos_id">
<span<?php echo $recibo_detalle_view->gastos_id->viewAttributes() ?>><?php echo $recibo_detalle_view->gastos_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($recibo_detalle_view->cantidad->Visible) { // cantidad ?>
	<tr id="r_cantidad">
		<td class="<?php echo $recibo_detalle_view->TableLeftColumnClass ?>"><span id="elh_recibo_detalle_cantidad"><?php echo $recibo_detalle_view->cantidad->caption() ?></span></td>
		<td data-name="cantidad" <?php echo $recibo_detalle_view->cantidad->cellAttributes() ?>>
<span id="el_recibo_detalle_cantidad">
<span<?php echo $recibo_detalle_view->cantidad->viewAttributes() ?>><?php echo $recibo_detalle_view->cantidad->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($recibo_detalle_view->precio->Visible) { // precio ?>
	<tr id="r_precio">
		<td class="<?php echo $recibo_detalle_view->TableLeftColumnClass ?>"><span id="elh_recibo_detalle_precio"><?php echo $recibo_detalle_view->precio->caption() ?></span></td>
		<td data-name="precio" <?php echo $recibo_detalle_view->precio->cellAttributes() ?>>
<span id="el_recibo_detalle_precio">
<span<?php echo $recibo_detalle_view->precio->viewAttributes() ?>><?php echo $recibo_detalle_view->precio->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($recibo_detalle_view->total->Visible) { // total ?>
	<tr id="r_total">
		<td class="<?php echo $recibo_detalle_view->TableLeftColumnClass ?>"><span id="elh_recibo_detalle_total"><?php echo $recibo_detalle_view->total->caption() ?></span></td>
		<td data-name="total" <?php echo $recibo_detalle_view->total->cellAttributes() ?>>
<span id="el_recibo_detalle_total">
<span<?php echo $recibo_detalle_view->total->viewAttributes() ?>><?php echo $recibo_detalle_view->total->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$recibo_detalle_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$recibo_detalle_view->isExport()) { ?>
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
$recibo_detalle_view->terminate();
?>