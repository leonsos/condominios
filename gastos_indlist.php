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
$gastos_ind_list = new gastos_ind_list();

// Run the page
$gastos_ind_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gastos_ind_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gastos_ind_list->isExport()) { ?>
<script>
var fgastos_indlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgastos_indlist = currentForm = new ew.Form("fgastos_indlist", "list");
	fgastos_indlist.formKeyCountName = '<?php echo $gastos_ind_list->FormKeyCountName ?>';
	loadjs.done("fgastos_indlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$gastos_ind_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gastos_ind_list->TotalRecords > 0 && $gastos_ind_list->ExportOptions->visible()) { ?>
<?php $gastos_ind_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gastos_ind_list->ImportOptions->visible()) { ?>
<?php $gastos_ind_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$gastos_ind_list->renderOtherOptions();
?>
<?php $gastos_ind_list->showPageHeader(); ?>
<?php
$gastos_ind_list->showMessage();
?>
<?php if ($gastos_ind_list->TotalRecords > 0 || $gastos_ind->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gastos_ind_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gastos_ind">
<form name="fgastos_indlist" id="fgastos_indlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gastos_ind">
<div id="gmp_gastos_ind" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gastos_ind_list->TotalRecords > 0 || $gastos_ind_list->isGridEdit()) { ?>
<table id="tbl_gastos_indlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gastos_ind->RowType = ROWTYPE_HEADER;

// Render list options
$gastos_ind_list->renderListOptions();

// Render list options (header, left)
$gastos_ind_list->ListOptions->render("header", "left");
?>
<?php if ($gastos_ind_list->id_gasto_ind->Visible) { // id_gasto_ind ?>
	<?php if ($gastos_ind_list->SortUrl($gastos_ind_list->id_gasto_ind) == "") { ?>
		<th data-name="id_gasto_ind" class="<?php echo $gastos_ind_list->id_gasto_ind->headerCellClass() ?>"><div id="elh_gastos_ind_id_gasto_ind" class="gastos_ind_id_gasto_ind"><div class="ew-table-header-caption"><?php echo $gastos_ind_list->id_gasto_ind->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_gasto_ind" class="<?php echo $gastos_ind_list->id_gasto_ind->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gastos_ind_list->SortUrl($gastos_ind_list->id_gasto_ind) ?>', 1);"><div id="elh_gastos_ind_id_gasto_ind" class="gastos_ind_id_gasto_ind">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gastos_ind_list->id_gasto_ind->caption() ?></span><span class="ew-table-header-sort"><?php if ($gastos_ind_list->id_gasto_ind->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gastos_ind_list->id_gasto_ind->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gastos_ind_list->tipo_gasto_id->Visible) { // tipo_gasto_id ?>
	<?php if ($gastos_ind_list->SortUrl($gastos_ind_list->tipo_gasto_id) == "") { ?>
		<th data-name="tipo_gasto_id" class="<?php echo $gastos_ind_list->tipo_gasto_id->headerCellClass() ?>"><div id="elh_gastos_ind_tipo_gasto_id" class="gastos_ind_tipo_gasto_id"><div class="ew-table-header-caption"><?php echo $gastos_ind_list->tipo_gasto_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipo_gasto_id" class="<?php echo $gastos_ind_list->tipo_gasto_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gastos_ind_list->SortUrl($gastos_ind_list->tipo_gasto_id) ?>', 1);"><div id="elh_gastos_ind_tipo_gasto_id" class="gastos_ind_tipo_gasto_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gastos_ind_list->tipo_gasto_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gastos_ind_list->tipo_gasto_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gastos_ind_list->tipo_gasto_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gastos_ind_list->monto->Visible) { // monto ?>
	<?php if ($gastos_ind_list->SortUrl($gastos_ind_list->monto) == "") { ?>
		<th data-name="monto" class="<?php echo $gastos_ind_list->monto->headerCellClass() ?>"><div id="elh_gastos_ind_monto" class="gastos_ind_monto"><div class="ew-table-header-caption"><?php echo $gastos_ind_list->monto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto" class="<?php echo $gastos_ind_list->monto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gastos_ind_list->SortUrl($gastos_ind_list->monto) ?>', 1);"><div id="elh_gastos_ind_monto" class="gastos_ind_monto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gastos_ind_list->monto->caption() ?></span><span class="ew-table-header-sort"><?php if ($gastos_ind_list->monto->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gastos_ind_list->monto->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gastos_ind_list->desde->Visible) { // desde ?>
	<?php if ($gastos_ind_list->SortUrl($gastos_ind_list->desde) == "") { ?>
		<th data-name="desde" class="<?php echo $gastos_ind_list->desde->headerCellClass() ?>"><div id="elh_gastos_ind_desde" class="gastos_ind_desde"><div class="ew-table-header-caption"><?php echo $gastos_ind_list->desde->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="desde" class="<?php echo $gastos_ind_list->desde->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gastos_ind_list->SortUrl($gastos_ind_list->desde) ?>', 1);"><div id="elh_gastos_ind_desde" class="gastos_ind_desde">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gastos_ind_list->desde->caption() ?></span><span class="ew-table-header-sort"><?php if ($gastos_ind_list->desde->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gastos_ind_list->desde->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gastos_ind_list->hasta->Visible) { // hasta ?>
	<?php if ($gastos_ind_list->SortUrl($gastos_ind_list->hasta) == "") { ?>
		<th data-name="hasta" class="<?php echo $gastos_ind_list->hasta->headerCellClass() ?>"><div id="elh_gastos_ind_hasta" class="gastos_ind_hasta"><div class="ew-table-header-caption"><?php echo $gastos_ind_list->hasta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hasta" class="<?php echo $gastos_ind_list->hasta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gastos_ind_list->SortUrl($gastos_ind_list->hasta) ?>', 1);"><div id="elh_gastos_ind_hasta" class="gastos_ind_hasta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gastos_ind_list->hasta->caption() ?></span><span class="ew-table-header-sort"><?php if ($gastos_ind_list->hasta->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gastos_ind_list->hasta->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gastos_ind_list->status->Visible) { // status ?>
	<?php if ($gastos_ind_list->SortUrl($gastos_ind_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $gastos_ind_list->status->headerCellClass() ?>"><div id="elh_gastos_ind_status" class="gastos_ind_status"><div class="ew-table-header-caption"><?php echo $gastos_ind_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $gastos_ind_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gastos_ind_list->SortUrl($gastos_ind_list->status) ?>', 1);"><div id="elh_gastos_ind_status" class="gastos_ind_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gastos_ind_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($gastos_ind_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gastos_ind_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gastos_ind_list->apartamento_id->Visible) { // apartamento_id ?>
	<?php if ($gastos_ind_list->SortUrl($gastos_ind_list->apartamento_id) == "") { ?>
		<th data-name="apartamento_id" class="<?php echo $gastos_ind_list->apartamento_id->headerCellClass() ?>"><div id="elh_gastos_ind_apartamento_id" class="gastos_ind_apartamento_id"><div class="ew-table-header-caption"><?php echo $gastos_ind_list->apartamento_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="apartamento_id" class="<?php echo $gastos_ind_list->apartamento_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gastos_ind_list->SortUrl($gastos_ind_list->apartamento_id) ?>', 1);"><div id="elh_gastos_ind_apartamento_id" class="gastos_ind_apartamento_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gastos_ind_list->apartamento_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gastos_ind_list->apartamento_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gastos_ind_list->apartamento_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gastos_ind_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gastos_ind_list->ExportAll && $gastos_ind_list->isExport()) {
	$gastos_ind_list->StopRecord = $gastos_ind_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gastos_ind_list->TotalRecords > $gastos_ind_list->StartRecord + $gastos_ind_list->DisplayRecords - 1)
		$gastos_ind_list->StopRecord = $gastos_ind_list->StartRecord + $gastos_ind_list->DisplayRecords - 1;
	else
		$gastos_ind_list->StopRecord = $gastos_ind_list->TotalRecords;
}
$gastos_ind_list->RecordCount = $gastos_ind_list->StartRecord - 1;
if ($gastos_ind_list->Recordset && !$gastos_ind_list->Recordset->EOF) {
	$gastos_ind_list->Recordset->moveFirst();
	$selectLimit = $gastos_ind_list->UseSelectLimit;
	if (!$selectLimit && $gastos_ind_list->StartRecord > 1)
		$gastos_ind_list->Recordset->move($gastos_ind_list->StartRecord - 1);
} elseif (!$gastos_ind->AllowAddDeleteRow && $gastos_ind_list->StopRecord == 0) {
	$gastos_ind_list->StopRecord = $gastos_ind->GridAddRowCount;
}

// Initialize aggregate
$gastos_ind->RowType = ROWTYPE_AGGREGATEINIT;
$gastos_ind->resetAttributes();
$gastos_ind_list->renderRow();
while ($gastos_ind_list->RecordCount < $gastos_ind_list->StopRecord) {
	$gastos_ind_list->RecordCount++;
	if ($gastos_ind_list->RecordCount >= $gastos_ind_list->StartRecord) {
		$gastos_ind_list->RowCount++;

		// Set up key count
		$gastos_ind_list->KeyCount = $gastos_ind_list->RowIndex;

		// Init row class and style
		$gastos_ind->resetAttributes();
		$gastos_ind->CssClass = "";
		if ($gastos_ind_list->isGridAdd()) {
		} else {
			$gastos_ind_list->loadRowValues($gastos_ind_list->Recordset); // Load row values
		}
		$gastos_ind->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gastos_ind->RowAttrs->merge(["data-rowindex" => $gastos_ind_list->RowCount, "id" => "r" . $gastos_ind_list->RowCount . "_gastos_ind", "data-rowtype" => $gastos_ind->RowType]);

		// Render row
		$gastos_ind_list->renderRow();

		// Render list options
		$gastos_ind_list->renderListOptions();
?>
	<tr <?php echo $gastos_ind->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gastos_ind_list->ListOptions->render("body", "left", $gastos_ind_list->RowCount);
?>
	<?php if ($gastos_ind_list->id_gasto_ind->Visible) { // id_gasto_ind ?>
		<td data-name="id_gasto_ind" <?php echo $gastos_ind_list->id_gasto_ind->cellAttributes() ?>>
<span id="el<?php echo $gastos_ind_list->RowCount ?>_gastos_ind_id_gasto_ind">
<span<?php echo $gastos_ind_list->id_gasto_ind->viewAttributes() ?>><?php echo $gastos_ind_list->id_gasto_ind->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gastos_ind_list->tipo_gasto_id->Visible) { // tipo_gasto_id ?>
		<td data-name="tipo_gasto_id" <?php echo $gastos_ind_list->tipo_gasto_id->cellAttributes() ?>>
<span id="el<?php echo $gastos_ind_list->RowCount ?>_gastos_ind_tipo_gasto_id">
<span<?php echo $gastos_ind_list->tipo_gasto_id->viewAttributes() ?>><?php echo $gastos_ind_list->tipo_gasto_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gastos_ind_list->monto->Visible) { // monto ?>
		<td data-name="monto" <?php echo $gastos_ind_list->monto->cellAttributes() ?>>
<span id="el<?php echo $gastos_ind_list->RowCount ?>_gastos_ind_monto">
<span<?php echo $gastos_ind_list->monto->viewAttributes() ?>><?php echo $gastos_ind_list->monto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gastos_ind_list->desde->Visible) { // desde ?>
		<td data-name="desde" <?php echo $gastos_ind_list->desde->cellAttributes() ?>>
<span id="el<?php echo $gastos_ind_list->RowCount ?>_gastos_ind_desde">
<span<?php echo $gastos_ind_list->desde->viewAttributes() ?>><?php echo $gastos_ind_list->desde->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gastos_ind_list->hasta->Visible) { // hasta ?>
		<td data-name="hasta" <?php echo $gastos_ind_list->hasta->cellAttributes() ?>>
<span id="el<?php echo $gastos_ind_list->RowCount ?>_gastos_ind_hasta">
<span<?php echo $gastos_ind_list->hasta->viewAttributes() ?>><?php echo $gastos_ind_list->hasta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gastos_ind_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $gastos_ind_list->status->cellAttributes() ?>>
<span id="el<?php echo $gastos_ind_list->RowCount ?>_gastos_ind_status">
<span<?php echo $gastos_ind_list->status->viewAttributes() ?>><?php echo $gastos_ind_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gastos_ind_list->apartamento_id->Visible) { // apartamento_id ?>
		<td data-name="apartamento_id" <?php echo $gastos_ind_list->apartamento_id->cellAttributes() ?>>
<span id="el<?php echo $gastos_ind_list->RowCount ?>_gastos_ind_apartamento_id">
<span<?php echo $gastos_ind_list->apartamento_id->viewAttributes() ?>><?php echo $gastos_ind_list->apartamento_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gastos_ind_list->ListOptions->render("body", "right", $gastos_ind_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gastos_ind_list->isGridAdd())
		$gastos_ind_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gastos_ind->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gastos_ind_list->Recordset)
	$gastos_ind_list->Recordset->Close();
?>
<?php if (!$gastos_ind_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gastos_ind_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gastos_ind_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gastos_ind_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gastos_ind_list->TotalRecords == 0 && !$gastos_ind->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gastos_ind_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gastos_ind_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gastos_ind_list->isExport()) { ?>
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
$gastos_ind_list->terminate();
?>