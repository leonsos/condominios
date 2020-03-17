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
$perfiles_delete = new perfiles_delete();

// Run the page
$perfiles_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$perfiles_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fperfilesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fperfilesdelete = currentForm = new ew.Form("fperfilesdelete", "delete");
	loadjs.done("fperfilesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $perfiles_delete->showPageHeader(); ?>
<?php
$perfiles_delete->showMessage();
?>
<form name="fperfilesdelete" id="fperfilesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="perfiles">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($perfiles_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($perfiles_delete->id_perfil->Visible) { // id_perfil ?>
		<th class="<?php echo $perfiles_delete->id_perfil->headerCellClass() ?>"><span id="elh_perfiles_id_perfil" class="perfiles_id_perfil"><?php echo $perfiles_delete->id_perfil->caption() ?></span></th>
<?php } ?>
<?php if ($perfiles_delete->descripcion_perfil->Visible) { // descripcion_perfil ?>
		<th class="<?php echo $perfiles_delete->descripcion_perfil->headerCellClass() ?>"><span id="elh_perfiles_descripcion_perfil" class="perfiles_descripcion_perfil"><?php echo $perfiles_delete->descripcion_perfil->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$perfiles_delete->RecordCount = 0;
$i = 0;
while (!$perfiles_delete->Recordset->EOF) {
	$perfiles_delete->RecordCount++;
	$perfiles_delete->RowCount++;

	// Set row properties
	$perfiles->resetAttributes();
	$perfiles->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$perfiles_delete->loadRowValues($perfiles_delete->Recordset);

	// Render row
	$perfiles_delete->renderRow();
?>
	<tr <?php echo $perfiles->rowAttributes() ?>>
<?php if ($perfiles_delete->id_perfil->Visible) { // id_perfil ?>
		<td <?php echo $perfiles_delete->id_perfil->cellAttributes() ?>>
<span id="el<?php echo $perfiles_delete->RowCount ?>_perfiles_id_perfil" class="perfiles_id_perfil">
<span<?php echo $perfiles_delete->id_perfil->viewAttributes() ?>><?php echo $perfiles_delete->id_perfil->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($perfiles_delete->descripcion_perfil->Visible) { // descripcion_perfil ?>
		<td <?php echo $perfiles_delete->descripcion_perfil->cellAttributes() ?>>
<span id="el<?php echo $perfiles_delete->RowCount ?>_perfiles_descripcion_perfil" class="perfiles_descripcion_perfil">
<span<?php echo $perfiles_delete->descripcion_perfil->viewAttributes() ?>><?php echo $perfiles_delete->descripcion_perfil->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$perfiles_delete->Recordset->moveNext();
}
$perfiles_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $perfiles_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$perfiles_delete->showPageFooter();
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
$perfiles_delete->terminate();
?>