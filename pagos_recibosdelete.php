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
$pagos_recibos_delete = new pagos_recibos_delete();

// Run the page
$pagos_recibos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pagos_recibos_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpagos_recibosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpagos_recibosdelete = currentForm = new ew.Form("fpagos_recibosdelete", "delete");
	loadjs.done("fpagos_recibosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pagos_recibos_delete->showPageHeader(); ?>
<?php
$pagos_recibos_delete->showMessage();
?>
<form name="fpagos_recibosdelete" id="fpagos_recibosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pagos_recibos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($pagos_recibos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($pagos_recibos_delete->id_pagos_recibos->Visible) { // id_pagos_recibos ?>
		<th class="<?php echo $pagos_recibos_delete->id_pagos_recibos->headerCellClass() ?>"><span id="elh_pagos_recibos_id_pagos_recibos" class="pagos_recibos_id_pagos_recibos"><?php echo $pagos_recibos_delete->id_pagos_recibos->caption() ?></span></th>
<?php } ?>
<?php if ($pagos_recibos_delete->pagos_id->Visible) { // pagos_id ?>
		<th class="<?php echo $pagos_recibos_delete->pagos_id->headerCellClass() ?>"><span id="elh_pagos_recibos_pagos_id" class="pagos_recibos_pagos_id"><?php echo $pagos_recibos_delete->pagos_id->caption() ?></span></th>
<?php } ?>
<?php if ($pagos_recibos_delete->recibos_id->Visible) { // recibos_id ?>
		<th class="<?php echo $pagos_recibos_delete->recibos_id->headerCellClass() ?>"><span id="elh_pagos_recibos_recibos_id" class="pagos_recibos_recibos_id"><?php echo $pagos_recibos_delete->recibos_id->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$pagos_recibos_delete->RecordCount = 0;
$i = 0;
while (!$pagos_recibos_delete->Recordset->EOF) {
	$pagos_recibos_delete->RecordCount++;
	$pagos_recibos_delete->RowCount++;

	// Set row properties
	$pagos_recibos->resetAttributes();
	$pagos_recibos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$pagos_recibos_delete->loadRowValues($pagos_recibos_delete->Recordset);

	// Render row
	$pagos_recibos_delete->renderRow();
?>
	<tr <?php echo $pagos_recibos->rowAttributes() ?>>
<?php if ($pagos_recibos_delete->id_pagos_recibos->Visible) { // id_pagos_recibos ?>
		<td <?php echo $pagos_recibos_delete->id_pagos_recibos->cellAttributes() ?>>
<span id="el<?php echo $pagos_recibos_delete->RowCount ?>_pagos_recibos_id_pagos_recibos" class="pagos_recibos_id_pagos_recibos">
<span<?php echo $pagos_recibos_delete->id_pagos_recibos->viewAttributes() ?>><?php echo $pagos_recibos_delete->id_pagos_recibos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pagos_recibos_delete->pagos_id->Visible) { // pagos_id ?>
		<td <?php echo $pagos_recibos_delete->pagos_id->cellAttributes() ?>>
<span id="el<?php echo $pagos_recibos_delete->RowCount ?>_pagos_recibos_pagos_id" class="pagos_recibos_pagos_id">
<span<?php echo $pagos_recibos_delete->pagos_id->viewAttributes() ?>><?php echo $pagos_recibos_delete->pagos_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pagos_recibos_delete->recibos_id->Visible) { // recibos_id ?>
		<td <?php echo $pagos_recibos_delete->recibos_id->cellAttributes() ?>>
<span id="el<?php echo $pagos_recibos_delete->RowCount ?>_pagos_recibos_recibos_id" class="pagos_recibos_recibos_id">
<span<?php echo $pagos_recibos_delete->recibos_id->viewAttributes() ?>><?php echo $pagos_recibos_delete->recibos_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$pagos_recibos_delete->Recordset->moveNext();
}
$pagos_recibos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pagos_recibos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$pagos_recibos_delete->showPageFooter();
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
$pagos_recibos_delete->terminate();
?>