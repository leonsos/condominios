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
$perfiles_permisos_list = new perfiles_permisos_list();

// Run the page
$perfiles_permisos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$perfiles_permisos_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$perfiles_permisos_list->isExport()) { ?>
<script>
var fperfiles_permisoslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fperfiles_permisoslist = currentForm = new ew.Form("fperfiles_permisoslist", "list");
	fperfiles_permisoslist.formKeyCountName = '<?php echo $perfiles_permisos_list->FormKeyCountName ?>';
	loadjs.done("fperfiles_permisoslist");
});
var fperfiles_permisoslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fperfiles_permisoslistsrch = currentSearchForm = new ew.Form("fperfiles_permisoslistsrch");

	// Dynamic selection lists
	// Filters

	fperfiles_permisoslistsrch.filterList = <?php echo $perfiles_permisos_list->getFilterList() ?>;
	loadjs.done("fperfiles_permisoslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$perfiles_permisos_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($perfiles_permisos_list->TotalRecords > 0 && $perfiles_permisos_list->ExportOptions->visible()) { ?>
<?php $perfiles_permisos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($perfiles_permisos_list->ImportOptions->visible()) { ?>
<?php $perfiles_permisos_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($perfiles_permisos_list->SearchOptions->visible()) { ?>
<?php $perfiles_permisos_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($perfiles_permisos_list->FilterOptions->visible()) { ?>
<?php $perfiles_permisos_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$perfiles_permisos_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$perfiles_permisos_list->isExport() && !$perfiles_permisos->CurrentAction) { ?>
<form name="fperfiles_permisoslistsrch" id="fperfiles_permisoslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fperfiles_permisoslistsrch-search-panel" class="<?php echo $perfiles_permisos_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="perfiles_permisos">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $perfiles_permisos_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($perfiles_permisos_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($perfiles_permisos_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $perfiles_permisos_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($perfiles_permisos_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($perfiles_permisos_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($perfiles_permisos_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($perfiles_permisos_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $perfiles_permisos_list->showPageHeader(); ?>
<?php
$perfiles_permisos_list->showMessage();
?>
<?php if ($perfiles_permisos_list->TotalRecords > 0 || $perfiles_permisos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($perfiles_permisos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> perfiles_permisos">
<form name="fperfiles_permisoslist" id="fperfiles_permisoslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="perfiles_permisos">
<div id="gmp_perfiles_permisos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($perfiles_permisos_list->TotalRecords > 0 || $perfiles_permisos_list->isGridEdit()) { ?>
<table id="tbl_perfiles_permisoslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$perfiles_permisos->RowType = ROWTYPE_HEADER;

// Render list options
$perfiles_permisos_list->renderListOptions();

// Render list options (header, left)
$perfiles_permisos_list->ListOptions->render("header", "left");
?>
<?php if ($perfiles_permisos_list->id_perfil_permisos->Visible) { // id_perfil_permisos ?>
	<?php if ($perfiles_permisos_list->SortUrl($perfiles_permisos_list->id_perfil_permisos) == "") { ?>
		<th data-name="id_perfil_permisos" class="<?php echo $perfiles_permisos_list->id_perfil_permisos->headerCellClass() ?>"><div id="elh_perfiles_permisos_id_perfil_permisos" class="perfiles_permisos_id_perfil_permisos"><div class="ew-table-header-caption"><?php echo $perfiles_permisos_list->id_perfil_permisos->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_perfil_permisos" class="<?php echo $perfiles_permisos_list->id_perfil_permisos->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $perfiles_permisos_list->SortUrl($perfiles_permisos_list->id_perfil_permisos) ?>', 1);"><div id="elh_perfiles_permisos_id_perfil_permisos" class="perfiles_permisos_id_perfil_permisos">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $perfiles_permisos_list->id_perfil_permisos->caption() ?></span><span class="ew-table-header-sort"><?php if ($perfiles_permisos_list->id_perfil_permisos->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($perfiles_permisos_list->id_perfil_permisos->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($perfiles_permisos_list->tabla->Visible) { // tabla ?>
	<?php if ($perfiles_permisos_list->SortUrl($perfiles_permisos_list->tabla) == "") { ?>
		<th data-name="tabla" class="<?php echo $perfiles_permisos_list->tabla->headerCellClass() ?>"><div id="elh_perfiles_permisos_tabla" class="perfiles_permisos_tabla"><div class="ew-table-header-caption"><?php echo $perfiles_permisos_list->tabla->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tabla" class="<?php echo $perfiles_permisos_list->tabla->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $perfiles_permisos_list->SortUrl($perfiles_permisos_list->tabla) ?>', 1);"><div id="elh_perfiles_permisos_tabla" class="perfiles_permisos_tabla">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $perfiles_permisos_list->tabla->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($perfiles_permisos_list->tabla->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($perfiles_permisos_list->tabla->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($perfiles_permisos_list->permiso->Visible) { // permiso ?>
	<?php if ($perfiles_permisos_list->SortUrl($perfiles_permisos_list->permiso) == "") { ?>
		<th data-name="permiso" class="<?php echo $perfiles_permisos_list->permiso->headerCellClass() ?>"><div id="elh_perfiles_permisos_permiso" class="perfiles_permisos_permiso"><div class="ew-table-header-caption"><?php echo $perfiles_permisos_list->permiso->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="permiso" class="<?php echo $perfiles_permisos_list->permiso->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $perfiles_permisos_list->SortUrl($perfiles_permisos_list->permiso) ?>', 1);"><div id="elh_perfiles_permisos_permiso" class="perfiles_permisos_permiso">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $perfiles_permisos_list->permiso->caption() ?></span><span class="ew-table-header-sort"><?php if ($perfiles_permisos_list->permiso->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($perfiles_permisos_list->permiso->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$perfiles_permisos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($perfiles_permisos_list->ExportAll && $perfiles_permisos_list->isExport()) {
	$perfiles_permisos_list->StopRecord = $perfiles_permisos_list->TotalRecords;
} else {

	// Set the last record to display
	if ($perfiles_permisos_list->TotalRecords > $perfiles_permisos_list->StartRecord + $perfiles_permisos_list->DisplayRecords - 1)
		$perfiles_permisos_list->StopRecord = $perfiles_permisos_list->StartRecord + $perfiles_permisos_list->DisplayRecords - 1;
	else
		$perfiles_permisos_list->StopRecord = $perfiles_permisos_list->TotalRecords;
}
$perfiles_permisos_list->RecordCount = $perfiles_permisos_list->StartRecord - 1;
if ($perfiles_permisos_list->Recordset && !$perfiles_permisos_list->Recordset->EOF) {
	$perfiles_permisos_list->Recordset->moveFirst();
	$selectLimit = $perfiles_permisos_list->UseSelectLimit;
	if (!$selectLimit && $perfiles_permisos_list->StartRecord > 1)
		$perfiles_permisos_list->Recordset->move($perfiles_permisos_list->StartRecord - 1);
} elseif (!$perfiles_permisos->AllowAddDeleteRow && $perfiles_permisos_list->StopRecord == 0) {
	$perfiles_permisos_list->StopRecord = $perfiles_permisos->GridAddRowCount;
}

// Initialize aggregate
$perfiles_permisos->RowType = ROWTYPE_AGGREGATEINIT;
$perfiles_permisos->resetAttributes();
$perfiles_permisos_list->renderRow();
while ($perfiles_permisos_list->RecordCount < $perfiles_permisos_list->StopRecord) {
	$perfiles_permisos_list->RecordCount++;
	if ($perfiles_permisos_list->RecordCount >= $perfiles_permisos_list->StartRecord) {
		$perfiles_permisos_list->RowCount++;

		// Set up key count
		$perfiles_permisos_list->KeyCount = $perfiles_permisos_list->RowIndex;

		// Init row class and style
		$perfiles_permisos->resetAttributes();
		$perfiles_permisos->CssClass = "";
		if ($perfiles_permisos_list->isGridAdd()) {
		} else {
			$perfiles_permisos_list->loadRowValues($perfiles_permisos_list->Recordset); // Load row values
		}
		$perfiles_permisos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$perfiles_permisos->RowAttrs->merge(["data-rowindex" => $perfiles_permisos_list->RowCount, "id" => "r" . $perfiles_permisos_list->RowCount . "_perfiles_permisos", "data-rowtype" => $perfiles_permisos->RowType]);

		// Render row
		$perfiles_permisos_list->renderRow();

		// Render list options
		$perfiles_permisos_list->renderListOptions();
?>
	<tr <?php echo $perfiles_permisos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$perfiles_permisos_list->ListOptions->render("body", "left", $perfiles_permisos_list->RowCount);
?>
	<?php if ($perfiles_permisos_list->id_perfil_permisos->Visible) { // id_perfil_permisos ?>
		<td data-name="id_perfil_permisos" <?php echo $perfiles_permisos_list->id_perfil_permisos->cellAttributes() ?>>
<span id="el<?php echo $perfiles_permisos_list->RowCount ?>_perfiles_permisos_id_perfil_permisos">
<span<?php echo $perfiles_permisos_list->id_perfil_permisos->viewAttributes() ?>><?php echo $perfiles_permisos_list->id_perfil_permisos->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($perfiles_permisos_list->tabla->Visible) { // tabla ?>
		<td data-name="tabla" <?php echo $perfiles_permisos_list->tabla->cellAttributes() ?>>
<span id="el<?php echo $perfiles_permisos_list->RowCount ?>_perfiles_permisos_tabla">
<span<?php echo $perfiles_permisos_list->tabla->viewAttributes() ?>><?php echo $perfiles_permisos_list->tabla->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($perfiles_permisos_list->permiso->Visible) { // permiso ?>
		<td data-name="permiso" <?php echo $perfiles_permisos_list->permiso->cellAttributes() ?>>
<span id="el<?php echo $perfiles_permisos_list->RowCount ?>_perfiles_permisos_permiso">
<span<?php echo $perfiles_permisos_list->permiso->viewAttributes() ?>><?php echo $perfiles_permisos_list->permiso->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$perfiles_permisos_list->ListOptions->render("body", "right", $perfiles_permisos_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$perfiles_permisos_list->isGridAdd())
		$perfiles_permisos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$perfiles_permisos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($perfiles_permisos_list->Recordset)
	$perfiles_permisos_list->Recordset->Close();
?>
<?php if (!$perfiles_permisos_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$perfiles_permisos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $perfiles_permisos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $perfiles_permisos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($perfiles_permisos_list->TotalRecords == 0 && !$perfiles_permisos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $perfiles_permisos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$perfiles_permisos_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$perfiles_permisos_list->isExport()) { ?>
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
$perfiles_permisos_list->terminate();
?>