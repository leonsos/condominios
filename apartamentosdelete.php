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
$apartamentos_delete = new apartamentos_delete();

// Run the page
$apartamentos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$apartamentos_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fapartamentosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fapartamentosdelete = currentForm = new ew.Form("fapartamentosdelete", "delete");
	loadjs.done("fapartamentosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $apartamentos_delete->showPageHeader(); ?>
<?php
$apartamentos_delete->showMessage();
?>
<form name="fapartamentosdelete" id="fapartamentosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="apartamentos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($apartamentos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($apartamentos_delete->id_apartamento->Visible) { // id_apartamento ?>
		<th class="<?php echo $apartamentos_delete->id_apartamento->headerCellClass() ?>"><span id="elh_apartamentos_id_apartamento" class="apartamentos_id_apartamento"><?php echo $apartamentos_delete->id_apartamento->caption() ?></span></th>
<?php } ?>
<?php if ($apartamentos_delete->propietario_id->Visible) { // propietario_id ?>
		<th class="<?php echo $apartamentos_delete->propietario_id->headerCellClass() ?>"><span id="elh_apartamentos_propietario_id" class="apartamentos_propietario_id"><?php echo $apartamentos_delete->propietario_id->caption() ?></span></th>
<?php } ?>
<?php if ($apartamentos_delete->piso_id->Visible) { // piso_id ?>
		<th class="<?php echo $apartamentos_delete->piso_id->headerCellClass() ?>"><span id="elh_apartamentos_piso_id" class="apartamentos_piso_id"><?php echo $apartamentos_delete->piso_id->caption() ?></span></th>
<?php } ?>
<?php if ($apartamentos_delete->metros_cuadrados->Visible) { // metros_cuadrados ?>
		<th class="<?php echo $apartamentos_delete->metros_cuadrados->headerCellClass() ?>"><span id="elh_apartamentos_metros_cuadrados" class="apartamentos_metros_cuadrados"><?php echo $apartamentos_delete->metros_cuadrados->caption() ?></span></th>
<?php } ?>
<?php if ($apartamentos_delete->nombre_numero->Visible) { // nombre_numero ?>
		<th class="<?php echo $apartamentos_delete->nombre_numero->headerCellClass() ?>"><span id="elh_apartamentos_nombre_numero" class="apartamentos_nombre_numero"><?php echo $apartamentos_delete->nombre_numero->caption() ?></span></th>
<?php } ?>
<?php if ($apartamentos_delete->alicuota->Visible) { // alicuota ?>
		<th class="<?php echo $apartamentos_delete->alicuota->headerCellClass() ?>"><span id="elh_apartamentos_alicuota" class="apartamentos_alicuota"><?php echo $apartamentos_delete->alicuota->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$apartamentos_delete->RecordCount = 0;
$i = 0;
while (!$apartamentos_delete->Recordset->EOF) {
	$apartamentos_delete->RecordCount++;
	$apartamentos_delete->RowCount++;

	// Set row properties
	$apartamentos->resetAttributes();
	$apartamentos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$apartamentos_delete->loadRowValues($apartamentos_delete->Recordset);

	// Render row
	$apartamentos_delete->renderRow();
?>
	<tr <?php echo $apartamentos->rowAttributes() ?>>
<?php if ($apartamentos_delete->id_apartamento->Visible) { // id_apartamento ?>
		<td <?php echo $apartamentos_delete->id_apartamento->cellAttributes() ?>>
<span id="el<?php echo $apartamentos_delete->RowCount ?>_apartamentos_id_apartamento" class="apartamentos_id_apartamento">
<span<?php echo $apartamentos_delete->id_apartamento->viewAttributes() ?>><?php echo $apartamentos_delete->id_apartamento->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($apartamentos_delete->propietario_id->Visible) { // propietario_id ?>
		<td <?php echo $apartamentos_delete->propietario_id->cellAttributes() ?>>
<span id="el<?php echo $apartamentos_delete->RowCount ?>_apartamentos_propietario_id" class="apartamentos_propietario_id">
<span<?php echo $apartamentos_delete->propietario_id->viewAttributes() ?>><?php echo $apartamentos_delete->propietario_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($apartamentos_delete->piso_id->Visible) { // piso_id ?>
		<td <?php echo $apartamentos_delete->piso_id->cellAttributes() ?>>
<span id="el<?php echo $apartamentos_delete->RowCount ?>_apartamentos_piso_id" class="apartamentos_piso_id">
<span<?php echo $apartamentos_delete->piso_id->viewAttributes() ?>><?php echo $apartamentos_delete->piso_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($apartamentos_delete->metros_cuadrados->Visible) { // metros_cuadrados ?>
		<td <?php echo $apartamentos_delete->metros_cuadrados->cellAttributes() ?>>
<span id="el<?php echo $apartamentos_delete->RowCount ?>_apartamentos_metros_cuadrados" class="apartamentos_metros_cuadrados">
<span<?php echo $apartamentos_delete->metros_cuadrados->viewAttributes() ?>><?php echo $apartamentos_delete->metros_cuadrados->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($apartamentos_delete->nombre_numero->Visible) { // nombre_numero ?>
		<td <?php echo $apartamentos_delete->nombre_numero->cellAttributes() ?>>
<span id="el<?php echo $apartamentos_delete->RowCount ?>_apartamentos_nombre_numero" class="apartamentos_nombre_numero">
<span<?php echo $apartamentos_delete->nombre_numero->viewAttributes() ?>><?php echo $apartamentos_delete->nombre_numero->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($apartamentos_delete->alicuota->Visible) { // alicuota ?>
		<td <?php echo $apartamentos_delete->alicuota->cellAttributes() ?>>
<span id="el<?php echo $apartamentos_delete->RowCount ?>_apartamentos_alicuota" class="apartamentos_alicuota">
<span<?php echo $apartamentos_delete->alicuota->viewAttributes() ?>><?php echo $apartamentos_delete->alicuota->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$apartamentos_delete->Recordset->moveNext();
}
$apartamentos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $apartamentos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$apartamentos_delete->showPageFooter();
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
$apartamentos_delete->terminate();
?>