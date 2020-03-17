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
$recibo_detalle_list = new recibo_detalle_list();

// Run the page
$recibo_detalle_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$recibo_detalle_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$recibo_detalle_list->isExport()) { ?>
<script>
var frecibo_detallelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	frecibo_detallelist = currentForm = new ew.Form("frecibo_detallelist", "list");
	frecibo_detallelist.formKeyCountName = '<?php echo $recibo_detalle_list->FormKeyCountName ?>';
	loadjs.done("frecibo_detallelist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$recibo_detalle_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($recibo_detalle_list->TotalRecords > 0 && $recibo_detalle_list->ExportOptions->visible()) { ?>
<?php $recibo_detalle_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($recibo_detalle_list->ImportOptions->visible()) { ?>
<?php $recibo_detalle_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$recibo_detalle_list->renderOtherOptions();
?>
<?php $recibo_detalle_list->showPageHeader(); ?>
<?php
$recibo_detalle_list->showMessage();
?>
<?php if ($recibo_detalle_list->TotalRecords > 0 || $recibo_detalle->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($recibo_detalle_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> recibo_detalle">
<form name="frecibo_detallelist" id="frecibo_detallelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="recibo_detalle">
<div id="gmp_recibo_detalle" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($recibo_detalle_list->TotalRecords > 0 || $recibo_detalle_list->isGridEdit()) { ?>
<table id="tbl_recibo_detallelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$recibo_detalle->RowType = ROWTYPE_HEADER;

// Render list options
$recibo_detalle_list->renderListOptions();

// Render list options (header, left)
$recibo_detalle_list->ListOptions->render("header", "left");
?>
<?php if ($recibo_detalle_list->id_recibo_detalle->Visible) { // id_recibo_detalle ?>
	<?php if ($recibo_detalle_list->SortUrl($recibo_detalle_list->id_recibo_detalle) == "") { ?>
		<th data-name="id_recibo_detalle" class="<?php echo $recibo_detalle_list->id_recibo_detalle->headerCellClass() ?>"><div id="elh_recibo_detalle_id_recibo_detalle" class="recibo_detalle_id_recibo_detalle"><div class="ew-table-header-caption"><?php echo $recibo_detalle_list->id_recibo_detalle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_recibo_detalle" class="<?php echo $recibo_detalle_list->id_recibo_detalle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $recibo_detalle_list->SortUrl($recibo_detalle_list->id_recibo_detalle) ?>', 1);"><div id="elh_recibo_detalle_id_recibo_detalle" class="recibo_detalle_id_recibo_detalle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $recibo_detalle_list->id_recibo_detalle->caption() ?></span><span class="ew-table-header-sort"><?php if ($recibo_detalle_list->id_recibo_detalle->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($recibo_detalle_list->id_recibo_detalle->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($recibo_detalle_list->recibo_id->Visible) { // recibo_id ?>
	<?php if ($recibo_detalle_list->SortUrl($recibo_detalle_list->recibo_id) == "") { ?>
		<th data-name="recibo_id" class="<?php echo $recibo_detalle_list->recibo_id->headerCellClass() ?>"><div id="elh_recibo_detalle_recibo_id" class="recibo_detalle_recibo_id"><div class="ew-table-header-caption"><?php echo $recibo_detalle_list->recibo_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="recibo_id" class="<?php echo $recibo_detalle_list->recibo_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $recibo_detalle_list->SortUrl($recibo_detalle_list->recibo_id) ?>', 1);"><div id="elh_recibo_detalle_recibo_id" class="recibo_detalle_recibo_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $recibo_detalle_list->recibo_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($recibo_detalle_list->recibo_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($recibo_detalle_list->recibo_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($recibo_detalle_list->gastos_id->Visible) { // gastos_id ?>
	<?php if ($recibo_detalle_list->SortUrl($recibo_detalle_list->gastos_id) == "") { ?>
		<th data-name="gastos_id" class="<?php echo $recibo_detalle_list->gastos_id->headerCellClass() ?>"><div id="elh_recibo_detalle_gastos_id" class="recibo_detalle_gastos_id"><div class="ew-table-header-caption"><?php echo $recibo_detalle_list->gastos_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gastos_id" class="<?php echo $recibo_detalle_list->gastos_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $recibo_detalle_list->SortUrl($recibo_detalle_list->gastos_id) ?>', 1);"><div id="elh_recibo_detalle_gastos_id" class="recibo_detalle_gastos_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $recibo_detalle_list->gastos_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($recibo_detalle_list->gastos_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($recibo_detalle_list->gastos_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($recibo_detalle_list->cantidad->Visible) { // cantidad ?>
	<?php if ($recibo_detalle_list->SortUrl($recibo_detalle_list->cantidad) == "") { ?>
		<th data-name="cantidad" class="<?php echo $recibo_detalle_list->cantidad->headerCellClass() ?>"><div id="elh_recibo_detalle_cantidad" class="recibo_detalle_cantidad"><div class="ew-table-header-caption"><?php echo $recibo_detalle_list->cantidad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cantidad" class="<?php echo $recibo_detalle_list->cantidad->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $recibo_detalle_list->SortUrl($recibo_detalle_list->cantidad) ?>', 1);"><div id="elh_recibo_detalle_cantidad" class="recibo_detalle_cantidad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $recibo_detalle_list->cantidad->caption() ?></span><span class="ew-table-header-sort"><?php if ($recibo_detalle_list->cantidad->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($recibo_detalle_list->cantidad->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($recibo_detalle_list->precio->Visible) { // precio ?>
	<?php if ($recibo_detalle_list->SortUrl($recibo_detalle_list->precio) == "") { ?>
		<th data-name="precio" class="<?php echo $recibo_detalle_list->precio->headerCellClass() ?>"><div id="elh_recibo_detalle_precio" class="recibo_detalle_precio"><div class="ew-table-header-caption"><?php echo $recibo_detalle_list->precio->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="precio" class="<?php echo $recibo_detalle_list->precio->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $recibo_detalle_list->SortUrl($recibo_detalle_list->precio) ?>', 1);"><div id="elh_recibo_detalle_precio" class="recibo_detalle_precio">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $recibo_detalle_list->precio->caption() ?></span><span class="ew-table-header-sort"><?php if ($recibo_detalle_list->precio->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($recibo_detalle_list->precio->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($recibo_detalle_list->total->Visible) { // total ?>
	<?php if ($recibo_detalle_list->SortUrl($recibo_detalle_list->total) == "") { ?>
		<th data-name="total" class="<?php echo $recibo_detalle_list->total->headerCellClass() ?>"><div id="elh_recibo_detalle_total" class="recibo_detalle_total"><div class="ew-table-header-caption"><?php echo $recibo_detalle_list->total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total" class="<?php echo $recibo_detalle_list->total->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $recibo_detalle_list->SortUrl($recibo_detalle_list->total) ?>', 1);"><div id="elh_recibo_detalle_total" class="recibo_detalle_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $recibo_detalle_list->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($recibo_detalle_list->total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($recibo_detalle_list->total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$recibo_detalle_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($recibo_detalle_list->ExportAll && $recibo_detalle_list->isExport()) {
	$recibo_detalle_list->StopRecord = $recibo_detalle_list->TotalRecords;
} else {

	// Set the last record to display
	if ($recibo_detalle_list->TotalRecords > $recibo_detalle_list->StartRecord + $recibo_detalle_list->DisplayRecords - 1)
		$recibo_detalle_list->StopRecord = $recibo_detalle_list->StartRecord + $recibo_detalle_list->DisplayRecords - 1;
	else
		$recibo_detalle_list->StopRecord = $recibo_detalle_list->TotalRecords;
}
$recibo_detalle_list->RecordCount = $recibo_detalle_list->StartRecord - 1;
if ($recibo_detalle_list->Recordset && !$recibo_detalle_list->Recordset->EOF) {
	$recibo_detalle_list->Recordset->moveFirst();
	$selectLimit = $recibo_detalle_list->UseSelectLimit;
	if (!$selectLimit && $recibo_detalle_list->StartRecord > 1)
		$recibo_detalle_list->Recordset->move($recibo_detalle_list->StartRecord - 1);
} elseif (!$recibo_detalle->AllowAddDeleteRow && $recibo_detalle_list->StopRecord == 0) {
	$recibo_detalle_list->StopRecord = $recibo_detalle->GridAddRowCount;
}

// Initialize aggregate
$recibo_detalle->RowType = ROWTYPE_AGGREGATEINIT;
$recibo_detalle->resetAttributes();
$recibo_detalle_list->renderRow();
while ($recibo_detalle_list->RecordCount < $recibo_detalle_list->StopRecord) {
	$recibo_detalle_list->RecordCount++;
	if ($recibo_detalle_list->RecordCount >= $recibo_detalle_list->StartRecord) {
		$recibo_detalle_list->RowCount++;

		// Set up key count
		$recibo_detalle_list->KeyCount = $recibo_detalle_list->RowIndex;

		// Init row class and style
		$recibo_detalle->resetAttributes();
		$recibo_detalle->CssClass = "";
		if ($recibo_detalle_list->isGridAdd()) {
		} else {
			$recibo_detalle_list->loadRowValues($recibo_detalle_list->Recordset); // Load row values
		}
		$recibo_detalle->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$recibo_detalle->RowAttrs->merge(["data-rowindex" => $recibo_detalle_list->RowCount, "id" => "r" . $recibo_detalle_list->RowCount . "_recibo_detalle", "data-rowtype" => $recibo_detalle->RowType]);

		// Render row
		$recibo_detalle_list->renderRow();

		// Render list options
		$recibo_detalle_list->renderListOptions();
?>
	<tr <?php echo $recibo_detalle->rowAttributes() ?>>
<?php

// Render list options (body, left)
$recibo_detalle_list->ListOptions->render("body", "left", $recibo_detalle_list->RowCount);
?>
	<?php if ($recibo_detalle_list->id_recibo_detalle->Visible) { // id_recibo_detalle ?>
		<td data-name="id_recibo_detalle" <?php echo $recibo_detalle_list->id_recibo_detalle->cellAttributes() ?>>
<span id="el<?php echo $recibo_detalle_list->RowCount ?>_recibo_detalle_id_recibo_detalle">
<span<?php echo $recibo_detalle_list->id_recibo_detalle->viewAttributes() ?>><?php echo $recibo_detalle_list->id_recibo_detalle->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($recibo_detalle_list->recibo_id->Visible) { // recibo_id ?>
		<td data-name="recibo_id" <?php echo $recibo_detalle_list->recibo_id->cellAttributes() ?>>
<span id="el<?php echo $recibo_detalle_list->RowCount ?>_recibo_detalle_recibo_id">
<span<?php echo $recibo_detalle_list->recibo_id->viewAttributes() ?>><?php echo $recibo_detalle_list->recibo_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($recibo_detalle_list->gastos_id->Visible) { // gastos_id ?>
		<td data-name="gastos_id" <?php echo $recibo_detalle_list->gastos_id->cellAttributes() ?>>
<span id="el<?php echo $recibo_detalle_list->RowCount ?>_recibo_detalle_gastos_id">
<span<?php echo $recibo_detalle_list->gastos_id->viewAttributes() ?>><?php echo $recibo_detalle_list->gastos_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($recibo_detalle_list->cantidad->Visible) { // cantidad ?>
		<td data-name="cantidad" <?php echo $recibo_detalle_list->cantidad->cellAttributes() ?>>
<span id="el<?php echo $recibo_detalle_list->RowCount ?>_recibo_detalle_cantidad">
<span<?php echo $recibo_detalle_list->cantidad->viewAttributes() ?>><?php echo $recibo_detalle_list->cantidad->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($recibo_detalle_list->precio->Visible) { // precio ?>
		<td data-name="precio" <?php echo $recibo_detalle_list->precio->cellAttributes() ?>>
<span id="el<?php echo $recibo_detalle_list->RowCount ?>_recibo_detalle_precio">
<span<?php echo $recibo_detalle_list->precio->viewAttributes() ?>><?php echo $recibo_detalle_list->precio->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($recibo_detalle_list->total->Visible) { // total ?>
		<td data-name="total" <?php echo $recibo_detalle_list->total->cellAttributes() ?>>
<span id="el<?php echo $recibo_detalle_list->RowCount ?>_recibo_detalle_total">
<span<?php echo $recibo_detalle_list->total->viewAttributes() ?>><?php echo $recibo_detalle_list->total->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$recibo_detalle_list->ListOptions->render("body", "right", $recibo_detalle_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$recibo_detalle_list->isGridAdd())
		$recibo_detalle_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$recibo_detalle->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($recibo_detalle_list->Recordset)
	$recibo_detalle_list->Recordset->Close();
?>
<?php if (!$recibo_detalle_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$recibo_detalle_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $recibo_detalle_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $recibo_detalle_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($recibo_detalle_list->TotalRecords == 0 && !$recibo_detalle->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $recibo_detalle_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$recibo_detalle_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$recibo_detalle_list->isExport()) { ?>
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
$recibo_detalle_list->terminate();
?>