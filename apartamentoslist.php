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
$apartamentos_list = new apartamentos_list();

// Run the page
$apartamentos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$apartamentos_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$apartamentos_list->isExport()) { ?>
<script>
var fapartamentoslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fapartamentoslist = currentForm = new ew.Form("fapartamentoslist", "list");
	fapartamentoslist.formKeyCountName = '<?php echo $apartamentos_list->FormKeyCountName ?>';
	loadjs.done("fapartamentoslist");
});
var fapartamentoslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fapartamentoslistsrch = currentSearchForm = new ew.Form("fapartamentoslistsrch");

	// Dynamic selection lists
	// Filters

	fapartamentoslistsrch.filterList = <?php echo $apartamentos_list->getFilterList() ?>;
	loadjs.done("fapartamentoslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$apartamentos_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($apartamentos_list->TotalRecords > 0 && $apartamentos_list->ExportOptions->visible()) { ?>
<?php $apartamentos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($apartamentos_list->ImportOptions->visible()) { ?>
<?php $apartamentos_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($apartamentos_list->SearchOptions->visible()) { ?>
<?php $apartamentos_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($apartamentos_list->FilterOptions->visible()) { ?>
<?php $apartamentos_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$apartamentos_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$apartamentos_list->isExport() && !$apartamentos->CurrentAction) { ?>
<form name="fapartamentoslistsrch" id="fapartamentoslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fapartamentoslistsrch-search-panel" class="<?php echo $apartamentos_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="apartamentos">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $apartamentos_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($apartamentos_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($apartamentos_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $apartamentos_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($apartamentos_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($apartamentos_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($apartamentos_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($apartamentos_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $apartamentos_list->showPageHeader(); ?>
<?php
$apartamentos_list->showMessage();
?>
<?php if ($apartamentos_list->TotalRecords > 0 || $apartamentos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($apartamentos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> apartamentos">
<form name="fapartamentoslist" id="fapartamentoslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="apartamentos">
<div id="gmp_apartamentos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($apartamentos_list->TotalRecords > 0 || $apartamentos_list->isGridEdit()) { ?>
<table id="tbl_apartamentoslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$apartamentos->RowType = ROWTYPE_HEADER;

// Render list options
$apartamentos_list->renderListOptions();

// Render list options (header, left)
$apartamentos_list->ListOptions->render("header", "left");
?>
<?php if ($apartamentos_list->id_apartamento->Visible) { // id_apartamento ?>
	<?php if ($apartamentos_list->SortUrl($apartamentos_list->id_apartamento) == "") { ?>
		<th data-name="id_apartamento" class="<?php echo $apartamentos_list->id_apartamento->headerCellClass() ?>"><div id="elh_apartamentos_id_apartamento" class="apartamentos_id_apartamento"><div class="ew-table-header-caption"><?php echo $apartamentos_list->id_apartamento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_apartamento" class="<?php echo $apartamentos_list->id_apartamento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $apartamentos_list->SortUrl($apartamentos_list->id_apartamento) ?>', 1);"><div id="elh_apartamentos_id_apartamento" class="apartamentos_id_apartamento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $apartamentos_list->id_apartamento->caption() ?></span><span class="ew-table-header-sort"><?php if ($apartamentos_list->id_apartamento->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($apartamentos_list->id_apartamento->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($apartamentos_list->propietario_id->Visible) { // propietario_id ?>
	<?php if ($apartamentos_list->SortUrl($apartamentos_list->propietario_id) == "") { ?>
		<th data-name="propietario_id" class="<?php echo $apartamentos_list->propietario_id->headerCellClass() ?>"><div id="elh_apartamentos_propietario_id" class="apartamentos_propietario_id"><div class="ew-table-header-caption"><?php echo $apartamentos_list->propietario_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="propietario_id" class="<?php echo $apartamentos_list->propietario_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $apartamentos_list->SortUrl($apartamentos_list->propietario_id) ?>', 1);"><div id="elh_apartamentos_propietario_id" class="apartamentos_propietario_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $apartamentos_list->propietario_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($apartamentos_list->propietario_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($apartamentos_list->propietario_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($apartamentos_list->piso_id->Visible) { // piso_id ?>
	<?php if ($apartamentos_list->SortUrl($apartamentos_list->piso_id) == "") { ?>
		<th data-name="piso_id" class="<?php echo $apartamentos_list->piso_id->headerCellClass() ?>"><div id="elh_apartamentos_piso_id" class="apartamentos_piso_id"><div class="ew-table-header-caption"><?php echo $apartamentos_list->piso_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="piso_id" class="<?php echo $apartamentos_list->piso_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $apartamentos_list->SortUrl($apartamentos_list->piso_id) ?>', 1);"><div id="elh_apartamentos_piso_id" class="apartamentos_piso_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $apartamentos_list->piso_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($apartamentos_list->piso_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($apartamentos_list->piso_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($apartamentos_list->metros_cuadrados->Visible) { // metros_cuadrados ?>
	<?php if ($apartamentos_list->SortUrl($apartamentos_list->metros_cuadrados) == "") { ?>
		<th data-name="metros_cuadrados" class="<?php echo $apartamentos_list->metros_cuadrados->headerCellClass() ?>"><div id="elh_apartamentos_metros_cuadrados" class="apartamentos_metros_cuadrados"><div class="ew-table-header-caption"><?php echo $apartamentos_list->metros_cuadrados->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="metros_cuadrados" class="<?php echo $apartamentos_list->metros_cuadrados->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $apartamentos_list->SortUrl($apartamentos_list->metros_cuadrados) ?>', 1);"><div id="elh_apartamentos_metros_cuadrados" class="apartamentos_metros_cuadrados">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $apartamentos_list->metros_cuadrados->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($apartamentos_list->metros_cuadrados->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($apartamentos_list->metros_cuadrados->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($apartamentos_list->nombre_numero->Visible) { // nombre_numero ?>
	<?php if ($apartamentos_list->SortUrl($apartamentos_list->nombre_numero) == "") { ?>
		<th data-name="nombre_numero" class="<?php echo $apartamentos_list->nombre_numero->headerCellClass() ?>"><div id="elh_apartamentos_nombre_numero" class="apartamentos_nombre_numero"><div class="ew-table-header-caption"><?php echo $apartamentos_list->nombre_numero->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre_numero" class="<?php echo $apartamentos_list->nombre_numero->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $apartamentos_list->SortUrl($apartamentos_list->nombre_numero) ?>', 1);"><div id="elh_apartamentos_nombre_numero" class="apartamentos_nombre_numero">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $apartamentos_list->nombre_numero->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($apartamentos_list->nombre_numero->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($apartamentos_list->nombre_numero->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($apartamentos_list->alicuota->Visible) { // alicuota ?>
	<?php if ($apartamentos_list->SortUrl($apartamentos_list->alicuota) == "") { ?>
		<th data-name="alicuota" class="<?php echo $apartamentos_list->alicuota->headerCellClass() ?>"><div id="elh_apartamentos_alicuota" class="apartamentos_alicuota"><div class="ew-table-header-caption"><?php echo $apartamentos_list->alicuota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="alicuota" class="<?php echo $apartamentos_list->alicuota->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $apartamentos_list->SortUrl($apartamentos_list->alicuota) ?>', 1);"><div id="elh_apartamentos_alicuota" class="apartamentos_alicuota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $apartamentos_list->alicuota->caption() ?></span><span class="ew-table-header-sort"><?php if ($apartamentos_list->alicuota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($apartamentos_list->alicuota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$apartamentos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($apartamentos_list->ExportAll && $apartamentos_list->isExport()) {
	$apartamentos_list->StopRecord = $apartamentos_list->TotalRecords;
} else {

	// Set the last record to display
	if ($apartamentos_list->TotalRecords > $apartamentos_list->StartRecord + $apartamentos_list->DisplayRecords - 1)
		$apartamentos_list->StopRecord = $apartamentos_list->StartRecord + $apartamentos_list->DisplayRecords - 1;
	else
		$apartamentos_list->StopRecord = $apartamentos_list->TotalRecords;
}
$apartamentos_list->RecordCount = $apartamentos_list->StartRecord - 1;
if ($apartamentos_list->Recordset && !$apartamentos_list->Recordset->EOF) {
	$apartamentos_list->Recordset->moveFirst();
	$selectLimit = $apartamentos_list->UseSelectLimit;
	if (!$selectLimit && $apartamentos_list->StartRecord > 1)
		$apartamentos_list->Recordset->move($apartamentos_list->StartRecord - 1);
} elseif (!$apartamentos->AllowAddDeleteRow && $apartamentos_list->StopRecord == 0) {
	$apartamentos_list->StopRecord = $apartamentos->GridAddRowCount;
}

// Initialize aggregate
$apartamentos->RowType = ROWTYPE_AGGREGATEINIT;
$apartamentos->resetAttributes();
$apartamentos_list->renderRow();
while ($apartamentos_list->RecordCount < $apartamentos_list->StopRecord) {
	$apartamentos_list->RecordCount++;
	if ($apartamentos_list->RecordCount >= $apartamentos_list->StartRecord) {
		$apartamentos_list->RowCount++;

		// Set up key count
		$apartamentos_list->KeyCount = $apartamentos_list->RowIndex;

		// Init row class and style
		$apartamentos->resetAttributes();
		$apartamentos->CssClass = "";
		if ($apartamentos_list->isGridAdd()) {
		} else {
			$apartamentos_list->loadRowValues($apartamentos_list->Recordset); // Load row values
		}
		$apartamentos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$apartamentos->RowAttrs->merge(["data-rowindex" => $apartamentos_list->RowCount, "id" => "r" . $apartamentos_list->RowCount . "_apartamentos", "data-rowtype" => $apartamentos->RowType]);

		// Render row
		$apartamentos_list->renderRow();

		// Render list options
		$apartamentos_list->renderListOptions();
?>
	<tr <?php echo $apartamentos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$apartamentos_list->ListOptions->render("body", "left", $apartamentos_list->RowCount);
?>
	<?php if ($apartamentos_list->id_apartamento->Visible) { // id_apartamento ?>
		<td data-name="id_apartamento" <?php echo $apartamentos_list->id_apartamento->cellAttributes() ?>>
<span id="el<?php echo $apartamentos_list->RowCount ?>_apartamentos_id_apartamento">
<span<?php echo $apartamentos_list->id_apartamento->viewAttributes() ?>><?php echo $apartamentos_list->id_apartamento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($apartamentos_list->propietario_id->Visible) { // propietario_id ?>
		<td data-name="propietario_id" <?php echo $apartamentos_list->propietario_id->cellAttributes() ?>>
<span id="el<?php echo $apartamentos_list->RowCount ?>_apartamentos_propietario_id">
<span<?php echo $apartamentos_list->propietario_id->viewAttributes() ?>><?php echo $apartamentos_list->propietario_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($apartamentos_list->piso_id->Visible) { // piso_id ?>
		<td data-name="piso_id" <?php echo $apartamentos_list->piso_id->cellAttributes() ?>>
<span id="el<?php echo $apartamentos_list->RowCount ?>_apartamentos_piso_id">
<span<?php echo $apartamentos_list->piso_id->viewAttributes() ?>><?php echo $apartamentos_list->piso_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($apartamentos_list->metros_cuadrados->Visible) { // metros_cuadrados ?>
		<td data-name="metros_cuadrados" <?php echo $apartamentos_list->metros_cuadrados->cellAttributes() ?>>
<span id="el<?php echo $apartamentos_list->RowCount ?>_apartamentos_metros_cuadrados">
<span<?php echo $apartamentos_list->metros_cuadrados->viewAttributes() ?>><?php echo $apartamentos_list->metros_cuadrados->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($apartamentos_list->nombre_numero->Visible) { // nombre_numero ?>
		<td data-name="nombre_numero" <?php echo $apartamentos_list->nombre_numero->cellAttributes() ?>>
<span id="el<?php echo $apartamentos_list->RowCount ?>_apartamentos_nombre_numero">
<span<?php echo $apartamentos_list->nombre_numero->viewAttributes() ?>><?php echo $apartamentos_list->nombre_numero->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($apartamentos_list->alicuota->Visible) { // alicuota ?>
		<td data-name="alicuota" <?php echo $apartamentos_list->alicuota->cellAttributes() ?>>
<span id="el<?php echo $apartamentos_list->RowCount ?>_apartamentos_alicuota">
<span<?php echo $apartamentos_list->alicuota->viewAttributes() ?>><?php echo $apartamentos_list->alicuota->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$apartamentos_list->ListOptions->render("body", "right", $apartamentos_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$apartamentos_list->isGridAdd())
		$apartamentos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$apartamentos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($apartamentos_list->Recordset)
	$apartamentos_list->Recordset->Close();
?>
<?php if (!$apartamentos_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$apartamentos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $apartamentos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $apartamentos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($apartamentos_list->TotalRecords == 0 && !$apartamentos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $apartamentos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$apartamentos_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$apartamentos_list->isExport()) { ?>
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
$apartamentos_list->terminate();
?>