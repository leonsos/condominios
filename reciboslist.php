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
$recibos_list = new recibos_list();

// Run the page
$recibos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$recibos_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$recibos_list->isExport()) { ?>
<script>
var freciboslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	freciboslist = currentForm = new ew.Form("freciboslist", "list");
	freciboslist.formKeyCountName = '<?php echo $recibos_list->FormKeyCountName ?>';
	loadjs.done("freciboslist");
});
var freciboslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	freciboslistsrch = currentSearchForm = new ew.Form("freciboslistsrch");

	// Dynamic selection lists
	// Filters

	freciboslistsrch.filterList = <?php echo $recibos_list->getFilterList() ?>;
	loadjs.done("freciboslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$recibos_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($recibos_list->TotalRecords > 0 && $recibos_list->ExportOptions->visible()) { ?>
<?php $recibos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($recibos_list->ImportOptions->visible()) { ?>
<?php $recibos_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($recibos_list->SearchOptions->visible()) { ?>
<?php $recibos_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($recibos_list->FilterOptions->visible()) { ?>
<?php $recibos_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$recibos_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$recibos_list->isExport() && !$recibos->CurrentAction) { ?>
<form name="freciboslistsrch" id="freciboslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="freciboslistsrch-search-panel" class="<?php echo $recibos_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="recibos">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $recibos_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($recibos_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($recibos_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $recibos_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($recibos_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($recibos_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($recibos_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($recibos_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $recibos_list->showPageHeader(); ?>
<?php
$recibos_list->showMessage();
?>
<?php if ($recibos_list->TotalRecords > 0 || $recibos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($recibos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> recibos">
<form name="freciboslist" id="freciboslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="recibos">
<div id="gmp_recibos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($recibos_list->TotalRecords > 0 || $recibos_list->isGridEdit()) { ?>
<table id="tbl_reciboslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$recibos->RowType = ROWTYPE_HEADER;

// Render list options
$recibos_list->renderListOptions();

// Render list options (header, left)
$recibos_list->ListOptions->render("header", "left");
?>
<?php if ($recibos_list->id_recibo->Visible) { // id_recibo ?>
	<?php if ($recibos_list->SortUrl($recibos_list->id_recibo) == "") { ?>
		<th data-name="id_recibo" class="<?php echo $recibos_list->id_recibo->headerCellClass() ?>"><div id="elh_recibos_id_recibo" class="recibos_id_recibo"><div class="ew-table-header-caption"><?php echo $recibos_list->id_recibo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_recibo" class="<?php echo $recibos_list->id_recibo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $recibos_list->SortUrl($recibos_list->id_recibo) ?>', 1);"><div id="elh_recibos_id_recibo" class="recibos_id_recibo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $recibos_list->id_recibo->caption() ?></span><span class="ew-table-header-sort"><?php if ($recibos_list->id_recibo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($recibos_list->id_recibo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($recibos_list->condo_mensual_id->Visible) { // condo_mensual_id ?>
	<?php if ($recibos_list->SortUrl($recibos_list->condo_mensual_id) == "") { ?>
		<th data-name="condo_mensual_id" class="<?php echo $recibos_list->condo_mensual_id->headerCellClass() ?>"><div id="elh_recibos_condo_mensual_id" class="recibos_condo_mensual_id"><div class="ew-table-header-caption"><?php echo $recibos_list->condo_mensual_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="condo_mensual_id" class="<?php echo $recibos_list->condo_mensual_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $recibos_list->SortUrl($recibos_list->condo_mensual_id) ?>', 1);"><div id="elh_recibos_condo_mensual_id" class="recibos_condo_mensual_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $recibos_list->condo_mensual_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($recibos_list->condo_mensual_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($recibos_list->condo_mensual_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($recibos_list->apartamento_id->Visible) { // apartamento_id ?>
	<?php if ($recibos_list->SortUrl($recibos_list->apartamento_id) == "") { ?>
		<th data-name="apartamento_id" class="<?php echo $recibos_list->apartamento_id->headerCellClass() ?>"><div id="elh_recibos_apartamento_id" class="recibos_apartamento_id"><div class="ew-table-header-caption"><?php echo $recibos_list->apartamento_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="apartamento_id" class="<?php echo $recibos_list->apartamento_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $recibos_list->SortUrl($recibos_list->apartamento_id) ?>', 1);"><div id="elh_recibos_apartamento_id" class="recibos_apartamento_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $recibos_list->apartamento_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($recibos_list->apartamento_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($recibos_list->apartamento_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($recibos_list->n_recibo->Visible) { // n_recibo ?>
	<?php if ($recibos_list->SortUrl($recibos_list->n_recibo) == "") { ?>
		<th data-name="n_recibo" class="<?php echo $recibos_list->n_recibo->headerCellClass() ?>"><div id="elh_recibos_n_recibo" class="recibos_n_recibo"><div class="ew-table-header-caption"><?php echo $recibos_list->n_recibo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="n_recibo" class="<?php echo $recibos_list->n_recibo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $recibos_list->SortUrl($recibos_list->n_recibo) ?>', 1);"><div id="elh_recibos_n_recibo" class="recibos_n_recibo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $recibos_list->n_recibo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($recibos_list->n_recibo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($recibos_list->n_recibo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($recibos_list->monto_pagar->Visible) { // monto_pagar ?>
	<?php if ($recibos_list->SortUrl($recibos_list->monto_pagar) == "") { ?>
		<th data-name="monto_pagar" class="<?php echo $recibos_list->monto_pagar->headerCellClass() ?>"><div id="elh_recibos_monto_pagar" class="recibos_monto_pagar"><div class="ew-table-header-caption"><?php echo $recibos_list->monto_pagar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto_pagar" class="<?php echo $recibos_list->monto_pagar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $recibos_list->SortUrl($recibos_list->monto_pagar) ?>', 1);"><div id="elh_recibos_monto_pagar" class="recibos_monto_pagar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $recibos_list->monto_pagar->caption() ?></span><span class="ew-table-header-sort"><?php if ($recibos_list->monto_pagar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($recibos_list->monto_pagar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($recibos_list->monto_ind->Visible) { // monto_ind ?>
	<?php if ($recibos_list->SortUrl($recibos_list->monto_ind) == "") { ?>
		<th data-name="monto_ind" class="<?php echo $recibos_list->monto_ind->headerCellClass() ?>"><div id="elh_recibos_monto_ind" class="recibos_monto_ind"><div class="ew-table-header-caption"><?php echo $recibos_list->monto_ind->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto_ind" class="<?php echo $recibos_list->monto_ind->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $recibos_list->SortUrl($recibos_list->monto_ind) ?>', 1);"><div id="elh_recibos_monto_ind" class="recibos_monto_ind">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $recibos_list->monto_ind->caption() ?></span><span class="ew-table-header-sort"><?php if ($recibos_list->monto_ind->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($recibos_list->monto_ind->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($recibos_list->monto_alicuota->Visible) { // monto_alicuota ?>
	<?php if ($recibos_list->SortUrl($recibos_list->monto_alicuota) == "") { ?>
		<th data-name="monto_alicuota" class="<?php echo $recibos_list->monto_alicuota->headerCellClass() ?>"><div id="elh_recibos_monto_alicuota" class="recibos_monto_alicuota"><div class="ew-table-header-caption"><?php echo $recibos_list->monto_alicuota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto_alicuota" class="<?php echo $recibos_list->monto_alicuota->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $recibos_list->SortUrl($recibos_list->monto_alicuota) ?>', 1);"><div id="elh_recibos_monto_alicuota" class="recibos_monto_alicuota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $recibos_list->monto_alicuota->caption() ?></span><span class="ew-table-header-sort"><?php if ($recibos_list->monto_alicuota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($recibos_list->monto_alicuota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$recibos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($recibos_list->ExportAll && $recibos_list->isExport()) {
	$recibos_list->StopRecord = $recibos_list->TotalRecords;
} else {

	// Set the last record to display
	if ($recibos_list->TotalRecords > $recibos_list->StartRecord + $recibos_list->DisplayRecords - 1)
		$recibos_list->StopRecord = $recibos_list->StartRecord + $recibos_list->DisplayRecords - 1;
	else
		$recibos_list->StopRecord = $recibos_list->TotalRecords;
}
$recibos_list->RecordCount = $recibos_list->StartRecord - 1;
if ($recibos_list->Recordset && !$recibos_list->Recordset->EOF) {
	$recibos_list->Recordset->moveFirst();
	$selectLimit = $recibos_list->UseSelectLimit;
	if (!$selectLimit && $recibos_list->StartRecord > 1)
		$recibos_list->Recordset->move($recibos_list->StartRecord - 1);
} elseif (!$recibos->AllowAddDeleteRow && $recibos_list->StopRecord == 0) {
	$recibos_list->StopRecord = $recibos->GridAddRowCount;
}

// Initialize aggregate
$recibos->RowType = ROWTYPE_AGGREGATEINIT;
$recibos->resetAttributes();
$recibos_list->renderRow();
while ($recibos_list->RecordCount < $recibos_list->StopRecord) {
	$recibos_list->RecordCount++;
	if ($recibos_list->RecordCount >= $recibos_list->StartRecord) {
		$recibos_list->RowCount++;

		// Set up key count
		$recibos_list->KeyCount = $recibos_list->RowIndex;

		// Init row class and style
		$recibos->resetAttributes();
		$recibos->CssClass = "";
		if ($recibos_list->isGridAdd()) {
		} else {
			$recibos_list->loadRowValues($recibos_list->Recordset); // Load row values
		}
		$recibos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$recibos->RowAttrs->merge(["data-rowindex" => $recibos_list->RowCount, "id" => "r" . $recibos_list->RowCount . "_recibos", "data-rowtype" => $recibos->RowType]);

		// Render row
		$recibos_list->renderRow();

		// Render list options
		$recibos_list->renderListOptions();
?>
	<tr <?php echo $recibos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$recibos_list->ListOptions->render("body", "left", $recibos_list->RowCount);
?>
	<?php if ($recibos_list->id_recibo->Visible) { // id_recibo ?>
		<td data-name="id_recibo" <?php echo $recibos_list->id_recibo->cellAttributes() ?>>
<span id="el<?php echo $recibos_list->RowCount ?>_recibos_id_recibo">
<span<?php echo $recibos_list->id_recibo->viewAttributes() ?>><?php echo $recibos_list->id_recibo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($recibos_list->condo_mensual_id->Visible) { // condo_mensual_id ?>
		<td data-name="condo_mensual_id" <?php echo $recibos_list->condo_mensual_id->cellAttributes() ?>>
<span id="el<?php echo $recibos_list->RowCount ?>_recibos_condo_mensual_id">
<span<?php echo $recibos_list->condo_mensual_id->viewAttributes() ?>><?php echo $recibos_list->condo_mensual_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($recibos_list->apartamento_id->Visible) { // apartamento_id ?>
		<td data-name="apartamento_id" <?php echo $recibos_list->apartamento_id->cellAttributes() ?>>
<span id="el<?php echo $recibos_list->RowCount ?>_recibos_apartamento_id">
<span<?php echo $recibos_list->apartamento_id->viewAttributes() ?>><?php echo $recibos_list->apartamento_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($recibos_list->n_recibo->Visible) { // n_recibo ?>
		<td data-name="n_recibo" <?php echo $recibos_list->n_recibo->cellAttributes() ?>>
<span id="el<?php echo $recibos_list->RowCount ?>_recibos_n_recibo">
<span<?php echo $recibos_list->n_recibo->viewAttributes() ?>><?php echo $recibos_list->n_recibo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($recibos_list->monto_pagar->Visible) { // monto_pagar ?>
		<td data-name="monto_pagar" <?php echo $recibos_list->monto_pagar->cellAttributes() ?>>
<span id="el<?php echo $recibos_list->RowCount ?>_recibos_monto_pagar">
<span<?php echo $recibos_list->monto_pagar->viewAttributes() ?>><?php echo $recibos_list->monto_pagar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($recibos_list->monto_ind->Visible) { // monto_ind ?>
		<td data-name="monto_ind" <?php echo $recibos_list->monto_ind->cellAttributes() ?>>
<span id="el<?php echo $recibos_list->RowCount ?>_recibos_monto_ind">
<span<?php echo $recibos_list->monto_ind->viewAttributes() ?>><?php echo $recibos_list->monto_ind->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($recibos_list->monto_alicuota->Visible) { // monto_alicuota ?>
		<td data-name="monto_alicuota" <?php echo $recibos_list->monto_alicuota->cellAttributes() ?>>
<span id="el<?php echo $recibos_list->RowCount ?>_recibos_monto_alicuota">
<span<?php echo $recibos_list->monto_alicuota->viewAttributes() ?>><?php echo $recibos_list->monto_alicuota->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$recibos_list->ListOptions->render("body", "right", $recibos_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$recibos_list->isGridAdd())
		$recibos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$recibos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($recibos_list->Recordset)
	$recibos_list->Recordset->Close();
?>
<?php if (!$recibos_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$recibos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $recibos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $recibos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($recibos_list->TotalRecords == 0 && !$recibos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $recibos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$recibos_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$recibos_list->isExport()) { ?>
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
$recibos_list->terminate();
?>