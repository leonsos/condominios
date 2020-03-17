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
$perfiles_permisos_delete = new perfiles_permisos_delete();

// Run the page
$perfiles_permisos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$perfiles_permisos_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fperfiles_permisosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fperfiles_permisosdelete = currentForm = new ew.Form("fperfiles_permisosdelete", "delete");
	loadjs.done("fperfiles_permisosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $perfiles_permisos_delete->showPageHeader(); ?>
<?php
$perfiles_permisos_delete->showMessage();
?>
<form name="fperfiles_permisosdelete" id="fperfiles_permisosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="perfiles_permisos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($perfiles_permisos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($perfiles_permisos_delete->id_perfil_permisos->Visible) { // id_perfil_permisos ?>
		<th class="<?php echo $perfiles_permisos_delete->id_perfil_permisos->headerCellClass() ?>"><span id="elh_perfiles_permisos_id_perfil_permisos" class="perfiles_permisos_id_perfil_permisos"><?php echo $perfiles_permisos_delete->id_perfil_permisos->caption() ?></span></th>
<?php } ?>
<?php if ($perfiles_permisos_delete->tabla->Visible) { // tabla ?>
		<th class="<?php echo $perfiles_permisos_delete->tabla->headerCellClass() ?>"><span id="elh_perfiles_permisos_tabla" class="perfiles_permisos_tabla"><?php echo $perfiles_permisos_delete->tabla->caption() ?></span></th>
<?php } ?>
<?php if ($perfiles_permisos_delete->permiso->Visible) { // permiso ?>
		<th class="<?php echo $perfiles_permisos_delete->permiso->headerCellClass() ?>"><span id="elh_perfiles_permisos_permiso" class="perfiles_permisos_permiso"><?php echo $perfiles_permisos_delete->permiso->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$perfiles_permisos_delete->RecordCount = 0;
$i = 0;
while (!$perfiles_permisos_delete->Recordset->EOF) {
	$perfiles_permisos_delete->RecordCount++;
	$perfiles_permisos_delete->RowCount++;

	// Set row properties
	$perfiles_permisos->resetAttributes();
	$perfiles_permisos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$perfiles_permisos_delete->loadRowValues($perfiles_permisos_delete->Recordset);

	// Render row
	$perfiles_permisos_delete->renderRow();
?>
	<tr <?php echo $perfiles_permisos->rowAttributes() ?>>
<?php if ($perfiles_permisos_delete->id_perfil_permisos->Visible) { // id_perfil_permisos ?>
		<td <?php echo $perfiles_permisos_delete->id_perfil_permisos->cellAttributes() ?>>
<span id="el<?php echo $perfiles_permisos_delete->RowCount ?>_perfiles_permisos_id_perfil_permisos" class="perfiles_permisos_id_perfil_permisos">
<span<?php echo $perfiles_permisos_delete->id_perfil_permisos->viewAttributes() ?>><?php echo $perfiles_permisos_delete->id_perfil_permisos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($perfiles_permisos_delete->tabla->Visible) { // tabla ?>
		<td <?php echo $perfiles_permisos_delete->tabla->cellAttributes() ?>>
<span id="el<?php echo $perfiles_permisos_delete->RowCount ?>_perfiles_permisos_tabla" class="perfiles_permisos_tabla">
<span<?php echo $perfiles_permisos_delete->tabla->viewAttributes() ?>><?php echo $perfiles_permisos_delete->tabla->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($perfiles_permisos_delete->permiso->Visible) { // permiso ?>
		<td <?php echo $perfiles_permisos_delete->permiso->cellAttributes() ?>>
<span id="el<?php echo $perfiles_permisos_delete->RowCount ?>_perfiles_permisos_permiso" class="perfiles_permisos_permiso">
<span<?php echo $perfiles_permisos_delete->permiso->viewAttributes() ?>><?php echo $perfiles_permisos_delete->permiso->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$perfiles_permisos_delete->Recordset->moveNext();
}
$perfiles_permisos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $perfiles_permisos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$perfiles_permisos_delete->showPageFooter();
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
$perfiles_permisos_delete->terminate();
?>