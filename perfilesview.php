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
$perfiles_view = new perfiles_view();

// Run the page
$perfiles_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$perfiles_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$perfiles_view->isExport()) { ?>
<script>
var fperfilesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fperfilesview = currentForm = new ew.Form("fperfilesview", "view");
	loadjs.done("fperfilesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$perfiles_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $perfiles_view->ExportOptions->render("body") ?>
<?php $perfiles_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $perfiles_view->showPageHeader(); ?>
<?php
$perfiles_view->showMessage();
?>
<form name="fperfilesview" id="fperfilesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="perfiles">
<input type="hidden" name="modal" value="<?php echo (int)$perfiles_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($perfiles_view->id_perfil->Visible) { // id_perfil ?>
	<tr id="r_id_perfil">
		<td class="<?php echo $perfiles_view->TableLeftColumnClass ?>"><span id="elh_perfiles_id_perfil"><?php echo $perfiles_view->id_perfil->caption() ?></span></td>
		<td data-name="id_perfil" <?php echo $perfiles_view->id_perfil->cellAttributes() ?>>
<span id="el_perfiles_id_perfil">
<span<?php echo $perfiles_view->id_perfil->viewAttributes() ?>><?php echo $perfiles_view->id_perfil->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($perfiles_view->descripcion_perfil->Visible) { // descripcion_perfil ?>
	<tr id="r_descripcion_perfil">
		<td class="<?php echo $perfiles_view->TableLeftColumnClass ?>"><span id="elh_perfiles_descripcion_perfil"><?php echo $perfiles_view->descripcion_perfil->caption() ?></span></td>
		<td data-name="descripcion_perfil" <?php echo $perfiles_view->descripcion_perfil->cellAttributes() ?>>
<span id="el_perfiles_descripcion_perfil">
<span<?php echo $perfiles_view->descripcion_perfil->viewAttributes() ?>><?php echo $perfiles_view->descripcion_perfil->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$perfiles_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$perfiles_view->isExport()) { ?>
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
$perfiles_view->terminate();
?>