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
$recibo_detalle_delete = new recibo_detalle_delete();

// Run the page
$recibo_detalle_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$recibo_detalle_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frecibo_detalledelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	frecibo_detalledelete = currentForm = new ew.Form("frecibo_detalledelete", "delete");
	loadjs.done("frecibo_detalledelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $recibo_detalle_delete->showPageHeader(); ?>
<?php
$recibo_detalle_delete->showMessage();
?>
<form name="frecibo_detalledelete" id="frecibo_detalledelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="recibo_detalle">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($recibo_detalle_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($recibo_detalle_delete->id_recibo_detalle->Visible) { // id_recibo_detalle ?>
		<th class="<?php echo $recibo_detalle_delete->id_recibo_detalle->headerCellClass() ?>"><span id="elh_recibo_detalle_id_recibo_detalle" class="recibo_detalle_id_recibo_detalle"><?php echo $recibo_detalle_delete->id_recibo_detalle->caption() ?></span></th>
<?php } ?>
<?php if ($recibo_detalle_delete->recibo_id->Visible) { // recibo_id ?>
		<th class="<?php echo $recibo_detalle_delete->recibo_id->headerCellClass() ?>"><span id="elh_recibo_detalle_recibo_id" class="recibo_detalle_recibo_id"><?php echo $recibo_detalle_delete->recibo_id->caption() ?></span></th>
<?php } ?>
<?php if ($recibo_detalle_delete->gastos_id->Visible) { // gastos_id ?>
		<th class="<?php echo $recibo_detalle_delete->gastos_id->headerCellClass() ?>"><span id="elh_recibo_detalle_gastos_id" class="recibo_detalle_gastos_id"><?php echo $recibo_detalle_delete->gastos_id->caption() ?></span></th>
<?php } ?>
<?php if ($recibo_detalle_delete->cantidad->Visible) { // cantidad ?>
		<th class="<?php echo $recibo_detalle_delete->cantidad->headerCellClass() ?>"><span id="elh_recibo_detalle_cantidad" class="recibo_detalle_cantidad"><?php echo $recibo_detalle_delete->cantidad->caption() ?></span></th>
<?php } ?>
<?php if ($recibo_detalle_delete->precio->Visible) { // precio ?>
		<th class="<?php echo $recibo_detalle_delete->precio->headerCellClass() ?>"><span id="elh_recibo_detalle_precio" class="recibo_detalle_precio"><?php echo $recibo_detalle_delete->precio->caption() ?></span></th>
<?php } ?>
<?php if ($recibo_detalle_delete->total->Visible) { // total ?>
		<th class="<?php echo $recibo_detalle_delete->total->headerCellClass() ?>"><span id="elh_recibo_detalle_total" class="recibo_detalle_total"><?php echo $recibo_detalle_delete->total->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$recibo_detalle_delete->RecordCount = 0;
$i = 0;
while (!$recibo_detalle_delete->Recordset->EOF) {
	$recibo_detalle_delete->RecordCount++;
	$recibo_detalle_delete->RowCount++;

	// Set row properties
	$recibo_detalle->resetAttributes();
	$recibo_detalle->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$recibo_detalle_delete->loadRowValues($recibo_detalle_delete->Recordset);

	// Render row
	$recibo_detalle_delete->renderRow();
?>
	<tr <?php echo $recibo_detalle->rowAttributes() ?>>
<?php if ($recibo_detalle_delete->id_recibo_detalle->Visible) { // id_recibo_detalle ?>
		<td <?php echo $recibo_detalle_delete->id_recibo_detalle->cellAttributes() ?>>
<span id="el<?php echo $recibo_detalle_delete->RowCount ?>_recibo_detalle_id_recibo_detalle" class="recibo_detalle_id_recibo_detalle">
<span<?php echo $recibo_detalle_delete->id_recibo_detalle->viewAttributes() ?>><?php echo $recibo_detalle_delete->id_recibo_detalle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($recibo_detalle_delete->recibo_id->Visible) { // recibo_id ?>
		<td <?php echo $recibo_detalle_delete->recibo_id->cellAttributes() ?>>
<span id="el<?php echo $recibo_detalle_delete->RowCount ?>_recibo_detalle_recibo_id" class="recibo_detalle_recibo_id">
<span<?php echo $recibo_detalle_delete->recibo_id->viewAttributes() ?>><?php echo $recibo_detalle_delete->recibo_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($recibo_detalle_delete->gastos_id->Visible) { // gastos_id ?>
		<td <?php echo $recibo_detalle_delete->gastos_id->cellAttributes() ?>>
<span id="el<?php echo $recibo_detalle_delete->RowCount ?>_recibo_detalle_gastos_id" class="recibo_detalle_gastos_id">
<span<?php echo $recibo_detalle_delete->gastos_id->viewAttributes() ?>><?php echo $recibo_detalle_delete->gastos_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($recibo_detalle_delete->cantidad->Visible) { // cantidad ?>
		<td <?php echo $recibo_detalle_delete->cantidad->cellAttributes() ?>>
<span id="el<?php echo $recibo_detalle_delete->RowCount ?>_recibo_detalle_cantidad" class="recibo_detalle_cantidad">
<span<?php echo $recibo_detalle_delete->cantidad->viewAttributes() ?>><?php echo $recibo_detalle_delete->cantidad->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($recibo_detalle_delete->precio->Visible) { // precio ?>
		<td <?php echo $recibo_detalle_delete->precio->cellAttributes() ?>>
<span id="el<?php echo $recibo_detalle_delete->RowCount ?>_recibo_detalle_precio" class="recibo_detalle_precio">
<span<?php echo $recibo_detalle_delete->precio->viewAttributes() ?>><?php echo $recibo_detalle_delete->precio->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($recibo_detalle_delete->total->Visible) { // total ?>
		<td <?php echo $recibo_detalle_delete->total->cellAttributes() ?>>
<span id="el<?php echo $recibo_detalle_delete->RowCount ?>_recibo_detalle_total" class="recibo_detalle_total">
<span<?php echo $recibo_detalle_delete->total->viewAttributes() ?>><?php echo $recibo_detalle_delete->total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$recibo_detalle_delete->Recordset->moveNext();
}
$recibo_detalle_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $recibo_detalle_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$recibo_detalle_delete->showPageFooter();
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
$recibo_detalle_delete->terminate();
?>