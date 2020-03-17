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
$edificios_delete = new edificios_delete();

// Run the page
$edificios_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$edificios_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fedificiosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fedificiosdelete = currentForm = new ew.Form("fedificiosdelete", "delete");
	loadjs.done("fedificiosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $edificios_delete->showPageHeader(); ?>
<?php
$edificios_delete->showMessage();
?>
<form name="fedificiosdelete" id="fedificiosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="edificios">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($edificios_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($edificios_delete->id_edificio->Visible) { // id_edificio ?>
		<th class="<?php echo $edificios_delete->id_edificio->headerCellClass() ?>"><span id="elh_edificios_id_edificio" class="edificios_id_edificio"><?php echo $edificios_delete->id_edificio->caption() ?></span></th>
<?php } ?>
<?php if ($edificios_delete->residencia_id->Visible) { // residencia_id ?>
		<th class="<?php echo $edificios_delete->residencia_id->headerCellClass() ?>"><span id="elh_edificios_residencia_id" class="edificios_residencia_id"><?php echo $edificios_delete->residencia_id->caption() ?></span></th>
<?php } ?>
<?php if ($edificios_delete->nombre->Visible) { // nombre ?>
		<th class="<?php echo $edificios_delete->nombre->headerCellClass() ?>"><span id="elh_edificios_nombre" class="edificios_nombre"><?php echo $edificios_delete->nombre->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$edificios_delete->RecordCount = 0;
$i = 0;
while (!$edificios_delete->Recordset->EOF) {
	$edificios_delete->RecordCount++;
	$edificios_delete->RowCount++;

	// Set row properties
	$edificios->resetAttributes();
	$edificios->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$edificios_delete->loadRowValues($edificios_delete->Recordset);

	// Render row
	$edificios_delete->renderRow();
?>
	<tr <?php echo $edificios->rowAttributes() ?>>
<?php if ($edificios_delete->id_edificio->Visible) { // id_edificio ?>
		<td <?php echo $edificios_delete->id_edificio->cellAttributes() ?>>
<span id="el<?php echo $edificios_delete->RowCount ?>_edificios_id_edificio" class="edificios_id_edificio">
<span<?php echo $edificios_delete->id_edificio->viewAttributes() ?>><?php echo $edificios_delete->id_edificio->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($edificios_delete->residencia_id->Visible) { // residencia_id ?>
		<td <?php echo $edificios_delete->residencia_id->cellAttributes() ?>>
<span id="el<?php echo $edificios_delete->RowCount ?>_edificios_residencia_id" class="edificios_residencia_id">
<span<?php echo $edificios_delete->residencia_id->viewAttributes() ?>><?php echo $edificios_delete->residencia_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($edificios_delete->nombre->Visible) { // nombre ?>
		<td <?php echo $edificios_delete->nombre->cellAttributes() ?>>
<span id="el<?php echo $edificios_delete->RowCount ?>_edificios_nombre" class="edificios_nombre">
<span<?php echo $edificios_delete->nombre->viewAttributes() ?>><?php echo $edificios_delete->nombre->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$edificios_delete->Recordset->moveNext();
}
$edificios_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $edificios_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$edificios_delete->showPageFooter();
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
$edificios_delete->terminate();
?>