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
$estacionamientos_list = new estacionamientos_list();

// Run the page
$estacionamientos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$estacionamientos_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$estacionamientos_list->isExport()) { ?>
<script>
var festacionamientoslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	festacionamientoslist = currentForm = new ew.Form("festacionamientoslist", "list");
	festacionamientoslist.formKeyCountName = '<?php echo $estacionamientos_list->FormKeyCountName ?>';
	loadjs.done("festacionamientoslist");
});
var festacionamientoslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	festacionamientoslistsrch = currentSearchForm = new ew.Form("festacionamientoslistsrch");

	// Dynamic selection lists
	// Filters

	festacionamientoslistsrch.filterList = <?php echo $estacionamientos_list->getFilterList() ?>;
	loadjs.done("festacionamientoslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$estacionamientos_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($estacionamientos_list->TotalRecords > 0 && $estacionamientos_list->ExportOptions->visible()) { ?>
<?php $estacionamientos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($estacionamientos_list->ImportOptions->visible()) { ?>
<?php $estacionamientos_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($estacionamientos_list->SearchOptions->visible()) { ?>
<?php $estacionamientos_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($estacionamientos_list->FilterOptions->visible()) { ?>
<?php $estacionamientos_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$estacionamientos_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$estacionamientos_list->isExport() && !$estacionamientos->CurrentAction) { ?>
<form name="festacionamientoslistsrch" id="festacionamientoslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="festacionamientoslistsrch-search-panel" class="<?php echo $estacionamientos_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="estacionamientos">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $estacionamientos_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($estacionamientos_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($estacionamientos_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $estacionamientos_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($estacionamientos_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($estacionamientos_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($estacionamientos_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($estacionamientos_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $estacionamientos_list->showPageHeader(); ?>
<?php
$estacionamientos_list->showMessage();
?>
<?php if ($estacionamientos_list->TotalRecords > 0 || $estacionamientos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($estacionamientos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> estacionamientos">
<form name="festacionamientoslist" id="festacionamientoslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="estacionamientos">
<div id="gmp_estacionamientos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($estacionamientos_list->TotalRecords > 0 || $estacionamientos_list->isGridEdit()) { ?>
<table id="tbl_estacionamientoslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$estacionamientos->RowType = ROWTYPE_HEADER;

// Render list options
$estacionamientos_list->renderListOptions();

// Render list options (header, left)
$estacionamientos_list->ListOptions->render("header", "left");
?>
<?php if ($estacionamientos_list->id_estacionamiento->Visible) { // id_estacionamiento ?>
	<?php if ($estacionamientos_list->SortUrl($estacionamientos_list->id_estacionamiento) == "") { ?>
		<th data-name="id_estacionamiento" class="<?php echo $estacionamientos_list->id_estacionamiento->headerCellClass() ?>"><div id="elh_estacionamientos_id_estacionamiento" class="estacionamientos_id_estacionamiento"><div class="ew-table-header-caption"><?php echo $estacionamientos_list->id_estacionamiento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_estacionamiento" class="<?php echo $estacionamientos_list->id_estacionamiento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $estacionamientos_list->SortUrl($estacionamientos_list->id_estacionamiento) ?>', 1);"><div id="elh_estacionamientos_id_estacionamiento" class="estacionamientos_id_estacionamiento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $estacionamientos_list->id_estacionamiento->caption() ?></span><span class="ew-table-header-sort"><?php if ($estacionamientos_list->id_estacionamiento->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($estacionamientos_list->id_estacionamiento->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($estacionamientos_list->nombre->Visible) { // nombre ?>
	<?php if ($estacionamientos_list->SortUrl($estacionamientos_list->nombre) == "") { ?>
		<th data-name="nombre" class="<?php echo $estacionamientos_list->nombre->headerCellClass() ?>"><div id="elh_estacionamientos_nombre" class="estacionamientos_nombre"><div class="ew-table-header-caption"><?php echo $estacionamientos_list->nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre" class="<?php echo $estacionamientos_list->nombre->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $estacionamientos_list->SortUrl($estacionamientos_list->nombre) ?>', 1);"><div id="elh_estacionamientos_nombre" class="estacionamientos_nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $estacionamientos_list->nombre->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($estacionamientos_list->nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($estacionamientos_list->nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($estacionamientos_list->apartamento_id->Visible) { // apartamento_id ?>
	<?php if ($estacionamientos_list->SortUrl($estacionamientos_list->apartamento_id) == "") { ?>
		<th data-name="apartamento_id" class="<?php echo $estacionamientos_list->apartamento_id->headerCellClass() ?>"><div id="elh_estacionamientos_apartamento_id" class="estacionamientos_apartamento_id"><div class="ew-table-header-caption"><?php echo $estacionamientos_list->apartamento_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="apartamento_id" class="<?php echo $estacionamientos_list->apartamento_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $estacionamientos_list->SortUrl($estacionamientos_list->apartamento_id) ?>', 1);"><div id="elh_estacionamientos_apartamento_id" class="estacionamientos_apartamento_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $estacionamientos_list->apartamento_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($estacionamientos_list->apartamento_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($estacionamientos_list->apartamento_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$estacionamientos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($estacionamientos_list->ExportAll && $estacionamientos_list->isExport()) {
	$estacionamientos_list->StopRecord = $estacionamientos_list->TotalRecords;
} else {

	// Set the last record to display
	if ($estacionamientos_list->TotalRecords > $estacionamientos_list->StartRecord + $estacionamientos_list->DisplayRecords - 1)
		$estacionamientos_list->StopRecord = $estacionamientos_list->StartRecord + $estacionamientos_list->DisplayRecords - 1;
	else
		$estacionamientos_list->StopRecord = $estacionamientos_list->TotalRecords;
}
$estacionamientos_list->RecordCount = $estacionamientos_list->StartRecord - 1;
if ($estacionamientos_list->Recordset && !$estacionamientos_list->Recordset->EOF) {
	$estacionamientos_list->Recordset->moveFirst();
	$selectLimit = $estacionamientos_list->UseSelectLimit;
	if (!$selectLimit && $estacionamientos_list->StartRecord > 1)
		$estacionamientos_list->Recordset->move($estacionamientos_list->StartRecord - 1);
} elseif (!$estacionamientos->AllowAddDeleteRow && $estacionamientos_list->StopRecord == 0) {
	$estacionamientos_list->StopRecord = $estacionamientos->GridAddRowCount;
}

// Initialize aggregate
$estacionamientos->RowType = ROWTYPE_AGGREGATEINIT;
$estacionamientos->resetAttributes();
$estacionamientos_list->renderRow();
while ($estacionamientos_list->RecordCount < $estacionamientos_list->StopRecord) {
	$estacionamientos_list->RecordCount++;
	if ($estacionamientos_list->RecordCount >= $estacionamientos_list->StartRecord) {
		$estacionamientos_list->RowCount++;

		// Set up key count
		$estacionamientos_list->KeyCount = $estacionamientos_list->RowIndex;

		// Init row class and style
		$estacionamientos->resetAttributes();
		$estacionamientos->CssClass = "";
		if ($estacionamientos_list->isGridAdd()) {
		} else {
			$estacionamientos_list->loadRowValues($estacionamientos_list->Recordset); // Load row values
		}
		$estacionamientos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$estacionamientos->RowAttrs->merge(["data-rowindex" => $estacionamientos_list->RowCount, "id" => "r" . $estacionamientos_list->RowCount . "_estacionamientos", "data-rowtype" => $estacionamientos->RowType]);

		// Render row
		$estacionamientos_list->renderRow();

		// Render list options
		$estacionamientos_list->renderListOptions();
?>
	<tr <?php echo $estacionamientos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$estacionamientos_list->ListOptions->render("body", "left", $estacionamientos_list->RowCount);
?>
	<?php if ($estacionamientos_list->id_estacionamiento->Visible) { // id_estacionamiento ?>
		<td data-name="id_estacionamiento" <?php echo $estacionamientos_list->id_estacionamiento->cellAttributes() ?>>
<span id="el<?php echo $estacionamientos_list->RowCount ?>_estacionamientos_id_estacionamiento">
<span<?php echo $estacionamientos_list->id_estacionamiento->viewAttributes() ?>><?php echo $estacionamientos_list->id_estacionamiento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($estacionamientos_list->nombre->Visible) { // nombre ?>
		<td data-name="nombre" <?php echo $estacionamientos_list->nombre->cellAttributes() ?>>
<span id="el<?php echo $estacionamientos_list->RowCount ?>_estacionamientos_nombre">
<span<?php echo $estacionamientos_list->nombre->viewAttributes() ?>><?php echo $estacionamientos_list->nombre->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($estacionamientos_list->apartamento_id->Visible) { // apartamento_id ?>
		<td data-name="apartamento_id" <?php echo $estacionamientos_list->apartamento_id->cellAttributes() ?>>
<span id="el<?php echo $estacionamientos_list->RowCount ?>_estacionamientos_apartamento_id">
<span<?php echo $estacionamientos_list->apartamento_id->viewAttributes() ?>><?php echo $estacionamientos_list->apartamento_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$estacionamientos_list->ListOptions->render("body", "right", $estacionamientos_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$estacionamientos_list->isGridAdd())
		$estacionamientos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$estacionamientos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($estacionamientos_list->Recordset)
	$estacionamientos_list->Recordset->Close();
?>
<?php if (!$estacionamientos_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$estacionamientos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $estacionamientos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $estacionamientos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($estacionamientos_list->TotalRecords == 0 && !$estacionamientos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $estacionamientos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$estacionamientos_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$estacionamientos_list->isExport()) { ?>
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
$estacionamientos_list->terminate();
?>