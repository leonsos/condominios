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
$recibos_view = new recibos_view();

// Run the page
$recibos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$recibos_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$recibos_view->isExport()) { ?>
<script>
var frecibosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	frecibosview = currentForm = new ew.Form("frecibosview", "view");
	loadjs.done("frecibosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$recibos_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $recibos_view->ExportOptions->render("body") ?>
<?php $recibos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $recibos_view->showPageHeader(); ?>
<?php
$recibos_view->showMessage();
?>
<form name="frecibosview" id="frecibosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="recibos">
<input type="hidden" name="modal" value="<?php echo (int)$recibos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($recibos_view->id_recibo->Visible) { // id_recibo ?>
	<tr id="r_id_recibo">
		<td class="<?php echo $recibos_view->TableLeftColumnClass ?>"><span id="elh_recibos_id_recibo"><?php echo $recibos_view->id_recibo->caption() ?></span></td>
		<td data-name="id_recibo" <?php echo $recibos_view->id_recibo->cellAttributes() ?>>
<span id="el_recibos_id_recibo">
<span<?php echo $recibos_view->id_recibo->viewAttributes() ?>><?php echo $recibos_view->id_recibo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($recibos_view->condo_mensual_id->Visible) { // condo_mensual_id ?>
	<tr id="r_condo_mensual_id">
		<td class="<?php echo $recibos_view->TableLeftColumnClass ?>"><span id="elh_recibos_condo_mensual_id"><?php echo $recibos_view->condo_mensual_id->caption() ?></span></td>
		<td data-name="condo_mensual_id" <?php echo $recibos_view->condo_mensual_id->cellAttributes() ?>>
<span id="el_recibos_condo_mensual_id">
<span<?php echo $recibos_view->condo_mensual_id->viewAttributes() ?>><?php echo $recibos_view->condo_mensual_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($recibos_view->apartamento_id->Visible) { // apartamento_id ?>
	<tr id="r_apartamento_id">
		<td class="<?php echo $recibos_view->TableLeftColumnClass ?>"><span id="elh_recibos_apartamento_id"><?php echo $recibos_view->apartamento_id->caption() ?></span></td>
		<td data-name="apartamento_id" <?php echo $recibos_view->apartamento_id->cellAttributes() ?>>
<span id="el_recibos_apartamento_id">
<span<?php echo $recibos_view->apartamento_id->viewAttributes() ?>><?php echo $recibos_view->apartamento_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($recibos_view->n_recibo->Visible) { // n_recibo ?>
	<tr id="r_n_recibo">
		<td class="<?php echo $recibos_view->TableLeftColumnClass ?>"><span id="elh_recibos_n_recibo"><?php echo $recibos_view->n_recibo->caption() ?></span></td>
		<td data-name="n_recibo" <?php echo $recibos_view->n_recibo->cellAttributes() ?>>
<span id="el_recibos_n_recibo">
<span<?php echo $recibos_view->n_recibo->viewAttributes() ?>><?php echo $recibos_view->n_recibo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($recibos_view->monto_pagar->Visible) { // monto_pagar ?>
	<tr id="r_monto_pagar">
		<td class="<?php echo $recibos_view->TableLeftColumnClass ?>"><span id="elh_recibos_monto_pagar"><?php echo $recibos_view->monto_pagar->caption() ?></span></td>
		<td data-name="monto_pagar" <?php echo $recibos_view->monto_pagar->cellAttributes() ?>>
<span id="el_recibos_monto_pagar">
<span<?php echo $recibos_view->monto_pagar->viewAttributes() ?>><?php echo $recibos_view->monto_pagar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($recibos_view->monto_ind->Visible) { // monto_ind ?>
	<tr id="r_monto_ind">
		<td class="<?php echo $recibos_view->TableLeftColumnClass ?>"><span id="elh_recibos_monto_ind"><?php echo $recibos_view->monto_ind->caption() ?></span></td>
		<td data-name="monto_ind" <?php echo $recibos_view->monto_ind->cellAttributes() ?>>
<span id="el_recibos_monto_ind">
<span<?php echo $recibos_view->monto_ind->viewAttributes() ?>><?php echo $recibos_view->monto_ind->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($recibos_view->monto_alicuota->Visible) { // monto_alicuota ?>
	<tr id="r_monto_alicuota">
		<td class="<?php echo $recibos_view->TableLeftColumnClass ?>"><span id="elh_recibos_monto_alicuota"><?php echo $recibos_view->monto_alicuota->caption() ?></span></td>
		<td data-name="monto_alicuota" <?php echo $recibos_view->monto_alicuota->cellAttributes() ?>>
<span id="el_recibos_monto_alicuota">
<span<?php echo $recibos_view->monto_alicuota->viewAttributes() ?>><?php echo $recibos_view->monto_alicuota->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$recibos_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$recibos_view->isExport()) { ?>
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
$recibos_view->terminate();
?>