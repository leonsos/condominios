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
$gastos_ind_view = new gastos_ind_view();

// Run the page
$gastos_ind_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gastos_ind_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gastos_ind_view->isExport()) { ?>
<script>
var fgastos_indview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fgastos_indview = currentForm = new ew.Form("fgastos_indview", "view");
	loadjs.done("fgastos_indview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$gastos_ind_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $gastos_ind_view->ExportOptions->render("body") ?>
<?php $gastos_ind_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $gastos_ind_view->showPageHeader(); ?>
<?php
$gastos_ind_view->showMessage();
?>
<form name="fgastos_indview" id="fgastos_indview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gastos_ind">
<input type="hidden" name="modal" value="<?php echo (int)$gastos_ind_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($gastos_ind_view->id_gasto_ind->Visible) { // id_gasto_ind ?>
	<tr id="r_id_gasto_ind">
		<td class="<?php echo $gastos_ind_view->TableLeftColumnClass ?>"><span id="elh_gastos_ind_id_gasto_ind"><?php echo $gastos_ind_view->id_gasto_ind->caption() ?></span></td>
		<td data-name="id_gasto_ind" <?php echo $gastos_ind_view->id_gasto_ind->cellAttributes() ?>>
<span id="el_gastos_ind_id_gasto_ind">
<span<?php echo $gastos_ind_view->id_gasto_ind->viewAttributes() ?>><?php echo $gastos_ind_view->id_gasto_ind->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gastos_ind_view->tipo_gasto_id->Visible) { // tipo_gasto_id ?>
	<tr id="r_tipo_gasto_id">
		<td class="<?php echo $gastos_ind_view->TableLeftColumnClass ?>"><span id="elh_gastos_ind_tipo_gasto_id"><?php echo $gastos_ind_view->tipo_gasto_id->caption() ?></span></td>
		<td data-name="tipo_gasto_id" <?php echo $gastos_ind_view->tipo_gasto_id->cellAttributes() ?>>
<span id="el_gastos_ind_tipo_gasto_id">
<span<?php echo $gastos_ind_view->tipo_gasto_id->viewAttributes() ?>><?php echo $gastos_ind_view->tipo_gasto_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gastos_ind_view->monto->Visible) { // monto ?>
	<tr id="r_monto">
		<td class="<?php echo $gastos_ind_view->TableLeftColumnClass ?>"><span id="elh_gastos_ind_monto"><?php echo $gastos_ind_view->monto->caption() ?></span></td>
		<td data-name="monto" <?php echo $gastos_ind_view->monto->cellAttributes() ?>>
<span id="el_gastos_ind_monto">
<span<?php echo $gastos_ind_view->monto->viewAttributes() ?>><?php echo $gastos_ind_view->monto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gastos_ind_view->desde->Visible) { // desde ?>
	<tr id="r_desde">
		<td class="<?php echo $gastos_ind_view->TableLeftColumnClass ?>"><span id="elh_gastos_ind_desde"><?php echo $gastos_ind_view->desde->caption() ?></span></td>
		<td data-name="desde" <?php echo $gastos_ind_view->desde->cellAttributes() ?>>
<span id="el_gastos_ind_desde">
<span<?php echo $gastos_ind_view->desde->viewAttributes() ?>><?php echo $gastos_ind_view->desde->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gastos_ind_view->hasta->Visible) { // hasta ?>
	<tr id="r_hasta">
		<td class="<?php echo $gastos_ind_view->TableLeftColumnClass ?>"><span id="elh_gastos_ind_hasta"><?php echo $gastos_ind_view->hasta->caption() ?></span></td>
		<td data-name="hasta" <?php echo $gastos_ind_view->hasta->cellAttributes() ?>>
<span id="el_gastos_ind_hasta">
<span<?php echo $gastos_ind_view->hasta->viewAttributes() ?>><?php echo $gastos_ind_view->hasta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gastos_ind_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $gastos_ind_view->TableLeftColumnClass ?>"><span id="elh_gastos_ind_status"><?php echo $gastos_ind_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $gastos_ind_view->status->cellAttributes() ?>>
<span id="el_gastos_ind_status">
<span<?php echo $gastos_ind_view->status->viewAttributes() ?>><?php echo $gastos_ind_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($gastos_ind_view->apartamento_id->Visible) { // apartamento_id ?>
	<tr id="r_apartamento_id">
		<td class="<?php echo $gastos_ind_view->TableLeftColumnClass ?>"><span id="elh_gastos_ind_apartamento_id"><?php echo $gastos_ind_view->apartamento_id->caption() ?></span></td>
		<td data-name="apartamento_id" <?php echo $gastos_ind_view->apartamento_id->cellAttributes() ?>>
<span id="el_gastos_ind_apartamento_id">
<span<?php echo $gastos_ind_view->apartamento_id->viewAttributes() ?>><?php echo $gastos_ind_view->apartamento_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$gastos_ind_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gastos_ind_view->isExport()) { ?>
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
$gastos_ind_view->terminate();
?>