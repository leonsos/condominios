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
$gastos_view = new gastos_view();

// Run the page
$gastos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gastos_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gastos_view->isExport()) { ?>
<script>
var fgastosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fgastosview = currentForm = new ew.Form("fgastosview", "view");
	loadjs.done("fgastosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$gastos_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $gastos_view->ExportOptions->render("body") ?>
<?php $gastos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $gastos_view->showPageHeader(); ?>
<?php
$gastos_view->showMessage();
?>
<form name="fgastosview" id="fgastosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gastos">
<input type="hidden" name="modal" value="<?php echo (int)$gastos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($gastos_view->id_gasto->Visible) { // id_gasto ?>
	<tr id="r_id_gasto">
		<td class="<?php echo $gastos_view->TableLeftColumnClass ?>"><span id="elh_gastos_id_gasto"><?php echo $gastos_view->id_gasto->caption() ?></span></td>
		<td data-name="id_gasto" <?php echo $gastos_view->id_gasto->cellAttributes() ?>>
<span id="el_gastos_id_gasto">
<span<?php echo $gastos_view->id_gasto->viewAttributes() ?>><?php echo $gastos_view->id_gasto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gastos_view->tipo_gasto_id->Visible) { // tipo_gasto_id ?>
	<tr id="r_tipo_gasto_id">
		<td class="<?php echo $gastos_view->TableLeftColumnClass ?>"><span id="elh_gastos_tipo_gasto_id"><?php echo $gastos_view->tipo_gasto_id->caption() ?></span></td>
		<td data-name="tipo_gasto_id" <?php echo $gastos_view->tipo_gasto_id->cellAttributes() ?>>
<span id="el_gastos_tipo_gasto_id">
<span<?php echo $gastos_view->tipo_gasto_id->viewAttributes() ?>><?php echo $gastos_view->tipo_gasto_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gastos_view->monto->Visible) { // monto ?>
	<tr id="r_monto">
		<td class="<?php echo $gastos_view->TableLeftColumnClass ?>"><span id="elh_gastos_monto"><?php echo $gastos_view->monto->caption() ?></span></td>
		<td data-name="monto" <?php echo $gastos_view->monto->cellAttributes() ?>>
<span id="el_gastos_monto">
<span<?php echo $gastos_view->monto->viewAttributes() ?>><?php echo $gastos_view->monto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gastos_view->condo_mens_id->Visible) { // condo_mens_id ?>
	<tr id="r_condo_mens_id">
		<td class="<?php echo $gastos_view->TableLeftColumnClass ?>"><span id="elh_gastos_condo_mens_id"><?php echo $gastos_view->condo_mens_id->caption() ?></span></td>
		<td data-name="condo_mens_id" <?php echo $gastos_view->condo_mens_id->cellAttributes() ?>>
<span id="el_gastos_condo_mens_id">
<span<?php echo $gastos_view->condo_mens_id->viewAttributes() ?>><?php echo $gastos_view->condo_mens_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$gastos_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gastos_view->isExport()) { ?>
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
$gastos_view->terminate();
?>