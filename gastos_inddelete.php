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
$gastos_ind_delete = new gastos_ind_delete();

// Run the page
$gastos_ind_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gastos_ind_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgastos_inddelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fgastos_inddelete = currentForm = new ew.Form("fgastos_inddelete", "delete");
	loadjs.done("fgastos_inddelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gastos_ind_delete->showPageHeader(); ?>
<?php
$gastos_ind_delete->showMessage();
?>
<form name="fgastos_inddelete" id="fgastos_inddelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gastos_ind">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($gastos_ind_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($gastos_ind_delete->id_gasto_ind->Visible) { // id_gasto_ind ?>
		<th class="<?php echo $gastos_ind_delete->id_gasto_ind->headerCellClass() ?>"><span id="elh_gastos_ind_id_gasto_ind" class="gastos_ind_id_gasto_ind"><?php echo $gastos_ind_delete->id_gasto_ind->caption() ?></span></th>
<?php } ?>
<?php if ($gastos_ind_delete->tipo_gasto_id->Visible) { // tipo_gasto_id ?>
		<th class="<?php echo $gastos_ind_delete->tipo_gasto_id->headerCellClass() ?>"><span id="elh_gastos_ind_tipo_gasto_id" class="gastos_ind_tipo_gasto_id"><?php echo $gastos_ind_delete->tipo_gasto_id->caption() ?></span></th>
<?php } ?>
<?php if ($gastos_ind_delete->monto->Visible) { // monto ?>
		<th class="<?php echo $gastos_ind_delete->monto->headerCellClass() ?>"><span id="elh_gastos_ind_monto" class="gastos_ind_monto"><?php echo $gastos_ind_delete->monto->caption() ?></span></th>
<?php } ?>
<?php if ($gastos_ind_delete->desde->Visible) { // desde ?>
		<th class="<?php echo $gastos_ind_delete->desde->headerCellClass() ?>"><span id="elh_gastos_ind_desde" class="gastos_ind_desde"><?php echo $gastos_ind_delete->desde->caption() ?></span></th>
<?php } ?>
<?php if ($gastos_ind_delete->hasta->Visible) { // hasta ?>
		<th class="<?php echo $gastos_ind_delete->hasta->headerCellClass() ?>"><span id="elh_gastos_ind_hasta" class="gastos_ind_hasta"><?php echo $gastos_ind_delete->hasta->caption() ?></span></th>
<?php } ?>
<?php if ($gastos_ind_delete->status->Visible) { // status ?>
		<th class="<?php echo $gastos_ind_delete->status->headerCellClass() ?>"><span id="elh_gastos_ind_status" class="gastos_ind_status"><?php echo $gastos_ind_delete->status->caption() ?></span></th>
<?php } ?>
<?php if ($gastos_ind_delete->apartamento_id->Visible) { // apartamento_id ?>
		<th class="<?php echo $gastos_ind_delete->apartamento_id->headerCellClass() ?>"><span id="elh_gastos_ind_apartamento_id" class="gastos_ind_apartamento_id"><?php echo $gastos_ind_delete->apartamento_id->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$gastos_ind_delete->RecordCount = 0;
$i = 0;
while (!$gastos_ind_delete->Recordset->EOF) {
	$gastos_ind_delete->RecordCount++;
	$gastos_ind_delete->RowCount++;

	// Set row properties
	$gastos_ind->resetAttributes();
	$gastos_ind->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$gastos_ind_delete->loadRowValues($gastos_ind_delete->Recordset);

	// Render row
	$gastos_ind_delete->renderRow();
?>
	<tr <?php echo $gastos_ind->rowAttributes() ?>>
<?php if ($gastos_ind_delete->id_gasto_ind->Visible) { // id_gasto_ind ?>
		<td <?php echo $gastos_ind_delete->id_gasto_ind->cellAttributes() ?>>
<span id="el<?php echo $gastos_ind_delete->RowCount ?>_gastos_ind_id_gasto_ind" class="gastos_ind_id_gasto_ind">
<span<?php echo $gastos_ind_delete->id_gasto_ind->viewAttributes() ?>><?php echo $gastos_ind_delete->id_gasto_ind->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gastos_ind_delete->tipo_gasto_id->Visible) { // tipo_gasto_id ?>
		<td <?php echo $gastos_ind_delete->tipo_gasto_id->cellAttributes() ?>>
<span id="el<?php echo $gastos_ind_delete->RowCount ?>_gastos_ind_tipo_gasto_id" class="gastos_ind_tipo_gasto_id">
<span<?php echo $gastos_ind_delete->tipo_gasto_id->viewAttributes() ?>><?php echo $gastos_ind_delete->tipo_gasto_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gastos_ind_delete->monto->Visible) { // monto ?>
		<td <?php echo $gastos_ind_delete->monto->cellAttributes() ?>>
<span id="el<?php echo $gastos_ind_delete->RowCount ?>_gastos_ind_monto" class="gastos_ind_monto">
<span<?php echo $gastos_ind_delete->monto->viewAttributes() ?>><?php echo $gastos_ind_delete->monto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gastos_ind_delete->desde->Visible) { // desde ?>
		<td <?php echo $gastos_ind_delete->desde->cellAttributes() ?>>
<span id="el<?php echo $gastos_ind_delete->RowCount ?>_gastos_ind_desde" class="gastos_ind_desde">
<span<?php echo $gastos_ind_delete->desde->viewAttributes() ?>><?php echo $gastos_ind_delete->desde->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gastos_ind_delete->hasta->Visible) { // hasta ?>
		<td <?php echo $gastos_ind_delete->hasta->cellAttributes() ?>>
<span id="el<?php echo $gastos_ind_delete->RowCount ?>_gastos_ind_hasta" class="gastos_ind_hasta">
<span<?php echo $gastos_ind_delete->hasta->viewAttributes() ?>><?php echo $gastos_ind_delete->hasta->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gastos_ind_delete->status->Visible) { // status ?>
		<td <?php echo $gastos_ind_delete->status->cellAttributes() ?>>
<span id="el<?php echo $gastos_ind_delete->RowCount ?>_gastos_ind_status" class="gastos_ind_status">
<span<?php echo $gastos_ind_delete->status->viewAttributes() ?>><?php echo $gastos_ind_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gastos_ind_delete->apartamento_id->Visible) { // apartamento_id ?>
		<td <?php echo $gastos_ind_delete->apartamento_id->cellAttributes() ?>>
<span id="el<?php echo $gastos_ind_delete->RowCount ?>_gastos_ind_apartamento_id" class="gastos_ind_apartamento_id">
<span<?php echo $gastos_ind_delete->apartamento_id->viewAttributes() ?>><?php echo $gastos_ind_delete->apartamento_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$gastos_ind_delete->Recordset->moveNext();
}
$gastos_ind_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gastos_ind_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$gastos_ind_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$gastos_ind_delete->terminate();
?>