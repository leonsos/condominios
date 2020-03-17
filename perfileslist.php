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
$perfiles_list = new perfiles_list();

// Run the page
$perfiles_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$perfiles_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$perfiles_list->isExport()) { ?>
<script>
var fperfileslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fperfileslist = currentForm = new ew.Form("fperfileslist", "list");
	fperfileslist.formKeyCountName = '<?php echo $perfiles_list->FormKeyCountName ?>';
	loadjs.done("fperfileslist");
});
var fperfileslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fperfileslistsrch = currentSearchForm = new ew.Form("fperfileslistsrch");

	// Dynamic selection lists
	// Filters

	fperfileslistsrch.filterList = <?php echo $perfiles_list->getFilterList() ?>;
	loadjs.done("fperfileslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$perfiles_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($perfiles_list->TotalRecords > 0 && $perfiles_list->ExportOptions->visible()) { ?>
<?php $perfiles_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($perfiles_list->ImportOptions->visible()) { ?>
<?php $perfiles_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($perfiles_list->SearchOptions->visible()) { ?>
<?php $perfiles_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($perfiles_list->FilterOptions->visible()) { ?>
<?php $perfiles_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$perfiles_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$perfiles_list->isExport() && !$perfiles->CurrentAction) { ?>
<form name="fperfileslistsrch" id="fperfileslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fperfileslistsrch-search-panel" class="<?php echo $perfiles_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="perfiles">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $perfiles_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($perfiles_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($perfiles_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $perfiles_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($perfiles_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($perfiles_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($perfiles_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($perfiles_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $perfiles_list->showPageHeader(); ?>
<?php
$perfiles_list->showMessage();
?>
<?php if ($perfiles_list->TotalRecords > 0 || $perfiles->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($perfiles_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> perfiles">
<form name="fperfileslist" id="fperfileslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="perfiles">
<div id="gmp_perfiles" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($perfiles_list->TotalRecords > 0 || $perfiles_list->isGridEdit()) { ?>
<table id="tbl_perfileslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$perfiles->RowType = ROWTYPE_HEADER;

// Render list options
$perfiles_list->renderListOptions();

// Render list options (header, left)
$perfiles_list->ListOptions->render("header", "left");
?>
<?php if ($perfiles_list->id_perfil->Visible) { // id_perfil ?>
	<?php if ($perfiles_list->SortUrl($perfiles_list->id_perfil) == "") { ?>
		<th data-name="id_perfil" class="<?php echo $perfiles_list->id_perfil->headerCellClass() ?>"><div id="elh_perfiles_id_perfil" class="perfiles_id_perfil"><div class="ew-table-header-caption"><?php echo $perfiles_list->id_perfil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_perfil" class="<?php echo $perfiles_list->id_perfil->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $perfiles_list->SortUrl($perfiles_list->id_perfil) ?>', 1);"><div id="elh_perfiles_id_perfil" class="perfiles_id_perfil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $perfiles_list->id_perfil->caption() ?></span><span class="ew-table-header-sort"><?php if ($perfiles_list->id_perfil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($perfiles_list->id_perfil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($perfiles_list->descripcion_perfil->Visible) { // descripcion_perfil ?>
	<?php if ($perfiles_list->SortUrl($perfiles_list->descripcion_perfil) == "") { ?>
		<th data-name="descripcion_perfil" class="<?php echo $perfiles_list->descripcion_perfil->headerCellClass() ?>"><div id="elh_perfiles_descripcion_perfil" class="perfiles_descripcion_perfil"><div class="ew-table-header-caption"><?php echo $perfiles_list->descripcion_perfil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion_perfil" class="<?php echo $perfiles_list->descripcion_perfil->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $perfiles_list->SortUrl($perfiles_list->descripcion_perfil) ?>', 1);"><div id="elh_perfiles_descripcion_perfil" class="perfiles_descripcion_perfil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $perfiles_list->descripcion_perfil->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($perfiles_list->descripcion_perfil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($perfiles_list->descripcion_perfil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$perfiles_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($perfiles_list->ExportAll && $perfiles_list->isExport()) {
	$perfiles_list->StopRecord = $perfiles_list->TotalRecords;
} else {

	// Set the last record to display
	if ($perfiles_list->TotalRecords > $perfiles_list->StartRecord + $perfiles_list->DisplayRecords - 1)
		$perfiles_list->StopRecord = $perfiles_list->StartRecord + $perfiles_list->DisplayRecords - 1;
	else
		$perfiles_list->StopRecord = $perfiles_list->TotalRecords;
}
$perfiles_list->RecordCount = $perfiles_list->StartRecord - 1;
if ($perfiles_list->Recordset && !$perfiles_list->Recordset->EOF) {
	$perfiles_list->Recordset->moveFirst();
	$selectLimit = $perfiles_list->UseSelectLimit;
	if (!$selectLimit && $perfiles_list->StartRecord > 1)
		$perfiles_list->Recordset->move($perfiles_list->StartRecord - 1);
} elseif (!$perfiles->AllowAddDeleteRow && $perfiles_list->StopRecord == 0) {
	$perfiles_list->StopRecord = $perfiles->GridAddRowCount;
}

// Initialize aggregate
$perfiles->RowType = ROWTYPE_AGGREGATEINIT;
$perfiles->resetAttributes();
$perfiles_list->renderRow();
while ($perfiles_list->RecordCount < $perfiles_list->StopRecord) {
	$perfiles_list->RecordCount++;
	if ($perfiles_list->RecordCount >= $perfiles_list->StartRecord) {
		$perfiles_list->RowCount++;

		// Set up key count
		$perfiles_list->KeyCount = $perfiles_list->RowIndex;

		// Init row class and style
		$perfiles->resetAttributes();
		$perfiles->CssClass = "";
		if ($perfiles_list->isGridAdd()) {
		} else {
			$perfiles_list->loadRowValues($perfiles_list->Recordset); // Load row values
		}
		$perfiles->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$perfiles->RowAttrs->merge(["data-rowindex" => $perfiles_list->RowCount, "id" => "r" . $perfiles_list->RowCount . "_perfiles", "data-rowtype" => $perfiles->RowType]);

		// Render row
		$perfiles_list->renderRow();

		// Render list options
		$perfiles_list->renderListOptions();
?>
	<tr <?php echo $perfiles->rowAttributes() ?>>
<?php

// Render list options (body, left)
$perfiles_list->ListOptions->render("body", "left", $perfiles_list->RowCount);
?>
	<?php if ($perfiles_list->id_perfil->Visible) { // id_perfil ?>
		<td data-name="id_perfil" <?php echo $perfiles_list->id_perfil->cellAttributes() ?>>
<span id="el<?php echo $perfiles_list->RowCount ?>_perfiles_id_perfil">
<span<?php echo $perfiles_list->id_perfil->viewAttributes() ?>><?php echo $perfiles_list->id_perfil->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($perfiles_list->descripcion_perfil->Visible) { // descripcion_perfil ?>
		<td data-name="descripcion_perfil" <?php echo $perfiles_list->descripcion_perfil->cellAttributes() ?>>
<span id="el<?php echo $perfiles_list->RowCount ?>_perfiles_descripcion_perfil">
<span<?php echo $perfiles_list->descripcion_perfil->viewAttributes() ?>><?php echo $perfiles_list->descripcion_perfil->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$perfiles_list->ListOptions->render("body", "right", $perfiles_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$perfiles_list->isGridAdd())
		$perfiles_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$perfiles->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($perfiles_list->Recordset)
	$perfiles_list->Recordset->Close();
?>
<?php if (!$perfiles_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$perfiles_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $perfiles_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $perfiles_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($perfiles_list->TotalRecords == 0 && !$perfiles->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $perfiles_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$perfiles_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$perfiles_list->isExport()) { ?>
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
$perfiles_list->terminate();
?>