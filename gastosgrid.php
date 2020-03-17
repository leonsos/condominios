<?php
namespace PHPMaker2020\condominios;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($gastos_grid))
	$gastos_grid = new gastos_grid();

// Run the page
$gastos_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gastos_grid->Page_Render();
?>
<?php if (!$gastos_grid->isExport()) { ?>
<script>
var fgastosgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fgastosgrid = new ew.Form("fgastosgrid", "grid");
	fgastosgrid.formKeyCountName = '<?php echo $gastos_grid->FormKeyCountName ?>';

	// Validate form
	fgastosgrid.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "F")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($gastos_grid->id_gasto->Required) { ?>
				elm = this.getElements("x" + infix + "_id_gasto");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gastos_grid->id_gasto->caption(), $gastos_grid->id_gasto->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gastos_grid->tipo_gasto_id->Required) { ?>
				elm = this.getElements("x" + infix + "_tipo_gasto_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gastos_grid->tipo_gasto_id->caption(), $gastos_grid->tipo_gasto_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tipo_gasto_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gastos_grid->tipo_gasto_id->errorMessage()) ?>");
			<?php if ($gastos_grid->monto->Required) { ?>
				elm = this.getElements("x" + infix + "_monto");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gastos_grid->monto->caption(), $gastos_grid->monto->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_monto");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gastos_grid->monto->errorMessage()) ?>");
			<?php if ($gastos_grid->condo_mens_id->Required) { ?>
				elm = this.getElements("x" + infix + "_condo_mens_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gastos_grid->condo_mens_id->caption(), $gastos_grid->condo_mens_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_condo_mens_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gastos_grid->condo_mens_id->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fgastosgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "tipo_gasto_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "monto", false)) return false;
		if (ew.valueChanged(fobj, infix, "condo_mens_id", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fgastosgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgastosgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fgastosgrid");
});
</script>
<?php } ?>
<?php
$gastos_grid->renderOtherOptions();
?>
<?php if ($gastos_grid->TotalRecords > 0 || $gastos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gastos_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gastos">
<div id="fgastosgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_gastos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_gastosgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gastos->RowType = ROWTYPE_HEADER;

// Render list options
$gastos_grid->renderListOptions();

// Render list options (header, left)
$gastos_grid->ListOptions->render("header", "left");
?>
<?php if ($gastos_grid->id_gasto->Visible) { // id_gasto ?>
	<?php if ($gastos_grid->SortUrl($gastos_grid->id_gasto) == "") { ?>
		<th data-name="id_gasto" class="<?php echo $gastos_grid->id_gasto->headerCellClass() ?>"><div id="elh_gastos_id_gasto" class="gastos_id_gasto"><div class="ew-table-header-caption"><?php echo $gastos_grid->id_gasto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_gasto" class="<?php echo $gastos_grid->id_gasto->headerCellClass() ?>"><div><div id="elh_gastos_id_gasto" class="gastos_id_gasto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gastos_grid->id_gasto->caption() ?></span><span class="ew-table-header-sort"><?php if ($gastos_grid->id_gasto->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gastos_grid->id_gasto->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gastos_grid->tipo_gasto_id->Visible) { // tipo_gasto_id ?>
	<?php if ($gastos_grid->SortUrl($gastos_grid->tipo_gasto_id) == "") { ?>
		<th data-name="tipo_gasto_id" class="<?php echo $gastos_grid->tipo_gasto_id->headerCellClass() ?>"><div id="elh_gastos_tipo_gasto_id" class="gastos_tipo_gasto_id"><div class="ew-table-header-caption"><?php echo $gastos_grid->tipo_gasto_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipo_gasto_id" class="<?php echo $gastos_grid->tipo_gasto_id->headerCellClass() ?>"><div><div id="elh_gastos_tipo_gasto_id" class="gastos_tipo_gasto_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gastos_grid->tipo_gasto_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gastos_grid->tipo_gasto_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gastos_grid->tipo_gasto_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gastos_grid->monto->Visible) { // monto ?>
	<?php if ($gastos_grid->SortUrl($gastos_grid->monto) == "") { ?>
		<th data-name="monto" class="<?php echo $gastos_grid->monto->headerCellClass() ?>"><div id="elh_gastos_monto" class="gastos_monto"><div class="ew-table-header-caption"><?php echo $gastos_grid->monto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto" class="<?php echo $gastos_grid->monto->headerCellClass() ?>"><div><div id="elh_gastos_monto" class="gastos_monto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gastos_grid->monto->caption() ?></span><span class="ew-table-header-sort"><?php if ($gastos_grid->monto->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gastos_grid->monto->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gastos_grid->condo_mens_id->Visible) { // condo_mens_id ?>
	<?php if ($gastos_grid->SortUrl($gastos_grid->condo_mens_id) == "") { ?>
		<th data-name="condo_mens_id" class="<?php echo $gastos_grid->condo_mens_id->headerCellClass() ?>"><div id="elh_gastos_condo_mens_id" class="gastos_condo_mens_id"><div class="ew-table-header-caption"><?php echo $gastos_grid->condo_mens_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="condo_mens_id" class="<?php echo $gastos_grid->condo_mens_id->headerCellClass() ?>"><div><div id="elh_gastos_condo_mens_id" class="gastos_condo_mens_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gastos_grid->condo_mens_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gastos_grid->condo_mens_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gastos_grid->condo_mens_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gastos_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$gastos_grid->StartRecord = 1;
$gastos_grid->StopRecord = $gastos_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($gastos->isConfirm() || $gastos_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($gastos_grid->FormKeyCountName) && ($gastos_grid->isGridAdd() || $gastos_grid->isGridEdit() || $gastos->isConfirm())) {
		$gastos_grid->KeyCount = $CurrentForm->getValue($gastos_grid->FormKeyCountName);
		$gastos_grid->StopRecord = $gastos_grid->StartRecord + $gastos_grid->KeyCount - 1;
	}
}
$gastos_grid->RecordCount = $gastos_grid->StartRecord - 1;
if ($gastos_grid->Recordset && !$gastos_grid->Recordset->EOF) {
	$gastos_grid->Recordset->moveFirst();
	$selectLimit = $gastos_grid->UseSelectLimit;
	if (!$selectLimit && $gastos_grid->StartRecord > 1)
		$gastos_grid->Recordset->move($gastos_grid->StartRecord - 1);
} elseif (!$gastos->AllowAddDeleteRow && $gastos_grid->StopRecord == 0) {
	$gastos_grid->StopRecord = $gastos->GridAddRowCount;
}

// Initialize aggregate
$gastos->RowType = ROWTYPE_AGGREGATEINIT;
$gastos->resetAttributes();
$gastos_grid->renderRow();
if ($gastos_grid->isGridAdd())
	$gastos_grid->RowIndex = 0;
if ($gastos_grid->isGridEdit())
	$gastos_grid->RowIndex = 0;
while ($gastos_grid->RecordCount < $gastos_grid->StopRecord) {
	$gastos_grid->RecordCount++;
	if ($gastos_grid->RecordCount >= $gastos_grid->StartRecord) {
		$gastos_grid->RowCount++;
		if ($gastos_grid->isGridAdd() || $gastos_grid->isGridEdit() || $gastos->isConfirm()) {
			$gastos_grid->RowIndex++;
			$CurrentForm->Index = $gastos_grid->RowIndex;
			if ($CurrentForm->hasValue($gastos_grid->FormActionName) && ($gastos->isConfirm() || $gastos_grid->EventCancelled))
				$gastos_grid->RowAction = strval($CurrentForm->getValue($gastos_grid->FormActionName));
			elseif ($gastos_grid->isGridAdd())
				$gastos_grid->RowAction = "insert";
			else
				$gastos_grid->RowAction = "";
		}

		// Set up key count
		$gastos_grid->KeyCount = $gastos_grid->RowIndex;

		// Init row class and style
		$gastos->resetAttributes();
		$gastos->CssClass = "";
		if ($gastos_grid->isGridAdd()) {
			if ($gastos->CurrentMode == "copy") {
				$gastos_grid->loadRowValues($gastos_grid->Recordset); // Load row values
				$gastos_grid->setRecordKey($gastos_grid->RowOldKey, $gastos_grid->Recordset); // Set old record key
			} else {
				$gastos_grid->loadRowValues(); // Load default values
				$gastos_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$gastos_grid->loadRowValues($gastos_grid->Recordset); // Load row values
		}
		$gastos->RowType = ROWTYPE_VIEW; // Render view
		if ($gastos_grid->isGridAdd()) // Grid add
			$gastos->RowType = ROWTYPE_ADD; // Render add
		if ($gastos_grid->isGridAdd() && $gastos->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$gastos_grid->restoreCurrentRowFormValues($gastos_grid->RowIndex); // Restore form values
		if ($gastos_grid->isGridEdit()) { // Grid edit
			if ($gastos->EventCancelled)
				$gastos_grid->restoreCurrentRowFormValues($gastos_grid->RowIndex); // Restore form values
			if ($gastos_grid->RowAction == "insert")
				$gastos->RowType = ROWTYPE_ADD; // Render add
			else
				$gastos->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($gastos_grid->isGridEdit() && ($gastos->RowType == ROWTYPE_EDIT || $gastos->RowType == ROWTYPE_ADD) && $gastos->EventCancelled) // Update failed
			$gastos_grid->restoreCurrentRowFormValues($gastos_grid->RowIndex); // Restore form values
		if ($gastos->RowType == ROWTYPE_EDIT) // Edit row
			$gastos_grid->EditRowCount++;
		if ($gastos->isConfirm()) // Confirm row
			$gastos_grid->restoreCurrentRowFormValues($gastos_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$gastos->RowAttrs->merge(["data-rowindex" => $gastos_grid->RowCount, "id" => "r" . $gastos_grid->RowCount . "_gastos", "data-rowtype" => $gastos->RowType]);

		// Render row
		$gastos_grid->renderRow();

		// Render list options
		$gastos_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($gastos_grid->RowAction != "delete" && $gastos_grid->RowAction != "insertdelete" && !($gastos_grid->RowAction == "insert" && $gastos->isConfirm() && $gastos_grid->emptyRow())) {
?>
	<tr <?php echo $gastos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gastos_grid->ListOptions->render("body", "left", $gastos_grid->RowCount);
?>
	<?php if ($gastos_grid->id_gasto->Visible) { // id_gasto ?>
		<td data-name="id_gasto" <?php echo $gastos_grid->id_gasto->cellAttributes() ?>>
<?php if ($gastos->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gastos_grid->RowCount ?>_gastos_id_gasto" class="form-group"></span>
<input type="hidden" data-table="gastos" data-field="x_id_gasto" name="o<?php echo $gastos_grid->RowIndex ?>_id_gasto" id="o<?php echo $gastos_grid->RowIndex ?>_id_gasto" value="<?php echo HtmlEncode($gastos_grid->id_gasto->OldValue) ?>">
<?php } ?>
<?php if ($gastos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gastos_grid->RowCount ?>_gastos_id_gasto" class="form-group">
<span<?php echo $gastos_grid->id_gasto->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gastos_grid->id_gasto->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="gastos" data-field="x_id_gasto" name="x<?php echo $gastos_grid->RowIndex ?>_id_gasto" id="x<?php echo $gastos_grid->RowIndex ?>_id_gasto" value="<?php echo HtmlEncode($gastos_grid->id_gasto->CurrentValue) ?>">
<?php } ?>
<?php if ($gastos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gastos_grid->RowCount ?>_gastos_id_gasto">
<span<?php echo $gastos_grid->id_gasto->viewAttributes() ?>><?php echo $gastos_grid->id_gasto->getViewValue() ?></span>
</span>
<?php if (!$gastos->isConfirm()) { ?>
<input type="hidden" data-table="gastos" data-field="x_id_gasto" name="x<?php echo $gastos_grid->RowIndex ?>_id_gasto" id="x<?php echo $gastos_grid->RowIndex ?>_id_gasto" value="<?php echo HtmlEncode($gastos_grid->id_gasto->FormValue) ?>">
<input type="hidden" data-table="gastos" data-field="x_id_gasto" name="o<?php echo $gastos_grid->RowIndex ?>_id_gasto" id="o<?php echo $gastos_grid->RowIndex ?>_id_gasto" value="<?php echo HtmlEncode($gastos_grid->id_gasto->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gastos" data-field="x_id_gasto" name="fgastosgrid$x<?php echo $gastos_grid->RowIndex ?>_id_gasto" id="fgastosgrid$x<?php echo $gastos_grid->RowIndex ?>_id_gasto" value="<?php echo HtmlEncode($gastos_grid->id_gasto->FormValue) ?>">
<input type="hidden" data-table="gastos" data-field="x_id_gasto" name="fgastosgrid$o<?php echo $gastos_grid->RowIndex ?>_id_gasto" id="fgastosgrid$o<?php echo $gastos_grid->RowIndex ?>_id_gasto" value="<?php echo HtmlEncode($gastos_grid->id_gasto->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gastos_grid->tipo_gasto_id->Visible) { // tipo_gasto_id ?>
		<td data-name="tipo_gasto_id" <?php echo $gastos_grid->tipo_gasto_id->cellAttributes() ?>>
<?php if ($gastos->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gastos_grid->RowCount ?>_gastos_tipo_gasto_id" class="form-group">
<input type="text" data-table="gastos" data-field="x_tipo_gasto_id" name="x<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" id="x<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gastos_grid->tipo_gasto_id->getPlaceHolder()) ?>" value="<?php echo $gastos_grid->tipo_gasto_id->EditValue ?>"<?php echo $gastos_grid->tipo_gasto_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gastos" data-field="x_tipo_gasto_id" name="o<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" id="o<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" value="<?php echo HtmlEncode($gastos_grid->tipo_gasto_id->OldValue) ?>">
<?php } ?>
<?php if ($gastos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gastos_grid->RowCount ?>_gastos_tipo_gasto_id" class="form-group">
<input type="text" data-table="gastos" data-field="x_tipo_gasto_id" name="x<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" id="x<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gastos_grid->tipo_gasto_id->getPlaceHolder()) ?>" value="<?php echo $gastos_grid->tipo_gasto_id->EditValue ?>"<?php echo $gastos_grid->tipo_gasto_id->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gastos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gastos_grid->RowCount ?>_gastos_tipo_gasto_id">
<span<?php echo $gastos_grid->tipo_gasto_id->viewAttributes() ?>><?php echo $gastos_grid->tipo_gasto_id->getViewValue() ?></span>
</span>
<?php if (!$gastos->isConfirm()) { ?>
<input type="hidden" data-table="gastos" data-field="x_tipo_gasto_id" name="x<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" id="x<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" value="<?php echo HtmlEncode($gastos_grid->tipo_gasto_id->FormValue) ?>">
<input type="hidden" data-table="gastos" data-field="x_tipo_gasto_id" name="o<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" id="o<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" value="<?php echo HtmlEncode($gastos_grid->tipo_gasto_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gastos" data-field="x_tipo_gasto_id" name="fgastosgrid$x<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" id="fgastosgrid$x<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" value="<?php echo HtmlEncode($gastos_grid->tipo_gasto_id->FormValue) ?>">
<input type="hidden" data-table="gastos" data-field="x_tipo_gasto_id" name="fgastosgrid$o<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" id="fgastosgrid$o<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" value="<?php echo HtmlEncode($gastos_grid->tipo_gasto_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gastos_grid->monto->Visible) { // monto ?>
		<td data-name="monto" <?php echo $gastos_grid->monto->cellAttributes() ?>>
<?php if ($gastos->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gastos_grid->RowCount ?>_gastos_monto" class="form-group">
<input type="text" data-table="gastos" data-field="x_monto" name="x<?php echo $gastos_grid->RowIndex ?>_monto" id="x<?php echo $gastos_grid->RowIndex ?>_monto" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($gastos_grid->monto->getPlaceHolder()) ?>" value="<?php echo $gastos_grid->monto->EditValue ?>"<?php echo $gastos_grid->monto->editAttributes() ?>>
</span>
<input type="hidden" data-table="gastos" data-field="x_monto" name="o<?php echo $gastos_grid->RowIndex ?>_monto" id="o<?php echo $gastos_grid->RowIndex ?>_monto" value="<?php echo HtmlEncode($gastos_grid->monto->OldValue) ?>">
<?php } ?>
<?php if ($gastos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gastos_grid->RowCount ?>_gastos_monto" class="form-group">
<input type="text" data-table="gastos" data-field="x_monto" name="x<?php echo $gastos_grid->RowIndex ?>_monto" id="x<?php echo $gastos_grid->RowIndex ?>_monto" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($gastos_grid->monto->getPlaceHolder()) ?>" value="<?php echo $gastos_grid->monto->EditValue ?>"<?php echo $gastos_grid->monto->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gastos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gastos_grid->RowCount ?>_gastos_monto">
<span<?php echo $gastos_grid->monto->viewAttributes() ?>><?php echo $gastos_grid->monto->getViewValue() ?></span>
</span>
<?php if (!$gastos->isConfirm()) { ?>
<input type="hidden" data-table="gastos" data-field="x_monto" name="x<?php echo $gastos_grid->RowIndex ?>_monto" id="x<?php echo $gastos_grid->RowIndex ?>_monto" value="<?php echo HtmlEncode($gastos_grid->monto->FormValue) ?>">
<input type="hidden" data-table="gastos" data-field="x_monto" name="o<?php echo $gastos_grid->RowIndex ?>_monto" id="o<?php echo $gastos_grid->RowIndex ?>_monto" value="<?php echo HtmlEncode($gastos_grid->monto->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gastos" data-field="x_monto" name="fgastosgrid$x<?php echo $gastos_grid->RowIndex ?>_monto" id="fgastosgrid$x<?php echo $gastos_grid->RowIndex ?>_monto" value="<?php echo HtmlEncode($gastos_grid->monto->FormValue) ?>">
<input type="hidden" data-table="gastos" data-field="x_monto" name="fgastosgrid$o<?php echo $gastos_grid->RowIndex ?>_monto" id="fgastosgrid$o<?php echo $gastos_grid->RowIndex ?>_monto" value="<?php echo HtmlEncode($gastos_grid->monto->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gastos_grid->condo_mens_id->Visible) { // condo_mens_id ?>
		<td data-name="condo_mens_id" <?php echo $gastos_grid->condo_mens_id->cellAttributes() ?>>
<?php if ($gastos->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($gastos_grid->condo_mens_id->getSessionValue() != "") { ?>
<span id="el<?php echo $gastos_grid->RowCount ?>_gastos_condo_mens_id" class="form-group">
<span<?php echo $gastos_grid->condo_mens_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gastos_grid->condo_mens_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" name="x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" value="<?php echo HtmlEncode($gastos_grid->condo_mens_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $gastos_grid->RowCount ?>_gastos_condo_mens_id" class="form-group">
<input type="text" data-table="gastos" data-field="x_condo_mens_id" name="x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" id="x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gastos_grid->condo_mens_id->getPlaceHolder()) ?>" value="<?php echo $gastos_grid->condo_mens_id->EditValue ?>"<?php echo $gastos_grid->condo_mens_id->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="gastos" data-field="x_condo_mens_id" name="o<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" id="o<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" value="<?php echo HtmlEncode($gastos_grid->condo_mens_id->OldValue) ?>">
<?php } ?>
<?php if ($gastos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($gastos_grid->condo_mens_id->getSessionValue() != "") { ?>
<span id="el<?php echo $gastos_grid->RowCount ?>_gastos_condo_mens_id" class="form-group">
<span<?php echo $gastos_grid->condo_mens_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gastos_grid->condo_mens_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" name="x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" value="<?php echo HtmlEncode($gastos_grid->condo_mens_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $gastos_grid->RowCount ?>_gastos_condo_mens_id" class="form-group">
<input type="text" data-table="gastos" data-field="x_condo_mens_id" name="x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" id="x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gastos_grid->condo_mens_id->getPlaceHolder()) ?>" value="<?php echo $gastos_grid->condo_mens_id->EditValue ?>"<?php echo $gastos_grid->condo_mens_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($gastos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gastos_grid->RowCount ?>_gastos_condo_mens_id">
<span<?php echo $gastos_grid->condo_mens_id->viewAttributes() ?>><?php echo $gastos_grid->condo_mens_id->getViewValue() ?></span>
</span>
<?php if (!$gastos->isConfirm()) { ?>
<input type="hidden" data-table="gastos" data-field="x_condo_mens_id" name="x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" id="x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" value="<?php echo HtmlEncode($gastos_grid->condo_mens_id->FormValue) ?>">
<input type="hidden" data-table="gastos" data-field="x_condo_mens_id" name="o<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" id="o<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" value="<?php echo HtmlEncode($gastos_grid->condo_mens_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gastos" data-field="x_condo_mens_id" name="fgastosgrid$x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" id="fgastosgrid$x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" value="<?php echo HtmlEncode($gastos_grid->condo_mens_id->FormValue) ?>">
<input type="hidden" data-table="gastos" data-field="x_condo_mens_id" name="fgastosgrid$o<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" id="fgastosgrid$o<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" value="<?php echo HtmlEncode($gastos_grid->condo_mens_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gastos_grid->ListOptions->render("body", "right", $gastos_grid->RowCount);
?>
	</tr>
<?php if ($gastos->RowType == ROWTYPE_ADD || $gastos->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fgastosgrid", "load"], function() {
	fgastosgrid.updateLists(<?php echo $gastos_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$gastos_grid->isGridAdd() || $gastos->CurrentMode == "copy")
		if (!$gastos_grid->Recordset->EOF)
			$gastos_grid->Recordset->moveNext();
}
?>
<?php
	if ($gastos->CurrentMode == "add" || $gastos->CurrentMode == "copy" || $gastos->CurrentMode == "edit") {
		$gastos_grid->RowIndex = '$rowindex$';
		$gastos_grid->loadRowValues();

		// Set row properties
		$gastos->resetAttributes();
		$gastos->RowAttrs->merge(["data-rowindex" => $gastos_grid->RowIndex, "id" => "r0_gastos", "data-rowtype" => ROWTYPE_ADD]);
		$gastos->RowAttrs->appendClass("ew-template");
		$gastos->RowType = ROWTYPE_ADD;

		// Render row
		$gastos_grid->renderRow();

		// Render list options
		$gastos_grid->renderListOptions();
		$gastos_grid->StartRowCount = 0;
?>
	<tr <?php echo $gastos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gastos_grid->ListOptions->render("body", "left", $gastos_grid->RowIndex);
?>
	<?php if ($gastos_grid->id_gasto->Visible) { // id_gasto ?>
		<td data-name="id_gasto">
<?php if (!$gastos->isConfirm()) { ?>
<span id="el$rowindex$_gastos_id_gasto" class="form-group gastos_id_gasto"></span>
<?php } else { ?>
<span id="el$rowindex$_gastos_id_gasto" class="form-group gastos_id_gasto">
<span<?php echo $gastos_grid->id_gasto->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gastos_grid->id_gasto->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gastos" data-field="x_id_gasto" name="x<?php echo $gastos_grid->RowIndex ?>_id_gasto" id="x<?php echo $gastos_grid->RowIndex ?>_id_gasto" value="<?php echo HtmlEncode($gastos_grid->id_gasto->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gastos" data-field="x_id_gasto" name="o<?php echo $gastos_grid->RowIndex ?>_id_gasto" id="o<?php echo $gastos_grid->RowIndex ?>_id_gasto" value="<?php echo HtmlEncode($gastos_grid->id_gasto->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gastos_grid->tipo_gasto_id->Visible) { // tipo_gasto_id ?>
		<td data-name="tipo_gasto_id">
<?php if (!$gastos->isConfirm()) { ?>
<span id="el$rowindex$_gastos_tipo_gasto_id" class="form-group gastos_tipo_gasto_id">
<input type="text" data-table="gastos" data-field="x_tipo_gasto_id" name="x<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" id="x<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gastos_grid->tipo_gasto_id->getPlaceHolder()) ?>" value="<?php echo $gastos_grid->tipo_gasto_id->EditValue ?>"<?php echo $gastos_grid->tipo_gasto_id->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gastos_tipo_gasto_id" class="form-group gastos_tipo_gasto_id">
<span<?php echo $gastos_grid->tipo_gasto_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gastos_grid->tipo_gasto_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gastos" data-field="x_tipo_gasto_id" name="x<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" id="x<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" value="<?php echo HtmlEncode($gastos_grid->tipo_gasto_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gastos" data-field="x_tipo_gasto_id" name="o<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" id="o<?php echo $gastos_grid->RowIndex ?>_tipo_gasto_id" value="<?php echo HtmlEncode($gastos_grid->tipo_gasto_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gastos_grid->monto->Visible) { // monto ?>
		<td data-name="monto">
<?php if (!$gastos->isConfirm()) { ?>
<span id="el$rowindex$_gastos_monto" class="form-group gastos_monto">
<input type="text" data-table="gastos" data-field="x_monto" name="x<?php echo $gastos_grid->RowIndex ?>_monto" id="x<?php echo $gastos_grid->RowIndex ?>_monto" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($gastos_grid->monto->getPlaceHolder()) ?>" value="<?php echo $gastos_grid->monto->EditValue ?>"<?php echo $gastos_grid->monto->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gastos_monto" class="form-group gastos_monto">
<span<?php echo $gastos_grid->monto->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gastos_grid->monto->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gastos" data-field="x_monto" name="x<?php echo $gastos_grid->RowIndex ?>_monto" id="x<?php echo $gastos_grid->RowIndex ?>_monto" value="<?php echo HtmlEncode($gastos_grid->monto->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gastos" data-field="x_monto" name="o<?php echo $gastos_grid->RowIndex ?>_monto" id="o<?php echo $gastos_grid->RowIndex ?>_monto" value="<?php echo HtmlEncode($gastos_grid->monto->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gastos_grid->condo_mens_id->Visible) { // condo_mens_id ?>
		<td data-name="condo_mens_id">
<?php if (!$gastos->isConfirm()) { ?>
<?php if ($gastos_grid->condo_mens_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_gastos_condo_mens_id" class="form-group gastos_condo_mens_id">
<span<?php echo $gastos_grid->condo_mens_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gastos_grid->condo_mens_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" name="x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" value="<?php echo HtmlEncode($gastos_grid->condo_mens_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_gastos_condo_mens_id" class="form-group gastos_condo_mens_id">
<input type="text" data-table="gastos" data-field="x_condo_mens_id" name="x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" id="x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gastos_grid->condo_mens_id->getPlaceHolder()) ?>" value="<?php echo $gastos_grid->condo_mens_id->EditValue ?>"<?php echo $gastos_grid->condo_mens_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_gastos_condo_mens_id" class="form-group gastos_condo_mens_id">
<span<?php echo $gastos_grid->condo_mens_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gastos_grid->condo_mens_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gastos" data-field="x_condo_mens_id" name="x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" id="x<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" value="<?php echo HtmlEncode($gastos_grid->condo_mens_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gastos" data-field="x_condo_mens_id" name="o<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" id="o<?php echo $gastos_grid->RowIndex ?>_condo_mens_id" value="<?php echo HtmlEncode($gastos_grid->condo_mens_id->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gastos_grid->ListOptions->render("body", "right", $gastos_grid->RowIndex);
?>
<script>
loadjs.ready(["fgastosgrid", "load"], function() {
	fgastosgrid.updateLists(<?php echo $gastos_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($gastos->CurrentMode == "add" || $gastos->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $gastos_grid->FormKeyCountName ?>" id="<?php echo $gastos_grid->FormKeyCountName ?>" value="<?php echo $gastos_grid->KeyCount ?>">
<?php echo $gastos_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($gastos->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $gastos_grid->FormKeyCountName ?>" id="<?php echo $gastos_grid->FormKeyCountName ?>" value="<?php echo $gastos_grid->KeyCount ?>">
<?php echo $gastos_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($gastos->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fgastosgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gastos_grid->Recordset)
	$gastos_grid->Recordset->Close();
?>
<?php if ($gastos_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $gastos_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gastos_grid->TotalRecords == 0 && !$gastos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gastos_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$gastos_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$gastos_grid->terminate();
?>