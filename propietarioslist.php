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
$propietarios_list = new propietarios_list();

// Run the page
$propietarios_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$propietarios_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$propietarios_list->isExport()) { ?>
<script>
var fpropietarioslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpropietarioslist = currentForm = new ew.Form("fpropietarioslist", "list");
	fpropietarioslist.formKeyCountName = '<?php echo $propietarios_list->FormKeyCountName ?>';
	loadjs.done("fpropietarioslist");
});
var fpropietarioslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpropietarioslistsrch = currentSearchForm = new ew.Form("fpropietarioslistsrch");

	// Dynamic selection lists
	// Filters

	fpropietarioslistsrch.filterList = <?php echo $propietarios_list->getFilterList() ?>;
	loadjs.done("fpropietarioslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$propietarios_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($propietarios_list->TotalRecords > 0 && $propietarios_list->ExportOptions->visible()) { ?>
<?php $propietarios_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($propietarios_list->ImportOptions->visible()) { ?>
<?php $propietarios_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($propietarios_list->SearchOptions->visible()) { ?>
<?php $propietarios_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($propietarios_list->FilterOptions->visible()) { ?>
<?php $propietarios_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$propietarios_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$propietarios_list->isExport() && !$propietarios->CurrentAction) { ?>
<form name="fpropietarioslistsrch" id="fpropietarioslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpropietarioslistsrch-search-panel" class="<?php echo $propietarios_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="propietarios">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $propietarios_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($propietarios_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($propietarios_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $propietarios_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($propietarios_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($propietarios_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($propietarios_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($propietarios_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $propietarios_list->showPageHeader(); ?>
<?php
$propietarios_list->showMessage();
?>
<?php if ($propietarios_list->TotalRecords > 0 || $propietarios->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($propietarios_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> propietarios">
<form name="fpropietarioslist" id="fpropietarioslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="propietarios">
<div id="gmp_propietarios" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($propietarios_list->TotalRecords > 0 || $propietarios_list->isGridEdit()) { ?>
<table id="tbl_propietarioslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$propietarios->RowType = ROWTYPE_HEADER;

// Render list options
$propietarios_list->renderListOptions();

// Render list options (header, left)
$propietarios_list->ListOptions->render("header", "left");
?>
<?php if ($propietarios_list->id_propietario->Visible) { // id_propietario ?>
	<?php if ($propietarios_list->SortUrl($propietarios_list->id_propietario) == "") { ?>
		<th data-name="id_propietario" class="<?php echo $propietarios_list->id_propietario->headerCellClass() ?>"><div id="elh_propietarios_id_propietario" class="propietarios_id_propietario"><div class="ew-table-header-caption"><?php echo $propietarios_list->id_propietario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_propietario" class="<?php echo $propietarios_list->id_propietario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $propietarios_list->SortUrl($propietarios_list->id_propietario) ?>', 1);"><div id="elh_propietarios_id_propietario" class="propietarios_id_propietario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $propietarios_list->id_propietario->caption() ?></span><span class="ew-table-header-sort"><?php if ($propietarios_list->id_propietario->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($propietarios_list->id_propietario->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($propietarios_list->nombre->Visible) { // nombre ?>
	<?php if ($propietarios_list->SortUrl($propietarios_list->nombre) == "") { ?>
		<th data-name="nombre" class="<?php echo $propietarios_list->nombre->headerCellClass() ?>"><div id="elh_propietarios_nombre" class="propietarios_nombre"><div class="ew-table-header-caption"><?php echo $propietarios_list->nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre" class="<?php echo $propietarios_list->nombre->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $propietarios_list->SortUrl($propietarios_list->nombre) ?>', 1);"><div id="elh_propietarios_nombre" class="propietarios_nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $propietarios_list->nombre->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($propietarios_list->nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($propietarios_list->nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($propietarios_list->apellido->Visible) { // apellido ?>
	<?php if ($propietarios_list->SortUrl($propietarios_list->apellido) == "") { ?>
		<th data-name="apellido" class="<?php echo $propietarios_list->apellido->headerCellClass() ?>"><div id="elh_propietarios_apellido" class="propietarios_apellido"><div class="ew-table-header-caption"><?php echo $propietarios_list->apellido->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="apellido" class="<?php echo $propietarios_list->apellido->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $propietarios_list->SortUrl($propietarios_list->apellido) ?>', 1);"><div id="elh_propietarios_apellido" class="propietarios_apellido">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $propietarios_list->apellido->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($propietarios_list->apellido->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($propietarios_list->apellido->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($propietarios_list->cedula->Visible) { // cedula ?>
	<?php if ($propietarios_list->SortUrl($propietarios_list->cedula) == "") { ?>
		<th data-name="cedula" class="<?php echo $propietarios_list->cedula->headerCellClass() ?>"><div id="elh_propietarios_cedula" class="propietarios_cedula"><div class="ew-table-header-caption"><?php echo $propietarios_list->cedula->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cedula" class="<?php echo $propietarios_list->cedula->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $propietarios_list->SortUrl($propietarios_list->cedula) ?>', 1);"><div id="elh_propietarios_cedula" class="propietarios_cedula">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $propietarios_list->cedula->caption() ?></span><span class="ew-table-header-sort"><?php if ($propietarios_list->cedula->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($propietarios_list->cedula->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($propietarios_list->telefono_princip->Visible) { // telefono_princip ?>
	<?php if ($propietarios_list->SortUrl($propietarios_list->telefono_princip) == "") { ?>
		<th data-name="telefono_princip" class="<?php echo $propietarios_list->telefono_princip->headerCellClass() ?>"><div id="elh_propietarios_telefono_princip" class="propietarios_telefono_princip"><div class="ew-table-header-caption"><?php echo $propietarios_list->telefono_princip->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefono_princip" class="<?php echo $propietarios_list->telefono_princip->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $propietarios_list->SortUrl($propietarios_list->telefono_princip) ?>', 1);"><div id="elh_propietarios_telefono_princip" class="propietarios_telefono_princip">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $propietarios_list->telefono_princip->caption() ?></span><span class="ew-table-header-sort"><?php if ($propietarios_list->telefono_princip->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($propietarios_list->telefono_princip->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($propietarios_list->telefono_secund->Visible) { // telefono_secund ?>
	<?php if ($propietarios_list->SortUrl($propietarios_list->telefono_secund) == "") { ?>
		<th data-name="telefono_secund" class="<?php echo $propietarios_list->telefono_secund->headerCellClass() ?>"><div id="elh_propietarios_telefono_secund" class="propietarios_telefono_secund"><div class="ew-table-header-caption"><?php echo $propietarios_list->telefono_secund->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefono_secund" class="<?php echo $propietarios_list->telefono_secund->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $propietarios_list->SortUrl($propietarios_list->telefono_secund) ?>', 1);"><div id="elh_propietarios_telefono_secund" class="propietarios_telefono_secund">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $propietarios_list->telefono_secund->caption() ?></span><span class="ew-table-header-sort"><?php if ($propietarios_list->telefono_secund->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($propietarios_list->telefono_secund->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$propietarios_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($propietarios_list->ExportAll && $propietarios_list->isExport()) {
	$propietarios_list->StopRecord = $propietarios_list->TotalRecords;
} else {

	// Set the last record to display
	if ($propietarios_list->TotalRecords > $propietarios_list->StartRecord + $propietarios_list->DisplayRecords - 1)
		$propietarios_list->StopRecord = $propietarios_list->StartRecord + $propietarios_list->DisplayRecords - 1;
	else
		$propietarios_list->StopRecord = $propietarios_list->TotalRecords;
}
$propietarios_list->RecordCount = $propietarios_list->StartRecord - 1;
if ($propietarios_list->Recordset && !$propietarios_list->Recordset->EOF) {
	$propietarios_list->Recordset->moveFirst();
	$selectLimit = $propietarios_list->UseSelectLimit;
	if (!$selectLimit && $propietarios_list->StartRecord > 1)
		$propietarios_list->Recordset->move($propietarios_list->StartRecord - 1);
} elseif (!$propietarios->AllowAddDeleteRow && $propietarios_list->StopRecord == 0) {
	$propietarios_list->StopRecord = $propietarios->GridAddRowCount;
}

// Initialize aggregate
$propietarios->RowType = ROWTYPE_AGGREGATEINIT;
$propietarios->resetAttributes();
$propietarios_list->renderRow();
while ($propietarios_list->RecordCount < $propietarios_list->StopRecord) {
	$propietarios_list->RecordCount++;
	if ($propietarios_list->RecordCount >= $propietarios_list->StartRecord) {
		$propietarios_list->RowCount++;

		// Set up key count
		$propietarios_list->KeyCount = $propietarios_list->RowIndex;

		// Init row class and style
		$propietarios->resetAttributes();
		$propietarios->CssClass = "";
		if ($propietarios_list->isGridAdd()) {
		} else {
			$propietarios_list->loadRowValues($propietarios_list->Recordset); // Load row values
		}
		$propietarios->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$propietarios->RowAttrs->merge(["data-rowindex" => $propietarios_list->RowCount, "id" => "r" . $propietarios_list->RowCount . "_propietarios", "data-rowtype" => $propietarios->RowType]);

		// Render row
		$propietarios_list->renderRow();

		// Render list options
		$propietarios_list->renderListOptions();
?>
	<tr <?php echo $propietarios->rowAttributes() ?>>
<?php

// Render list options (body, left)
$propietarios_list->ListOptions->render("body", "left", $propietarios_list->RowCount);
?>
	<?php if ($propietarios_list->id_propietario->Visible) { // id_propietario ?>
		<td data-name="id_propietario" <?php echo $propietarios_list->id_propietario->cellAttributes() ?>>
<span id="el<?php echo $propietarios_list->RowCount ?>_propietarios_id_propietario">
<span<?php echo $propietarios_list->id_propietario->viewAttributes() ?>><?php echo $propietarios_list->id_propietario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($propietarios_list->nombre->Visible) { // nombre ?>
		<td data-name="nombre" <?php echo $propietarios_list->nombre->cellAttributes() ?>>
<span id="el<?php echo $propietarios_list->RowCount ?>_propietarios_nombre">
<span<?php echo $propietarios_list->nombre->viewAttributes() ?>><?php echo $propietarios_list->nombre->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($propietarios_list->apellido->Visible) { // apellido ?>
		<td data-name="apellido" <?php echo $propietarios_list->apellido->cellAttributes() ?>>
<span id="el<?php echo $propietarios_list->RowCount ?>_propietarios_apellido">
<span<?php echo $propietarios_list->apellido->viewAttributes() ?>><?php echo $propietarios_list->apellido->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($propietarios_list->cedula->Visible) { // cedula ?>
		<td data-name="cedula" <?php echo $propietarios_list->cedula->cellAttributes() ?>>
<span id="el<?php echo $propietarios_list->RowCount ?>_propietarios_cedula">
<span<?php echo $propietarios_list->cedula->viewAttributes() ?>><?php echo $propietarios_list->cedula->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($propietarios_list->telefono_princip->Visible) { // telefono_princip ?>
		<td data-name="telefono_princip" <?php echo $propietarios_list->telefono_princip->cellAttributes() ?>>
<span id="el<?php echo $propietarios_list->RowCount ?>_propietarios_telefono_princip">
<span<?php echo $propietarios_list->telefono_princip->viewAttributes() ?>><?php echo $propietarios_list->telefono_princip->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($propietarios_list->telefono_secund->Visible) { // telefono_secund ?>
		<td data-name="telefono_secund" <?php echo $propietarios_list->telefono_secund->cellAttributes() ?>>
<span id="el<?php echo $propietarios_list->RowCount ?>_propietarios_telefono_secund">
<span<?php echo $propietarios_list->telefono_secund->viewAttributes() ?>><?php echo $propietarios_list->telefono_secund->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$propietarios_list->ListOptions->render("body", "right", $propietarios_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$propietarios_list->isGridAdd())
		$propietarios_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$propietarios->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($propietarios_list->Recordset)
	$propietarios_list->Recordset->Close();
?>
<?php if (!$propietarios_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$propietarios_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $propietarios_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $propietarios_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($propietarios_list->TotalRecords == 0 && !$propietarios->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $propietarios_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$propietarios_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$propietarios_list->isExport()) { ?>
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
$propietarios_list->terminate();
?>