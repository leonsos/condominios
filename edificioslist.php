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
$edificios_list = new edificios_list();

// Run the page
$edificios_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$edificios_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$edificios_list->isExport()) { ?>
<script>
var fedificioslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fedificioslist = currentForm = new ew.Form("fedificioslist", "list");
	fedificioslist.formKeyCountName = '<?php echo $edificios_list->FormKeyCountName ?>';
	loadjs.done("fedificioslist");
});
var fedificioslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fedificioslistsrch = currentSearchForm = new ew.Form("fedificioslistsrch");

	// Dynamic selection lists
	// Filters

	fedificioslistsrch.filterList = <?php echo $edificios_list->getFilterList() ?>;
	loadjs.done("fedificioslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$edificios_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($edificios_list->TotalRecords > 0 && $edificios_list->ExportOptions->visible()) { ?>
<?php $edificios_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($edificios_list->ImportOptions->visible()) { ?>
<?php $edificios_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($edificios_list->SearchOptions->visible()) { ?>
<?php $edificios_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($edificios_list->FilterOptions->visible()) { ?>
<?php $edificios_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$edificios_list->isExport() || Config("EXPORT_MASTER_RECORD") && $edificios_list->isExport("print")) { ?>
<?php
if ($edificios_list->DbMasterFilter != "" && $edificios->getCurrentMasterTable() == "residencias") {
	if ($edificios_list->MasterRecordExists) {
		include_once "residenciasmaster.php";
	}
}
?>
<?php } ?>
<?php
$edificios_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$edificios_list->isExport() && !$edificios->CurrentAction) { ?>
<form name="fedificioslistsrch" id="fedificioslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fedificioslistsrch-search-panel" class="<?php echo $edificios_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="edificios">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $edificios_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($edificios_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($edificios_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $edificios_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($edificios_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($edificios_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($edificios_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($edificios_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $edificios_list->showPageHeader(); ?>
<?php
$edificios_list->showMessage();
?>
<?php if ($edificios_list->TotalRecords > 0 || $edificios->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($edificios_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> edificios">
<form name="fedificioslist" id="fedificioslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="edificios">
<?php if ($edificios->getCurrentMasterTable() == "residencias" && $edificios->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="residencias">
<input type="hidden" name="fk_id_residencia" value="<?php echo $edificios_list->residencia_id->getSessionValue() ?>">
<?php } ?>
<div id="gmp_edificios" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($edificios_list->TotalRecords > 0 || $edificios_list->isGridEdit()) { ?>
<table id="tbl_edificioslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$edificios->RowType = ROWTYPE_HEADER;

// Render list options
$edificios_list->renderListOptions();

// Render list options (header, left)
$edificios_list->ListOptions->render("header", "left");
?>
<?php if ($edificios_list->id_edificio->Visible) { // id_edificio ?>
	<?php if ($edificios_list->SortUrl($edificios_list->id_edificio) == "") { ?>
		<th data-name="id_edificio" class="<?php echo $edificios_list->id_edificio->headerCellClass() ?>"><div id="elh_edificios_id_edificio" class="edificios_id_edificio"><div class="ew-table-header-caption"><?php echo $edificios_list->id_edificio->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_edificio" class="<?php echo $edificios_list->id_edificio->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $edificios_list->SortUrl($edificios_list->id_edificio) ?>', 1);"><div id="elh_edificios_id_edificio" class="edificios_id_edificio">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $edificios_list->id_edificio->caption() ?></span><span class="ew-table-header-sort"><?php if ($edificios_list->id_edificio->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($edificios_list->id_edificio->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($edificios_list->residencia_id->Visible) { // residencia_id ?>
	<?php if ($edificios_list->SortUrl($edificios_list->residencia_id) == "") { ?>
		<th data-name="residencia_id" class="<?php echo $edificios_list->residencia_id->headerCellClass() ?>"><div id="elh_edificios_residencia_id" class="edificios_residencia_id"><div class="ew-table-header-caption"><?php echo $edificios_list->residencia_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="residencia_id" class="<?php echo $edificios_list->residencia_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $edificios_list->SortUrl($edificios_list->residencia_id) ?>', 1);"><div id="elh_edificios_residencia_id" class="edificios_residencia_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $edificios_list->residencia_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($edificios_list->residencia_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($edificios_list->residencia_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($edificios_list->nombre->Visible) { // nombre ?>
	<?php if ($edificios_list->SortUrl($edificios_list->nombre) == "") { ?>
		<th data-name="nombre" class="<?php echo $edificios_list->nombre->headerCellClass() ?>"><div id="elh_edificios_nombre" class="edificios_nombre"><div class="ew-table-header-caption"><?php echo $edificios_list->nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre" class="<?php echo $edificios_list->nombre->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $edificios_list->SortUrl($edificios_list->nombre) ?>', 1);"><div id="elh_edificios_nombre" class="edificios_nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $edificios_list->nombre->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($edificios_list->nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($edificios_list->nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$edificios_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($edificios_list->ExportAll && $edificios_list->isExport()) {
	$edificios_list->StopRecord = $edificios_list->TotalRecords;
} else {

	// Set the last record to display
	if ($edificios_list->TotalRecords > $edificios_list->StartRecord + $edificios_list->DisplayRecords - 1)
		$edificios_list->StopRecord = $edificios_list->StartRecord + $edificios_list->DisplayRecords - 1;
	else
		$edificios_list->StopRecord = $edificios_list->TotalRecords;
}
$edificios_list->RecordCount = $edificios_list->StartRecord - 1;
if ($edificios_list->Recordset && !$edificios_list->Recordset->EOF) {
	$edificios_list->Recordset->moveFirst();
	$selectLimit = $edificios_list->UseSelectLimit;
	if (!$selectLimit && $edificios_list->StartRecord > 1)
		$edificios_list->Recordset->move($edificios_list->StartRecord - 1);
} elseif (!$edificios->AllowAddDeleteRow && $edificios_list->StopRecord == 0) {
	$edificios_list->StopRecord = $edificios->GridAddRowCount;
}

// Initialize aggregate
$edificios->RowType = ROWTYPE_AGGREGATEINIT;
$edificios->resetAttributes();
$edificios_list->renderRow();
while ($edificios_list->RecordCount < $edificios_list->StopRecord) {
	$edificios_list->RecordCount++;
	if ($edificios_list->RecordCount >= $edificios_list->StartRecord) {
		$edificios_list->RowCount++;

		// Set up key count
		$edificios_list->KeyCount = $edificios_list->RowIndex;

		// Init row class and style
		$edificios->resetAttributes();
		$edificios->CssClass = "";
		if ($edificios_list->isGridAdd()) {
		} else {
			$edificios_list->loadRowValues($edificios_list->Recordset); // Load row values
		}
		$edificios->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$edificios->RowAttrs->merge(["data-rowindex" => $edificios_list->RowCount, "id" => "r" . $edificios_list->RowCount . "_edificios", "data-rowtype" => $edificios->RowType]);

		// Render row
		$edificios_list->renderRow();

		// Render list options
		$edificios_list->renderListOptions();
?>
	<tr <?php echo $edificios->rowAttributes() ?>>
<?php

// Render list options (body, left)
$edificios_list->ListOptions->render("body", "left", $edificios_list->RowCount);
?>
	<?php if ($edificios_list->id_edificio->Visible) { // id_edificio ?>
		<td data-name="id_edificio" <?php echo $edificios_list->id_edificio->cellAttributes() ?>>
<span id="el<?php echo $edificios_list->RowCount ?>_edificios_id_edificio">
<span<?php echo $edificios_list->id_edificio->viewAttributes() ?>><?php echo $edificios_list->id_edificio->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($edificios_list->residencia_id->Visible) { // residencia_id ?>
		<td data-name="residencia_id" <?php echo $edificios_list->residencia_id->cellAttributes() ?>>
<span id="el<?php echo $edificios_list->RowCount ?>_edificios_residencia_id">
<span<?php echo $edificios_list->residencia_id->viewAttributes() ?>><?php echo $edificios_list->residencia_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($edificios_list->nombre->Visible) { // nombre ?>
		<td data-name="nombre" <?php echo $edificios_list->nombre->cellAttributes() ?>>
<span id="el<?php echo $edificios_list->RowCount ?>_edificios_nombre">
<span<?php echo $edificios_list->nombre->viewAttributes() ?>><?php echo $edificios_list->nombre->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$edificios_list->ListOptions->render("body", "right", $edificios_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$edificios_list->isGridAdd())
		$edificios_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$edificios->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($edificios_list->Recordset)
	$edificios_list->Recordset->Close();
?>
<?php if (!$edificios_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$edificios_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $edificios_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $edificios_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($edificios_list->TotalRecords == 0 && !$edificios->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $edificios_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$edificios_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$edificios_list->isExport()) { ?>
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
$edificios_list->terminate();
?>