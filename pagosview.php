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
$pagos_view = new pagos_view();

// Run the page
$pagos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pagos_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pagos_view->isExport()) { ?>
<script>
var fpagosview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpagosview = currentForm = new ew.Form("fpagosview", "view");
	loadjs.done("fpagosview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$pagos_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $pagos_view->ExportOptions->render("body") ?>
<?php $pagos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $pagos_view->showPageHeader(); ?>
<?php
$pagos_view->showMessage();
?>
<form name="fpagosview" id="fpagosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pagos">
<input type="hidden" name="modal" value="<?php echo (int)$pagos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($pagos_view->id_pagos->Visible) { // id_pagos ?>
	<tr id="r_id_pagos">
		<td class="<?php echo $pagos_view->TableLeftColumnClass ?>"><span id="elh_pagos_id_pagos"><?php echo $pagos_view->id_pagos->caption() ?></span></td>
		<td data-name="id_pagos" <?php echo $pagos_view->id_pagos->cellAttributes() ?>>
<span id="el_pagos_id_pagos">
<span<?php echo $pagos_view->id_pagos->viewAttributes() ?>><?php echo $pagos_view->id_pagos->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$pagos_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pagos_view->isExport()) { ?>
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
$pagos_view->terminate();
?>