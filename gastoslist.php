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
$gastos_list = new gastos_list();

// Run the page
$gastos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gastos_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gastos_list->isExport()) { ?>
<script>
var fgastoslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgastoslist = currentForm = new ew.Form("fgastoslist", "list");
	fgastoslist.formKeyCountName = '<?php echo $gastos_list->FormKeyCountName ?>';
	loadjs.done("fgastoslist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$gastos_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gastos_list->TotalRecords > 0 && $gastos_list->ExportOptions->visible()) { ?>
<?php $gastos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gastos_list->ImportOptions->visible()) { ?>
<?php $gastos_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$gastos_list->isExport() || Config("EXPORT_MASTER_RECORD") && $gastos_list->isExport("print")) { ?>
<?php
if ($gastos_list->DbMasterFilter != "" && $gastos->getCurrentMasterTable() == "condo_mensual") {
	if ($gastos_list->MasterRecordExists) {
		include_once "condo_mensualmaster.php";
	}
}
?>
<?php } ?>
<?php
$gastos_list->renderOtherOptions();
?>
<?php $gastos_list->showPageHeader(); ?>
<?php
$gastos_list->showMessage();
?>
<?php if ($gastos_list->TotalRecords > 0 || $gastos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gastos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gastos">
<form name="fgastoslist" id="fgastoslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gastos">
<?php if ($gastos->getCurrentMasterTable() == "condo_mensual" && $gastos->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="condo_mensual">
<input type="hidden" name="fk_id_condo_mensual" value="<?php echo $gastos_list->condo_mens_id->getSessionValue() ?>">
<?php } ?>
<div id="gmp_gastos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gastos_list->TotalRecords > 0 || $gastos_list->isGridEdit()) { ?>
<table id="tbl_gastoslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gastos->RowType = ROWTYPE_HEADER;

// Render list options
$gastos_list->renderListOptions();

// Render list options (header, left)
$gastos_list->ListOptions->render("header", "left");
?>
<?php if ($gastos_list->id_gasto->Visible) { // id_gasto ?>
	<?php if ($gastos_list->SortUrl($gastos_list->id_gasto) == "") { ?>
		<th data-name="id_gasto" class="<?php echo $gastos_list->id_gasto->headerCellClass() ?>"><div id="elh_gastos_id_gasto" class="gastos_id_gasto"><div class="ew-table-header-caption"><?php echo $gastos_list->id_gasto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_gasto" class="<?php echo $gastos_list->id_gasto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gastos_list->SortUrl($gastos_list->id_gasto) ?>', 1);"><div id="elh_gastos_id_gasto" class="gastos_id_gasto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gastos_list->id_gasto->caption() ?></span><span class="ew-table-header-sort"><?php if ($gastos_list->id_gasto->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gastos_list->id_gasto->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gastos_list->tipo_gasto_id->Visible) { // tipo_gasto_id ?>
	<?php if ($gastos_list->SortUrl($gastos_list->tipo_gasto_id) == "") { ?>
		<th data-name="tipo_gasto_id" class="<?php echo $gastos_list->tipo_gasto_id->headerCellClass() ?>"><div id="elh_gastos_tipo_gasto_id" class="gastos_tipo_gasto_id"><div class="ew-table-header-caption"><?php echo $gastos_list->tipo_gasto_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipo_gasto_id" class="<?php echo $gastos_list->tipo_gasto_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gastos_list->SortUrl($gastos_list->tipo_gasto_id) ?>', 1);"><div id="elh_gastos_tipo_gasto_id" class="gastos_tipo_gasto_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gastos_list->tipo_gasto_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gastos_list->tipo_gasto_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gastos_list->tipo_gasto_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gastos_list->monto->Visible) { // monto ?>
	<?php if ($gastos_list->SortUrl($gastos_list->monto) == "") { ?>
		<th data-name="monto" class="<?php echo $gastos_list->monto->headerCellClass() ?>"><div id="elh_gastos_monto" class="gastos_monto"><div class="ew-table-header-caption"><?php echo $gastos_list->monto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto" class="<?php echo $gastos_list->monto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gastos_list->SortUrl($gastos_list->monto) ?>', 1);"><div id="elh_gastos_monto" class="gastos_monto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gastos_list->monto->caption() ?></span><span class="ew-table-header-sort"><?php if ($gastos_list->monto->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gastos_list->monto->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gastos_list->condo_mens_id->Visible) { // condo_mens_id ?>
	<?php if ($gastos_list->SortUrl($gastos_list->condo_mens_id) == "") { ?>
		<th data-name="condo_mens_id" class="<?php echo $gastos_list->condo_mens_id->headerCellClass() ?>"><div id="elh_gastos_condo_mens_id" class="gastos_condo_mens_id"><div class="ew-table-header-caption"><?php echo $gastos_list->condo_mens_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="condo_mens_id" class="<?php echo $gastos_list->condo_mens_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gastos_list->SortUrl($gastos_list->condo_mens_id) ?>', 1);"><div id="elh_gastos_condo_mens_id" class="gastos_condo_mens_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gastos_list->condo_mens_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gastos_list->condo_mens_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gastos_list->condo_mens_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gastos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gastos_list->ExportAll && $gastos_list->isExport()) {
	$gastos_list->StopRecord = $gastos_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gastos_list->TotalRecords > $gastos_list->StartRecord + $gastos_list->DisplayRecords - 1)
		$gastos_list->StopRecord = $gastos_list->StartRecord + $gastos_list->DisplayRecords - 1;
	else
		$gastos_list->StopRecord = $gastos_list->TotalRecords;
}
$gastos_list->RecordCount = $gastos_list->StartRecord - 1;
if ($gastos_list->Recordset && !$gastos_list->Recordset->EOF) {
	$gastos_list->Recordset->moveFirst();
	$selectLimit = $gastos_list->UseSelectLimit;
	if (!$selectLimit && $gastos_list->StartRecord > 1)
		$gastos_list->Recordset->move($gastos_list->StartRecord - 1);
} elseif (!$gastos->AllowAddDeleteRow && $gastos_list->StopRecord == 0) {
	$gastos_list->StopRecord = $gastos->GridAddRowCount;
}

// Initialize aggregate
$gastos->RowType = ROWTYPE_AGGREGATEINIT;
$gastos->resetAttributes();
$gastos_list->renderRow();
while ($gastos_list->RecordCount < $gastos_list->StopRecord) {
	$gastos_list->RecordCount++;
	if ($gastos_list->RecordCount >= $gastos_list->StartRecord) {
		$gastos_list->RowCount++;

		// Set up key count
		$gastos_list->KeyCount = $gastos_list->RowIndex;

		// Init row class and style
		$gastos->resetAttributes();
		$gastos->CssClass = "";
		if ($gastos_list->isGridAdd()) {
		} else {
			$gastos_list->loadRowValues($gastos_list->Recordset); // Load row values
		}
		$gastos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gastos->RowAttrs->merge(["data-rowindex" => $gastos_list->RowCount, "id" => "r" . $gastos_list->RowCount . "_gastos", "data-rowtype" => $gastos->RowType]);

		// Render row
		$gastos_list->renderRow();

		// Render list options
		$gastos_list->renderListOptions();
?>
	<tr <?php echo $gastos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gastos_list->ListOptions->render("body", "left", $gastos_list->RowCount);
?>
	<?php if ($gastos_list->id_gasto->Visible) { // id_gasto ?>
		<td data-name="id_gasto" <?php echo $gastos_list->id_gasto->cellAttributes() ?>>
<span id="el<?php echo $gastos_list->RowCount ?>_gastos_id_gasto">
<span<?php echo $gastos_list->id_gasto->viewAttributes() ?>><?php echo $gastos_list->id_gasto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gastos_list->tipo_gasto_id->Visible) { // tipo_gasto_id ?>
		<td data-name="tipo_gasto_id" <?php echo $gastos_list->tipo_gasto_id->cellAttributes() ?>>
<span id="el<?php echo $gastos_list->RowCount ?>_gastos_tipo_gasto_id">
<span<?php echo $gastos_list->tipo_gasto_id->viewAttributes() ?>><?php echo $gastos_list->tipo_gasto_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gastos_list->monto->Visible) { // monto ?>
		<td data-name="monto" <?php echo $gastos_list->monto->cellAttributes() ?>>
<span id="el<?php echo $gastos_list->RowCount ?>_gastos_monto">
<span<?php echo $gastos_list->monto->viewAttributes() ?>><?php echo $gastos_list->monto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gastos_list->condo_mens_id->Visible) { // condo_mens_id ?>
		<td data-name="condo_mens_id" <?php echo $gastos_list->condo_mens_id->cellAttributes() ?>>
<span id="el<?php echo $gastos_list->RowCount ?>_gastos_condo_mens_id">
<span<?php echo $gastos_list->condo_mens_id->viewAttributes() ?>><?php echo $gastos_list->condo_mens_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gastos_list->ListOptions->render("body", "right", $gastos_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gastos_list->isGridAdd())
		$gastos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gastos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gastos_list->Recordset)
	$gastos_list->Recordset->Close();
?>
<?php if (!$gastos_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gastos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gastos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gastos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gastos_list->TotalRecords == 0 && !$gastos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gastos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gastos_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gastos_list->isExport()) { ?>
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
$gastos_list->terminate();
?>