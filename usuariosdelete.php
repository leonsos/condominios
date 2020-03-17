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
$usuarios_delete = new usuarios_delete();

// Run the page
$usuarios_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuarios_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusuariosdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fusuariosdelete = currentForm = new ew.Form("fusuariosdelete", "delete");
	loadjs.done("fusuariosdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $usuarios_delete->showPageHeader(); ?>
<?php
$usuarios_delete->showMessage();
?>
<form name="fusuariosdelete" id="fusuariosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuarios">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($usuarios_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($usuarios_delete->id_usuario->Visible) { // id_usuario ?>
		<th class="<?php echo $usuarios_delete->id_usuario->headerCellClass() ?>"><span id="elh_usuarios_id_usuario" class="usuarios_id_usuario"><?php echo $usuarios_delete->id_usuario->caption() ?></span></th>
<?php } ?>
<?php if ($usuarios_delete->nombre_usuario->Visible) { // nombre_usuario ?>
		<th class="<?php echo $usuarios_delete->nombre_usuario->headerCellClass() ?>"><span id="elh_usuarios_nombre_usuario" class="usuarios_nombre_usuario"><?php echo $usuarios_delete->nombre_usuario->caption() ?></span></th>
<?php } ?>
<?php if ($usuarios_delete->clave->Visible) { // clave ?>
		<th class="<?php echo $usuarios_delete->clave->headerCellClass() ?>"><span id="elh_usuarios_clave" class="usuarios_clave"><?php echo $usuarios_delete->clave->caption() ?></span></th>
<?php } ?>
<?php if ($usuarios_delete->nombres->Visible) { // nombres ?>
		<th class="<?php echo $usuarios_delete->nombres->headerCellClass() ?>"><span id="elh_usuarios_nombres" class="usuarios_nombres"><?php echo $usuarios_delete->nombres->caption() ?></span></th>
<?php } ?>
<?php if ($usuarios_delete->apellidos->Visible) { // apellidos ?>
		<th class="<?php echo $usuarios_delete->apellidos->headerCellClass() ?>"><span id="elh_usuarios_apellidos" class="usuarios_apellidos"><?php echo $usuarios_delete->apellidos->caption() ?></span></th>
<?php } ?>
<?php if ($usuarios_delete->cedula->Visible) { // cedula ?>
		<th class="<?php echo $usuarios_delete->cedula->headerCellClass() ?>"><span id="elh_usuarios_cedula" class="usuarios_cedula"><?php echo $usuarios_delete->cedula->caption() ?></span></th>
<?php } ?>
<?php if ($usuarios_delete->telefono->Visible) { // telefono ?>
		<th class="<?php echo $usuarios_delete->telefono->headerCellClass() ?>"><span id="elh_usuarios_telefono" class="usuarios_telefono"><?php echo $usuarios_delete->telefono->caption() ?></span></th>
<?php } ?>
<?php if ($usuarios_delete->correo->Visible) { // correo ?>
		<th class="<?php echo $usuarios_delete->correo->headerCellClass() ?>"><span id="elh_usuarios_correo" class="usuarios_correo"><?php echo $usuarios_delete->correo->caption() ?></span></th>
<?php } ?>
<?php if ($usuarios_delete->perfil_id->Visible) { // perfil_id ?>
		<th class="<?php echo $usuarios_delete->perfil_id->headerCellClass() ?>"><span id="elh_usuarios_perfil_id" class="usuarios_perfil_id"><?php echo $usuarios_delete->perfil_id->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$usuarios_delete->RecordCount = 0;
$i = 0;
while (!$usuarios_delete->Recordset->EOF) {
	$usuarios_delete->RecordCount++;
	$usuarios_delete->RowCount++;

	// Set row properties
	$usuarios->resetAttributes();
	$usuarios->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$usuarios_delete->loadRowValues($usuarios_delete->Recordset);

	// Render row
	$usuarios_delete->renderRow();
?>
	<tr <?php echo $usuarios->rowAttributes() ?>>
<?php if ($usuarios_delete->id_usuario->Visible) { // id_usuario ?>
		<td <?php echo $usuarios_delete->id_usuario->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCount ?>_usuarios_id_usuario" class="usuarios_id_usuario">
<span<?php echo $usuarios_delete->id_usuario->viewAttributes() ?>><?php echo $usuarios_delete->id_usuario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuarios_delete->nombre_usuario->Visible) { // nombre_usuario ?>
		<td <?php echo $usuarios_delete->nombre_usuario->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCount ?>_usuarios_nombre_usuario" class="usuarios_nombre_usuario">
<span<?php echo $usuarios_delete->nombre_usuario->viewAttributes() ?>><?php echo $usuarios_delete->nombre_usuario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuarios_delete->clave->Visible) { // clave ?>
		<td <?php echo $usuarios_delete->clave->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCount ?>_usuarios_clave" class="usuarios_clave">
<span<?php echo $usuarios_delete->clave->viewAttributes() ?>><?php echo $usuarios_delete->clave->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuarios_delete->nombres->Visible) { // nombres ?>
		<td <?php echo $usuarios_delete->nombres->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCount ?>_usuarios_nombres" class="usuarios_nombres">
<span<?php echo $usuarios_delete->nombres->viewAttributes() ?>><?php echo $usuarios_delete->nombres->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuarios_delete->apellidos->Visible) { // apellidos ?>
		<td <?php echo $usuarios_delete->apellidos->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCount ?>_usuarios_apellidos" class="usuarios_apellidos">
<span<?php echo $usuarios_delete->apellidos->viewAttributes() ?>><?php echo $usuarios_delete->apellidos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuarios_delete->cedula->Visible) { // cedula ?>
		<td <?php echo $usuarios_delete->cedula->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCount ?>_usuarios_cedula" class="usuarios_cedula">
<span<?php echo $usuarios_delete->cedula->viewAttributes() ?>><?php echo $usuarios_delete->cedula->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuarios_delete->telefono->Visible) { // telefono ?>
		<td <?php echo $usuarios_delete->telefono->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCount ?>_usuarios_telefono" class="usuarios_telefono">
<span<?php echo $usuarios_delete->telefono->viewAttributes() ?>><?php echo $usuarios_delete->telefono->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuarios_delete->correo->Visible) { // correo ?>
		<td <?php echo $usuarios_delete->correo->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCount ?>_usuarios_correo" class="usuarios_correo">
<span<?php echo $usuarios_delete->correo->viewAttributes() ?>><?php echo $usuarios_delete->correo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuarios_delete->perfil_id->Visible) { // perfil_id ?>
		<td <?php echo $usuarios_delete->perfil_id->cellAttributes() ?>>
<span id="el<?php echo $usuarios_delete->RowCount ?>_usuarios_perfil_id" class="usuarios_perfil_id">
<span<?php echo $usuarios_delete->perfil_id->viewAttributes() ?>><?php echo $usuarios_delete->perfil_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$usuarios_delete->Recordset->moveNext();
}
$usuarios_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $usuarios_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$usuarios_delete->showPageFooter();
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
$usuarios_delete->terminate();
?>