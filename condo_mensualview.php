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
$condo_mensual_view = new condo_mensual_view();

// Run the page
$condo_mensual_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$condo_mensual_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$condo_mensual_view->isExport()) { ?>
<script>
var fcondo_mensualview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcondo_mensualview = currentForm = new ew.Form("fcondo_mensualview", "view");
	loadjs.done("fcondo_mensualview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$condo_mensual_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $condo_mensual_view->ExportOptions->render("body") ?>
<?php $condo_mensual_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $condo_mensual_view->showPageHeader(); ?>
<?php
$condo_mensual_view->showMessage();
?>
<form name="fcondo_mensualview" id="fcondo_mensualview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="condo_mensual">
<input type="hidden" name="modal" value="<?php echo (int)$condo_mensual_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($condo_mensual_view->id_condo_mensual->Visible) { // id_condo_mensual ?>
	<tr id="r_id_condo_mensual">
		<td class="<?php echo $condo_mensual_view->TableLeftColumnClass ?>"><span id="elh_condo_mensual_id_condo_mensual"><?php echo $condo_mensual_view->id_condo_mensual->caption() ?></span></td>
		<td data-name="id_condo_mensual" <?php echo $condo_mensual_view->id_condo_mensual->cellAttributes() ?>>
<span id="el_condo_mensual_id_condo_mensual">
<span<?php echo $condo_mensual_view->id_condo_mensual->viewAttributes() ?>><?php echo $condo_mensual_view->id_condo_mensual->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($condo_mensual_view->mes->Visible) { // mes ?>
	<tr id="r_mes">
		<td class="<?php echo $condo_mensual_view->TableLeftColumnClass ?>"><span id="elh_condo_mensual_mes"><?php echo $condo_mensual_view->mes->caption() ?></span></td>
		<td data-name="mes" <?php echo $condo_mensual_view->mes->cellAttributes() ?>>
<span id="el_condo_mensual_mes">
<span<?php echo $condo_mensual_view->mes->viewAttributes() ?>><?php echo $condo_mensual_view->mes->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($condo_mensual_view->ano->Visible) { // año ?>
	<tr id="r_ano">
		<td class="<?php echo $condo_mensual_view->TableLeftColumnClass ?>"><span id="elh_condo_mensual_ano"><?php echo $condo_mensual_view->ano->caption() ?></span></td>
		<td data-name="ano" <?php echo $condo_mensual_view->ano->cellAttributes() ?>>
<span id="el_condo_mensual_ano">
<span<?php echo $condo_mensual_view->ano->viewAttributes() ?>><?php echo $condo_mensual_view->ano->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($condo_mensual_view->aux->Visible) { // aux ?>
	<tr id="r_aux">
		<td class="<?php echo $condo_mensual_view->TableLeftColumnClass ?>"><span id="elh_condo_mensual_aux"><?php echo $condo_mensual_view->aux->caption() ?></span></td>
		<td data-name="aux" <?php echo $condo_mensual_view->aux->cellAttributes() ?>>
<span id="el_condo_mensual_aux">
<span<?php echo $condo_mensual_view->aux->viewAttributes() ?>><?php echo $condo_mensual_view->aux->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("gastos", explode(",", $condo_mensual->getCurrentDetailTable())) && $gastos->DetailView) {
?>
<?php if ($condo_mensual->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("gastos", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "gastosgrid.php" ?>
<?php } ?>
</form>
<?php
$condo_mensual_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$condo_mensual_view->isExport()) { ?>
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
$condo_mensual_view->terminate();
?>