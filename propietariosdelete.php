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
$propietarios_delete = new propietarios_delete();

// Run the page
$propietarios_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$propietarios_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpropietariosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpropietariosdelete = currentForm = new ew.Form("fpropietariosdelete", "delete");
	loadjs.done("fpropietariosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $propietarios_delete->showPageHeader(); ?>
<?php
$propietarios_delete->showMessage();
?>
<form name="fpropietariosdelete" id="fpropietariosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="propietarios">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($propietarios_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($propietarios_delete->id_propietario->Visible) { // id_propietario ?>
		<th class="<?php echo $propietarios_delete->id_propietario->headerCellClass() ?>"><span id="elh_propietarios_id_propietario" class="propietarios_id_propietario"><?php echo $propietarios_delete->id_propietario->caption() ?></span></th>
<?php } ?>
<?php if ($propietarios_delete->nombre->Visible) { // nombre ?>
		<th class="<?php echo $propietarios_delete->nombre->headerCellClass() ?>"><span id="elh_propietarios_nombre" class="propietarios_nombre"><?php echo $propietarios_delete->nombre->caption() ?></span></th>
<?php } ?>
<?php if ($propietarios_delete->apellido->Visible) { // apellido ?>
		<th class="<?php echo $propietarios_delete->apellido->headerCellClass() ?>"><span id="elh_propietarios_apellido" class="propietarios_apellido"><?php echo $propietarios_delete->apellido->caption() ?></span></th>
<?php } ?>
<?php if ($propietarios_delete->cedula->Visible) { // cedula ?>
		<th class="<?php echo $propietarios_delete->cedula->headerCellClass() ?>"><span id="elh_propietarios_cedula" class="propietarios_cedula"><?php echo $propietarios_delete->cedula->caption() ?></span></th>
<?php } ?>
<?php if ($propietarios_delete->telefono_princip->Visible) { // telefono_princip ?>
		<th class="<?php echo $propietarios_delete->telefono_princip->headerCellClass() ?>"><span id="elh_propietarios_telefono_princip" class="propietarios_telefono_princip"><?php echo $propietarios_delete->telefono_princip->caption() ?></span></th>
<?php } ?>
<?php if ($propietarios_delete->telefono_secund->Visible) { // telefono_secund ?>
		<th class="<?php echo $propietarios_delete->telefono_secund->headerCellClass() ?>"><span id="elh_propietarios_telefono_secund" class="propietarios_telefono_secund"><?php echo $propietarios_delete->telefono_secund->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$propietarios_delete->RecordCount = 0;
$i = 0;
while (!$propietarios_delete->Recordset->EOF) {
	$propietarios_delete->RecordCount++;
	$propietarios_delete->RowCount++;

	// Set row properties
	$propietarios->resetAttributes();
	$propietarios->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$propietarios_delete->loadRowValues($propietarios_delete->Recordset);

	// Render row
	$propietarios_delete->renderRow();
?>
	<tr <?php echo $propietarios->rowAttributes() ?>>
<?php if ($propietarios_delete->id_propietario->Visible) { // id_propietario ?>
		<td <?php echo $propietarios_delete->id_propietario->cellAttributes() ?>>
<span id="el<?php echo $propietarios_delete->RowCount ?>_propietarios_id_propietario" class="propietarios_id_propietario">
<span<?php echo $propietarios_delete->id_propietario->viewAttributes() ?>><?php echo $propietarios_delete->id_propietario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($propietarios_delete->nombre->Visible) { // nombre ?>
		<td <?php echo $propietarios_delete->nombre->cellAttributes() ?>>
<span id="el<?php echo $propietarios_delete->RowCount ?>_propietarios_nombre" class="propietarios_nombre">
<span<?php echo $propietarios_delete->nombre->viewAttributes() ?>><?php echo $propietarios_delete->nombre->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($propietarios_delete->apellido->Visible) { // apellido ?>
		<td <?php echo $propietarios_delete->apellido->cellAttributes() ?>>
<span id="el<?php echo $propietarios_delete->RowCount ?>_propietarios_apellido" class="propietarios_apellido">
<span<?php echo $propietarios_delete->apellido->viewAttributes() ?>><?php echo $propietarios_delete->apellido->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($propietarios_delete->cedula->Visible) { // cedula ?>
		<td <?php echo $propietarios_delete->cedula->cellAttributes() ?>>
<span id="el<?php echo $propietarios_delete->RowCount ?>_propietarios_cedula" class="propietarios_cedula">
<span<?php echo $propietarios_delete->cedula->viewAttributes() ?>><?php echo $propietarios_delete->cedula->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($propietarios_delete->telefono_princip->Visible) { // telefono_princip ?>
		<td <?php echo $propietarios_delete->telefono_princip->cellAttributes() ?>>
<span id="el<?php echo $propietarios_delete->RowCount ?>_propietarios_telefono_princip" class="propietarios_telefono_princip">
<span<?php echo $propietarios_delete->telefono_princip->viewAttributes() ?>><?php echo $propietarios_delete->telefono_princip->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($propietarios_delete->telefono_secund->Visible) { // telefono_secund ?>
		<td <?php echo $propietarios_delete->telefono_secund->cellAttributes() ?>>
<span id="el<?php echo $propietarios_delete->RowCount ?>_propietarios_telefono_secund" class="propietarios_telefono_secund">
<span<?php echo $propietarios_delete->telefono_secund->viewAttributes() ?>><?php echo $propietarios_delete->telefono_secund->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$propietarios_delete->Recordset->moveNext();
}
$propietarios_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $propietarios_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$propietarios_delete->showPageFooter();
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
$propietarios_delete->terminate();
?>