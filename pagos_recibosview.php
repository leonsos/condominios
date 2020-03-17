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
$pagos_recibos_view = new pagos_recibos_view();

// Run the page
$pagos_recibos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pagos_recibos_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pagos_recibos_view->isExport()) { ?>
<script>
var fpagos_recibosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpagos_recibosview = currentForm = new ew.Form("fpagos_recibosview", "view");
	loadjs.done("fpagos_recibosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$pagos_recibos_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $pagos_recibos_view->ExportOptions->render("body") ?>
<?php $pagos_recibos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $pagos_recibos_view->showPageHeader(); ?>
<?php
$pagos_recibos_view->showMessage();
?>
<form name="fpagos_recibosview" id="fpagos_recibosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pagos_recibos">
<input type="hidden" name="modal" value="<?php echo (int)$pagos_recibos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($pagos_recibos_view->id_pagos_recibos->Visible) { // id_pagos_recibos ?>
	<tr id="r_id_pagos_recibos">
		<td class="<?php echo $pagos_recibos_view->TableLeftColumnClass ?>"><span id="elh_pagos_recibos_id_pagos_recibos"><?php echo $pagos_recibos_view->id_pagos_recibos->caption() ?></span></td>
		<td data-name="id_pagos_recibos" <?php echo $pagos_recibos_view->id_pagos_recibos->cellAttributes() ?>>
<span id="el_pagos_recibos_id_pagos_recibos">
<span<?php echo $pagos_recibos_view->id_pagos_recibos->viewAttributes() ?>><?php echo $pagos_recibos_view->id_pagos_recibos->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pagos_recibos_view->pagos_id->Visible) { // pagos_id ?>
	<tr id="r_pagos_id">
		<td class="<?php echo $pagos_recibos_view->TableLeftColumnClass ?>"><span id="elh_pagos_recibos_pagos_id"><?php echo $pagos_recibos_view->pagos_id->caption() ?></span></td>
		<td data-name="pagos_id" <?php echo $pagos_recibos_view->pagos_id->cellAttributes() ?>>
<span id="el_pagos_recibos_pagos_id">
<span<?php echo $pagos_recibos_view->pagos_id->viewAttributes() ?>><?php echo $pagos_recibos_view->pagos_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pagos_recibos_view->recibos_id->Visible) { // recibos_id ?>
	<tr id="r_recibos_id">
		<td class="<?php echo $pagos_recibos_view->TableLeftColumnClass ?>"><span id="elh_pagos_recibos_recibos_id"><?php echo $pagos_recibos_view->recibos_id->caption() ?></span></td>
		<td data-name="recibos_id" <?php echo $pagos_recibos_view->recibos_id->cellAttributes() ?>>
<span id="el_pagos_recibos_recibos_id">
<span<?php echo $pagos_recibos_view->recibos_id->viewAttributes() ?>><?php echo $pagos_recibos_view->recibos_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$pagos_recibos_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pagos_recibos_view->isExport()) { ?>
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
$pagos_recibos_view->terminate();
?>