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
$gastos_delete = new gastos_delete();

// Run the page
$gastos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gastos_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgastosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fgastosdelete = currentForm = new ew.Form("fgastosdelete", "delete");
	loadjs.done("fgastosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gastos_delete->showPageHeader(); ?>
<?php
$gastos_delete->showMessage();
?>
<form name="fgastosdelete" id="fgastosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gastos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($gastos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($gastos_delete->id_gasto->Visible) { // id_gasto ?>
		<th class="<?php echo $gastos_delete->id_gasto->headerCellClass() ?>"><span id="elh_gastos_id_gasto" class="gastos_id_gasto"><?php echo $gastos_delete->id_gasto->caption() ?></span></th>
<?php } ?>
<?php if ($gastos_delete->tipo_gasto_id->Visible) { // tipo_gasto_id ?>
		<th class="<?php echo $gastos_delete->tipo_gasto_id->headerCellClass() ?>"><span id="elh_gastos_tipo_gasto_id" class="gastos_tipo_gasto_id"><?php echo $gastos_delete->tipo_gasto_id->caption() ?></span></th>
<?php } ?>
<?php if ($gastos_delete->monto->Visible) { // monto ?>
		<th class="<?php echo $gastos_delete->monto->headerCellClass() ?>"><span id="elh_gastos_monto" class="gastos_monto"><?php echo $gastos_delete->monto->caption() ?></span></th>
<?php } ?>
<?php if ($gastos_delete->condo_mens_id->Visible) { // condo_mens_id ?>
		<th class="<?php echo $gastos_delete->condo_mens_id->headerCellClass() ?>"><span id="elh_gastos_condo_mens_id" class="gastos_condo_mens_id"><?php echo $gastos_delete->condo_mens_id->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$gastos_delete->RecordCount = 0;
$i = 0;
while (!$gastos_delete->Recordset->EOF) {
	$gastos_delete->RecordCount++;
	$gastos_delete->RowCount++;

	// Set row properties
	$gastos->resetAttributes();
	$gastos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$gastos_delete->loadRowValues($gastos_delete->Recordset);

	// Render row
	$gastos_delete->renderRow();
?>
	<tr <?php echo $gastos->rowAttributes() ?>>
<?php if ($gastos_delete->id_gasto->Visible) { // id_gasto ?>
		<td <?php echo $gastos_delete->id_gasto->cellAttributes() ?>>
<span id="el<?php echo $gastos_delete->RowCount ?>_gastos_id_gasto" class="gastos_id_gasto">
<span<?php echo $gastos_delete->id_gasto->viewAttributes() ?>><?php echo $gastos_delete->id_gasto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gastos_delete->tipo_gasto_id->Visible) { // tipo_gasto_id ?>
		<td <?php echo $gastos_delete->tipo_gasto_id->cellAttributes() ?>>
<span id="el<?php echo $gastos_delete->RowCount ?>_gastos_tipo_gasto_id" class="gastos_tipo_gasto_id">
<span<?php echo $gastos_delete->tipo_gasto_id->viewAttributes() ?>><?php echo $gastos_delete->tipo_gasto_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gastos_delete->monto->Visible) { // monto ?>
		<td <?php echo $gastos_delete->monto->cellAttributes() ?>>
<span id="el<?php echo $gastos_delete->RowCount ?>_gastos_monto" class="gastos_monto">
<span<?php echo $gastos_delete->monto->viewAttributes() ?>><?php echo $gastos_delete->monto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gastos_delete->condo_mens_id->Visible) { // condo_mens_id ?>
		<td <?php echo $gastos_delete->condo_mens_id->cellAttributes() ?>>
<span id="el<?php echo $gastos_delete->RowCount ?>_gastos_condo_mens_id" class="gastos_condo_mens_id">
<span<?php echo $gastos_delete->condo_mens_id->viewAttributes() ?>><?php echo $gastos_delete->condo_mens_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$gastos_delete->Recordset->moveNext();
}
$gastos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gastos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$gastos_delete->showPageFooter();
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
$gastos_delete->terminate();
?>