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
$pagos_recibos_list = new pagos_recibos_list();

// Run the page
$pagos_recibos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pagos_recibos_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pagos_recibos_list->isExport()) { ?>
<script>
var fpagos_reciboslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpagos_reciboslist = currentForm = new ew.Form("fpagos_reciboslist", "list");
	fpagos_reciboslist.formKeyCountName = '<?php echo $pagos_recibos_list->FormKeyCountName ?>';
	loadjs.done("fpagos_reciboslist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$pagos_recibos_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($pagos_recibos_list->TotalRecords > 0 && $pagos_recibos_list->ExportOptions->visible()) { ?>
<?php $pagos_recibos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($pagos_recibos_list->ImportOptions->visible()) { ?>
<?php $pagos_recibos_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$pagos_recibos_list->renderOtherOptions();
?>
<?php $pagos_recibos_list->showPageHeader(); ?>
<?php
$pagos_recibos_list->showMessage();
?>
<?php if ($pagos_recibos_list->TotalRecords > 0 || $pagos_recibos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($pagos_recibos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pagos_recibos">
<form name="fpagos_reciboslist" id="fpagos_reciboslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pagos_recibos">
<div id="gmp_pagos_recibos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($pagos_recibos_list->TotalRecords > 0 || $pagos_recibos_list->isGridEdit()) { ?>
<table id="tbl_pagos_reciboslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$pagos_recibos->RowType = ROWTYPE_HEADER;

// Render list options
$pagos_recibos_list->renderListOptions();

// Render list options (header, left)
$pagos_recibos_list->ListOptions->render("header", "left");
?>
<?php if ($pagos_recibos_list->id_pagos_recibos->Visible) { // id_pagos_recibos ?>
	<?php if ($pagos_recibos_list->SortUrl($pagos_recibos_list->id_pagos_recibos) == "") { ?>
		<th data-name="id_pagos_recibos" class="<?php echo $pagos_recibos_list->id_pagos_recibos->headerCellClass() ?>"><div id="elh_pagos_recibos_id_pagos_recibos" class="pagos_recibos_id_pagos_recibos"><div class="ew-table-header-caption"><?php echo $pagos_recibos_list->id_pagos_recibos->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pagos_recibos" class="<?php echo $pagos_recibos_list->id_pagos_recibos->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pagos_recibos_list->SortUrl($pagos_recibos_list->id_pagos_recibos) ?>', 1);"><div id="elh_pagos_recibos_id_pagos_recibos" class="pagos_recibos_id_pagos_recibos">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pagos_recibos_list->id_pagos_recibos->caption() ?></span><span class="ew-table-header-sort"><?php if ($pagos_recibos_list->id_pagos_recibos->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pagos_recibos_list->id_pagos_recibos->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pagos_recibos_list->pagos_id->Visible) { // pagos_id ?>
	<?php if ($pagos_recibos_list->SortUrl($pagos_recibos_list->pagos_id) == "") { ?>
		<th data-name="pagos_id" class="<?php echo $pagos_recibos_list->pagos_id->headerCellClass() ?>"><div id="elh_pagos_recibos_pagos_id" class="pagos_recibos_pagos_id"><div class="ew-table-header-caption"><?php echo $pagos_recibos_list->pagos_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pagos_id" class="<?php echo $pagos_recibos_list->pagos_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pagos_recibos_list->SortUrl($pagos_recibos_list->pagos_id) ?>', 1);"><div id="elh_pagos_recibos_pagos_id" class="pagos_recibos_pagos_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pagos_recibos_list->pagos_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($pagos_recibos_list->pagos_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pagos_recibos_list->pagos_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pagos_recibos_list->recibos_id->Visible) { // recibos_id ?>
	<?php if ($pagos_recibos_list->SortUrl($pagos_recibos_list->recibos_id) == "") { ?>
		<th data-name="recibos_id" class="<?php echo $pagos_recibos_list->recibos_id->headerCellClass() ?>"><div id="elh_pagos_recibos_recibos_id" class="pagos_recibos_recibos_id"><div class="ew-table-header-caption"><?php echo $pagos_recibos_list->recibos_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="recibos_id" class="<?php echo $pagos_recibos_list->recibos_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pagos_recibos_list->SortUrl($pagos_recibos_list->recibos_id) ?>', 1);"><div id="elh_pagos_recibos_recibos_id" class="pagos_recibos_recibos_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pagos_recibos_list->recibos_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($pagos_recibos_list->recibos_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pagos_recibos_list->recibos_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pagos_recibos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($pagos_recibos_list->ExportAll && $pagos_recibos_list->isExport()) {
	$pagos_recibos_list->StopRecord = $pagos_recibos_list->TotalRecords;
} else {

	// Set the last record to display
	if ($pagos_recibos_list->TotalRecords > $pagos_recibos_list->StartRecord + $pagos_recibos_list->DisplayRecords - 1)
		$pagos_recibos_list->StopRecord = $pagos_recibos_list->StartRecord + $pagos_recibos_list->DisplayRecords - 1;
	else
		$pagos_recibos_list->StopRecord = $pagos_recibos_list->TotalRecords;
}
$pagos_recibos_list->RecordCount = $pagos_recibos_list->StartRecord - 1;
if ($pagos_recibos_list->Recordset && !$pagos_recibos_list->Recordset->EOF) {
	$pagos_recibos_list->Recordset->moveFirst();
	$selectLimit = $pagos_recibos_list->UseSelectLimit;
	if (!$selectLimit && $pagos_recibos_list->StartRecord > 1)
		$pagos_recibos_list->Recordset->move($pagos_recibos_list->StartRecord - 1);
} elseif (!$pagos_recibos->AllowAddDeleteRow && $pagos_recibos_list->StopRecord == 0) {
	$pagos_recibos_list->StopRecord = $pagos_recibos->GridAddRowCount;
}

// Initialize aggregate
$pagos_recibos->RowType = ROWTYPE_AGGREGATEINIT;
$pagos_recibos->resetAttributes();
$pagos_recibos_list->renderRow();
while ($pagos_recibos_list->RecordCount < $pagos_recibos_list->StopRecord) {
	$pagos_recibos_list->RecordCount++;
	if ($pagos_recibos_list->RecordCount >= $pagos_recibos_list->StartRecord) {
		$pagos_recibos_list->RowCount++;

		// Set up key count
		$pagos_recibos_list->KeyCount = $pagos_recibos_list->RowIndex;

		// Init row class and style
		$pagos_recibos->resetAttributes();
		$pagos_recibos->CssClass = "";
		if ($pagos_recibos_list->isGridAdd()) {
		} else {
			$pagos_recibos_list->loadRowValues($pagos_recibos_list->Recordset); // Load row values
		}
		$pagos_recibos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$pagos_recibos->RowAttrs->merge(["data-rowindex" => $pagos_recibos_list->RowCount, "id" => "r" . $pagos_recibos_list->RowCount . "_pagos_recibos", "data-rowtype" => $pagos_recibos->RowType]);

		// Render row
		$pagos_recibos_list->renderRow();

		// Render list options
		$pagos_recibos_list->renderListOptions();
?>
	<tr <?php echo $pagos_recibos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pagos_recibos_list->ListOptions->render("body", "left", $pagos_recibos_list->RowCount);
?>
	<?php if ($pagos_recibos_list->id_pagos_recibos->Visible) { // id_pagos_recibos ?>
		<td data-name="id_pagos_recibos" <?php echo $pagos_recibos_list->id_pagos_recibos->cellAttributes() ?>>
<span id="el<?php echo $pagos_recibos_list->RowCount ?>_pagos_recibos_id_pagos_recibos">
<span<?php echo $pagos_recibos_list->id_pagos_recibos->viewAttributes() ?>><?php echo $pagos_recibos_list->id_pagos_recibos->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pagos_recibos_list->pagos_id->Visible) { // pagos_id ?>
		<td data-name="pagos_id" <?php echo $pagos_recibos_list->pagos_id->cellAttributes() ?>>
<span id="el<?php echo $pagos_recibos_list->RowCount ?>_pagos_recibos_pagos_id">
<span<?php echo $pagos_recibos_list->pagos_id->viewAttributes() ?>><?php echo $pagos_recibos_list->pagos_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pagos_recibos_list->recibos_id->Visible) { // recibos_id ?>
		<td data-name="recibos_id" <?php echo $pagos_recibos_list->recibos_id->cellAttributes() ?>>
<span id="el<?php echo $pagos_recibos_list->RowCount ?>_pagos_recibos_recibos_id">
<span<?php echo $pagos_recibos_list->recibos_id->viewAttributes() ?>><?php echo $pagos_recibos_list->recibos_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pagos_recibos_list->ListOptions->render("body", "right", $pagos_recibos_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$pagos_recibos_list->isGridAdd())
		$pagos_recibos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$pagos_recibos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($pagos_recibos_list->Recordset)
	$pagos_recibos_list->Recordset->Close();
?>
<?php if (!$pagos_recibos_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$pagos_recibos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pagos_recibos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pagos_recibos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($pagos_recibos_list->TotalRecords == 0 && !$pagos_recibos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $pagos_recibos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$pagos_recibos_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pagos_recibos_list->isExport()) { ?>
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
$pagos_recibos_list->terminate();
?>