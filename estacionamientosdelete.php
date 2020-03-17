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
$estacionamientos_delete = new estacionamientos_delete();

// Run the page
$estacionamientos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$estacionamientos_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var festacionamientosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	festacionamientosdelete = currentForm = new ew.Form("festacionamientosdelete", "delete");
	loadjs.done("festacionamientosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $estacionamientos_delete->showPageHeader(); ?>
<?php
$estacionamientos_delete->showMessage();
?>
<form name="festacionamientosdelete" id="festacionamientosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="estacionamientos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($estacionamientos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($estacionamientos_delete->id_estacionamiento->Visible) { // id_estacionamiento ?>
		<th class="<?php echo $estacionamientos_delete->id_estacionamiento->headerCellClass() ?>"><span id="elh_estacionamientos_id_estacionamiento" class="estacionamientos_id_estacionamiento"><?php echo $estacionamientos_delete->id_estacionamiento->caption() ?></span></th>
<?php } ?>
<?php if ($estacionamientos_delete->nombre->Visible) { // nombre ?>
		<th class="<?php echo $estacionamientos_delete->nombre->headerCellClass() ?>"><span id="elh_estacionamientos_nombre" class="estacionamientos_nombre"><?php echo $estacionamientos_delete->nombre->caption() ?></span></th>
<?php } ?>
<?php if ($estacionamientos_delete->apartamento_id->Visible) { // apartamento_id ?>
		<th class="<?php echo $estacionamientos_delete->apartamento_id->headerCellClass() ?>"><span id="elh_estacionamientos_apartamento_id" class="estacionamientos_apartamento_id"><?php echo $estacionamientos_delete->apartamento_id->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$estacionamientos_delete->RecordCount = 0;
$i = 0;
while (!$estacionamientos_delete->Recordset->EOF) {
	$estacionamientos_delete->RecordCount++;
	$estacionamientos_delete->RowCount++;

	// Set row properties
	$estacionamientos->resetAttributes();
	$estacionamientos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$estacionamientos_delete->loadRowValues($estacionamientos_delete->Recordset);

	// Render row
	$estacionamientos_delete->renderRow();
?>
	<tr <?php echo $estacionamientos->rowAttributes() ?>>
<?php if ($estacionamientos_delete->id_estacionamiento->Visible) { // id_estacionamiento ?>
		<td <?php echo $estacionamientos_delete->id_estacionamiento->cellAttributes() ?>>
<span id="el<?php echo $estacionamientos_delete->RowCount ?>_estacionamientos_id_estacionamiento" class="estacionamientos_id_estacionamiento">
<span<?php echo $estacionamientos_delete->id_estacionamiento->viewAttributes() ?>><?php echo $estacionamientos_delete->id_estacionamiento->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($estacionamientos_delete->nombre->Visible) { // nombre ?>
		<td <?php echo $estacionamientos_delete->nombre->cellAttributes() ?>>
<span id="el<?php echo $estacionamientos_delete->RowCount ?>_estacionamientos_nombre" class="estacionamientos_nombre">
<span<?php echo $estacionamientos_delete->nombre->viewAttributes() ?>><?php echo $estacionamientos_delete->nombre->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($estacionamientos_delete->apartamento_id->Visible) { // apartamento_id ?>
		<td <?php echo $estacionamientos_delete->apartamento_id->cellAttributes() ?>>
<span id="el<?php echo $estacionamientos_delete->RowCount ?>_estacionamientos_apartamento_id" class="estacionamientos_apartamento_id">
<span<?php echo $estacionamientos_delete->apartamento_id->viewAttributes() ?>><?php echo $estacionamientos_delete->apartamento_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$estacionamientos_delete->Recordset->moveNext();
}
$estacionamientos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $estacionamientos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$estacionamientos_delete->showPageFooter();
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
$estacionamientos_delete->terminate();
?>