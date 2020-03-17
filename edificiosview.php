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
$edificios_view = new edificios_view();

// Run the page
$edificios_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$edificios_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$edificios_view->isExport()) { ?>
<script>
var fedificiosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fedificiosview = currentForm = new ew.Form("fedificiosview", "view");
	loadjs.done("fedificiosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$edificios_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $edificios_view->ExportOptions->render("body") ?>
<?php $edificios_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $edificios_view->showPageHeader(); ?>
<?php
$edificios_view->showMessage();
?>
<form name="fedificiosview" id="fedificiosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="edificios">
<input type="hidden" name="modal" value="<?php echo (int)$edificios_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($edificios_view->id_edificio->Visible) { // id_edificio ?>
	<tr id="r_id_edificio">
		<td class="<?php echo $edificios_view->TableLeftColumnClass ?>"><span id="elh_edificios_id_edificio"><?php echo $edificios_view->id_edificio->caption() ?></span></td>
		<td data-name="id_edificio" <?php echo $edificios_view->id_edificio->cellAttributes() ?>>
<span id="el_edificios_id_edificio">
<span<?php echo $edificios_view->id_edificio->viewAttributes() ?>><?php echo $edificios_view->id_edificio->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($edificios_view->residencia_id->Visible) { // residencia_id ?>
	<tr id="r_residencia_id">
		<td class="<?php echo $edificios_view->TableLeftColumnClass ?>"><span id="elh_edificios_residencia_id"><?php echo $edificios_view->residencia_id->caption() ?></span></td>
		<td data-name="residencia_id" <?php echo $edificios_view->residencia_id->cellAttributes() ?>>
<span id="el_edificios_residencia_id">
<span<?php echo $edificios_view->residencia_id->viewAttributes() ?>><?php echo $edificios_view->residencia_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($edificios_view->nombre->Visible) { // nombre ?>
	<tr id="r_nombre">
		<td class="<?php echo $edificios_view->TableLeftColumnClass ?>"><span id="elh_edificios_nombre"><?php echo $edificios_view->nombre->caption() ?></span></td>
		<td data-name="nombre" <?php echo $edificios_view->nombre->cellAttributes() ?>>
<span id="el_edificios_nombre">
<span<?php echo $edificios_view->nombre->viewAttributes() ?>><?php echo $edificios_view->nombre->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$edificios_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$edificios_view->isExport()) { ?>
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
$edificios_view->terminate();
?>