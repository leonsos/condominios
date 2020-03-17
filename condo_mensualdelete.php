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
$condo_mensual_delete = new condo_mensual_delete();

// Run the page
$condo_mensual_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$condo_mensual_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcondo_mensualdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcondo_mensualdelete = currentForm = new ew.Form("fcondo_mensualdelete", "delete");
	loadjs.done("fcondo_mensualdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $condo_mensual_delete->showPageHeader(); ?>
<?php
$condo_mensual_delete->showMessage();
?>
<form name="fcondo_mensualdelete" id="fcondo_mensualdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="condo_mensual">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($condo_mensual_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($condo_mensual_delete->id_condo_mensual->Visible) { // id_condo_mensual ?>
		<th class="<?php echo $condo_mensual_delete->id_condo_mensual->headerCellClass() ?>"><span id="elh_condo_mensual_id_condo_mensual" class="condo_mensual_id_condo_mensual"><?php echo $condo_mensual_delete->id_condo_mensual->caption() ?></span></th>
<?php } ?>
<?php if ($condo_mensual_delete->mes->Visible) { // mes ?>
		<th class="<?php echo $condo_mensual_delete->mes->headerCellClass() ?>"><span id="elh_condo_mensual_mes" class="condo_mensual_mes"><?php echo $condo_mensual_delete->mes->caption() ?></span></th>
<?php } ?>
<?php if ($condo_mensual_delete->ano->Visible) { // año ?>
		<th class="<?php echo $condo_mensual_delete->ano->headerCellClass() ?>"><span id="elh_condo_mensual_ano" class="condo_mensual_ano"><?php echo $condo_mensual_delete->ano->caption() ?></span></th>
<?php } ?>
<?php if ($condo_mensual_delete->aux->Visible) { // aux ?>
		<th class="<?php echo $condo_mensual_delete->aux->headerCellClass() ?>"><span id="elh_condo_mensual_aux" class="condo_mensual_aux"><?php echo $condo_mensual_delete->aux->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$condo_mensual_delete->RecordCount = 0;
$i = 0;
while (!$condo_mensual_delete->Recordset->EOF) {
	$condo_mensual_delete->RecordCount++;
	$condo_mensual_delete->RowCount++;

	// Set row properties
	$condo_mensual->resetAttributes();
	$condo_mensual->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$condo_mensual_delete->loadRowValues($condo_mensual_delete->Recordset);

	// Render row
	$condo_mensual_delete->renderRow();
?>
	<tr <?php echo $condo_mensual->rowAttributes() ?>>
<?php if ($condo_mensual_delete->id_condo_mensual->Visible) { // id_condo_mensual ?>
		<td <?php echo $condo_mensual_delete->id_condo_mensual->cellAttributes() ?>>
<span id="el<?php echo $condo_mensual_delete->RowCount ?>_condo_mensual_id_condo_mensual" class="condo_mensual_id_condo_mensual">
<span<?php echo $condo_mensual_delete->id_condo_mensual->viewAttributes() ?>><?php echo $condo_mensual_delete->id_condo_mensual->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($condo_mensual_delete->mes->Visible) { // mes ?>
		<td <?php echo $condo_mensual_delete->mes->cellAttributes() ?>>
<span id="el<?php echo $condo_mensual_delete->RowCount ?>_condo_mensual_mes" class="condo_mensual_mes">
<span<?php echo $condo_mensual_delete->mes->viewAttributes() ?>><?php echo $condo_mensual_delete->mes->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($condo_mensual_delete->ano->Visible) { // año ?>
		<td <?php echo $condo_mensual_delete->ano->cellAttributes() ?>>
<span id="el<?php echo $condo_mensual_delete->RowCount ?>_condo_mensual_ano" class="condo_mensual_ano">
<span<?php echo $condo_mensual_delete->ano->viewAttributes() ?>><?php echo $condo_mensual_delete->ano->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($condo_mensual_delete->aux->Visible) { // aux ?>
		<td <?php echo $condo_mensual_delete->aux->cellAttributes() ?>>
<span id="el<?php echo $condo_mensual_delete->RowCount ?>_condo_mensual_aux" class="condo_mensual_aux">
<span<?php echo $condo_mensual_delete->aux->viewAttributes() ?>><?php echo $condo_mensual_delete->aux->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$condo_mensual_delete->Recordset->moveNext();
}
$condo_mensual_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $condo_mensual_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$condo_mensual_delete->showPageFooter();
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
$condo_mensual_delete->terminate();
?>