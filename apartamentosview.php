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
$apartamentos_view = new apartamentos_view();

// Run the page
$apartamentos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$apartamentos_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$apartamentos_view->isExport()) { ?>
<script>
var fapartamentosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fapartamentosview = currentForm = new ew.Form("fapartamentosview", "view");
	loadjs.done("fapartamentosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$apartamentos_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $apartamentos_view->ExportOptions->render("body") ?>
<?php $apartamentos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $apartamentos_view->showPageHeader(); ?>
<?php
$apartamentos_view->showMessage();
?>
<form name="fapartamentosview" id="fapartamentosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="apartamentos">
<input type="hidden" name="modal" value="<?php echo (int)$apartamentos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($apartamentos_view->id_apartamento->Visible) { // id_apartamento ?>
	<tr id="r_id_apartamento">
		<td class="<?php echo $apartamentos_view->TableLeftColumnClass ?>"><span id="elh_apartamentos_id_apartamento"><?php echo $apartamentos_view->id_apartamento->caption() ?></span></td>
		<td data-name="id_apartamento" <?php echo $apartamentos_view->id_apartamento->cellAttributes() ?>>
<span id="el_apartamentos_id_apartamento">
<span<?php echo $apartamentos_view->id_apartamento->viewAttributes() ?>><?php echo $apartamentos_view->id_apartamento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($apartamentos_view->propietario_id->Visible) { // propietario_id ?>
	<tr id="r_propietario_id">
		<td class="<?php echo $apartamentos_view->TableLeftColumnClass ?>"><span id="elh_apartamentos_propietario_id"><?php echo $apartamentos_view->propietario_id->caption() ?></span></td>
		<td data-name="propietario_id" <?php echo $apartamentos_view->propietario_id->cellAttributes() ?>>
<span id="el_apartamentos_propietario_id">
<span<?php echo $apartamentos_view->propietario_id->viewAttributes() ?>><?php echo $apartamentos_view->propietario_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($apartamentos_view->piso_id->Visible) { // piso_id ?>
	<tr id="r_piso_id">
		<td class="<?php echo $apartamentos_view->TableLeftColumnClass ?>"><span id="elh_apartamentos_piso_id"><?php echo $apartamentos_view->piso_id->caption() ?></span></td>
		<td data-name="piso_id" <?php echo $apartamentos_view->piso_id->cellAttributes() ?>>
<span id="el_apartamentos_piso_id">
<span<?php echo $apartamentos_view->piso_id->viewAttributes() ?>><?php echo $apartamentos_view->piso_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($apartamentos_view->metros_cuadrados->Visible) { // metros_cuadrados ?>
	<tr id="r_metros_cuadrados">
		<td class="<?php echo $apartamentos_view->TableLeftColumnClass ?>"><span id="elh_apartamentos_metros_cuadrados"><?php echo $apartamentos_view->metros_cuadrados->caption() ?></span></td>
		<td data-name="metros_cuadrados" <?php echo $apartamentos_view->metros_cuadrados->cellAttributes() ?>>
<span id="el_apartamentos_metros_cuadrados">
<span<?php echo $apartamentos_view->metros_cuadrados->viewAttributes() ?>><?php echo $apartamentos_view->metros_cuadrados->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($apartamentos_view->nombre_numero->Visible) { // nombre_numero ?>
	<tr id="r_nombre_numero">
		<td class="<?php echo $apartamentos_view->TableLeftColumnClass ?>"><span id="elh_apartamentos_nombre_numero"><?php echo $apartamentos_view->nombre_numero->caption() ?></span></td>
		<td data-name="nombre_numero" <?php echo $apartamentos_view->nombre_numero->cellAttributes() ?>>
<span id="el_apartamentos_nombre_numero">
<span<?php echo $apartamentos_view->nombre_numero->viewAttributes() ?>><?php echo $apartamentos_view->nombre_numero->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($apartamentos_view->alicuota->Visible) { // alicuota ?>
	<tr id="r_alicuota">
		<td class="<?php echo $apartamentos_view->TableLeftColumnClass ?>"><span id="elh_apartamentos_alicuota"><?php echo $apartamentos_view->alicuota->caption() ?></span></td>
		<td data-name="alicuota" <?php echo $apartamentos_view->alicuota->cellAttributes() ?>>
<span id="el_apartamentos_alicuota">
<span<?php echo $apartamentos_view->alicuota->viewAttributes() ?>><?php echo $apartamentos_view->alicuota->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$apartamentos_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$apartamentos_view->isExport()) { ?>
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
$apartamentos_view->terminate();
?>