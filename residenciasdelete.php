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
$residencias_delete = new residencias_delete();

// Run the page
$residencias_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$residencias_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fresidenciasdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fresidenciasdelete = currentForm = new ew.Form("fresidenciasdelete", "delete");
	loadjs.done("fresidenciasdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $residencias_delete->showPageHeader(); ?>
<?php
$residencias_delete->showMessage();
?>
<form name="fresidenciasdelete" id="fresidenciasdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="residencias">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($residencias_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($residencias_delete->id_residencia->Visible) { // id_residencia ?>
		<th class="<?php echo $residencias_delete->id_residencia->headerCellClass() ?>"><span id="elh_residencias_id_residencia" class="residencias_id_residencia"><?php echo $residencias_delete->id_residencia->caption() ?></span></th>
<?php } ?>
<?php if ($residencias_delete->nombre->Visible) { // nombre ?>
		<th class="<?php echo $residencias_delete->nombre->headerCellClass() ?>"><span id="elh_residencias_nombre" class="residencias_nombre"><?php echo $residencias_delete->nombre->caption() ?></span></th>
<?php } ?>
<?php if ($residencias_delete->presidente->Visible) { // presidente ?>
		<th class="<?php echo $residencias_delete->presidente->headerCellClass() ?>"><span id="elh_residencias_presidente" class="residencias_presidente"><?php echo $residencias_delete->presidente->caption() ?></span></th>
<?php } ?>
<?php if ($residencias_delete->presidente_telefono->Visible) { // presidente_telefono ?>
		<th class="<?php echo $residencias_delete->presidente_telefono->headerCellClass() ?>"><span id="elh_residencias_presidente_telefono" class="residencias_presidente_telefono"><?php echo $residencias_delete->presidente_telefono->caption() ?></span></th>
<?php } ?>
<?php if ($residencias_delete->consecutivo_recibo->Visible) { // consecutivo_recibo ?>
		<th class="<?php echo $residencias_delete->consecutivo_recibo->headerCellClass() ?>"><span id="elh_residencias_consecutivo_recibo" class="residencias_consecutivo_recibo"><?php echo $residencias_delete->consecutivo_recibo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$residencias_delete->RecordCount = 0;
$i = 0;
while (!$residencias_delete->Recordset->EOF) {
	$residencias_delete->RecordCount++;
	$residencias_delete->RowCount++;

	// Set row properties
	$residencias->resetAttributes();
	$residencias->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$residencias_delete->loadRowValues($residencias_delete->Recordset);

	// Render row
	$residencias_delete->renderRow();
?>
	<tr <?php echo $residencias->rowAttributes() ?>>
<?php if ($residencias_delete->id_residencia->Visible) { // id_residencia ?>
		<td <?php echo $residencias_delete->id_residencia->cellAttributes() ?>>
<span id="el<?php echo $residencias_delete->RowCount ?>_residencias_id_residencia" class="residencias_id_residencia">
<span<?php echo $residencias_delete->id_residencia->viewAttributes() ?>><?php echo $residencias_delete->id_residencia->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($residencias_delete->nombre->Visible) { // nombre ?>
		<td <?php echo $residencias_delete->nombre->cellAttributes() ?>>
<span id="el<?php echo $residencias_delete->RowCount ?>_residencias_nombre" class="residencias_nombre">
<span<?php echo $residencias_delete->nombre->viewAttributes() ?>><?php echo $residencias_delete->nombre->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($residencias_delete->presidente->Visible) { // presidente ?>
		<td <?php echo $residencias_delete->presidente->cellAttributes() ?>>
<span id="el<?php echo $residencias_delete->RowCount ?>_residencias_presidente" class="residencias_presidente">
<span<?php echo $residencias_delete->presidente->viewAttributes() ?>><?php echo $residencias_delete->presidente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($residencias_delete->presidente_telefono->Visible) { // presidente_telefono ?>
		<td <?php echo $residencias_delete->presidente_telefono->cellAttributes() ?>>
<span id="el<?php echo $residencias_delete->RowCount ?>_residencias_presidente_telefono" class="residencias_presidente_telefono">
<span<?php echo $residencias_delete->presidente_telefono->viewAttributes() ?>><?php echo $residencias_delete->presidente_telefono->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($residencias_delete->consecutivo_recibo->Visible) { // consecutivo_recibo ?>
		<td <?php echo $residencias_delete->consecutivo_recibo->cellAttributes() ?>>
<span id="el<?php echo $residencias_delete->RowCount ?>_residencias_consecutivo_recibo" class="residencias_consecutivo_recibo">
<span<?php echo $residencias_delete->consecutivo_recibo->viewAttributes() ?>><?php echo $residencias_delete->consecutivo_recibo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$residencias_delete->Recordset->moveNext();
}
$residencias_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $residencias_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$residencias_delete->showPageFooter();
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
$residencias_delete->terminate();
?>