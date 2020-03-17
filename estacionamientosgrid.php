<?php
namespace PHPMaker2020\condominios;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($estacionamientos_grid))
	$estacionamientos_grid = new estacionamientos_grid();

// Run the page
$estacionamientos_grid->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$estacionamientos_grid->Page_Render();
?>
<?php if (!$estacionamientos_grid->isExport()) { ?>
<script>
var festacionamientosgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	festacionamientosgrid = new ew.Form("festacionamientosgrid", "grid");
	festacionamientosgrid.formKeyCountName = '<?php echo $estacionamientos_grid->FormKeyCountName ?>';

	// Validate form
	festacionamientosgrid.validate = function() {
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
			<?php if ($estacionamientos_grid->id_estacionamiento->Required) { ?>
				elm = this.getElements("x" + infix + "_id_estacionamiento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $estacionamientos_grid->id_estacionamiento->caption(), $estacionamientos_grid->id_estacionamiento->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($estacionamientos_grid->nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $estacionamientos_grid->nombre->caption(), $estacionamientos_grid->nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($estacionamientos_grid->apartamento_id->Required) { ?>
				elm = this.getElements("x" + infix + "_apartamento_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $estacionamientos_grid->apartamento_id->caption(), $estacionamientos_grid->apartamento_id->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	festacionamientosgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "nombre", false)) return false;
		if (ew.valueChanged(fobj, infix, "apartamento_id", false)) return false;
		return true;
	}

	// Form_CustomValidate
	festacionamientosgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	festacionamientosgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	festacionamientosgrid.lists["x_apartamento_id"] = <?php echo $estacionamientos_grid->apartamento_id->Lookup->toClientList($estacionamientos_grid) ?>;
	festacionamientosgrid.lists["x_apartamento_id"].options = <?php echo JsonEncode($estacionamientos_grid->apartamento_id->lookupOptions()) ?>;
	loadjs.done("festacionamientosgrid");
});
</script>
<?php } ?>
<?php
$estacionamientos_grid->renderOtherOptions();
?>
<?php if ($estacionamientos_grid->TotalRecords > 0 || $estacionamientos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($estacionamientos_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> estacionamientos">
<div id="festacionamientosgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_estacionamientos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_estacionamientosgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$estacionamientos->RowType = ROWTYPE_HEADER;

// Render list options
$estacionamientos_grid->renderListOptions();

// Render list options (header, left)
$estacionamientos_grid->ListOptions->render("header", "left");
?>
<?php if ($estacionamientos_grid->id_estacionamiento->Visible) { // id_estacionamiento ?>
	<?php if ($estacionamientos_grid->SortUrl($estacionamientos_grid->id_estacionamiento) == "") { ?>
		<th data-name="id_estacionamiento" class="<?php echo $estacionamientos_grid->id_estacionamiento->headerCellClass() ?>"><div id="elh_estacionamientos_id_estacionamiento" class="estacionamientos_id_estacionamiento"><div class="ew-table-header-caption"><?php echo $estacionamientos_grid->id_estacionamiento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_estacionamiento" class="<?php echo $estacionamientos_grid->id_estacionamiento->headerCellClass() ?>"><div><div id="elh_estacionamientos_id_estacionamiento" class="estacionamientos_id_estacionamiento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $estacionamientos_grid->id_estacionamiento->caption() ?></span><span class="ew-table-header-sort"><?php if ($estacionamientos_grid->id_estacionamiento->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($estacionamientos_grid->id_estacionamiento->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($estacionamientos_grid->nombre->Visible) { // nombre ?>
	<?php if ($estacionamientos_grid->SortUrl($estacionamientos_grid->nombre) == "") { ?>
		<th data-name="nombre" class="<?php echo $estacionamientos_grid->nombre->headerCellClass() ?>"><div id="elh_estacionamientos_nombre" class="estacionamientos_nombre"><div class="ew-table-header-caption"><?php echo $estacionamientos_grid->nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre" class="<?php echo $estacionamientos_grid->nombre->headerCellClass() ?>"><div><div id="elh_estacionamientos_nombre" class="estacionamientos_nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $estacionamientos_grid->nombre->caption() ?></span><span class="ew-table-header-sort"><?php if ($estacionamientos_grid->nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($estacionamientos_grid->nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($estacionamientos_grid->apartamento_id->Visible) { // apartamento_id ?>
	<?php if ($estacionamientos_grid->SortUrl($estacionamientos_grid->apartamento_id) == "") { ?>
		<th data-name="apartamento_id" class="<?php echo $estacionamientos_grid->apartamento_id->headerCellClass() ?>"><div id="elh_estacionamientos_apartamento_id" class="estacionamientos_apartamento_id"><div class="ew-table-header-caption"><?php echo $estacionamientos_grid->apartamento_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="apartamento_id" class="<?php echo $estacionamientos_grid->apartamento_id->headerCellClass() ?>"><div><div id="elh_estacionamientos_apartamento_id" class="estacionamientos_apartamento_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $estacionamientos_grid->apartamento_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($estacionamientos_grid->apartamento_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($estacionamientos_grid->apartamento_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$estacionamientos_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$estacionamientos_grid->StartRecord = 1;
$estacionamientos_grid->StopRecord = $estacionamientos_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($estacionamientos->isConfirm() || $estacionamientos_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($estacionamientos_grid->FormKeyCountName) && ($estacionamientos_grid->isGridAdd() || $estacionamientos_grid->isGridEdit() || $estacionamientos->isConfirm())) {
		$estacionamientos_grid->KeyCount = $CurrentForm->getValue($estacionamientos_grid->FormKeyCountName);
		$estacionamientos_grid->StopRecord = $estacionamientos_grid->StartRecord + $estacionamientos_grid->KeyCount - 1;
	}
}
$estacionamientos_grid->RecordCount = $estacionamientos_grid->StartRecord - 1;
if ($estacionamientos_grid->Recordset && !$estacionamientos_grid->Recordset->EOF) {
	$estacionamientos_grid->Recordset->moveFirst();
	$selectLimit = $estacionamientos_grid->UseSelectLimit;
	if (!$selectLimit && $estacionamientos_grid->StartRecord > 1)
		$estacionamientos_grid->Recordset->move($estacionamientos_grid->StartRecord - 1);
} elseif (!$estacionamientos->AllowAddDeleteRow && $estacionamientos_grid->StopRecord == 0) {
	$estacionamientos_grid->StopRecord = $estacionamientos->GridAddRowCount;
}

// Initialize aggregate
$estacionamientos->RowType = ROWTYPE_AGGREGATEINIT;
$estacionamientos->resetAttributes();
$estacionamientos_grid->renderRow();
if ($estacionamientos_grid->isGridAdd())
	$estacionamientos_grid->RowIndex = 0;
if ($estacionamientos_grid->isGridEdit())
	$estacionamientos_grid->RowIndex = 0;
while ($estacionamientos_grid->RecordCount < $estacionamientos_grid->StopRecord) {
	$estacionamientos_grid->RecordCount++;
	if ($estacionamientos_grid->RecordCount >= $estacionamientos_grid->StartRecord) {
		$estacionamientos_grid->RowCount++;
		if ($estacionamientos_grid->isGridAdd() || $estacionamientos_grid->isGridEdit() || $estacionamientos->isConfirm()) {
			$estacionamientos_grid->RowIndex++;
			$CurrentForm->Index = $estacionamientos_grid->RowIndex;
			if ($CurrentForm->hasValue($estacionamientos_grid->FormActionName) && ($estacionamientos->isConfirm() || $estacionamientos_grid->EventCancelled))
				$estacionamientos_grid->RowAction = strval($CurrentForm->getValue($estacionamientos_grid->FormActionName));
			elseif ($estacionamientos_grid->isGridAdd())
				$estacionamientos_grid->RowAction = "insert";
			else
				$estacionamientos_grid->RowAction = "";
		}

		// Set up key count
		$estacionamientos_grid->KeyCount = $estacionamientos_grid->RowIndex;

		// Init row class and style
		$estacionamientos->resetAttributes();
		$estacionamientos->CssClass = "";
		if ($estacionamientos_grid->isGridAdd()) {
			if ($estacionamientos->CurrentMode == "copy") {
				$estacionamientos_grid->loadRowValues($estacionamientos_grid->Recordset); // Load row values
				$estacionamientos_grid->setRecordKey($estacionamientos_grid->RowOldKey, $estacionamientos_grid->Recordset); // Set old record key
			} else {
				$estacionamientos_grid->loadRowValues(); // Load default values
				$estacionamientos_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$estacionamientos_grid->loadRowValues($estacionamientos_grid->Recordset); // Load row values
		}
		$estacionamientos->RowType = ROWTYPE_VIEW; // Render view
		if ($estacionamientos_grid->isGridAdd()) // Grid add
			$estacionamientos->RowType = ROWTYPE_ADD; // Render add
		if ($estacionamientos_grid->isGridAdd() && $estacionamientos->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$estacionamientos_grid->restoreCurrentRowFormValues($estacionamientos_grid->RowIndex); // Restore form values
		if ($estacionamientos_grid->isGridEdit()) { // Grid edit
			if ($estacionamientos->EventCancelled)
				$estacionamientos_grid->restoreCurrentRowFormValues($estacionamientos_grid->RowIndex); // Restore form values
			if ($estacionamientos_grid->RowAction == "insert")
				$estacionamientos->RowType = ROWTYPE_ADD; // Render add
			else
				$estacionamientos->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($estacionamientos_grid->isGridEdit() && ($estacionamientos->RowType == ROWTYPE_EDIT || $estacionamientos->RowType == ROWTYPE_ADD) && $estacionamientos->EventCancelled) // Update failed
			$estacionamientos_grid->restoreCurrentRowFormValues($estacionamientos_grid->RowIndex); // Restore form values
		if ($estacionamientos->RowType == ROWTYPE_EDIT) // Edit row
			$estacionamientos_grid->EditRowCount++;
		if ($estacionamientos->isConfirm()) // Confirm row
			$estacionamientos_grid->restoreCurrentRowFormValues($estacionamientos_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$estacionamientos->RowAttrs->merge(["data-rowindex" => $estacionamientos_grid->RowCount, "id" => "r" . $estacionamientos_grid->RowCount . "_estacionamientos", "data-rowtype" => $estacionamientos->RowType]);

		// Render row
		$estacionamientos_grid->renderRow();

		// Render list options
		$estacionamientos_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($estacionamientos_grid->RowAction != "delete" && $estacionamientos_grid->RowAction != "insertdelete" && !($estacionamientos_grid->RowAction == "insert" && $estacionamientos->isConfirm() && $estacionamientos_grid->emptyRow())) {
?>
	<tr <?php echo $estacionamientos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$estacionamientos_grid->ListOptions->render("body", "left", $estacionamientos_grid->RowCount);
?>
	<?php if ($estacionamientos_grid->id_estacionamiento->Visible) { // id_estacionamiento ?>
		<td data-name="id_estacionamiento" <?php echo $estacionamientos_grid->id_estacionamiento->cellAttributes() ?>>
<?php if ($estacionamientos->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $estacionamientos_grid->RowCount ?>_estacionamientos_id_estacionamiento" class="form-group"></span>
<input type="hidden" data-table="estacionamientos" data-field="x_id_estacionamiento" name="o<?php echo $estacionamientos_grid->RowIndex ?>_id_estacionamiento" id="o<?php echo $estacionamientos_grid->RowIndex ?>_id_estacionamiento" value="<?php echo HtmlEncode($estacionamientos_grid->id_estacionamiento->OldValue) ?>">
<?php } ?>
<?php if ($estacionamientos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $estacionamientos_grid->RowCount ?>_estacionamientos_id_estacionamiento" class="form-group">
<span<?php echo $estacionamientos_grid->id_estacionamiento->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($estacionamientos_grid->id_estacionamiento->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="estacionamientos" data-field="x_id_estacionamiento" name="x<?php echo $estacionamientos_grid->RowIndex ?>_id_estacionamiento" id="x<?php echo $estacionamientos_grid->RowIndex ?>_id_estacionamiento" value="<?php echo HtmlEncode($estacionamientos_grid->id_estacionamiento->CurrentValue) ?>">
<?php } ?>
<?php if ($estacionamientos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $estacionamientos_grid->RowCount ?>_estacionamientos_id_estacionamiento">
<span<?php echo $estacionamientos_grid->id_estacionamiento->viewAttributes() ?>><?php echo $estacionamientos_grid->id_estacionamiento->getViewValue() ?></span>
</span>
<?php if (!$estacionamientos->isConfirm()) { ?>
<input type="hidden" data-table="estacionamientos" data-field="x_id_estacionamiento" name="x<?php echo $estacionamientos_grid->RowIndex ?>_id_estacionamiento" id="x<?php echo $estacionamientos_grid->RowIndex ?>_id_estacionamiento" value="<?php echo HtmlEncode($estacionamientos_grid->id_estacionamiento->FormValue) ?>">
<input type="hidden" data-table="estacionamientos" data-field="x_id_estacionamiento" name="o<?php echo $estacionamientos_grid->RowIndex ?>_id_estacionamiento" id="o<?php echo $estacionamientos_grid->RowIndex ?>_id_estacionamiento" value="<?php echo HtmlEncode($estacionamientos_grid->id_estacionamiento->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="estacionamientos" data-field="x_id_estacionamiento" name="festacionamientosgrid$x<?php echo $estacionamientos_grid->RowIndex ?>_id_estacionamiento" id="festacionamientosgrid$x<?php echo $estacionamientos_grid->RowIndex ?>_id_estacionamiento" value="<?php echo HtmlEncode($estacionamientos_grid->id_estacionamiento->FormValue) ?>">
<input type="hidden" data-table="estacionamientos" data-field="x_id_estacionamiento" name="festacionamientosgrid$o<?php echo $estacionamientos_grid->RowIndex ?>_id_estacionamiento" id="festacionamientosgrid$o<?php echo $estacionamientos_grid->RowIndex ?>_id_estacionamiento" value="<?php echo HtmlEncode($estacionamientos_grid->id_estacionamiento->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($estacionamientos_grid->nombre->Visible) { // nombre ?>
		<td data-name="nombre" <?php echo $estacionamientos_grid->nombre->cellAttributes() ?>>
<?php if ($estacionamientos->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $estacionamientos_grid->RowCount ?>_estacionamientos_nombre" class="form-group">
<input type="text" data-table="estacionamientos" data-field="x_nombre" name="x<?php echo $estacionamientos_grid->RowIndex ?>_nombre" id="x<?php echo $estacionamientos_grid->RowIndex ?>_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($estacionamientos_grid->nombre->getPlaceHolder()) ?>" value="<?php echo $estacionamientos_grid->nombre->EditValue ?>"<?php echo $estacionamientos_grid->nombre->editAttributes() ?>>
</span>
<input type="hidden" data-table="estacionamientos" data-field="x_nombre" name="o<?php echo $estacionamientos_grid->RowIndex ?>_nombre" id="o<?php echo $estacionamientos_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($estacionamientos_grid->nombre->OldValue) ?>">
<?php } ?>
<?php if ($estacionamientos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $estacionamientos_grid->RowCount ?>_estacionamientos_nombre" class="form-group">
<input type="text" data-table="estacionamientos" data-field="x_nombre" name="x<?php echo $estacionamientos_grid->RowIndex ?>_nombre" id="x<?php echo $estacionamientos_grid->RowIndex ?>_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($estacionamientos_grid->nombre->getPlaceHolder()) ?>" value="<?php echo $estacionamientos_grid->nombre->EditValue ?>"<?php echo $estacionamientos_grid->nombre->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($estacionamientos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $estacionamientos_grid->RowCount ?>_estacionamientos_nombre">
<span<?php echo $estacionamientos_grid->nombre->viewAttributes() ?>><?php echo $estacionamientos_grid->nombre->getViewValue() ?></span>
</span>
<?php if (!$estacionamientos->isConfirm()) { ?>
<input type="hidden" data-table="estacionamientos" data-field="x_nombre" name="x<?php echo $estacionamientos_grid->RowIndex ?>_nombre" id="x<?php echo $estacionamientos_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($estacionamientos_grid->nombre->FormValue) ?>">
<input type="hidden" data-table="estacionamientos" data-field="x_nombre" name="o<?php echo $estacionamientos_grid->RowIndex ?>_nombre" id="o<?php echo $estacionamientos_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($estacionamientos_grid->nombre->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="estacionamientos" data-field="x_nombre" name="festacionamientosgrid$x<?php echo $estacionamientos_grid->RowIndex ?>_nombre" id="festacionamientosgrid$x<?php echo $estacionamientos_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($estacionamientos_grid->nombre->FormValue) ?>">
<input type="hidden" data-table="estacionamientos" data-field="x_nombre" name="festacionamientosgrid$o<?php echo $estacionamientos_grid->RowIndex ?>_nombre" id="festacionamientosgrid$o<?php echo $estacionamientos_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($estacionamientos_grid->nombre->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($estacionamientos_grid->apartamento_id->Visible) { // apartamento_id ?>
		<td data-name="apartamento_id" <?php echo $estacionamientos_grid->apartamento_id->cellAttributes() ?>>
<?php if ($estacionamientos->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($estacionamientos_grid->apartamento_id->getSessionValue() != "") { ?>
<span id="el<?php echo $estacionamientos_grid->RowCount ?>_estacionamientos_apartamento_id" class="form-group">
<span<?php echo $estacionamientos_grid->apartamento_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($estacionamientos_grid->apartamento_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" name="x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" value="<?php echo HtmlEncode($estacionamientos_grid->apartamento_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $estacionamientos_grid->RowCount ?>_estacionamientos_apartamento_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="estacionamientos" data-field="x_apartamento_id" data-value-separator="<?php echo $estacionamientos_grid->apartamento_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" name="x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id"<?php echo $estacionamientos_grid->apartamento_id->editAttributes() ?>>
			<?php echo $estacionamientos_grid->apartamento_id->selectOptionListHtml("x{$estacionamientos_grid->RowIndex}_apartamento_id") ?>
		</select>
</div>
<?php echo $estacionamientos_grid->apartamento_id->Lookup->getParamTag($estacionamientos_grid, "p_x" . $estacionamientos_grid->RowIndex . "_apartamento_id") ?>
</span>
<?php } ?>
<input type="hidden" data-table="estacionamientos" data-field="x_apartamento_id" name="o<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" id="o<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" value="<?php echo HtmlEncode($estacionamientos_grid->apartamento_id->OldValue) ?>">
<?php } ?>
<?php if ($estacionamientos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($estacionamientos_grid->apartamento_id->getSessionValue() != "") { ?>
<span id="el<?php echo $estacionamientos_grid->RowCount ?>_estacionamientos_apartamento_id" class="form-group">
<span<?php echo $estacionamientos_grid->apartamento_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($estacionamientos_grid->apartamento_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" name="x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" value="<?php echo HtmlEncode($estacionamientos_grid->apartamento_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $estacionamientos_grid->RowCount ?>_estacionamientos_apartamento_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="estacionamientos" data-field="x_apartamento_id" data-value-separator="<?php echo $estacionamientos_grid->apartamento_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" name="x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id"<?php echo $estacionamientos_grid->apartamento_id->editAttributes() ?>>
			<?php echo $estacionamientos_grid->apartamento_id->selectOptionListHtml("x{$estacionamientos_grid->RowIndex}_apartamento_id") ?>
		</select>
</div>
<?php echo $estacionamientos_grid->apartamento_id->Lookup->getParamTag($estacionamientos_grid, "p_x" . $estacionamientos_grid->RowIndex . "_apartamento_id") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($estacionamientos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $estacionamientos_grid->RowCount ?>_estacionamientos_apartamento_id">
<span<?php echo $estacionamientos_grid->apartamento_id->viewAttributes() ?>><?php echo $estacionamientos_grid->apartamento_id->getViewValue() ?></span>
</span>
<?php if (!$estacionamientos->isConfirm()) { ?>
<input type="hidden" data-table="estacionamientos" data-field="x_apartamento_id" name="x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" id="x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" value="<?php echo HtmlEncode($estacionamientos_grid->apartamento_id->FormValue) ?>">
<input type="hidden" data-table="estacionamientos" data-field="x_apartamento_id" name="o<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" id="o<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" value="<?php echo HtmlEncode($estacionamientos_grid->apartamento_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="estacionamientos" data-field="x_apartamento_id" name="festacionamientosgrid$x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" id="festacionamientosgrid$x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" value="<?php echo HtmlEncode($estacionamientos_grid->apartamento_id->FormValue) ?>">
<input type="hidden" data-table="estacionamientos" data-field="x_apartamento_id" name="festacionamientosgrid$o<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" id="festacionamientosgrid$o<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" value="<?php echo HtmlEncode($estacionamientos_grid->apartamento_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$estacionamientos_grid->ListOptions->render("body", "right", $estacionamientos_grid->RowCount);
?>
	</tr>
<?php if ($estacionamientos->RowType == ROWTYPE_ADD || $estacionamientos->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["festacionamientosgrid", "load"], function() {
	festacionamientosgrid.updateLists(<?php echo $estacionamientos_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$estacionamientos_grid->isGridAdd() || $estacionamientos->CurrentMode == "copy")
		if (!$estacionamientos_grid->Recordset->EOF)
			$estacionamientos_grid->Recordset->moveNext();
}
?>
<?php
	if ($estacionamientos->CurrentMode == "add" || $estacionamientos->CurrentMode == "copy" || $estacionamientos->CurrentMode == "edit") {
		$estacionamientos_grid->RowIndex = '$rowindex$';
		$estacionamientos_grid->loadRowValues();

		// Set row properties
		$estacionamientos->resetAttributes();
		$estacionamientos->RowAttrs->merge(["data-rowindex" => $estacionamientos_grid->RowIndex, "id" => "r0_estacionamientos", "data-rowtype" => ROWTYPE_ADD]);
		$estacionamientos->RowAttrs->appendClass("ew-template");
		$estacionamientos->RowType = ROWTYPE_ADD;

		// Render row
		$estacionamientos_grid->renderRow();

		// Render list options
		$estacionamientos_grid->renderListOptions();
		$estacionamientos_grid->StartRowCount = 0;
?>
	<tr <?php echo $estacionamientos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$estacionamientos_grid->ListOptions->render("body", "left", $estacionamientos_grid->RowIndex);
?>
	<?php if ($estacionamientos_grid->id_estacionamiento->Visible) { // id_estacionamiento ?>
		<td data-name="id_estacionamiento">
<?php if (!$estacionamientos->isConfirm()) { ?>
<span id="el$rowindex$_estacionamientos_id_estacionamiento" class="form-group estacionamientos_id_estacionamiento"></span>
<?php } else { ?>
<span id="el$rowindex$_estacionamientos_id_estacionamiento" class="form-group estacionamientos_id_estacionamiento">
<span<?php echo $estacionamientos_grid->id_estacionamiento->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($estacionamientos_grid->id_estacionamiento->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="estacionamientos" data-field="x_id_estacionamiento" name="x<?php echo $estacionamientos_grid->RowIndex ?>_id_estacionamiento" id="x<?php echo $estacionamientos_grid->RowIndex ?>_id_estacionamiento" value="<?php echo HtmlEncode($estacionamientos_grid->id_estacionamiento->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="estacionamientos" data-field="x_id_estacionamiento" name="o<?php echo $estacionamientos_grid->RowIndex ?>_id_estacionamiento" id="o<?php echo $estacionamientos_grid->RowIndex ?>_id_estacionamiento" value="<?php echo HtmlEncode($estacionamientos_grid->id_estacionamiento->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($estacionamientos_grid->nombre->Visible) { // nombre ?>
		<td data-name="nombre">
<?php if (!$estacionamientos->isConfirm()) { ?>
<span id="el$rowindex$_estacionamientos_nombre" class="form-group estacionamientos_nombre">
<input type="text" data-table="estacionamientos" data-field="x_nombre" name="x<?php echo $estacionamientos_grid->RowIndex ?>_nombre" id="x<?php echo $estacionamientos_grid->RowIndex ?>_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($estacionamientos_grid->nombre->getPlaceHolder()) ?>" value="<?php echo $estacionamientos_grid->nombre->EditValue ?>"<?php echo $estacionamientos_grid->nombre->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_estacionamientos_nombre" class="form-group estacionamientos_nombre">
<span<?php echo $estacionamientos_grid->nombre->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($estacionamientos_grid->nombre->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="estacionamientos" data-field="x_nombre" name="x<?php echo $estacionamientos_grid->RowIndex ?>_nombre" id="x<?php echo $estacionamientos_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($estacionamientos_grid->nombre->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="estacionamientos" data-field="x_nombre" name="o<?php echo $estacionamientos_grid->RowIndex ?>_nombre" id="o<?php echo $estacionamientos_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($estacionamientos_grid->nombre->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($estacionamientos_grid->apartamento_id->Visible) { // apartamento_id ?>
		<td data-name="apartamento_id">
<?php if (!$estacionamientos->isConfirm()) { ?>
<?php if ($estacionamientos_grid->apartamento_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_estacionamientos_apartamento_id" class="form-group estacionamientos_apartamento_id">
<span<?php echo $estacionamientos_grid->apartamento_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($estacionamientos_grid->apartamento_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" name="x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" value="<?php echo HtmlEncode($estacionamientos_grid->apartamento_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_estacionamientos_apartamento_id" class="form-group estacionamientos_apartamento_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="estacionamientos" data-field="x_apartamento_id" data-value-separator="<?php echo $estacionamientos_grid->apartamento_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" name="x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id"<?php echo $estacionamientos_grid->apartamento_id->editAttributes() ?>>
			<?php echo $estacionamientos_grid->apartamento_id->selectOptionListHtml("x{$estacionamientos_grid->RowIndex}_apartamento_id") ?>
		</select>
</div>
<?php echo $estacionamientos_grid->apartamento_id->Lookup->getParamTag($estacionamientos_grid, "p_x" . $estacionamientos_grid->RowIndex . "_apartamento_id") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_estacionamientos_apartamento_id" class="form-group estacionamientos_apartamento_id">
<span<?php echo $estacionamientos_grid->apartamento_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($estacionamientos_grid->apartamento_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="estacionamientos" data-field="x_apartamento_id" name="x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" id="x<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" value="<?php echo HtmlEncode($estacionamientos_grid->apartamento_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="estacionamientos" data-field="x_apartamento_id" name="o<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" id="o<?php echo $estacionamientos_grid->RowIndex ?>_apartamento_id" value="<?php echo HtmlEncode($estacionamientos_grid->apartamento_id->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$estacionamientos_grid->ListOptions->render("body", "right", $estacionamientos_grid->RowIndex);
?>
<script>
loadjs.ready(["festacionamientosgrid", "load"], function() {
	festacionamientosgrid.updateLists(<?php echo $estacionamientos_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($estacionamientos->CurrentMode == "add" || $estacionamientos->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $estacionamientos_grid->FormKeyCountName ?>" id="<?php echo $estacionamientos_grid->FormKeyCountName ?>" value="<?php echo $estacionamientos_grid->KeyCount ?>">
<?php echo $estacionamientos_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($estacionamientos->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $estacionamientos_grid->FormKeyCountName ?>" id="<?php echo $estacionamientos_grid->FormKeyCountName ?>" value="<?php echo $estacionamientos_grid->KeyCount ?>">
<?php echo $estacionamientos_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($estacionamientos->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="festacionamientosgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($estacionamientos_grid->Recordset)
	$estacionamientos_grid->Recordset->Close();
?>
<?php if ($estacionamientos_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $estacionamientos_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($estacionamientos_grid->TotalRecords == 0 && !$estacionamientos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $estacionamientos_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$estacionamientos_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$estacionamientos_grid->terminate();
?>