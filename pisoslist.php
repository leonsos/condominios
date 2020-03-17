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
$pisos_list = new pisos_list();

// Run the page
$pisos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pisos_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pisos_list->isExport()) { ?>
<script>
var fpisoslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpisoslist = currentForm = new ew.Form("fpisoslist", "list");
	fpisoslist.formKeyCountName = '<?php echo $pisos_list->FormKeyCountName ?>';
	loadjs.done("fpisoslist");
});
var fpisoslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpisoslistsrch = currentSearchForm = new ew.Form("fpisoslistsrch");

	// Dynamic selection lists
	// Filters

	fpisoslistsrch.filterList = <?php echo $pisos_list->getFilterList() ?>;
	loadjs.done("fpisoslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$pisos_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($pisos_list->TotalRecords > 0 && $pisos_list->ExportOptions->visible()) { ?>
<?php $pisos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($pisos_list->ImportOptions->visible()) { ?>
<?php $pisos_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($pisos_list->SearchOptions->visible()) { ?>
<?php $pisos_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($pisos_list->FilterOptions->visible()) { ?>
<?php $pisos_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$pisos_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$pisos_list->isExport() && !$pisos->CurrentAction) { ?>
<form name="fpisoslistsrch" id="fpisoslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpisoslistsrch-search-panel" class="<?php echo $pisos_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pisos">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $pisos_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($pisos_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($pisos_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $pisos_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($pisos_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($pisos_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($pisos_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($pisos_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $pisos_list->showPageHeader(); ?>
<?php
$pisos_list->showMessage();
?>
<?php if ($pisos_list->TotalRecords > 0 || $pisos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($pisos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pisos">
<form name="fpisoslist" id="fpisoslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pisos">
<div id="gmp_pisos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($pisos_list->TotalRecords > 0 || $pisos_list->isGridEdit()) { ?>
<table id="tbl_pisoslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$pisos->RowType = ROWTYPE_HEADER;

// Render list options
$pisos_list->renderListOptions();

// Render list options (header, left)
$pisos_list->ListOptions->render("header", "left");
?>
<?php if ($pisos_list->id_piso->Visible) { // id_piso ?>
	<?php if ($pisos_list->SortUrl($pisos_list->id_piso) == "") { ?>
		<th data-name="id_piso" class="<?php echo $pisos_list->id_piso->headerCellClass() ?>"><div id="elh_pisos_id_piso" class="pisos_id_piso"><div class="ew-table-header-caption"><?php echo $pisos_list->id_piso->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_piso" class="<?php echo $pisos_list->id_piso->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pisos_list->SortUrl($pisos_list->id_piso) ?>', 1);"><div id="elh_pisos_id_piso" class="pisos_id_piso">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pisos_list->id_piso->caption() ?></span><span class="ew-table-header-sort"><?php if ($pisos_list->id_piso->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pisos_list->id_piso->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pisos_list->edificio_id->Visible) { // edificio_id ?>
	<?php if ($pisos_list->SortUrl($pisos_list->edificio_id) == "") { ?>
		<th data-name="edificio_id" class="<?php echo $pisos_list->edificio_id->headerCellClass() ?>"><div id="elh_pisos_edificio_id" class="pisos_edificio_id"><div class="ew-table-header-caption"><?php echo $pisos_list->edificio_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="edificio_id" class="<?php echo $pisos_list->edificio_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pisos_list->SortUrl($pisos_list->edificio_id) ?>', 1);"><div id="elh_pisos_edificio_id" class="pisos_edificio_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pisos_list->edificio_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($pisos_list->edificio_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pisos_list->edificio_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pisos_list->nombre->Visible) { // nombre ?>
	<?php if ($pisos_list->SortUrl($pisos_list->nombre) == "") { ?>
		<th data-name="nombre" class="<?php echo $pisos_list->nombre->headerCellClass() ?>"><div id="elh_pisos_nombre" class="pisos_nombre"><div class="ew-table-header-caption"><?php echo $pisos_list->nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre" class="<?php echo $pisos_list->nombre->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pisos_list->SortUrl($pisos_list->nombre) ?>', 1);"><div id="elh_pisos_nombre" class="pisos_nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pisos_list->nombre->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pisos_list->nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pisos_list->nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pisos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($pisos_list->ExportAll && $pisos_list->isExport()) {
	$pisos_list->StopRecord = $pisos_list->TotalRecords;
} else {

	// Set the last record to display
	if ($pisos_list->TotalRecords > $pisos_list->StartRecord + $pisos_list->DisplayRecords - 1)
		$pisos_list->StopRecord = $pisos_list->StartRecord + $pisos_list->DisplayRecords - 1;
	else
		$pisos_list->StopRecord = $pisos_list->TotalRecords;
}
$pisos_list->RecordCount = $pisos_list->StartRecord - 1;
if ($pisos_list->Recordset && !$pisos_list->Recordset->EOF) {
	$pisos_list->Recordset->moveFirst();
	$selectLimit = $pisos_list->UseSelectLimit;
	if (!$selectLimit && $pisos_list->StartRecord > 1)
		$pisos_list->Recordset->move($pisos_list->StartRecord - 1);
} elseif (!$pisos->AllowAddDeleteRow && $pisos_list->StopRecord == 0) {
	$pisos_list->StopRecord = $pisos->GridAddRowCount;
}

// Initialize aggregate
$pisos->RowType = ROWTYPE_AGGREGATEINIT;
$pisos->resetAttributes();
$pisos_list->renderRow();
while ($pisos_list->RecordCount < $pisos_list->StopRecord) {
	$pisos_list->RecordCount++;
	if ($pisos_list->RecordCount >= $pisos_list->StartRecord) {
		$pisos_list->RowCount++;

		// Set up key count
		$pisos_list->KeyCount = $pisos_list->RowIndex;

		// Init row class and style
		$pisos->resetAttributes();
		$pisos->CssClass = "";
		if ($pisos_list->isGridAdd()) {
		} else {
			$pisos_list->loadRowValues($pisos_list->Recordset); // Load row values
		}
		$pisos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$pisos->RowAttrs->merge(["data-rowindex" => $pisos_list->RowCount, "id" => "r" . $pisos_list->RowCount . "_pisos", "data-rowtype" => $pisos->RowType]);

		// Render row
		$pisos_list->renderRow();

		// Render list options
		$pisos_list->renderListOptions();
?>
	<tr <?php echo $pisos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pisos_list->ListOptions->render("body", "left", $pisos_list->RowCount);
?>
	<?php if ($pisos_list->id_piso->Visible) { // id_piso ?>
		<td data-name="id_piso" <?php echo $pisos_list->id_piso->cellAttributes() ?>>
<span id="el<?php echo $pisos_list->RowCount ?>_pisos_id_piso">
<span<?php echo $pisos_list->id_piso->viewAttributes() ?>><?php echo $pisos_list->id_piso->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pisos_list->edificio_id->Visible) { // edificio_id ?>
		<td data-name="edificio_id" <?php echo $pisos_list->edificio_id->cellAttributes() ?>>
<span id="el<?php echo $pisos_list->RowCount ?>_pisos_edificio_id">
<span<?php echo $pisos_list->edificio_id->viewAttributes() ?>><?php echo $pisos_list->edificio_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pisos_list->nombre->Visible) { // nombre ?>
		<td data-name="nombre" <?php echo $pisos_list->nombre->cellAttributes() ?>>
<span id="el<?php echo $pisos_list->RowCount ?>_pisos_nombre">
<span<?php echo $pisos_list->nombre->viewAttributes() ?>><?php echo $pisos_list->nombre->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pisos_list->ListOptions->render("body", "right", $pisos_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$pisos_list->isGridAdd())
		$pisos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$pisos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($pisos_list->Recordset)
	$pisos_list->Recordset->Close();
?>
<?php if (!$pisos_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$pisos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pisos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pisos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($pisos_list->TotalRecords == 0 && !$pisos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $pisos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$pisos_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pisos_list->isExport()) { ?>
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
$pisos_list->terminate();
?>