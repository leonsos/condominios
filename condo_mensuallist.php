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
$condo_mensual_list = new condo_mensual_list();

// Run the page
$condo_mensual_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$condo_mensual_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$condo_mensual_list->isExport()) { ?>
<script>
var fcondo_mensuallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcondo_mensuallist = currentForm = new ew.Form("fcondo_mensuallist", "list");
	fcondo_mensuallist.formKeyCountName = '<?php echo $condo_mensual_list->FormKeyCountName ?>';
	loadjs.done("fcondo_mensuallist");
});
var fcondo_mensuallistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcondo_mensuallistsrch = currentSearchForm = new ew.Form("fcondo_mensuallistsrch");

	// Dynamic selection lists
	// Filters

	fcondo_mensuallistsrch.filterList = <?php echo $condo_mensual_list->getFilterList() ?>;
	loadjs.done("fcondo_mensuallistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$condo_mensual_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($condo_mensual_list->TotalRecords > 0 && $condo_mensual_list->ExportOptions->visible()) { ?>
<?php $condo_mensual_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($condo_mensual_list->ImportOptions->visible()) { ?>
<?php $condo_mensual_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($condo_mensual_list->SearchOptions->visible()) { ?>
<?php $condo_mensual_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($condo_mensual_list->FilterOptions->visible()) { ?>
<?php $condo_mensual_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$condo_mensual_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$condo_mensual_list->isExport() && !$condo_mensual->CurrentAction) { ?>
<form name="fcondo_mensuallistsrch" id="fcondo_mensuallistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcondo_mensuallistsrch-search-panel" class="<?php echo $condo_mensual_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="condo_mensual">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $condo_mensual_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($condo_mensual_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($condo_mensual_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $condo_mensual_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($condo_mensual_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($condo_mensual_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($condo_mensual_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($condo_mensual_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $condo_mensual_list->showPageHeader(); ?>
<?php
$condo_mensual_list->showMessage();
?>
<?php if ($condo_mensual_list->TotalRecords > 0 || $condo_mensual->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($condo_mensual_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> condo_mensual">
<form name="fcondo_mensuallist" id="fcondo_mensuallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="condo_mensual">
<div id="gmp_condo_mensual" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($condo_mensual_list->TotalRecords > 0 || $condo_mensual_list->isGridEdit()) { ?>
<table id="tbl_condo_mensuallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$condo_mensual->RowType = ROWTYPE_HEADER;

// Render list options
$condo_mensual_list->renderListOptions();

// Render list options (header, left)
$condo_mensual_list->ListOptions->render("header", "left");
?>
<?php if ($condo_mensual_list->id_condo_mensual->Visible) { // id_condo_mensual ?>
	<?php if ($condo_mensual_list->SortUrl($condo_mensual_list->id_condo_mensual) == "") { ?>
		<th data-name="id_condo_mensual" class="<?php echo $condo_mensual_list->id_condo_mensual->headerCellClass() ?>"><div id="elh_condo_mensual_id_condo_mensual" class="condo_mensual_id_condo_mensual"><div class="ew-table-header-caption"><?php echo $condo_mensual_list->id_condo_mensual->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_condo_mensual" class="<?php echo $condo_mensual_list->id_condo_mensual->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $condo_mensual_list->SortUrl($condo_mensual_list->id_condo_mensual) ?>', 1);"><div id="elh_condo_mensual_id_condo_mensual" class="condo_mensual_id_condo_mensual">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $condo_mensual_list->id_condo_mensual->caption() ?></span><span class="ew-table-header-sort"><?php if ($condo_mensual_list->id_condo_mensual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($condo_mensual_list->id_condo_mensual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($condo_mensual_list->mes->Visible) { // mes ?>
	<?php if ($condo_mensual_list->SortUrl($condo_mensual_list->mes) == "") { ?>
		<th data-name="mes" class="<?php echo $condo_mensual_list->mes->headerCellClass() ?>"><div id="elh_condo_mensual_mes" class="condo_mensual_mes"><div class="ew-table-header-caption"><?php echo $condo_mensual_list->mes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mes" class="<?php echo $condo_mensual_list->mes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $condo_mensual_list->SortUrl($condo_mensual_list->mes) ?>', 1);"><div id="elh_condo_mensual_mes" class="condo_mensual_mes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $condo_mensual_list->mes->caption() ?></span><span class="ew-table-header-sort"><?php if ($condo_mensual_list->mes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($condo_mensual_list->mes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($condo_mensual_list->ano->Visible) { // año ?>
	<?php if ($condo_mensual_list->SortUrl($condo_mensual_list->ano) == "") { ?>
		<th data-name="ano" class="<?php echo $condo_mensual_list->ano->headerCellClass() ?>"><div id="elh_condo_mensual_ano" class="condo_mensual_ano"><div class="ew-table-header-caption"><?php echo $condo_mensual_list->ano->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ano" class="<?php echo $condo_mensual_list->ano->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $condo_mensual_list->SortUrl($condo_mensual_list->ano) ?>', 1);"><div id="elh_condo_mensual_ano" class="condo_mensual_ano">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $condo_mensual_list->ano->caption() ?></span><span class="ew-table-header-sort"><?php if ($condo_mensual_list->ano->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($condo_mensual_list->ano->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($condo_mensual_list->aux->Visible) { // aux ?>
	<?php if ($condo_mensual_list->SortUrl($condo_mensual_list->aux) == "") { ?>
		<th data-name="aux" class="<?php echo $condo_mensual_list->aux->headerCellClass() ?>"><div id="elh_condo_mensual_aux" class="condo_mensual_aux"><div class="ew-table-header-caption"><?php echo $condo_mensual_list->aux->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="aux" class="<?php echo $condo_mensual_list->aux->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $condo_mensual_list->SortUrl($condo_mensual_list->aux) ?>', 1);"><div id="elh_condo_mensual_aux" class="condo_mensual_aux">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $condo_mensual_list->aux->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($condo_mensual_list->aux->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($condo_mensual_list->aux->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$condo_mensual_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($condo_mensual_list->ExportAll && $condo_mensual_list->isExport()) {
	$condo_mensual_list->StopRecord = $condo_mensual_list->TotalRecords;
} else {

	// Set the last record to display
	if ($condo_mensual_list->TotalRecords > $condo_mensual_list->StartRecord + $condo_mensual_list->DisplayRecords - 1)
		$condo_mensual_list->StopRecord = $condo_mensual_list->StartRecord + $condo_mensual_list->DisplayRecords - 1;
	else
		$condo_mensual_list->StopRecord = $condo_mensual_list->TotalRecords;
}
$condo_mensual_list->RecordCount = $condo_mensual_list->StartRecord - 1;
if ($condo_mensual_list->Recordset && !$condo_mensual_list->Recordset->EOF) {
	$condo_mensual_list->Recordset->moveFirst();
	$selectLimit = $condo_mensual_list->UseSelectLimit;
	if (!$selectLimit && $condo_mensual_list->StartRecord > 1)
		$condo_mensual_list->Recordset->move($condo_mensual_list->StartRecord - 1);
} elseif (!$condo_mensual->AllowAddDeleteRow && $condo_mensual_list->StopRecord == 0) {
	$condo_mensual_list->StopRecord = $condo_mensual->GridAddRowCount;
}

// Initialize aggregate
$condo_mensual->RowType = ROWTYPE_AGGREGATEINIT;
$condo_mensual->resetAttributes();
$condo_mensual_list->renderRow();
while ($condo_mensual_list->RecordCount < $condo_mensual_list->StopRecord) {
	$condo_mensual_list->RecordCount++;
	if ($condo_mensual_list->RecordCount >= $condo_mensual_list->StartRecord) {
		$condo_mensual_list->RowCount++;

		// Set up key count
		$condo_mensual_list->KeyCount = $condo_mensual_list->RowIndex;

		// Init row class and style
		$condo_mensual->resetAttributes();
		$condo_mensual->CssClass = "";
		if ($condo_mensual_list->isGridAdd()) {
		} else {
			$condo_mensual_list->loadRowValues($condo_mensual_list->Recordset); // Load row values
		}
		$condo_mensual->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$condo_mensual->RowAttrs->merge(["data-rowindex" => $condo_mensual_list->RowCount, "id" => "r" . $condo_mensual_list->RowCount . "_condo_mensual", "data-rowtype" => $condo_mensual->RowType]);

		// Render row
		$condo_mensual_list->renderRow();

		// Render list options
		$condo_mensual_list->renderListOptions();
?>
	<tr <?php echo $condo_mensual->rowAttributes() ?>>
<?php

// Render list options (body, left)
$condo_mensual_list->ListOptions->render("body", "left", $condo_mensual_list->RowCount);
?>
	<?php if ($condo_mensual_list->id_condo_mensual->Visible) { // id_condo_mensual ?>
		<td data-name="id_condo_mensual" <?php echo $condo_mensual_list->id_condo_mensual->cellAttributes() ?>>
<span id="el<?php echo $condo_mensual_list->RowCount ?>_condo_mensual_id_condo_mensual">
<span<?php echo $condo_mensual_list->id_condo_mensual->viewAttributes() ?>><?php echo $condo_mensual_list->id_condo_mensual->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($condo_mensual_list->mes->Visible) { // mes ?>
		<td data-name="mes" <?php echo $condo_mensual_list->mes->cellAttributes() ?>>
<span id="el<?php echo $condo_mensual_list->RowCount ?>_condo_mensual_mes">
<span<?php echo $condo_mensual_list->mes->viewAttributes() ?>><?php echo $condo_mensual_list->mes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($condo_mensual_list->ano->Visible) { // año ?>
		<td data-name="ano" <?php echo $condo_mensual_list->ano->cellAttributes() ?>>
<span id="el<?php echo $condo_mensual_list->RowCount ?>_condo_mensual_ano">
<span<?php echo $condo_mensual_list->ano->viewAttributes() ?>><?php echo $condo_mensual_list->ano->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($condo_mensual_list->aux->Visible) { // aux ?>
		<td data-name="aux" <?php echo $condo_mensual_list->aux->cellAttributes() ?>>
<span id="el<?php echo $condo_mensual_list->RowCount ?>_condo_mensual_aux">
<span<?php echo $condo_mensual_list->aux->viewAttributes() ?>><?php echo $condo_mensual_list->aux->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$condo_mensual_list->ListOptions->render("body", "right", $condo_mensual_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$condo_mensual_list->isGridAdd())
		$condo_mensual_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$condo_mensual->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($condo_mensual_list->Recordset)
	$condo_mensual_list->Recordset->Close();
?>
<?php if (!$condo_mensual_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$condo_mensual_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $condo_mensual_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $condo_mensual_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($condo_mensual_list->TotalRecords == 0 && !$condo_mensual->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $condo_mensual_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$condo_mensual_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$condo_mensual_list->isExport()) { ?>
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
$condo_mensual_list->terminate();
?>