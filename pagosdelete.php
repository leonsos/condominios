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
$pagos_delete = new pagos_delete();

// Run the page
$pagos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pagos_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpagosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpagosdelete = currentForm = new ew.Form("fpagosdelete", "delete");
	loadjs.done("fpagosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pagos_delete->showPageHeader(); ?>
<?php
$pagos_delete->showMessage();
?>
<form name="fpagosdelete" id="fpagosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pagos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($pagos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($pagos_delete->id_pagos->Visible) { // id_pagos ?>
		<th class="<?php echo $pagos_delete->id_pagos->headerCellClass() ?>"><span id="elh_pagos_id_pagos" class="pagos_id_pagos"><?php echo $pagos_delete->id_pagos->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$pagos_delete->RecordCount = 0;
$i = 0;
while (!$pagos_delete->Recordset->EOF) {
	$pagos_delete->RecordCount++;
	$pagos_delete->RowCount++;

	// Set row properties
	$pagos->resetAttributes();
	$pagos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$pagos_delete->loadRowValues($pagos_delete->Recordset);

	// Render row
	$pagos_delete->renderRow();
?>
	<tr <?php echo $pagos->rowAttributes() ?>>
<?php if ($pagos_delete->id_pagos->Visible) { // id_pagos ?>
		<td <?php echo $pagos_delete->id_pagos->cellAttributes() ?>>
<span id="el<?php echo $pagos_delete->RowCount ?>_pagos_id_pagos" class="pagos_id_pagos">
<span<?php echo $pagos_delete->id_pagos->viewAttributes() ?>><?php echo $pagos_delete->id_pagos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$pagos_delete->Recordset->moveNext();
}
$pagos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pagos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$pagos_delete->showPageFooter();
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
$pagos_delete->terminate();
?>