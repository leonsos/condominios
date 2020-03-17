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
$pisos_delete = new pisos_delete();

// Run the page
$pisos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pisos_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpisosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpisosdelete = currentForm = new ew.Form("fpisosdelete", "delete");
	loadjs.done("fpisosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pisos_delete->showPageHeader(); ?>
<?php
$pisos_delete->showMessage();
?>
<form name="fpisosdelete" id="fpisosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pisos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($pisos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($pisos_delete->id_piso->Visible) { // id_piso ?>
		<th class="<?php echo $pisos_delete->id_piso->headerCellClass() ?>"><span id="elh_pisos_id_piso" class="pisos_id_piso"><?php echo $pisos_delete->id_piso->caption() ?></span></th>
<?php } ?>
<?php if ($pisos_delete->edificio_id->Visible) { // edificio_id ?>
		<th class="<?php echo $pisos_delete->edificio_id->headerCellClass() ?>"><span id="elh_pisos_edificio_id" class="pisos_edificio_id"><?php echo $pisos_delete->edificio_id->caption() ?></span></th>
<?php } ?>
<?php if ($pisos_delete->nombre->Visible) { // nombre ?>
		<th class="<?php echo $pisos_delete->nombre->headerCellClass() ?>"><span id="elh_pisos_nombre" class="pisos_nombre"><?php echo $pisos_delete->nombre->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$pisos_delete->RecordCount = 0;
$i = 0;
while (!$pisos_delete->Recordset->EOF) {
	$pisos_delete->RecordCount++;
	$pisos_delete->RowCount++;

	// Set row properties
	$pisos->resetAttributes();
	$pisos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$pisos_delete->loadRowValues($pisos_delete->Recordset);

	// Render row
	$pisos_delete->renderRow();
?>
	<tr <?php echo $pisos->rowAttributes() ?>>
<?php if ($pisos_delete->id_piso->Visible) { // id_piso ?>
		<td <?php echo $pisos_delete->id_piso->cellAttributes() ?>>
<span id="el<?php echo $pisos_delete->RowCount ?>_pisos_id_piso" class="pisos_id_piso">
<span<?php echo $pisos_delete->id_piso->viewAttributes() ?>><?php echo $pisos_delete->id_piso->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pisos_delete->edificio_id->Visible) { // edificio_id ?>
		<td <?php echo $pisos_delete->edificio_id->cellAttributes() ?>>
<span id="el<?php echo $pisos_delete->RowCount ?>_pisos_edificio_id" class="pisos_edificio_id">
<span<?php echo $pisos_delete->edificio_id->viewAttributes() ?>><?php echo $pisos_delete->edificio_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pisos_delete->nombre->Visible) { // nombre ?>
		<td <?php echo $pisos_delete->nombre->cellAttributes() ?>>
<span id="el<?php echo $pisos_delete->RowCount ?>_pisos_nombre" class="pisos_nombre">
<span<?php echo $pisos_delete->nombre->viewAttributes() ?>><?php echo $pisos_delete->nombre->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$pisos_delete->Recordset->moveNext();
}
$pisos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pisos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$pisos_delete->showPageFooter();
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
$pisos_delete->terminate();
?>