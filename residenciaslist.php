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
$residencias_list = new residencias_list();

// Run the page
$residencias_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$residencias_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$residencias_list->isExport()) { ?>
<script>
var fresidenciaslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fresidenciaslist = currentForm = new ew.Form("fresidenciaslist", "list");
	fresidenciaslist.formKeyCountName = '<?php echo $residencias_list->FormKeyCountName ?>';
	loadjs.done("fresidenciaslist");
});
var fresidenciaslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fresidenciaslistsrch = currentSearchForm = new ew.Form("fresidenciaslistsrch");

	// Dynamic selection lists
	// Filters

	fresidenciaslistsrch.filterList = <?php echo $residencias_list->getFilterList() ?>;
	loadjs.done("fresidenciaslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$residencias_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($residencias_list->TotalRecords > 0 && $residencias_list->ExportOptions->visible()) { ?>
<?php $residencias_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($residencias_list->ImportOptions->visible()) { ?>
<?php $residencias_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($residencias_list->SearchOptions->visible()) { ?>
<?php $residencias_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($residencias_list->FilterOptions->visible()) { ?>
<?php $residencias_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$residencias_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$residencias_list->isExport() && !$residencias->CurrentAction) { ?>
<form name="fresidenciaslistsrch" id="fresidenciaslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fresidenciaslistsrch-search-panel" class="<?php echo $residencias_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="residencias">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $residencias_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($residencias_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($residencias_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $residencias_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($residencias_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($residencias_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($residencias_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($residencias_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $residencias_list->showPageHeader(); ?>
<?php
$residencias_list->showMessage();
?>
<?php if ($residencias_list->TotalRecords > 0 || $residencias->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($residencias_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> residencias">
<form name="fresidenciaslist" id="fresidenciaslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="residencias">
<div id="gmp_residencias" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($residencias_list->TotalRecords > 0 || $residencias_list->isGridEdit()) { ?>
<table id="tbl_residenciaslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$residencias->RowType = ROWTYPE_HEADER;

// Render list options
$residencias_list->renderListOptions();

// Render list options (header, left)
$residencias_list->ListOptions->render("header", "left");
?>
<?php if ($residencias_list->id_residencia->Visible) { // id_residencia ?>
	<?php if ($residencias_list->SortUrl($residencias_list->id_residencia) == "") { ?>
		<th data-name="id_residencia" class="<?php echo $residencias_list->id_residencia->headerCellClass() ?>"><div id="elh_residencias_id_residencia" class="residencias_id_residencia"><div class="ew-table-header-caption"><?php echo $residencias_list->id_residencia->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_residencia" class="<?php echo $residencias_list->id_residencia->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $residencias_list->SortUrl($residencias_list->id_residencia) ?>', 1);"><div id="elh_residencias_id_residencia" class="residencias_id_residencia">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $residencias_list->id_residencia->caption() ?></span><span class="ew-table-header-sort"><?php if ($residencias_list->id_residencia->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($residencias_list->id_residencia->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($residencias_list->nombre->Visible) { // nombre ?>
	<?php if ($residencias_list->SortUrl($residencias_list->nombre) == "") { ?>
		<th data-name="nombre" class="<?php echo $residencias_list->nombre->headerCellClass() ?>"><div id="elh_residencias_nombre" class="residencias_nombre"><div class="ew-table-header-caption"><?php echo $residencias_list->nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre" class="<?php echo $residencias_list->nombre->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $residencias_list->SortUrl($residencias_list->nombre) ?>', 1);"><div id="elh_residencias_nombre" class="residencias_nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $residencias_list->nombre->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($residencias_list->nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($residencias_list->nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($residencias_list->presidente->Visible) { // presidente ?>
	<?php if ($residencias_list->SortUrl($residencias_list->presidente) == "") { ?>
		<th data-name="presidente" class="<?php echo $residencias_list->presidente->headerCellClass() ?>"><div id="elh_residencias_presidente" class="residencias_presidente"><div class="ew-table-header-caption"><?php echo $residencias_list->presidente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="presidente" class="<?php echo $residencias_list->presidente->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $residencias_list->SortUrl($residencias_list->presidente) ?>', 1);"><div id="elh_residencias_presidente" class="residencias_presidente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $residencias_list->presidente->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($residencias_list->presidente->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($residencias_list->presidente->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($residencias_list->presidente_telefono->Visible) { // presidente_telefono ?>
	<?php if ($residencias_list->SortUrl($residencias_list->presidente_telefono) == "") { ?>
		<th data-name="presidente_telefono" class="<?php echo $residencias_list->presidente_telefono->headerCellClass() ?>"><div id="elh_residencias_presidente_telefono" class="residencias_presidente_telefono"><div class="ew-table-header-caption"><?php echo $residencias_list->presidente_telefono->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="presidente_telefono" class="<?php echo $residencias_list->presidente_telefono->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $residencias_list->SortUrl($residencias_list->presidente_telefono) ?>', 1);"><div id="elh_residencias_presidente_telefono" class="residencias_presidente_telefono">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $residencias_list->presidente_telefono->caption() ?></span><span class="ew-table-header-sort"><?php if ($residencias_list->presidente_telefono->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($residencias_list->presidente_telefono->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($residencias_list->consecutivo_recibo->Visible) { // consecutivo_recibo ?>
	<?php if ($residencias_list->SortUrl($residencias_list->consecutivo_recibo) == "") { ?>
		<th data-name="consecutivo_recibo" class="<?php echo $residencias_list->consecutivo_recibo->headerCellClass() ?>"><div id="elh_residencias_consecutivo_recibo" class="residencias_consecutivo_recibo"><div class="ew-table-header-caption"><?php echo $residencias_list->consecutivo_recibo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="consecutivo_recibo" class="<?php echo $residencias_list->consecutivo_recibo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $residencias_list->SortUrl($residencias_list->consecutivo_recibo) ?>', 1);"><div id="elh_residencias_consecutivo_recibo" class="residencias_consecutivo_recibo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $residencias_list->consecutivo_recibo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($residencias_list->consecutivo_recibo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($residencias_list->consecutivo_recibo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$residencias_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($residencias_list->ExportAll && $residencias_list->isExport()) {
	$residencias_list->StopRecord = $residencias_list->TotalRecords;
} else {

	// Set the last record to display
	if ($residencias_list->TotalRecords > $residencias_list->StartRecord + $residencias_list->DisplayRecords - 1)
		$residencias_list->StopRecord = $residencias_list->StartRecord + $residencias_list->DisplayRecords - 1;
	else
		$residencias_list->StopRecord = $residencias_list->TotalRecords;
}
$residencias_list->RecordCount = $residencias_list->StartRecord - 1;
if ($residencias_list->Recordset && !$residencias_list->Recordset->EOF) {
	$residencias_list->Recordset->moveFirst();
	$selectLimit = $residencias_list->UseSelectLimit;
	if (!$selectLimit && $residencias_list->StartRecord > 1)
		$residencias_list->Recordset->move($residencias_list->StartRecord - 1);
} elseif (!$residencias->AllowAddDeleteRow && $residencias_list->StopRecord == 0) {
	$residencias_list->StopRecord = $residencias->GridAddRowCount;
}

// Initialize aggregate
$residencias->RowType = ROWTYPE_AGGREGATEINIT;
$residencias->resetAttributes();
$residencias_list->renderRow();
while ($residencias_list->RecordCount < $residencias_list->StopRecord) {
	$residencias_list->RecordCount++;
	if ($residencias_list->RecordCount >= $residencias_list->StartRecord) {
		$residencias_list->RowCount++;

		// Set up key count
		$residencias_list->KeyCount = $residencias_list->RowIndex;

		// Init row class and style
		$residencias->resetAttributes();
		$residencias->CssClass = "";
		if ($residencias_list->isGridAdd()) {
		} else {
			$residencias_list->loadRowValues($residencias_list->Recordset); // Load row values
		}
		$residencias->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$residencias->RowAttrs->merge(["data-rowindex" => $residencias_list->RowCount, "id" => "r" . $residencias_list->RowCount . "_residencias", "data-rowtype" => $residencias->RowType]);

		// Render row
		$residencias_list->renderRow();

		// Render list options
		$residencias_list->renderListOptions();
?>
	<tr <?php echo $residencias->rowAttributes() ?>>
<?php

// Render list options (body, left)
$residencias_list->ListOptions->render("body", "left", $residencias_list->RowCount);
?>
	<?php if ($residencias_list->id_residencia->Visible) { // id_residencia ?>
		<td data-name="id_residencia" <?php echo $residencias_list->id_residencia->cellAttributes() ?>>
<span id="el<?php echo $residencias_list->RowCount ?>_residencias_id_residencia">
<span<?php echo $residencias_list->id_residencia->viewAttributes() ?>><?php echo $residencias_list->id_residencia->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($residencias_list->nombre->Visible) { // nombre ?>
		<td data-name="nombre" <?php echo $residencias_list->nombre->cellAttributes() ?>>
<span id="el<?php echo $residencias_list->RowCount ?>_residencias_nombre">
<span<?php echo $residencias_list->nombre->viewAttributes() ?>><?php echo $residencias_list->nombre->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($residencias_list->presidente->Visible) { // presidente ?>
		<td data-name="presidente" <?php echo $residencias_list->presidente->cellAttributes() ?>>
<span id="el<?php echo $residencias_list->RowCount ?>_residencias_presidente">
<span<?php echo $residencias_list->presidente->viewAttributes() ?>><?php echo $residencias_list->presidente->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($residencias_list->presidente_telefono->Visible) { // presidente_telefono ?>
		<td data-name="presidente_telefono" <?php echo $residencias_list->presidente_telefono->cellAttributes() ?>>
<span id="el<?php echo $residencias_list->RowCount ?>_residencias_presidente_telefono">
<span<?php echo $residencias_list->presidente_telefono->viewAttributes() ?>><?php echo $residencias_list->presidente_telefono->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($residencias_list->consecutivo_recibo->Visible) { // consecutivo_recibo ?>
		<td data-name="consecutivo_recibo" <?php echo $residencias_list->consecutivo_recibo->cellAttributes() ?>>
<span id="el<?php echo $residencias_list->RowCount ?>_residencias_consecutivo_recibo">
<span<?php echo $residencias_list->consecutivo_recibo->viewAttributes() ?>><?php echo $residencias_list->consecutivo_recibo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$residencias_list->ListOptions->render("body", "right", $residencias_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$residencias_list->isGridAdd())
		$residencias_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$residencias->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($residencias_list->Recordset)
	$residencias_list->Recordset->Close();
?>
<?php if (!$residencias_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$residencias_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $residencias_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $residencias_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($residencias_list->TotalRecords == 0 && !$residencias->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $residencias_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$residencias_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$residencias_list->isExport()) { ?>
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
$residencias_list->terminate();
?>