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
$tipo_gastos_list = new tipo_gastos_list();

// Run the page
$tipo_gastos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tipo_gastos_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tipo_gastos_list->isExport()) { ?>
<script>
var ftipo_gastoslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftipo_gastoslist = currentForm = new ew.Form("ftipo_gastoslist", "list");
	ftipo_gastoslist.formKeyCountName = '<?php echo $tipo_gastos_list->FormKeyCountName ?>';
	loadjs.done("ftipo_gastoslist");
});
var ftipo_gastoslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftipo_gastoslistsrch = currentSearchForm = new ew.Form("ftipo_gastoslistsrch");

	// Dynamic selection lists
	// Filters

	ftipo_gastoslistsrch.filterList = <?php echo $tipo_gastos_list->getFilterList() ?>;
	loadjs.done("ftipo_gastoslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tipo_gastos_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tipo_gastos_list->TotalRecords > 0 && $tipo_gastos_list->ExportOptions->visible()) { ?>
<?php $tipo_gastos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tipo_gastos_list->ImportOptions->visible()) { ?>
<?php $tipo_gastos_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tipo_gastos_list->SearchOptions->visible()) { ?>
<?php $tipo_gastos_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tipo_gastos_list->FilterOptions->visible()) { ?>
<?php $tipo_gastos_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tipo_gastos_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tipo_gastos_list->isExport() && !$tipo_gastos->CurrentAction) { ?>
<form name="ftipo_gastoslistsrch" id="ftipo_gastoslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftipo_gastoslistsrch-search-panel" class="<?php echo $tipo_gastos_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tipo_gastos">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tipo_gastos_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tipo_gastos_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tipo_gastos_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tipo_gastos_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tipo_gastos_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tipo_gastos_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tipo_gastos_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tipo_gastos_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tipo_gastos_list->showPageHeader(); ?>
<?php
$tipo_gastos_list->showMessage();
?>
<?php if ($tipo_gastos_list->TotalRecords > 0 || $tipo_gastos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tipo_gastos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tipo_gastos">
<form name="ftipo_gastoslist" id="ftipo_gastoslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tipo_gastos">
<div id="gmp_tipo_gastos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tipo_gastos_list->TotalRecords > 0 || $tipo_gastos_list->isGridEdit()) { ?>
<table id="tbl_tipo_gastoslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tipo_gastos->RowType = ROWTYPE_HEADER;

// Render list options
$tipo_gastos_list->renderListOptions();

// Render list options (header, left)
$tipo_gastos_list->ListOptions->render("header", "left");
?>
<?php if ($tipo_gastos_list->id_tipo_gasto->Visible) { // id_tipo_gasto ?>
	<?php if ($tipo_gastos_list->SortUrl($tipo_gastos_list->id_tipo_gasto) == "") { ?>
		<th data-name="id_tipo_gasto" class="<?php echo $tipo_gastos_list->id_tipo_gasto->headerCellClass() ?>"><div id="elh_tipo_gastos_id_tipo_gasto" class="tipo_gastos_id_tipo_gasto"><div class="ew-table-header-caption"><?php echo $tipo_gastos_list->id_tipo_gasto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_tipo_gasto" class="<?php echo $tipo_gastos_list->id_tipo_gasto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tipo_gastos_list->SortUrl($tipo_gastos_list->id_tipo_gasto) ?>', 1);"><div id="elh_tipo_gastos_id_tipo_gasto" class="tipo_gastos_id_tipo_gasto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tipo_gastos_list->id_tipo_gasto->caption() ?></span><span class="ew-table-header-sort"><?php if ($tipo_gastos_list->id_tipo_gasto->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tipo_gastos_list->id_tipo_gasto->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tipo_gastos_list->nombre->Visible) { // nombre ?>
	<?php if ($tipo_gastos_list->SortUrl($tipo_gastos_list->nombre) == "") { ?>
		<th data-name="nombre" class="<?php echo $tipo_gastos_list->nombre->headerCellClass() ?>"><div id="elh_tipo_gastos_nombre" class="tipo_gastos_nombre"><div class="ew-table-header-caption"><?php echo $tipo_gastos_list->nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre" class="<?php echo $tipo_gastos_list->nombre->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tipo_gastos_list->SortUrl($tipo_gastos_list->nombre) ?>', 1);"><div id="elh_tipo_gastos_nombre" class="tipo_gastos_nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tipo_gastos_list->nombre->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tipo_gastos_list->nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tipo_gastos_list->nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tipo_gastos_list->tipo_gasto->Visible) { // tipo_gasto ?>
	<?php if ($tipo_gastos_list->SortUrl($tipo_gastos_list->tipo_gasto) == "") { ?>
		<th data-name="tipo_gasto" class="<?php echo $tipo_gastos_list->tipo_gasto->headerCellClass() ?>"><div id="elh_tipo_gastos_tipo_gasto" class="tipo_gastos_tipo_gasto"><div class="ew-table-header-caption"><?php echo $tipo_gastos_list->tipo_gasto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipo_gasto" class="<?php echo $tipo_gastos_list->tipo_gasto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tipo_gastos_list->SortUrl($tipo_gastos_list->tipo_gasto) ?>', 1);"><div id="elh_tipo_gastos_tipo_gasto" class="tipo_gastos_tipo_gasto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tipo_gastos_list->tipo_gasto->caption() ?></span><span class="ew-table-header-sort"><?php if ($tipo_gastos_list->tipo_gasto->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tipo_gastos_list->tipo_gasto->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tipo_gastos_list->operacion->Visible) { // operacion ?>
	<?php if ($tipo_gastos_list->SortUrl($tipo_gastos_list->operacion) == "") { ?>
		<th data-name="operacion" class="<?php echo $tipo_gastos_list->operacion->headerCellClass() ?>"><div id="elh_tipo_gastos_operacion" class="tipo_gastos_operacion"><div class="ew-table-header-caption"><?php echo $tipo_gastos_list->operacion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="operacion" class="<?php echo $tipo_gastos_list->operacion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tipo_gastos_list->SortUrl($tipo_gastos_list->operacion) ?>', 1);"><div id="elh_tipo_gastos_operacion" class="tipo_gastos_operacion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tipo_gastos_list->operacion->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tipo_gastos_list->operacion->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tipo_gastos_list->operacion->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tipo_gastos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tipo_gastos_list->ExportAll && $tipo_gastos_list->isExport()) {
	$tipo_gastos_list->StopRecord = $tipo_gastos_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tipo_gastos_list->TotalRecords > $tipo_gastos_list->StartRecord + $tipo_gastos_list->DisplayRecords - 1)
		$tipo_gastos_list->StopRecord = $tipo_gastos_list->StartRecord + $tipo_gastos_list->DisplayRecords - 1;
	else
		$tipo_gastos_list->StopRecord = $tipo_gastos_list->TotalRecords;
}
$tipo_gastos_list->RecordCount = $tipo_gastos_list->StartRecord - 1;
if ($tipo_gastos_list->Recordset && !$tipo_gastos_list->Recordset->EOF) {
	$tipo_gastos_list->Recordset->moveFirst();
	$selectLimit = $tipo_gastos_list->UseSelectLimit;
	if (!$selectLimit && $tipo_gastos_list->StartRecord > 1)
		$tipo_gastos_list->Recordset->move($tipo_gastos_list->StartRecord - 1);
} elseif (!$tipo_gastos->AllowAddDeleteRow && $tipo_gastos_list->StopRecord == 0) {
	$tipo_gastos_list->StopRecord = $tipo_gastos->GridAddRowCount;
}

// Initialize aggregate
$tipo_gastos->RowType = ROWTYPE_AGGREGATEINIT;
$tipo_gastos->resetAttributes();
$tipo_gastos_list->renderRow();
while ($tipo_gastos_list->RecordCount < $tipo_gastos_list->StopRecord) {
	$tipo_gastos_list->RecordCount++;
	if ($tipo_gastos_list->RecordCount >= $tipo_gastos_list->StartRecord) {
		$tipo_gastos_list->RowCount++;

		// Set up key count
		$tipo_gastos_list->KeyCount = $tipo_gastos_list->RowIndex;

		// Init row class and style
		$tipo_gastos->resetAttributes();
		$tipo_gastos->CssClass = "";
		if ($tipo_gastos_list->isGridAdd()) {
		} else {
			$tipo_gastos_list->loadRowValues($tipo_gastos_list->Recordset); // Load row values
		}
		$tipo_gastos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tipo_gastos->RowAttrs->merge(["data-rowindex" => $tipo_gastos_list->RowCount, "id" => "r" . $tipo_gastos_list->RowCount . "_tipo_gastos", "data-rowtype" => $tipo_gastos->RowType]);

		// Render row
		$tipo_gastos_list->renderRow();

		// Render list options
		$tipo_gastos_list->renderListOptions();
?>
	<tr <?php echo $tipo_gastos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tipo_gastos_list->ListOptions->render("body", "left", $tipo_gastos_list->RowCount);
?>
	<?php if ($tipo_gastos_list->id_tipo_gasto->Visible) { // id_tipo_gasto ?>
		<td data-name="id_tipo_gasto" <?php echo $tipo_gastos_list->id_tipo_gasto->cellAttributes() ?>>
<span id="el<?php echo $tipo_gastos_list->RowCount ?>_tipo_gastos_id_tipo_gasto">
<span<?php echo $tipo_gastos_list->id_tipo_gasto->viewAttributes() ?>><?php echo $tipo_gastos_list->id_tipo_gasto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tipo_gastos_list->nombre->Visible) { // nombre ?>
		<td data-name="nombre" <?php echo $tipo_gastos_list->nombre->cellAttributes() ?>>
<span id="el<?php echo $tipo_gastos_list->RowCount ?>_tipo_gastos_nombre">
<span<?php echo $tipo_gastos_list->nombre->viewAttributes() ?>><?php echo $tipo_gastos_list->nombre->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tipo_gastos_list->tipo_gasto->Visible) { // tipo_gasto ?>
		<td data-name="tipo_gasto" <?php echo $tipo_gastos_list->tipo_gasto->cellAttributes() ?>>
<span id="el<?php echo $tipo_gastos_list->RowCount ?>_tipo_gastos_tipo_gasto">
<span<?php echo $tipo_gastos_list->tipo_gasto->viewAttributes() ?>><?php echo $tipo_gastos_list->tipo_gasto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tipo_gastos_list->operacion->Visible) { // operacion ?>
		<td data-name="operacion" <?php echo $tipo_gastos_list->operacion->cellAttributes() ?>>
<span id="el<?php echo $tipo_gastos_list->RowCount ?>_tipo_gastos_operacion">
<span<?php echo $tipo_gastos_list->operacion->viewAttributes() ?>><?php echo $tipo_gastos_list->operacion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tipo_gastos_list->ListOptions->render("body", "right", $tipo_gastos_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tipo_gastos_list->isGridAdd())
		$tipo_gastos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tipo_gastos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tipo_gastos_list->Recordset)
	$tipo_gastos_list->Recordset->Close();
?>
<?php if (!$tipo_gastos_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tipo_gastos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tipo_gastos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tipo_gastos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tipo_gastos_list->TotalRecords == 0 && !$tipo_gastos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tipo_gastos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tipo_gastos_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tipo_gastos_list->isExport()) { ?>
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
$tipo_gastos_list->terminate();
?>