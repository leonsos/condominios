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
$tipo_gastos_delete = new tipo_gastos_delete();

// Run the page
$tipo_gastos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tipo_gastos_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftipo_gastosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftipo_gastosdelete = currentForm = new ew.Form("ftipo_gastosdelete", "delete");
	loadjs.done("ftipo_gastosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tipo_gastos_delete->showPageHeader(); ?>
<?php
$tipo_gastos_delete->showMessage();
?>
<form name="ftipo_gastosdelete" id="ftipo_gastosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tipo_gastos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tipo_gastos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tipo_gastos_delete->id_tipo_gasto->Visible) { // id_tipo_gasto ?>
		<th class="<?php echo $tipo_gastos_delete->id_tipo_gasto->headerCellClass() ?>"><span id="elh_tipo_gastos_id_tipo_gasto" class="tipo_gastos_id_tipo_gasto"><?php echo $tipo_gastos_delete->id_tipo_gasto->caption() ?></span></th>
<?php } ?>
<?php if ($tipo_gastos_delete->nombre->Visible) { // nombre ?>
		<th class="<?php echo $tipo_gastos_delete->nombre->headerCellClass() ?>"><span id="elh_tipo_gastos_nombre" class="tipo_gastos_nombre"><?php echo $tipo_gastos_delete->nombre->caption() ?></span></th>
<?php } ?>
<?php if ($tipo_gastos_delete->tipo_gasto->Visible) { // tipo_gasto ?>
		<th class="<?php echo $tipo_gastos_delete->tipo_gasto->headerCellClass() ?>"><span id="elh_tipo_gastos_tipo_gasto" class="tipo_gastos_tipo_gasto"><?php echo $tipo_gastos_delete->tipo_gasto->caption() ?></span></th>
<?php } ?>
<?php if ($tipo_gastos_delete->operacion->Visible) { // operacion ?>
		<th class="<?php echo $tipo_gastos_delete->operacion->headerCellClass() ?>"><span id="elh_tipo_gastos_operacion" class="tipo_gastos_operacion"><?php echo $tipo_gastos_delete->operacion->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tipo_gastos_delete->RecordCount = 0;
$i = 0;
while (!$tipo_gastos_delete->Recordset->EOF) {
	$tipo_gastos_delete->RecordCount++;
	$tipo_gastos_delete->RowCount++;

	// Set row properties
	$tipo_gastos->resetAttributes();
	$tipo_gastos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tipo_gastos_delete->loadRowValues($tipo_gastos_delete->Recordset);

	// Render row
	$tipo_gastos_delete->renderRow();
?>
	<tr <?php echo $tipo_gastos->rowAttributes() ?>>
<?php if ($tipo_gastos_delete->id_tipo_gasto->Visible) { // id_tipo_gasto ?>
		<td <?php echo $tipo_gastos_delete->id_tipo_gasto->cellAttributes() ?>>
<span id="el<?php echo $tipo_gastos_delete->RowCount ?>_tipo_gastos_id_tipo_gasto" class="tipo_gastos_id_tipo_gasto">
<span<?php echo $tipo_gastos_delete->id_tipo_gasto->viewAttributes() ?>><?php echo $tipo_gastos_delete->id_tipo_gasto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tipo_gastos_delete->nombre->Visible) { // nombre ?>
		<td <?php echo $tipo_gastos_delete->nombre->cellAttributes() ?>>
<span id="el<?php echo $tipo_gastos_delete->RowCount ?>_tipo_gastos_nombre" class="tipo_gastos_nombre">
<span<?php echo $tipo_gastos_delete->nombre->viewAttributes() ?>><?php echo $tipo_gastos_delete->nombre->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tipo_gastos_delete->tipo_gasto->Visible) { // tipo_gasto ?>
		<td <?php echo $tipo_gastos_delete->tipo_gasto->cellAttributes() ?>>
<span id="el<?php echo $tipo_gastos_delete->RowCount ?>_tipo_gastos_tipo_gasto" class="tipo_gastos_tipo_gasto">
<span<?php echo $tipo_gastos_delete->tipo_gasto->viewAttributes() ?>><?php echo $tipo_gastos_delete->tipo_gasto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tipo_gastos_delete->operacion->Visible) { // operacion ?>
		<td <?php echo $tipo_gastos_delete->operacion->cellAttributes() ?>>
<span id="el<?php echo $tipo_gastos_delete->RowCount ?>_tipo_gastos_operacion" class="tipo_gastos_operacion">
<span<?php echo $tipo_gastos_delete->operacion->viewAttributes() ?>><?php echo $tipo_gastos_delete->operacion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tipo_gastos_delete->Recordset->moveNext();
}
$tipo_gastos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tipo_gastos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tipo_gastos_delete->showPageFooter();
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
$tipo_gastos_delete->terminate();
?>