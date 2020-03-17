<?php
namespace PHPMaker2020\condominios;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($pisos_grid))
	$pisos_grid = new pisos_grid();

// Run the page
$pisos_grid->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pisos_grid->Page_Render();
?>
<?php if (!$pisos_grid->isExport()) { ?>
<script>
var fpisosgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fpisosgrid = new ew.Form("fpisosgrid", "grid");
	fpisosgrid.formKeyCountName = '<?php echo $pisos_grid->FormKeyCountName ?>';

	// Validate form
	fpisosgrid.validate = function() {
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
			<?php if ($pisos_grid->id_piso->Required) { ?>
				elm = this.getElements("x" + infix + "_id_piso");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pisos_grid->id_piso->caption(), $pisos_grid->id_piso->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pisos_grid->edificio_id->Required) { ?>
				elm = this.getElements("x" + infix + "_edificio_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pisos_grid->edificio_id->caption(), $pisos_grid->edificio_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_edificio_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pisos_grid->edificio_id->errorMessage()) ?>");
			<?php if ($pisos_grid->nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pisos_grid->nombre->caption(), $pisos_grid->nombre->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fpisosgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "edificio_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "nombre", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fpisosgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpisosgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpisosgrid.lists["x_id_piso"] = <?php echo $pisos_grid->id_piso->Lookup->toClientList($pisos_grid) ?>;
	fpisosgrid.lists["x_id_piso"].options = <?php echo JsonEncode($pisos_grid->id_piso->lookupOptions()) ?>;
	loadjs.done("fpisosgrid");
});
</script>
<?php } ?>
<?php
$pisos_grid->renderOtherOptions();
?>
<?php if ($pisos_grid->TotalRecords > 0 || $pisos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($pisos_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pisos">
<div id="fpisosgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_pisos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_pisosgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$pisos->RowType = ROWTYPE_HEADER;

// Render list options
$pisos_grid->renderListOptions();

// Render list options (header, left)
$pisos_grid->ListOptions->render("header", "left");
?>
<?php if ($pisos_grid->id_piso->Visible) { // id_piso ?>
	<?php if ($pisos_grid->SortUrl($pisos_grid->id_piso) == "") { ?>
		<th data-name="id_piso" class="<?php echo $pisos_grid->id_piso->headerCellClass() ?>"><div id="elh_pisos_id_piso" class="pisos_id_piso"><div class="ew-table-header-caption"><?php echo $pisos_grid->id_piso->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_piso" class="<?php echo $pisos_grid->id_piso->headerCellClass() ?>"><div><div id="elh_pisos_id_piso" class="pisos_id_piso">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pisos_grid->id_piso->caption() ?></span><span class="ew-table-header-sort"><?php if ($pisos_grid->id_piso->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pisos_grid->id_piso->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pisos_grid->edificio_id->Visible) { // edificio_id ?>
	<?php if ($pisos_grid->SortUrl($pisos_grid->edificio_id) == "") { ?>
		<th data-name="edificio_id" class="<?php echo $pisos_grid->edificio_id->headerCellClass() ?>"><div id="elh_pisos_edificio_id" class="pisos_edificio_id"><div class="ew-table-header-caption"><?php echo $pisos_grid->edificio_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="edificio_id" class="<?php echo $pisos_grid->edificio_id->headerCellClass() ?>"><div><div id="elh_pisos_edificio_id" class="pisos_edificio_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pisos_grid->edificio_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($pisos_grid->edificio_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pisos_grid->edificio_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pisos_grid->nombre->Visible) { // nombre ?>
	<?php if ($pisos_grid->SortUrl($pisos_grid->nombre) == "") { ?>
		<th data-name="nombre" class="<?php echo $pisos_grid->nombre->headerCellClass() ?>"><div id="elh_pisos_nombre" class="pisos_nombre"><div class="ew-table-header-caption"><?php echo $pisos_grid->nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre" class="<?php echo $pisos_grid->nombre->headerCellClass() ?>"><div><div id="elh_pisos_nombre" class="pisos_nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pisos_grid->nombre->caption() ?></span><span class="ew-table-header-sort"><?php if ($pisos_grid->nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pisos_grid->nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pisos_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$pisos_grid->StartRecord = 1;
$pisos_grid->StopRecord = $pisos_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($pisos->isConfirm() || $pisos_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($pisos_grid->FormKeyCountName) && ($pisos_grid->isGridAdd() || $pisos_grid->isGridEdit() || $pisos->isConfirm())) {
		$pisos_grid->KeyCount = $CurrentForm->getValue($pisos_grid->FormKeyCountName);
		$pisos_grid->StopRecord = $pisos_grid->StartRecord + $pisos_grid->KeyCount - 1;
	}
}
$pisos_grid->RecordCount = $pisos_grid->StartRecord - 1;
if ($pisos_grid->Recordset && !$pisos_grid->Recordset->EOF) {
	$pisos_grid->Recordset->moveFirst();
	$selectLimit = $pisos_grid->UseSelectLimit;
	if (!$selectLimit && $pisos_grid->StartRecord > 1)
		$pisos_grid->Recordset->move($pisos_grid->StartRecord - 1);
} elseif (!$pisos->AllowAddDeleteRow && $pisos_grid->StopRecord == 0) {
	$pisos_grid->StopRecord = $pisos->GridAddRowCount;
}

// Initialize aggregate
$pisos->RowType = ROWTYPE_AGGREGATEINIT;
$pisos->resetAttributes();
$pisos_grid->renderRow();
if ($pisos_grid->isGridAdd())
	$pisos_grid->RowIndex = 0;
if ($pisos_grid->isGridEdit())
	$pisos_grid->RowIndex = 0;
while ($pisos_grid->RecordCount < $pisos_grid->StopRecord) {
	$pisos_grid->RecordCount++;
	if ($pisos_grid->RecordCount >= $pisos_grid->StartRecord) {
		$pisos_grid->RowCount++;
		if ($pisos_grid->isGridAdd() || $pisos_grid->isGridEdit() || $pisos->isConfirm()) {
			$pisos_grid->RowIndex++;
			$CurrentForm->Index = $pisos_grid->RowIndex;
			if ($CurrentForm->hasValue($pisos_grid->FormActionName) && ($pisos->isConfirm() || $pisos_grid->EventCancelled))
				$pisos_grid->RowAction = strval($CurrentForm->getValue($pisos_grid->FormActionName));
			elseif ($pisos_grid->isGridAdd())
				$pisos_grid->RowAction = "insert";
			else
				$pisos_grid->RowAction = "";
		}

		// Set up key count
		$pisos_grid->KeyCount = $pisos_grid->RowIndex;

		// Init row class and style
		$pisos->resetAttributes();
		$pisos->CssClass = "";
		if ($pisos_grid->isGridAdd()) {
			if ($pisos->CurrentMode == "copy") {
				$pisos_grid->loadRowValues($pisos_grid->Recordset); // Load row values
				$pisos_grid->setRecordKey($pisos_grid->RowOldKey, $pisos_grid->Recordset); // Set old record key
			} else {
				$pisos_grid->loadRowValues(); // Load default values
				$pisos_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$pisos_grid->loadRowValues($pisos_grid->Recordset); // Load row values
		}
		$pisos->RowType = ROWTYPE_VIEW; // Render view
		if ($pisos_grid->isGridAdd()) // Grid add
			$pisos->RowType = ROWTYPE_ADD; // Render add
		if ($pisos_grid->isGridAdd() && $pisos->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$pisos_grid->restoreCurrentRowFormValues($pisos_grid->RowIndex); // Restore form values
		if ($pisos_grid->isGridEdit()) { // Grid edit
			if ($pisos->EventCancelled)
				$pisos_grid->restoreCurrentRowFormValues($pisos_grid->RowIndex); // Restore form values
			if ($pisos_grid->RowAction == "insert")
				$pisos->RowType = ROWTYPE_ADD; // Render add
			else
				$pisos->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($pisos_grid->isGridEdit() && ($pisos->RowType == ROWTYPE_EDIT || $pisos->RowType == ROWTYPE_ADD) && $pisos->EventCancelled) // Update failed
			$pisos_grid->restoreCurrentRowFormValues($pisos_grid->RowIndex); // Restore form values
		if ($pisos->RowType == ROWTYPE_EDIT) // Edit row
			$pisos_grid->EditRowCount++;
		if ($pisos->isConfirm()) // Confirm row
			$pisos_grid->restoreCurrentRowFormValues($pisos_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$pisos->RowAttrs->merge(["data-rowindex" => $pisos_grid->RowCount, "id" => "r" . $pisos_grid->RowCount . "_pisos", "data-rowtype" => $pisos->RowType]);

		// Render row
		$pisos_grid->renderRow();

		// Render list options
		$pisos_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($pisos_grid->RowAction != "delete" && $pisos_grid->RowAction != "insertdelete" && !($pisos_grid->RowAction == "insert" && $pisos->isConfirm() && $pisos_grid->emptyRow())) {
?>
	<tr <?php echo $pisos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pisos_grid->ListOptions->render("body", "left", $pisos_grid->RowCount);
?>
	<?php if ($pisos_grid->id_piso->Visible) { // id_piso ?>
		<td data-name="id_piso" <?php echo $pisos_grid->id_piso->cellAttributes() ?>>
<?php if ($pisos->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $pisos_grid->RowCount ?>_pisos_id_piso" class="form-group"></span>
<input type="hidden" data-table="pisos" data-field="x_id_piso" name="o<?php echo $pisos_grid->RowIndex ?>_id_piso" id="o<?php echo $pisos_grid->RowIndex ?>_id_piso" value="<?php echo HtmlEncode($pisos_grid->id_piso->OldValue) ?>">
<?php } ?>
<?php if ($pisos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $pisos_grid->RowCount ?>_pisos_id_piso" class="form-group">
<span<?php echo $pisos_grid->id_piso->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pisos_grid->id_piso->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="pisos" data-field="x_id_piso" name="x<?php echo $pisos_grid->RowIndex ?>_id_piso" id="x<?php echo $pisos_grid->RowIndex ?>_id_piso" value="<?php echo HtmlEncode($pisos_grid->id_piso->CurrentValue) ?>">
<?php } ?>
<?php if ($pisos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pisos_grid->RowCount ?>_pisos_id_piso">
<span<?php echo $pisos_grid->id_piso->viewAttributes() ?>><?php echo $pisos_grid->id_piso->getViewValue() ?></span>
</span>
<?php if (!$pisos->isConfirm()) { ?>
<input type="hidden" data-table="pisos" data-field="x_id_piso" name="x<?php echo $pisos_grid->RowIndex ?>_id_piso" id="x<?php echo $pisos_grid->RowIndex ?>_id_piso" value="<?php echo HtmlEncode($pisos_grid->id_piso->FormValue) ?>">
<input type="hidden" data-table="pisos" data-field="x_id_piso" name="o<?php echo $pisos_grid->RowIndex ?>_id_piso" id="o<?php echo $pisos_grid->RowIndex ?>_id_piso" value="<?php echo HtmlEncode($pisos_grid->id_piso->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pisos" data-field="x_id_piso" name="fpisosgrid$x<?php echo $pisos_grid->RowIndex ?>_id_piso" id="fpisosgrid$x<?php echo $pisos_grid->RowIndex ?>_id_piso" value="<?php echo HtmlEncode($pisos_grid->id_piso->FormValue) ?>">
<input type="hidden" data-table="pisos" data-field="x_id_piso" name="fpisosgrid$o<?php echo $pisos_grid->RowIndex ?>_id_piso" id="fpisosgrid$o<?php echo $pisos_grid->RowIndex ?>_id_piso" value="<?php echo HtmlEncode($pisos_grid->id_piso->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pisos_grid->edificio_id->Visible) { // edificio_id ?>
		<td data-name="edificio_id" <?php echo $pisos_grid->edificio_id->cellAttributes() ?>>
<?php if ($pisos->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($pisos_grid->edificio_id->getSessionValue() != "") { ?>
<span id="el<?php echo $pisos_grid->RowCount ?>_pisos_edificio_id" class="form-group">
<span<?php echo $pisos_grid->edificio_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pisos_grid->edificio_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $pisos_grid->RowIndex ?>_edificio_id" name="x<?php echo $pisos_grid->RowIndex ?>_edificio_id" value="<?php echo HtmlEncode($pisos_grid->edificio_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $pisos_grid->RowCount ?>_pisos_edificio_id" class="form-group">
<input type="text" data-table="pisos" data-field="x_edificio_id" name="x<?php echo $pisos_grid->RowIndex ?>_edificio_id" id="x<?php echo $pisos_grid->RowIndex ?>_edificio_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($pisos_grid->edificio_id->getPlaceHolder()) ?>" value="<?php echo $pisos_grid->edificio_id->EditValue ?>"<?php echo $pisos_grid->edificio_id->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="pisos" data-field="x_edificio_id" name="o<?php echo $pisos_grid->RowIndex ?>_edificio_id" id="o<?php echo $pisos_grid->RowIndex ?>_edificio_id" value="<?php echo HtmlEncode($pisos_grid->edificio_id->OldValue) ?>">
<?php } ?>
<?php if ($pisos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($pisos_grid->edificio_id->getSessionValue() != "") { ?>
<span id="el<?php echo $pisos_grid->RowCount ?>_pisos_edificio_id" class="form-group">
<span<?php echo $pisos_grid->edificio_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pisos_grid->edificio_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $pisos_grid->RowIndex ?>_edificio_id" name="x<?php echo $pisos_grid->RowIndex ?>_edificio_id" value="<?php echo HtmlEncode($pisos_grid->edificio_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $pisos_grid->RowCount ?>_pisos_edificio_id" class="form-group">
<input type="text" data-table="pisos" data-field="x_edificio_id" name="x<?php echo $pisos_grid->RowIndex ?>_edificio_id" id="x<?php echo $pisos_grid->RowIndex ?>_edificio_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($pisos_grid->edificio_id->getPlaceHolder()) ?>" value="<?php echo $pisos_grid->edificio_id->EditValue ?>"<?php echo $pisos_grid->edificio_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($pisos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pisos_grid->RowCount ?>_pisos_edificio_id">
<span<?php echo $pisos_grid->edificio_id->viewAttributes() ?>><?php echo $pisos_grid->edificio_id->getViewValue() ?></span>
</span>
<?php if (!$pisos->isConfirm()) { ?>
<input type="hidden" data-table="pisos" data-field="x_edificio_id" name="x<?php echo $pisos_grid->RowIndex ?>_edificio_id" id="x<?php echo $pisos_grid->RowIndex ?>_edificio_id" value="<?php echo HtmlEncode($pisos_grid->edificio_id->FormValue) ?>">
<input type="hidden" data-table="pisos" data-field="x_edificio_id" name="o<?php echo $pisos_grid->RowIndex ?>_edificio_id" id="o<?php echo $pisos_grid->RowIndex ?>_edificio_id" value="<?php echo HtmlEncode($pisos_grid->edificio_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pisos" data-field="x_edificio_id" name="fpisosgrid$x<?php echo $pisos_grid->RowIndex ?>_edificio_id" id="fpisosgrid$x<?php echo $pisos_grid->RowIndex ?>_edificio_id" value="<?php echo HtmlEncode($pisos_grid->edificio_id->FormValue) ?>">
<input type="hidden" data-table="pisos" data-field="x_edificio_id" name="fpisosgrid$o<?php echo $pisos_grid->RowIndex ?>_edificio_id" id="fpisosgrid$o<?php echo $pisos_grid->RowIndex ?>_edificio_id" value="<?php echo HtmlEncode($pisos_grid->edificio_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pisos_grid->nombre->Visible) { // nombre ?>
		<td data-name="nombre" <?php echo $pisos_grid->nombre->cellAttributes() ?>>
<?php if ($pisos->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $pisos_grid->RowCount ?>_pisos_nombre" class="form-group">
<input type="text" data-table="pisos" data-field="x_nombre" name="x<?php echo $pisos_grid->RowIndex ?>_nombre" id="x<?php echo $pisos_grid->RowIndex ?>_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($pisos_grid->nombre->getPlaceHolder()) ?>" value="<?php echo $pisos_grid->nombre->EditValue ?>"<?php echo $pisos_grid->nombre->editAttributes() ?>>
</span>
<input type="hidden" data-table="pisos" data-field="x_nombre" name="o<?php echo $pisos_grid->RowIndex ?>_nombre" id="o<?php echo $pisos_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($pisos_grid->nombre->OldValue) ?>">
<?php } ?>
<?php if ($pisos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $pisos_grid->RowCount ?>_pisos_nombre" class="form-group">
<input type="text" data-table="pisos" data-field="x_nombre" name="x<?php echo $pisos_grid->RowIndex ?>_nombre" id="x<?php echo $pisos_grid->RowIndex ?>_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($pisos_grid->nombre->getPlaceHolder()) ?>" value="<?php echo $pisos_grid->nombre->EditValue ?>"<?php echo $pisos_grid->nombre->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($pisos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pisos_grid->RowCount ?>_pisos_nombre">
<span<?php echo $pisos_grid->nombre->viewAttributes() ?>><?php echo $pisos_grid->nombre->getViewValue() ?></span>
</span>
<?php if (!$pisos->isConfirm()) { ?>
<input type="hidden" data-table="pisos" data-field="x_nombre" name="x<?php echo $pisos_grid->RowIndex ?>_nombre" id="x<?php echo $pisos_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($pisos_grid->nombre->FormValue) ?>">
<input type="hidden" data-table="pisos" data-field="x_nombre" name="o<?php echo $pisos_grid->RowIndex ?>_nombre" id="o<?php echo $pisos_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($pisos_grid->nombre->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pisos" data-field="x_nombre" name="fpisosgrid$x<?php echo $pisos_grid->RowIndex ?>_nombre" id="fpisosgrid$x<?php echo $pisos_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($pisos_grid->nombre->FormValue) ?>">
<input type="hidden" data-table="pisos" data-field="x_nombre" name="fpisosgrid$o<?php echo $pisos_grid->RowIndex ?>_nombre" id="fpisosgrid$o<?php echo $pisos_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($pisos_grid->nombre->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pisos_grid->ListOptions->render("body", "right", $pisos_grid->RowCount);
?>
	</tr>
<?php if ($pisos->RowType == ROWTYPE_ADD || $pisos->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fpisosgrid", "load"], function() {
	fpisosgrid.updateLists(<?php echo $pisos_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$pisos_grid->isGridAdd() || $pisos->CurrentMode == "copy")
		if (!$pisos_grid->Recordset->EOF)
			$pisos_grid->Recordset->moveNext();
}
?>
<?php
	if ($pisos->CurrentMode == "add" || $pisos->CurrentMode == "copy" || $pisos->CurrentMode == "edit") {
		$pisos_grid->RowIndex = '$rowindex$';
		$pisos_grid->loadRowValues();

		// Set row properties
		$pisos->resetAttributes();
		$pisos->RowAttrs->merge(["data-rowindex" => $pisos_grid->RowIndex, "id" => "r0_pisos", "data-rowtype" => ROWTYPE_ADD]);
		$pisos->RowAttrs->appendClass("ew-template");
		$pisos->RowType = ROWTYPE_ADD;

		// Render row
		$pisos_grid->renderRow();

		// Render list options
		$pisos_grid->renderListOptions();
		$pisos_grid->StartRowCount = 0;
?>
	<tr <?php echo $pisos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pisos_grid->ListOptions->render("body", "left", $pisos_grid->RowIndex);
?>
	<?php if ($pisos_grid->id_piso->Visible) { // id_piso ?>
		<td data-name="id_piso">
<?php if (!$pisos->isConfirm()) { ?>
<span id="el$rowindex$_pisos_id_piso" class="form-group pisos_id_piso"></span>
<?php } else { ?>
<span id="el$rowindex$_pisos_id_piso" class="form-group pisos_id_piso">
<span<?php echo $pisos_grid->id_piso->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pisos_grid->id_piso->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="pisos" data-field="x_id_piso" name="x<?php echo $pisos_grid->RowIndex ?>_id_piso" id="x<?php echo $pisos_grid->RowIndex ?>_id_piso" value="<?php echo HtmlEncode($pisos_grid->id_piso->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pisos" data-field="x_id_piso" name="o<?php echo $pisos_grid->RowIndex ?>_id_piso" id="o<?php echo $pisos_grid->RowIndex ?>_id_piso" value="<?php echo HtmlEncode($pisos_grid->id_piso->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pisos_grid->edificio_id->Visible) { // edificio_id ?>
		<td data-name="edificio_id">
<?php if (!$pisos->isConfirm()) { ?>
<?php if ($pisos_grid->edificio_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_pisos_edificio_id" class="form-group pisos_edificio_id">
<span<?php echo $pisos_grid->edificio_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pisos_grid->edificio_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $pisos_grid->RowIndex ?>_edificio_id" name="x<?php echo $pisos_grid->RowIndex ?>_edificio_id" value="<?php echo HtmlEncode($pisos_grid->edificio_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_pisos_edificio_id" class="form-group pisos_edificio_id">
<input type="text" data-table="pisos" data-field="x_edificio_id" name="x<?php echo $pisos_grid->RowIndex ?>_edificio_id" id="x<?php echo $pisos_grid->RowIndex ?>_edificio_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($pisos_grid->edificio_id->getPlaceHolder()) ?>" value="<?php echo $pisos_grid->edificio_id->EditValue ?>"<?php echo $pisos_grid->edificio_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_pisos_edificio_id" class="form-group pisos_edificio_id">
<span<?php echo $pisos_grid->edificio_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pisos_grid->edificio_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="pisos" data-field="x_edificio_id" name="x<?php echo $pisos_grid->RowIndex ?>_edificio_id" id="x<?php echo $pisos_grid->RowIndex ?>_edificio_id" value="<?php echo HtmlEncode($pisos_grid->edificio_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pisos" data-field="x_edificio_id" name="o<?php echo $pisos_grid->RowIndex ?>_edificio_id" id="o<?php echo $pisos_grid->RowIndex ?>_edificio_id" value="<?php echo HtmlEncode($pisos_grid->edificio_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pisos_grid->nombre->Visible) { // nombre ?>
		<td data-name="nombre">
<?php if (!$pisos->isConfirm()) { ?>
<span id="el$rowindex$_pisos_nombre" class="form-group pisos_nombre">
<input type="text" data-table="pisos" data-field="x_nombre" name="x<?php echo $pisos_grid->RowIndex ?>_nombre" id="x<?php echo $pisos_grid->RowIndex ?>_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($pisos_grid->nombre->getPlaceHolder()) ?>" value="<?php echo $pisos_grid->nombre->EditValue ?>"<?php echo $pisos_grid->nombre->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_pisos_nombre" class="form-group pisos_nombre">
<span<?php echo $pisos_grid->nombre->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pisos_grid->nombre->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="pisos" data-field="x_nombre" name="x<?php echo $pisos_grid->RowIndex ?>_nombre" id="x<?php echo $pisos_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($pisos_grid->nombre->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pisos" data-field="x_nombre" name="o<?php echo $pisos_grid->RowIndex ?>_nombre" id="o<?php echo $pisos_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($pisos_grid->nombre->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pisos_grid->ListOptions->render("body", "right", $pisos_grid->RowIndex);
?>
<script>
loadjs.ready(["fpisosgrid", "load"], function() {
	fpisosgrid.updateLists(<?php echo $pisos_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($pisos->CurrentMode == "add" || $pisos->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $pisos_grid->FormKeyCountName ?>" id="<?php echo $pisos_grid->FormKeyCountName ?>" value="<?php echo $pisos_grid->KeyCount ?>">
<?php echo $pisos_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($pisos->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $pisos_grid->FormKeyCountName ?>" id="<?php echo $pisos_grid->FormKeyCountName ?>" value="<?php echo $pisos_grid->KeyCount ?>">
<?php echo $pisos_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($pisos->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fpisosgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($pisos_grid->Recordset)
	$pisos_grid->Recordset->Close();
?>
<?php if ($pisos_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $pisos_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($pisos_grid->TotalRecords == 0 && !$pisos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $pisos_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$pisos_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$pisos_grid->terminate();
?>