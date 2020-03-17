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
$maleteros_list = new maleteros_list();

// Run the page
$maleteros_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$maleteros_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$maleteros_list->isExport()) { ?>
<script>
var fmaleteroslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmaleteroslist = currentForm = new ew.Form("fmaleteroslist", "list");
	fmaleteroslist.formKeyCountName = '<?php echo $maleteros_list->FormKeyCountName ?>';
	loadjs.done("fmaleteroslist");
});
var fmaleteroslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmaleteroslistsrch = currentSearchForm = new ew.Form("fmaleteroslistsrch");

	// Dynamic selection lists
	// Filters

	fmaleteroslistsrch.filterList = <?php echo $maleteros_list->getFilterList() ?>;
	loadjs.done("fmaleteroslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$maleteros_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($maleteros_list->TotalRecords > 0 && $maleteros_list->ExportOptions->visible()) { ?>
<?php $maleteros_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($maleteros_list->ImportOptions->visible()) { ?>
<?php $maleteros_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($maleteros_list->SearchOptions->visible()) { ?>
<?php $maleteros_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($maleteros_list->FilterOptions->visible()) { ?>
<?php $maleteros_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$maleteros_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$maleteros_list->isExport() && !$maleteros->CurrentAction) { ?>
<form name="fmaleteroslistsrch" id="fmaleteroslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmaleteroslistsrch-search-panel" class="<?php echo $maleteros_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="maleteros">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $maleteros_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($maleteros_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($maleteros_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $maleteros_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($maleteros_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($maleteros_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($maleteros_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($maleteros_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $maleteros_list->showPageHeader(); ?>
<?php
$maleteros_list->showMessage();
?>
<?php if ($maleteros_list->TotalRecords > 0 || $maleteros->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($maleteros_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> maleteros">
<form name="fmaleteroslist" id="fmaleteroslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="maleteros">
<div id="gmp_maleteros" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($maleteros_list->TotalRecords > 0 || $maleteros_list->isGridEdit()) { ?>
<table id="tbl_maleteroslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$maleteros->RowType = ROWTYPE_HEADER;

// Render list options
$maleteros_list->renderListOptions();

// Render list options (header, left)
$maleteros_list->ListOptions->render("header", "left");
?>
<?php if ($maleteros_list->id_maletero->Visible) { // id_maletero ?>
	<?php if ($maleteros_list->SortUrl($maleteros_list->id_maletero) == "") { ?>
		<th data-name="id_maletero" class="<?php echo $maleteros_list->id_maletero->headerCellClass() ?>"><div id="elh_maleteros_id_maletero" class="maleteros_id_maletero"><div class="ew-table-header-caption"><?php echo $maleteros_list->id_maletero->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_maletero" class="<?php echo $maleteros_list->id_maletero->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $maleteros_list->SortUrl($maleteros_list->id_maletero) ?>', 1);"><div id="elh_maleteros_id_maletero" class="maleteros_id_maletero">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $maleteros_list->id_maletero->caption() ?></span><span class="ew-table-header-sort"><?php if ($maleteros_list->id_maletero->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($maleteros_list->id_maletero->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($maleteros_list->nombre_numero->Visible) { // nombre_numero ?>
	<?php if ($maleteros_list->SortUrl($maleteros_list->nombre_numero) == "") { ?>
		<th data-name="nombre_numero" class="<?php echo $maleteros_list->nombre_numero->headerCellClass() ?>"><div id="elh_maleteros_nombre_numero" class="maleteros_nombre_numero"><div class="ew-table-header-caption"><?php echo $maleteros_list->nombre_numero->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre_numero" class="<?php echo $maleteros_list->nombre_numero->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $maleteros_list->SortUrl($maleteros_list->nombre_numero) ?>', 1);"><div id="elh_maleteros_nombre_numero" class="maleteros_nombre_numero">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $maleteros_list->nombre_numero->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($maleteros_list->nombre_numero->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($maleteros_list->nombre_numero->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($maleteros_list->apartamento_id->Visible) { // apartamento_id ?>
	<?php if ($maleteros_list->SortUrl($maleteros_list->apartamento_id) == "") { ?>
		<th data-name="apartamento_id" class="<?php echo $maleteros_list->apartamento_id->headerCellClass() ?>"><div id="elh_maleteros_apartamento_id" class="maleteros_apartamento_id"><div class="ew-table-header-caption"><?php echo $maleteros_list->apartamento_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="apartamento_id" class="<?php echo $maleteros_list->apartamento_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $maleteros_list->SortUrl($maleteros_list->apartamento_id) ?>', 1);"><div id="elh_maleteros_apartamento_id" class="maleteros_apartamento_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $maleteros_list->apartamento_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($maleteros_list->apartamento_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($maleteros_list->apartamento_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$maleteros_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($maleteros_list->ExportAll && $maleteros_list->isExport()) {
	$maleteros_list->StopRecord = $maleteros_list->TotalRecords;
} else {

	// Set the last record to display
	if ($maleteros_list->TotalRecords > $maleteros_list->StartRecord + $maleteros_list->DisplayRecords - 1)
		$maleteros_list->StopRecord = $maleteros_list->StartRecord + $maleteros_list->DisplayRecords - 1;
	else
		$maleteros_list->StopRecord = $maleteros_list->TotalRecords;
}
$maleteros_list->RecordCount = $maleteros_list->StartRecord - 1;
if ($maleteros_list->Recordset && !$maleteros_list->Recordset->EOF) {
	$maleteros_list->Recordset->moveFirst();
	$selectLimit = $maleteros_list->UseSelectLimit;
	if (!$selectLimit && $maleteros_list->StartRecord > 1)
		$maleteros_list->Recordset->move($maleteros_list->StartRecord - 1);
} elseif (!$maleteros->AllowAddDeleteRow && $maleteros_list->StopRecord == 0) {
	$maleteros_list->StopRecord = $maleteros->GridAddRowCount;
}

// Initialize aggregate
$maleteros->RowType = ROWTYPE_AGGREGATEINIT;
$maleteros->resetAttributes();
$maleteros_list->renderRow();
while ($maleteros_list->RecordCount < $maleteros_list->StopRecord) {
	$maleteros_list->RecordCount++;
	if ($maleteros_list->RecordCount >= $maleteros_list->StartRecord) {
		$maleteros_list->RowCount++;

		// Set up key count
		$maleteros_list->KeyCount = $maleteros_list->RowIndex;

		// Init row class and style
		$maleteros->resetAttributes();
		$maleteros->CssClass = "";
		if ($maleteros_list->isGridAdd()) {
		} else {
			$maleteros_list->loadRowValues($maleteros_list->Recordset); // Load row values
		}
		$maleteros->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$maleteros->RowAttrs->merge(["data-rowindex" => $maleteros_list->RowCount, "id" => "r" . $maleteros_list->RowCount . "_maleteros", "data-rowtype" => $maleteros->RowType]);

		// Render row
		$maleteros_list->renderRow();

		// Render list options
		$maleteros_list->renderListOptions();
?>
	<tr <?php echo $maleteros->rowAttributes() ?>>
<?php

// Render list options (body, left)
$maleteros_list->ListOptions->render("body", "left", $maleteros_list->RowCount);
?>
	<?php if ($maleteros_list->id_maletero->Visible) { // id_maletero ?>
		<td data-name="id_maletero" <?php echo $maleteros_list->id_maletero->cellAttributes() ?>>
<span id="el<?php echo $maleteros_list->RowCount ?>_maleteros_id_maletero">
<span<?php echo $maleteros_list->id_maletero->viewAttributes() ?>><?php echo $maleteros_list->id_maletero->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($maleteros_list->nombre_numero->Visible) { // nombre_numero ?>
		<td data-name="nombre_numero" <?php echo $maleteros_list->nombre_numero->cellAttributes() ?>>
<span id="el<?php echo $maleteros_list->RowCount ?>_maleteros_nombre_numero">
<span<?php echo $maleteros_list->nombre_numero->viewAttributes() ?>><?php echo $maleteros_list->nombre_numero->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($maleteros_list->apartamento_id->Visible) { // apartamento_id ?>
		<td data-name="apartamento_id" <?php echo $maleteros_list->apartamento_id->cellAttributes() ?>>
<span id="el<?php echo $maleteros_list->RowCount ?>_maleteros_apartamento_id">
<span<?php echo $maleteros_list->apartamento_id->viewAttributes() ?>><?php echo $maleteros_list->apartamento_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$maleteros_list->ListOptions->render("body", "right", $maleteros_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$maleteros_list->isGridAdd())
		$maleteros_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$maleteros->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($maleteros_list->Recordset)
	$maleteros_list->Recordset->Close();
?>
<?php if (!$maleteros_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$maleteros_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $maleteros_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $maleteros_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($maleteros_list->TotalRecords == 0 && !$maleteros->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $maleteros_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$maleteros_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$maleteros_list->isExport()) { ?>
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
$maleteros_list->terminate();
?>