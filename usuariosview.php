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
$usuarios_view = new usuarios_view();

// Run the page
$usuarios_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuarios_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$usuarios_view->isExport()) { ?>
<script>
var fusuariosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fusuariosview = currentForm = new ew.Form("fusuariosview", "view");
	loadjs.done("fusuariosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$usuarios_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $usuarios_view->ExportOptions->render("body") ?>
<?php $usuarios_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $usuarios_view->showPageHeader(); ?>
<?php
$usuarios_view->showMessage();
?>
<form name="fusuariosview" id="fusuariosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuarios">
<input type="hidden" name="modal" value="<?php echo (int)$usuarios_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($usuarios_view->id_usuario->Visible) { // id_usuario ?>
	<tr id="r_id_usuario">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_id_usuario"><?php echo $usuarios_view->id_usuario->caption() ?></span></td>
		<td data-name="id_usuario" <?php echo $usuarios_view->id_usuario->cellAttributes() ?>>
<span id="el_usuarios_id_usuario">
<span<?php echo $usuarios_view->id_usuario->viewAttributes() ?>><?php echo $usuarios_view->id_usuario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios_view->nombre_usuario->Visible) { // nombre_usuario ?>
	<tr id="r_nombre_usuario">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_nombre_usuario"><?php echo $usuarios_view->nombre_usuario->caption() ?></span></td>
		<td data-name="nombre_usuario" <?php echo $usuarios_view->nombre_usuario->cellAttributes() ?>>
<span id="el_usuarios_nombre_usuario">
<span<?php echo $usuarios_view->nombre_usuario->viewAttributes() ?>><?php echo $usuarios_view->nombre_usuario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios_view->clave->Visible) { // clave ?>
	<tr id="r_clave">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_clave"><?php echo $usuarios_view->clave->caption() ?></span></td>
		<td data-name="clave" <?php echo $usuarios_view->clave->cellAttributes() ?>>
<span id="el_usuarios_clave">
<span<?php echo $usuarios_view->clave->viewAttributes() ?>><?php echo $usuarios_view->clave->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios_view->nombres->Visible) { // nombres ?>
	<tr id="r_nombres">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_nombres"><?php echo $usuarios_view->nombres->caption() ?></span></td>
		<td data-name="nombres" <?php echo $usuarios_view->nombres->cellAttributes() ?>>
<span id="el_usuarios_nombres">
<span<?php echo $usuarios_view->nombres->viewAttributes() ?>><?php echo $usuarios_view->nombres->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios_view->apellidos->Visible) { // apellidos ?>
	<tr id="r_apellidos">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_apellidos"><?php echo $usuarios_view->apellidos->caption() ?></span></td>
		<td data-name="apellidos" <?php echo $usuarios_view->apellidos->cellAttributes() ?>>
<span id="el_usuarios_apellidos">
<span<?php echo $usuarios_view->apellidos->viewAttributes() ?>><?php echo $usuarios_view->apellidos->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios_view->cedula->Visible) { // cedula ?>
	<tr id="r_cedula">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_cedula"><?php echo $usuarios_view->cedula->caption() ?></span></td>
		<td data-name="cedula" <?php echo $usuarios_view->cedula->cellAttributes() ?>>
<span id="el_usuarios_cedula">
<span<?php echo $usuarios_view->cedula->viewAttributes() ?>><?php echo $usuarios_view->cedula->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios_view->telefono->Visible) { // telefono ?>
	<tr id="r_telefono">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_telefono"><?php echo $usuarios_view->telefono->caption() ?></span></td>
		<td data-name="telefono" <?php echo $usuarios_view->telefono->cellAttributes() ?>>
<span id="el_usuarios_telefono">
<span<?php echo $usuarios_view->telefono->viewAttributes() ?>><?php echo $usuarios_view->telefono->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios_view->correo->Visible) { // correo ?>
	<tr id="r_correo">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_correo"><?php echo $usuarios_view->correo->caption() ?></span></td>
		<td data-name="correo" <?php echo $usuarios_view->correo->cellAttributes() ?>>
<span id="el_usuarios_correo">
<span<?php echo $usuarios_view->correo->viewAttributes() ?>><?php echo $usuarios_view->correo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios_view->perfil_id->Visible) { // perfil_id ?>
	<tr id="r_perfil_id">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_perfil_id"><?php echo $usuarios_view->perfil_id->caption() ?></span></td>
		<td data-name="perfil_id" <?php echo $usuarios_view->perfil_id->cellAttributes() ?>>
<span id="el_usuarios_perfil_id">
<span<?php echo $usuarios_view->perfil_id->viewAttributes() ?>><?php echo $usuarios_view->perfil_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuarios_view->memo->Visible) { // memo ?>
	<tr id="r_memo">
		<td class="<?php echo $usuarios_view->TableLeftColumnClass ?>"><span id="elh_usuarios_memo"><?php echo $usuarios_view->memo->caption() ?></span></td>
		<td data-name="memo" <?php echo $usuarios_view->memo->cellAttributes() ?>>
<span id="el_usuarios_memo">
<span<?php echo $usuarios_view->memo->viewAttributes() ?>><?php echo $usuarios_view->memo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$usuarios_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$usuarios_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$usuarios_view->terminate();
?>