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
$pagos_list = new pagos_list();

// Run the page
$pagos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pagos_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pagos_list->isExport()) { ?>
<script>
var fpagoslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpagoslist = currentForm = new ew.Form("fpagoslist", "list");
	fpagoslist.formKeyCountName = '<?php echo $pagos_list->FormKeyCountName ?>';
	loadjs.done("fpagoslist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$pagos_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($pagos_list->TotalRecords > 0 && $pagos_list->ExportOptions->visible()) { ?>
<?php $pagos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($pagos_list->ImportOptions->visible()) { ?>
<?php $pagos_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$pagos_list->renderOtherOptions();
?>
<?php $pagos_list->showPageHeader(); ?>
<?php
$pagos_list->showMessage();
?>
<?php if ($pagos_list->TotalRecords > 0 || $pagos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($pagos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pagos">
<form name="fpagoslist" id="fpagoslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pagos">
<div id="gmp_pagos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($pagos_list->TotalRecords > 0 || $pagos_list->isGridEdit()) { ?>
<table id="tbl_pagoslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$pagos->RowType = ROWTYPE_HEADER;

// Render list options
$pagos_list->renderListOptions();

// Render list options (header, left)
$pagos_list->ListOptions->render("header", "left");
?>
<?php if ($pagos_list->id_pagos->Visible) { // id_pagos ?>
	<?php if ($pagos_list->SortUrl($pagos_list->id_pagos) == "") { ?>
		<th data-name="id_pagos" class="<?php echo $pagos_list->id_pagos->headerCellClass() ?>"><div id="elh_pagos_id_pagos" class="pagos_id_pagos"><div class="ew-table-header-caption"><?php echo $pagos_list->id_pagos->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pagos" class="<?php echo $pagos_list->id_pagos->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pagos_list->SortUrl($pagos_list->id_pagos) ?>', 1);"><div id="elh_pagos_id_pagos" class="pagos_id_pagos">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pagos_list->id_pagos->caption() ?></span><span class="ew-table-header-sort"><?php if ($pagos_list->id_pagos->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pagos_list->id_pagos->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pagos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($pagos_list->ExportAll && $pagos_list->isExport()) {
	$pagos_list->StopRecord = $pagos_list->TotalRecords;
} else {

	// Set the last record to display
	if ($pagos_list->TotalRecords > $pagos_list->StartRecord + $pagos_list->DisplayRecords - 1)
		$pagos_list->StopRecord = $pagos_list->StartRecord + $pagos_list->DisplayRecords - 1;
	else
		$pagos_list->StopRecord = $pagos_list->TotalRecords;
}
$pagos_list->RecordCount = $pagos_list->StartRecord - 1;
if ($pagos_list->Recordset && !$pagos_list->Recordset->EOF) {
	$pagos_list->Recordset->moveFirst();
	$selectLimit = $pagos_list->UseSelectLimit;
	if (!$selectLimit && $pagos_list->StartRecord > 1)
		$pagos_list->Recordset->move($pagos_list->StartRecord - 1);
} elseif (!$pagos->AllowAddDeleteRow && $pagos_list->StopRecord == 0) {
	$pagos_list->StopRecord = $pagos->GridAddRowCount;
}

// Initialize aggregate
$pagos->RowType = ROWTYPE_AGGREGATEINIT;
$pagos->resetAttributes();
$pagos_list->renderRow();
while ($pagos_list->RecordCount < $pagos_list->StopRecord) {
	$pagos_list->RecordCount++;
	if ($pagos_list->RecordCount >= $pagos_list->StartRecord) {
		$pagos_list->RowCount++;

		// Set up key count
		$pagos_list->KeyCount = $pagos_list->RowIndex;

		// Init row class and style
		$pagos->resetAttributes();
		$pagos->CssClass = "";
		if ($pagos_list->isGridAdd()) {
		} else {
			$pagos_list->loadRowValues($pagos_list->Recordset); // Load row values
		}
		$pagos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$pagos->RowAttrs->merge(["data-rowindex" => $pagos_list->RowCount, "id" => "r" . $pagos_list->RowCount . "_pagos", "data-rowtype" => $pagos->RowType]);

		// Render row
		$pagos_list->renderRow();

		// Render list options
		$pagos_list->renderListOptions();
?>
	<tr <?php echo $pagos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pagos_list->ListOptions->render("body", "left", $pagos_list->RowCount);
?>
	<?php if ($pagos_list->id_pagos->Visible) { // id_pagos ?>
		<td data-name="id_pagos" <?php echo $pagos_list->id_pagos->cellAttributes() ?>>
<span id="el<?php echo $pagos_list->RowCount ?>_pagos_id_pagos">
<span<?php echo $pagos_list->id_pagos->viewAttributes() ?>><?php echo $pagos_list->id_pagos->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pagos_list->ListOptions->render("body", "right", $pagos_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$pagos_list->isGridAdd())
		$pagos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$pagos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($pagos_list->Recordset)
	$pagos_list->Recordset->Close();
?>
<?php if (!$pagos_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$pagos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pagos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pagos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($pagos_list->TotalRecords == 0 && !$pagos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $pagos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$pagos_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pagos_list->isExport()) { ?>
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
$pagos_list->terminate();
?>