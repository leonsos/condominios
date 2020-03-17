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
$propietarios_view = new propietarios_view();

// Run the page
$propietarios_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$propietarios_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$propietarios_view->isExport()) { ?>
<script>
var fpropietariosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpropietariosview = currentForm = new ew.Form("fpropietariosview", "view");
	loadjs.done("fpropietariosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$propietarios_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $propietarios_view->ExportOptions->render("body") ?>
<?php $propietarios_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $propietarios_view->showPageHeader(); ?>
<?php
$propietarios_view->showMessage();
?>
<form name="fpropietariosview" id="fpropietariosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="propietarios">
<input type="hidden" name="modal" value="<?php echo (int)$propietarios_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($propietarios_view->id_propietario->Visible) { // id_propietario ?>
	<tr id="r_id_propietario">
		<td class="<?php echo $propietarios_view->TableLeftColumnClass ?>"><span id="elh_propietarios_id_propietario"><?php echo $propietarios_view->id_propietario->caption() ?></span></td>
		<td data-name="id_propietario" <?php echo $propietarios_view->id_propietario->cellAttributes() ?>>
<span id="el_propietarios_id_propietario">
<span<?php echo $propietarios_view->id_propietario->viewAttributes() ?>><?php echo $propietarios_view->id_propietario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($propietarios_view->nombre->Visible) { // nombre ?>
	<tr id="r_nombre">
		<td class="<?php echo $propietarios_view->TableLeftColumnClass ?>"><span id="elh_propietarios_nombre"><?php echo $propietarios_view->nombre->caption() ?></span></td>
		<td data-name="nombre" <?php echo $propietarios_view->nombre->cellAttributes() ?>>
<span id="el_propietarios_nombre">
<span<?php echo $propietarios_view->nombre->viewAttributes() ?>><?php echo $propietarios_view->nombre->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($propietarios_view->apellido->Visible) { // apellido ?>
	<tr id="r_apellido">
		<td class="<?php echo $propietarios_view->TableLeftColumnClass ?>"><span id="elh_propietarios_apellido"><?php echo $propietarios_view->apellido->caption() ?></span></td>
		<td data-name="apellido" <?php echo $propietarios_view->apellido->cellAttributes() ?>>
<span id="el_propietarios_apellido">
<span<?php echo $propietarios_view->apellido->viewAttributes() ?>><?php echo $propietarios_view->apellido->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($propietarios_view->cedula->Visible) { // cedula ?>
	<tr id="r_cedula">
		<td class="<?php echo $propietarios_view->TableLeftColumnClass ?>"><span id="elh_propietarios_cedula"><?php echo $propietarios_view->cedula->caption() ?></span></td>
		<td data-name="cedula" <?php echo $propietarios_view->cedula->cellAttributes() ?>>
<span id="el_propietarios_cedula">
<span<?php echo $propietarios_view->cedula->viewAttributes() ?>><?php echo $propietarios_view->cedula->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($propietarios_view->telefono_princip->Visible) { // telefono_princip ?>
	<tr id="r_telefono_princip">
		<td class="<?php echo $propietarios_view->TableLeftColumnClass ?>"><span id="elh_propietarios_telefono_princip"><?php echo $propietarios_view->telefono_princip->caption() ?></span></td>
		<td data-name="telefono_princip" <?php echo $propietarios_view->telefono_princip->cellAttributes() ?>>
<span id="el_propietarios_telefono_princip">
<span<?php echo $propietarios_view->telefono_princip->viewAttributes() ?>><?php echo $propietarios_view->telefono_princip->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($propietarios_view->telefono_secund->Visible) { // telefono_secund ?>
	<tr id="r_telefono_secund">
		<td class="<?php echo $propietarios_view->TableLeftColumnClass ?>"><span id="elh_propietarios_telefono_secund"><?php echo $propietarios_view->telefono_secund->caption() ?></span></td>
		<td data-name="telefono_secund" <?php echo $propietarios_view->telefono_secund->cellAttributes() ?>>
<span id="el_propietarios_telefono_secund">
<span<?php echo $propietarios_view->telefono_secund->viewAttributes() ?>><?php echo $propietarios_view->telefono_secund->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$propietarios_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$propietarios_view->isExport()) { ?>
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
$propietarios_view->terminate();
?>