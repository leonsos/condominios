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
$maleteros_delete = new maleteros_delete();

// Run the page
$maleteros_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$maleteros_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmaleterosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmaleterosdelete = currentForm = new ew.Form("fmaleterosdelete", "delete");
	loadjs.done("fmaleterosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $maleteros_delete->showPageHeader(); ?>
<?php
$maleteros_delete->showMessage();
?>
<form name="fmaleterosdelete" id="fmaleterosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="maleteros">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($maleteros_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($maleteros_delete->id_maletero->Visible) { // id_maletero ?>
		<th class="<?php echo $maleteros_delete->id_maletero->headerCellClass() ?>"><span id="elh_maleteros_id_maletero" class="maleteros_id_maletero"><?php echo $maleteros_delete->id_maletero->caption() ?></span></th>
<?php } ?>
<?php if ($maleteros_delete->nombre_numero->Visible) { // nombre_numero ?>
		<th class="<?php echo $maleteros_delete->nombre_numero->headerCellClass() ?>"><span id="elh_maleteros_nombre_numero" class="maleteros_nombre_numero"><?php echo $maleteros_delete->nombre_numero->caption() ?></span></th>
<?php } ?>
<?php if ($maleteros_delete->apartamento_id->Visible) { // apartamento_id ?>
		<th class="<?php echo $maleteros_delete->apartamento_id->headerCellClass() ?>"><span id="elh_maleteros_apartamento_id" class="maleteros_apartamento_id"><?php echo $maleteros_delete->apartamento_id->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$maleteros_delete->RecordCount = 0;
$i = 0;
while (!$maleteros_delete->Recordset->EOF) {
	$maleteros_delete->RecordCount++;
	$maleteros_delete->RowCount++;

	// Set row properties
	$maleteros->resetAttributes();
	$maleteros->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$maleteros_delete->loadRowValues($maleteros_delete->Recordset);

	// Render row
	$maleteros_delete->renderRow();
?>
	<tr <?php echo $maleteros->rowAttributes() ?>>
<?php if ($maleteros_delete->id_maletero->Visible) { // id_maletero ?>
		<td <?php echo $maleteros_delete->id_maletero->cellAttributes() ?>>
<span id="el<?php echo $maleteros_delete->RowCount ?>_maleteros_id_maletero" class="maleteros_id_maletero">
<span<?php echo $maleteros_delete->id_maletero->viewAttributes() ?>><?php echo $maleteros_delete->id_maletero->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($maleteros_delete->nombre_numero->Visible) { // nombre_numero ?>
		<td <?php echo $maleteros_delete->nombre_numero->cellAttributes() ?>>
<span id="el<?php echo $maleteros_delete->RowCount ?>_maleteros_nombre_numero" class="maleteros_nombre_numero">
<span<?php echo $maleteros_delete->nombre_numero->viewAttributes() ?>><?php echo $maleteros_delete->nombre_numero->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($maleteros_delete->apartamento_id->Visible) { // apartamento_id ?>
		<td <?php echo $maleteros_delete->apartamento_id->cellAttributes() ?>>
<span id="el<?php echo $maleteros_delete->RowCount ?>_maleteros_apartamento_id" class="maleteros_apartamento_id">
<span<?php echo $maleteros_delete->apartamento_id->viewAttributes() ?>><?php echo $maleteros_delete->apartamento_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$maleteros_delete->Recordset->moveNext();
}
$maleteros_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $maleteros_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$maleteros_delete->showPageFooter();
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
$maleteros_delete->terminate();
?>