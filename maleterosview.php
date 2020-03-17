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
$maleteros_view = new maleteros_view();

// Run the page
$maleteros_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$maleteros_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$maleteros_view->isExport()) { ?>
<script>
var fmaleterosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmaleterosview = currentForm = new ew.Form("fmaleterosview", "view");
	loadjs.done("fmaleterosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$maleteros_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $maleteros_view->ExportOptions->render("body") ?>
<?php $maleteros_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $maleteros_view->showPageHeader(); ?>
<?php
$maleteros_view->showMessage();
?>
<form name="fmaleterosview" id="fmaleterosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="maleteros">
<input type="hidden" name="modal" value="<?php echo (int)$maleteros_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($maleteros_view->id_maletero->Visible) { // id_maletero ?>
	<tr id="r_id_maletero">
		<td class="<?php echo $maleteros_view->TableLeftColumnClass ?>"><span id="elh_maleteros_id_maletero"><?php echo $maleteros_view->id_maletero->caption() ?></span></td>
		<td data-name="id_maletero" <?php echo $maleteros_view->id_maletero->cellAttributes() ?>>
<span id="el_maleteros_id_maletero">
<span<?php echo $maleteros_view->id_maletero->viewAttributes() ?>><?php echo $maleteros_view->id_maletero->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($maleteros_view->nombre_numero->Visible) { // nombre_numero ?>
	<tr id="r_nombre_numero">
		<td class="<?php echo $maleteros_view->TableLeftColumnClass ?>"><span id="elh_maleteros_nombre_numero"><?php echo $maleteros_view->nombre_numero->caption() ?></span></td>
		<td data-name="nombre_numero" <?php echo $maleteros_view->nombre_numero->cellAttributes() ?>>
<span id="el_maleteros_nombre_numero">
<span<?php echo $maleteros_view->nombre_numero->viewAttributes() ?>><?php echo $maleteros_view->nombre_numero->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($maleteros_view->apartamento_id->Visible) { // apartamento_id ?>
	<tr id="r_apartamento_id">
		<td class="<?php echo $maleteros_view->TableLeftColumnClass ?>"><span id="elh_maleteros_apartamento_id"><?php echo $maleteros_view->apartamento_id->caption() ?></span></td>
		<td data-name="apartamento_id" <?php echo $maleteros_view->apartamento_id->cellAttributes() ?>>
<span id="el_maleteros_apartamento_id">
<span<?php echo $maleteros_view->apartamento_id->viewAttributes() ?>><?php echo $maleteros_view->apartamento_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$maleteros_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$maleteros_view->isExport()) { ?>
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
$maleteros_view->terminate();
?>