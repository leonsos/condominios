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
$recibos_delete = new recibos_delete();

// Run the page
$recibos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$recibos_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frecibosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	frecibosdelete = currentForm = new ew.Form("frecibosdelete", "delete");
	loadjs.done("frecibosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $recibos_delete->showPageHeader(); ?>
<?php
$recibos_delete->showMessage();
?>
<form name="frecibosdelete" id="frecibosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="recibos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($recibos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($recibos_delete->id_recibo->Visible) { // id_recibo ?>
		<th class="<?php echo $recibos_delete->id_recibo->headerCellClass() ?>"><span id="elh_recibos_id_recibo" class="recibos_id_recibo"><?php echo $recibos_delete->id_recibo->caption() ?></span></th>
<?php } ?>
<?php if ($recibos_delete->condo_mensual_id->Visible) { // condo_mensual_id ?>
		<th class="<?php echo $recibos_delete->condo_mensual_id->headerCellClass() ?>"><span id="elh_recibos_condo_mensual_id" class="recibos_condo_mensual_id"><?php echo $recibos_delete->condo_mensual_id->caption() ?></span></th>
<?php } ?>
<?php if ($recibos_delete->apartamento_id->Visible) { // apartamento_id ?>
		<th class="<?php echo $recibos_delete->apartamento_id->headerCellClass() ?>"><span id="elh_recibos_apartamento_id" class="recibos_apartamento_id"><?php echo $recibos_delete->apartamento_id->caption() ?></span></th>
<?php } ?>
<?php if ($recibos_delete->n_recibo->Visible) { // n_recibo ?>
		<th class="<?php echo $recibos_delete->n_recibo->headerCellClass() ?>"><span id="elh_recibos_n_recibo" class="recibos_n_recibo"><?php echo $recibos_delete->n_recibo->caption() ?></span></th>
<?php } ?>
<?php if ($recibos_delete->monto_pagar->Visible) { // monto_pagar ?>
		<th class="<?php echo $recibos_delete->monto_pagar->headerCellClass() ?>"><span id="elh_recibos_monto_pagar" class="recibos_monto_pagar"><?php echo $recibos_delete->monto_pagar->caption() ?></span></th>
<?php } ?>
<?php if ($recibos_delete->monto_ind->Visible) { // monto_ind ?>
		<th class="<?php echo $recibos_delete->monto_ind->headerCellClass() ?>"><span id="elh_recibos_monto_ind" class="recibos_monto_ind"><?php echo $recibos_delete->monto_ind->caption() ?></span></th>
<?php } ?>
<?php if ($recibos_delete->monto_alicuota->Visible) { // monto_alicuota ?>
		<th class="<?php echo $recibos_delete->monto_alicuota->headerCellClass() ?>"><span id="elh_recibos_monto_alicuota" class="recibos_monto_alicuota"><?php echo $recibos_delete->monto_alicuota->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$recibos_delete->RecordCount = 0;
$i = 0;
while (!$recibos_delete->Recordset->EOF) {
	$recibos_delete->RecordCount++;
	$recibos_delete->RowCount++;

	// Set row properties
	$recibos->resetAttributes();
	$recibos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$recibos_delete->loadRowValues($recibos_delete->Recordset);

	// Render row
	$recibos_delete->renderRow();
?>
	<tr <?php echo $recibos->rowAttributes() ?>>
<?php if ($recibos_delete->id_recibo->Visible) { // id_recibo ?>
		<td <?php echo $recibos_delete->id_recibo->cellAttributes() ?>>
<span id="el<?php echo $recibos_delete->RowCount ?>_recibos_id_recibo" class="recibos_id_recibo">
<span<?php echo $recibos_delete->id_recibo->viewAttributes() ?>><?php echo $recibos_delete->id_recibo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($recibos_delete->condo_mensual_id->Visible) { // condo_mensual_id ?>
		<td <?php echo $recibos_delete->condo_mensual_id->cellAttributes() ?>>
<span id="el<?php echo $recibos_delete->RowCount ?>_recibos_condo_mensual_id" class="recibos_condo_mensual_id">
<span<?php echo $recibos_delete->condo_mensual_id->viewAttributes() ?>><?php echo $recibos_delete->condo_mensual_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($recibos_delete->apartamento_id->Visible) { // apartamento_id ?>
		<td <?php echo $recibos_delete->apartamento_id->cellAttributes() ?>>
<span id="el<?php echo $recibos_delete->RowCount ?>_recibos_apartamento_id" class="recibos_apartamento_id">
<span<?php echo $recibos_delete->apartamento_id->viewAttributes() ?>><?php echo $recibos_delete->apartamento_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($recibos_delete->n_recibo->Visible) { // n_recibo ?>
		<td <?php echo $recibos_delete->n_recibo->cellAttributes() ?>>
<span id="el<?php echo $recibos_delete->RowCount ?>_recibos_n_recibo" class="recibos_n_recibo">
<span<?php echo $recibos_delete->n_recibo->viewAttributes() ?>><?php echo $recibos_delete->n_recibo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($recibos_delete->monto_pagar->Visible) { // monto_pagar ?>
		<td <?php echo $recibos_delete->monto_pagar->cellAttributes() ?>>
<span id="el<?php echo $recibos_delete->RowCount ?>_recibos_monto_pagar" class="recibos_monto_pagar">
<span<?php echo $recibos_delete->monto_pagar->viewAttributes() ?>><?php echo $recibos_delete->monto_pagar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($recibos_delete->monto_ind->Visible) { // monto_ind ?>
		<td <?php echo $recibos_delete->monto_ind->cellAttributes() ?>>
<span id="el<?php echo $recibos_delete->RowCount ?>_recibos_monto_ind" class="recibos_monto_ind">
<span<?php echo $recibos_delete->monto_ind->viewAttributes() ?>><?php echo $recibos_delete->monto_ind->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($recibos_delete->monto_alicuota->Visible) { // monto_alicuota ?>
		<td <?php echo $recibos_delete->monto_alicuota->cellAttributes() ?>>
<span id="el<?php echo $recibos_delete->RowCount ?>_recibos_monto_alicuota" class="recibos_monto_alicuota">
<span<?php echo $recibos_delete->monto_alicuota->viewAttributes() ?>><?php echo $recibos_delete->monto_alicuota->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$recibos_delete->Recordset->moveNext();
}
$recibos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $recibos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$recibos_delete->showPageFooter();
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
$recibos_delete->terminate();
?>