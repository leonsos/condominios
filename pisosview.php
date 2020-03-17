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
$pisos_view = new pisos_view();

// Run the page
$pisos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pisos_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pisos_view->isExport()) { ?>
<script>
var fpisosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpisosview = currentForm = new ew.Form("fpisosview", "view");
	loadjs.done("fpisosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$pisos_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $pisos_view->ExportOptions->render("body") ?>
<?php $pisos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $pisos_view->showPageHeader(); ?>
<?php
$pisos_view->showMessage();
?>
<form name="fpisosview" id="fpisosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pisos">
<input type="hidden" name="modal" value="<?php echo (int)$pisos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($pisos_view->id_piso->Visible) { // id_piso ?>
	<tr id="r_id_piso">
		<td class="<?php echo $pisos_view->TableLeftColumnClass ?>"><span id="elh_pisos_id_piso"><?php echo $pisos_view->id_piso->caption() ?></span></td>
		<td data-name="id_piso" <?php echo $pisos_view->id_piso->cellAttributes() ?>>
<span id="el_pisos_id_piso">
<span<?php echo $pisos_view->id_piso->viewAttributes() ?>><?php echo $pisos_view->id_piso->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pisos_view->edificio_id->Visible) { // edificio_id ?>
	<tr id="r_edificio_id">
		<td class="<?php echo $pisos_view->TableLeftColumnClass ?>"><span id="elh_pisos_edificio_id"><?php echo $pisos_view->edificio_id->caption() ?></span></td>
		<td data-name="edificio_id" <?php echo $pisos_view->edificio_id->cellAttributes() ?>>
<span id="el_pisos_edificio_id">
<span<?php echo $pisos_view->edificio_id->viewAttributes() ?>><?php echo $pisos_view->edificio_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pisos_view->nombre->Visible) { // nombre ?>
	<tr id="r_nombre">
		<td class="<?php echo $pisos_view->TableLeftColumnClass ?>"><span id="elh_pisos_nombre"><?php echo $pisos_view->nombre->caption() ?></span></td>
		<td data-name="nombre" <?php echo $pisos_view->nombre->cellAttributes() ?>>
<span id="el_pisos_nombre">
<span<?php echo $pisos_view->nombre->viewAttributes() ?>><?php echo $pisos_view->nombre->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$pisos_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pisos_view->isExport()) { ?>
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
$pisos_view->terminate();
?>