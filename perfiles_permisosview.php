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
$perfiles_permisos_view = new perfiles_permisos_view();

// Run the page
$perfiles_permisos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$perfiles_permisos_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$perfiles_permisos_view->isExport()) { ?>
<script>
var fperfiles_permisosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fperfiles_permisosview = currentForm = new ew.Form("fperfiles_permisosview", "view");
	loadjs.done("fperfiles_permisosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$perfiles_permisos_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $perfiles_permisos_view->ExportOptions->render("body") ?>
<?php $perfiles_permisos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $perfiles_permisos_view->showPageHeader(); ?>
<?php
$perfiles_permisos_view->showMessage();
?>
<form name="fperfiles_permisosview" id="fperfiles_permisosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="perfiles_permisos">
<input type="hidden" name="modal" value="<?php echo (int)$perfiles_permisos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($perfiles_permisos_view->id_perfil_permisos->Visible) { // id_perfil_permisos ?>
	<tr id="r_id_perfil_permisos">
		<td class="<?php echo $perfiles_permisos_view->TableLeftColumnClass ?>"><span id="elh_perfiles_permisos_id_perfil_permisos"><?php echo $perfiles_permisos_view->id_perfil_permisos->caption() ?></span></td>
		<td data-name="id_perfil_permisos" <?php echo $perfiles_permisos_view->id_perfil_permisos->cellAttributes() ?>>
<span id="el_perfiles_permisos_id_perfil_permisos">
<span<?php echo $perfiles_permisos_view->id_perfil_permisos->viewAttributes() ?>><?php echo $perfiles_permisos_view->id_perfil_permisos->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($perfiles_permisos_view->tabla->Visible) { // tabla ?>
	<tr id="r_tabla">
		<td class="<?php echo $perfiles_permisos_view->TableLeftColumnClass ?>"><span id="elh_perfiles_permisos_tabla"><?php echo $perfiles_permisos_view->tabla->caption() ?></span></td>
		<td data-name="tabla" <?php echo $perfiles_permisos_view->tabla->cellAttributes() ?>>
<span id="el_perfiles_permisos_tabla">
<span<?php echo $perfiles_permisos_view->tabla->viewAttributes() ?>><?php echo $perfiles_permisos_view->tabla->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($perfiles_permisos_view->permiso->Visible) { // permiso ?>
	<tr id="r_permiso">
		<td class="<?php echo $perfiles_permisos_view->TableLeftColumnClass ?>"><span id="elh_perfiles_permisos_permiso"><?php echo $perfiles_permisos_view->permiso->caption() ?></span></td>
		<td data-name="permiso" <?php echo $perfiles_permisos_view->permiso->cellAttributes() ?>>
<span id="el_perfiles_permisos_permiso">
<span<?php echo $perfiles_permisos_view->permiso->viewAttributes() ?>><?php echo $perfiles_permisos_view->permiso->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$perfiles_permisos_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$perfiles_permisos_view->isExport()) { ?>
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
$perfiles_permisos_view->terminate();
?>