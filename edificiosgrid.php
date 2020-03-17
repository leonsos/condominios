<?php
namespace PHPMaker2020\condominios;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($edificios_grid))
	$edificios_grid = new edificios_grid();

// Run the page
$edificios_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$edificios_grid->Page_Render();
?>
<?php if (!$edificios_grid->isExport()) { ?>
<script>
var fedificiosgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fedificiosgrid = new ew.Form("fedificiosgrid", "grid");
	fedificiosgrid.formKeyCountName = '<?php echo $edificios_grid->FormKeyCountName ?>';

	// Validate form
	fedificiosgrid.validate = function() {
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
			<?php if ($edificios_grid->id_edificio->Required) { ?>
				elm = this.getElements("x" + infix + "_id_edificio");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $edificios_grid->id_edificio->caption(), $edificios_grid->id_edificio->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($edificios_grid->residencia_id->Required) { ?>
				elm = this.getElements("x" + infix + "_residencia_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $edificios_grid->residencia_id->caption(), $edificios_grid->residencia_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_residencia_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($edificios_grid->residencia_id->errorMessage()) ?>");
			<?php if ($edificios_grid->nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $edificios_grid->nombre->caption(), $edificios_grid->nombre->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fedificiosgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "residencia_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "nombre", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fedificiosgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fedificiosgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fedificiosgrid");
});
</script>
<?php } ?>
<?php
$edificios_grid->renderOtherOptions();
?>
<?php if ($edificios_grid->TotalRecords > 0 || $edificios->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($edificios_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> edificios">
<div id="fedificiosgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_edificios" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_edificiosgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$edificios->RowType = ROWTYPE_HEADER;

// Render list options
$edificios_grid->renderListOptions();

// Render list options (header, left)
$edificios_grid->ListOptions->render("header", "left");
?>
<?php if ($edificios_grid->id_edificio->Visible) { // id_edificio ?>
	<?php if ($edificios_grid->SortUrl($edificios_grid->id_edificio) == "") { ?>
		<th data-name="id_edificio" class="<?php echo $edificios_grid->id_edificio->headerCellClass() ?>"><div id="elh_edificios_id_edificio" class="edificios_id_edificio"><div class="ew-table-header-caption"><?php echo $edificios_grid->id_edificio->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_edificio" class="<?php echo $edificios_grid->id_edificio->headerCellClass() ?>"><div><div id="elh_edificios_id_edificio" class="edificios_id_edificio">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $edificios_grid->id_edificio->caption() ?></span><span class="ew-table-header-sort"><?php if ($edificios_grid->id_edificio->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($edificios_grid->id_edificio->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($edificios_grid->residencia_id->Visible) { // residencia_id ?>
	<?php if ($edificios_grid->SortUrl($edificios_grid->residencia_id) == "") { ?>
		<th data-name="residencia_id" class="<?php echo $edificios_grid->residencia_id->headerCellClass() ?>"><div id="elh_edificios_residencia_id" class="edificios_residencia_id"><div class="ew-table-header-caption"><?php echo $edificios_grid->residencia_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="residencia_id" class="<?php echo $edificios_grid->residencia_id->headerCellClass() ?>"><div><div id="elh_edificios_residencia_id" class="edificios_residencia_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $edificios_grid->residencia_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($edificios_grid->residencia_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($edificios_grid->residencia_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($edificios_grid->nombre->Visible) { // nombre ?>
	<?php if ($edificios_grid->SortUrl($edificios_grid->nombre) == "") { ?>
		<th data-name="nombre" class="<?php echo $edificios_grid->nombre->headerCellClass() ?>"><div id="elh_edificios_nombre" class="edificios_nombre"><div class="ew-table-header-caption"><?php echo $edificios_grid->nombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre" class="<?php echo $edificios_grid->nombre->headerCellClass() ?>"><div><div id="elh_edificios_nombre" class="edificios_nombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $edificios_grid->nombre->caption() ?></span><span class="ew-table-header-sort"><?php if ($edificios_grid->nombre->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($edificios_grid->nombre->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$edificios_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$edificios_grid->StartRecord = 1;
$edificios_grid->StopRecord = $edificios_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($edificios->isConfirm() || $edificios_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($edificios_grid->FormKeyCountName) && ($edificios_grid->isGridAdd() || $edificios_grid->isGridEdit() || $edificios->isConfirm())) {
		$edificios_grid->KeyCount = $CurrentForm->getValue($edificios_grid->FormKeyCountName);
		$edificios_grid->StopRecord = $edificios_grid->StartRecord + $edificios_grid->KeyCount - 1;
	}
}
$edificios_grid->RecordCount = $edificios_grid->StartRecord - 1;
if ($edificios_grid->Recordset && !$edificios_grid->Recordset->EOF) {
	$edificios_grid->Recordset->moveFirst();
	$selectLimit = $edificios_grid->UseSelectLimit;
	if (!$selectLimit && $edificios_grid->StartRecord > 1)
		$edificios_grid->Recordset->move($edificios_grid->StartRecord - 1);
} elseif (!$edificios->AllowAddDeleteRow && $edificios_grid->StopRecord == 0) {
	$edificios_grid->StopRecord = $edificios->GridAddRowCount;
}

// Initialize aggregate
$edificios->RowType = ROWTYPE_AGGREGATEINIT;
$edificios->resetAttributes();
$edificios_grid->renderRow();
if ($edificios_grid->isGridAdd())
	$edificios_grid->RowIndex = 0;
if ($edificios_grid->isGridEdit())
	$edificios_grid->RowIndex = 0;
while ($edificios_grid->RecordCount < $edificios_grid->StopRecord) {
	$edificios_grid->RecordCount++;
	if ($edificios_grid->RecordCount >= $edificios_grid->StartRecord) {
		$edificios_grid->RowCount++;
		if ($edificios_grid->isGridAdd() || $edificios_grid->isGridEdit() || $edificios->isConfirm()) {
			$edificios_grid->RowIndex++;
			$CurrentForm->Index = $edificios_grid->RowIndex;
			if ($CurrentForm->hasValue($edificios_grid->FormActionName) && ($edificios->isConfirm() || $edificios_grid->EventCancelled))
				$edificios_grid->RowAction = strval($CurrentForm->getValue($edificios_grid->FormActionName));
			elseif ($edificios_grid->isGridAdd())
				$edificios_grid->RowAction = "insert";
			else
				$edificios_grid->RowAction = "";
		}

		// Set up key count
		$edificios_grid->KeyCount = $edificios_grid->RowIndex;

		// Init row class and style
		$edificios->resetAttributes();
		$edificios->CssClass = "";
		if ($edificios_grid->isGridAdd()) {
			if ($edificios->CurrentMode == "copy") {
				$edificios_grid->loadRowValues($edificios_grid->Recordset); // Load row values
				$edificios_grid->setRecordKey($edificios_grid->RowOldKey, $edificios_grid->Recordset); // Set old record key
			} else {
				$edificios_grid->loadRowValues(); // Load default values
				$edificios_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$edificios_grid->loadRowValues($edificios_grid->Recordset); // Load row values
		}
		$edificios->RowType = ROWTYPE_VIEW; // Render view
		if ($edificios_grid->isGridAdd()) // Grid add
			$edificios->RowType = ROWTYPE_ADD; // Render add
		if ($edificios_grid->isGridAdd() && $edificios->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$edificios_grid->restoreCurrentRowFormValues($edificios_grid->RowIndex); // Restore form values
		if ($edificios_grid->isGridEdit()) { // Grid edit
			if ($edificios->EventCancelled)
				$edificios_grid->restoreCurrentRowFormValues($edificios_grid->RowIndex); // Restore form values
			if ($edificios_grid->RowAction == "insert")
				$edificios->RowType = ROWTYPE_ADD; // Render add
			else
				$edificios->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($edificios_grid->isGridEdit() && ($edificios->RowType == ROWTYPE_EDIT || $edificios->RowType == ROWTYPE_ADD) && $edificios->EventCancelled) // Update failed
			$edificios_grid->restoreCurrentRowFormValues($edificios_grid->RowIndex); // Restore form values
		if ($edificios->RowType == ROWTYPE_EDIT) // Edit row
			$edificios_grid->EditRowCount++;
		if ($edificios->isConfirm()) // Confirm row
			$edificios_grid->restoreCurrentRowFormValues($edificios_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$edificios->RowAttrs->merge(["data-rowindex" => $edificios_grid->RowCount, "id" => "r" . $edificios_grid->RowCount . "_edificios", "data-rowtype" => $edificios->RowType]);

		// Render row
		$edificios_grid->renderRow();

		// Render list options
		$edificios_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($edificios_grid->RowAction != "delete" && $edificios_grid->RowAction != "insertdelete" && !($edificios_grid->RowAction == "insert" && $edificios->isConfirm() && $edificios_grid->emptyRow())) {
?>
	<tr <?php echo $edificios->rowAttributes() ?>>
<?php

// Render list options (body, left)
$edificios_grid->ListOptions->render("body", "left", $edificios_grid->RowCount);
?>
	<?php if ($edificios_grid->id_edificio->Visible) { // id_edificio ?>
		<td data-name="id_edificio" <?php echo $edificios_grid->id_edificio->cellAttributes() ?>>
<?php if ($edificios->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $edificios_grid->RowCount ?>_edificios_id_edificio" class="form-group"></span>
<input type="hidden" data-table="edificios" data-field="x_id_edificio" name="o<?php echo $edificios_grid->RowIndex ?>_id_edificio" id="o<?php echo $edificios_grid->RowIndex ?>_id_edificio" value="<?php echo HtmlEncode($edificios_grid->id_edificio->OldValue) ?>">
<?php } ?>
<?php if ($edificios->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $edificios_grid->RowCount ?>_edificios_id_edificio" class="form-group">
<span<?php echo $edificios_grid->id_edificio->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($edificios_grid->id_edificio->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="edificios" data-field="x_id_edificio" name="x<?php echo $edificios_grid->RowIndex ?>_id_edificio" id="x<?php echo $edificios_grid->RowIndex ?>_id_edificio" value="<?php echo HtmlEncode($edificios_grid->id_edificio->CurrentValue) ?>">
<?php } ?>
<?php if ($edificios->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $edificios_grid->RowCount ?>_edificios_id_edificio">
<span<?php echo $edificios_grid->id_edificio->viewAttributes() ?>><?php echo $edificios_grid->id_edificio->getViewValue() ?></span>
</span>
<?php if (!$edificios->isConfirm()) { ?>
<input type="hidden" data-table="edificios" data-field="x_id_edificio" name="x<?php echo $edificios_grid->RowIndex ?>_id_edificio" id="x<?php echo $edificios_grid->RowIndex ?>_id_edificio" value="<?php echo HtmlEncode($edificios_grid->id_edificio->FormValue) ?>">
<input type="hidden" data-table="edificios" data-field="x_id_edificio" name="o<?php echo $edificios_grid->RowIndex ?>_id_edificio" id="o<?php echo $edificios_grid->RowIndex ?>_id_edificio" value="<?php echo HtmlEncode($edificios_grid->id_edificio->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="edificios" data-field="x_id_edificio" name="fedificiosgrid$x<?php echo $edificios_grid->RowIndex ?>_id_edificio" id="fedificiosgrid$x<?php echo $edificios_grid->RowIndex ?>_id_edificio" value="<?php echo HtmlEncode($edificios_grid->id_edificio->FormValue) ?>">
<input type="hidden" data-table="edificios" data-field="x_id_edificio" name="fedificiosgrid$o<?php echo $edificios_grid->RowIndex ?>_id_edificio" id="fedificiosgrid$o<?php echo $edificios_grid->RowIndex ?>_id_edificio" value="<?php echo HtmlEncode($edificios_grid->id_edificio->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($edificios_grid->residencia_id->Visible) { // residencia_id ?>
		<td data-name="residencia_id" <?php echo $edificios_grid->residencia_id->cellAttributes() ?>>
<?php if ($edificios->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($edificios_grid->residencia_id->getSessionValue() != "") { ?>
<span id="el<?php echo $edificios_grid->RowCount ?>_edificios_residencia_id" class="form-group">
<span<?php echo $edificios_grid->residencia_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($edificios_grid->residencia_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $edificios_grid->RowIndex ?>_residencia_id" name="x<?php echo $edificios_grid->RowIndex ?>_residencia_id" value="<?php echo HtmlEncode($edificios_grid->residencia_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $edificios_grid->RowCount ?>_edificios_residencia_id" class="form-group">
<input type="text" data-table="edificios" data-field="x_residencia_id" name="x<?php echo $edificios_grid->RowIndex ?>_residencia_id" id="x<?php echo $edificios_grid->RowIndex ?>_residencia_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($edificios_grid->residencia_id->getPlaceHolder()) ?>" value="<?php echo $edificios_grid->residencia_id->EditValue ?>"<?php echo $edificios_grid->residencia_id->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="edificios" data-field="x_residencia_id" name="o<?php echo $edificios_grid->RowIndex ?>_residencia_id" id="o<?php echo $edificios_grid->RowIndex ?>_residencia_id" value="<?php echo HtmlEncode($edificios_grid->residencia_id->OldValue) ?>">
<?php } ?>
<?php if ($edificios->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($edificios_grid->residencia_id->getSessionValue() != "") { ?>
<span id="el<?php echo $edificios_grid->RowCount ?>_edificios_residencia_id" class="form-group">
<span<?php echo $edificios_grid->residencia_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($edificios_grid->residencia_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $edificios_grid->RowIndex ?>_residencia_id" name="x<?php echo $edificios_grid->RowIndex ?>_residencia_id" value="<?php echo HtmlEncode($edificios_grid->residencia_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $edificios_grid->RowCount ?>_edificios_residencia_id" class="form-group">
<input type="text" data-table="edificios" data-field="x_residencia_id" name="x<?php echo $edificios_grid->RowIndex ?>_residencia_id" id="x<?php echo $edificios_grid->RowIndex ?>_residencia_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($edificios_grid->residencia_id->getPlaceHolder()) ?>" value="<?php echo $edificios_grid->residencia_id->EditValue ?>"<?php echo $edificios_grid->residencia_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($edificios->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $edificios_grid->RowCount ?>_edificios_residencia_id">
<span<?php echo $edificios_grid->residencia_id->viewAttributes() ?>><?php echo $edificios_grid->residencia_id->getViewValue() ?></span>
</span>
<?php if (!$edificios->isConfirm()) { ?>
<input type="hidden" data-table="edificios" data-field="x_residencia_id" name="x<?php echo $edificios_grid->RowIndex ?>_residencia_id" id="x<?php echo $edificios_grid->RowIndex ?>_residencia_id" value="<?php echo HtmlEncode($edificios_grid->residencia_id->FormValue) ?>">
<input type="hidden" data-table="edificios" data-field="x_residencia_id" name="o<?php echo $edificios_grid->RowIndex ?>_residencia_id" id="o<?php echo $edificios_grid->RowIndex ?>_residencia_id" value="<?php echo HtmlEncode($edificios_grid->residencia_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="edificios" data-field="x_residencia_id" name="fedificiosgrid$x<?php echo $edificios_grid->RowIndex ?>_residencia_id" id="fedificiosgrid$x<?php echo $edificios_grid->RowIndex ?>_residencia_id" value="<?php echo HtmlEncode($edificios_grid->residencia_id->FormValue) ?>">
<input type="hidden" data-table="edificios" data-field="x_residencia_id" name="fedificiosgrid$o<?php echo $edificios_grid->RowIndex ?>_residencia_id" id="fedificiosgrid$o<?php echo $edificios_grid->RowIndex ?>_residencia_id" value="<?php echo HtmlEncode($edificios_grid->residencia_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($edificios_grid->nombre->Visible) { // nombre ?>
		<td data-name="nombre" <?php echo $edificios_grid->nombre->cellAttributes() ?>>
<?php if ($edificios->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $edificios_grid->RowCount ?>_edificios_nombre" class="form-group">
<input type="text" data-table="edificios" data-field="x_nombre" name="x<?php echo $edificios_grid->RowIndex ?>_nombre" id="x<?php echo $edificios_grid->RowIndex ?>_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($edificios_grid->nombre->getPlaceHolder()) ?>" value="<?php echo $edificios_grid->nombre->EditValue ?>"<?php echo $edificios_grid->nombre->editAttributes() ?>>
</span>
<input type="hidden" data-table="edificios" data-field="x_nombre" name="o<?php echo $edificios_grid->RowIndex ?>_nombre" id="o<?php echo $edificios_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($edificios_grid->nombre->OldValue) ?>">
<?php } ?>
<?php if ($edificios->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $edificios_grid->RowCount ?>_edificios_nombre" class="form-group">
<input type="text" data-table="edificios" data-field="x_nombre" name="x<?php echo $edificios_grid->RowIndex ?>_nombre" id="x<?php echo $edificios_grid->RowIndex ?>_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($edificios_grid->nombre->getPlaceHolder()) ?>" value="<?php echo $edificios_grid->nombre->EditValue ?>"<?php echo $edificios_grid->nombre->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($edificios->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $edificios_grid->RowCount ?>_edificios_nombre">
<span<?php echo $edificios_grid->nombre->viewAttributes() ?>><?php echo $edificios_grid->nombre->getViewValue() ?></span>
</span>
<?php if (!$edificios->isConfirm()) { ?>
<input type="hidden" data-table="edificios" data-field="x_nombre" name="x<?php echo $edificios_grid->RowIndex ?>_nombre" id="x<?php echo $edificios_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($edificios_grid->nombre->FormValue) ?>">
<input type="hidden" data-table="edificios" data-field="x_nombre" name="o<?php echo $edificios_grid->RowIndex ?>_nombre" id="o<?php echo $edificios_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($edificios_grid->nombre->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="edificios" data-field="x_nombre" name="fedificiosgrid$x<?php echo $edificios_grid->RowIndex ?>_nombre" id="fedificiosgrid$x<?php echo $edificios_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($edificios_grid->nombre->FormValue) ?>">
<input type="hidden" data-table="edificios" data-field="x_nombre" name="fedificiosgrid$o<?php echo $edificios_grid->RowIndex ?>_nombre" id="fedificiosgrid$o<?php echo $edificios_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($edificios_grid->nombre->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$edificios_grid->ListOptions->render("body", "right", $edificios_grid->RowCount);
?>
	</tr>
<?php if ($edificios->RowType == ROWTYPE_ADD || $edificios->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fedificiosgrid", "load"], function() {
	fedificiosgrid.updateLists(<?php echo $edificios_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$edificios_grid->isGridAdd() || $edificios->CurrentMode == "copy")
		if (!$edificios_grid->Recordset->EOF)
			$edificios_grid->Recordset->moveNext();
}
?>
<?php
	if ($edificios->CurrentMode == "add" || $edificios->CurrentMode == "copy" || $edificios->CurrentMode == "edit") {
		$edificios_grid->RowIndex = '$rowindex$';
		$edificios_grid->loadRowValues();

		// Set row properties
		$edificios->resetAttributes();
		$edificios->RowAttrs->merge(["data-rowindex" => $edificios_grid->RowIndex, "id" => "r0_edificios", "data-rowtype" => ROWTYPE_ADD]);
		$edificios->RowAttrs->appendClass("ew-template");
		$edificios->RowType = ROWTYPE_ADD;

		// Render row
		$edificios_grid->renderRow();

		// Render list options
		$edificios_grid->renderListOptions();
		$edificios_grid->StartRowCount = 0;
?>
	<tr <?php echo $edificios->rowAttributes() ?>>
<?php

// Render list options (body, left)
$edificios_grid->ListOptions->render("body", "left", $edificios_grid->RowIndex);
?>
	<?php if ($edificios_grid->id_edificio->Visible) { // id_edificio ?>
		<td data-name="id_edificio">
<?php if (!$edificios->isConfirm()) { ?>
<span id="el$rowindex$_edificios_id_edificio" class="form-group edificios_id_edificio"></span>
<?php } else { ?>
<span id="el$rowindex$_edificios_id_edificio" class="form-group edificios_id_edificio">
<span<?php echo $edificios_grid->id_edificio->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($edificios_grid->id_edificio->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="edificios" data-field="x_id_edificio" name="x<?php echo $edificios_grid->RowIndex ?>_id_edificio" id="x<?php echo $edificios_grid->RowIndex ?>_id_edificio" value="<?php echo HtmlEncode($edificios_grid->id_edificio->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="edificios" data-field="x_id_edificio" name="o<?php echo $edificios_grid->RowIndex ?>_id_edificio" id="o<?php echo $edificios_grid->RowIndex ?>_id_edificio" value="<?php echo HtmlEncode($edificios_grid->id_edificio->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($edificios_grid->residencia_id->Visible) { // residencia_id ?>
		<td data-name="residencia_id">
<?php if (!$edificios->isConfirm()) { ?>
<?php if ($edificios_grid->residencia_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_edificios_residencia_id" class="form-group edificios_residencia_id">
<span<?php echo $edificios_grid->residencia_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($edificios_grid->residencia_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $edificios_grid->RowIndex ?>_residencia_id" name="x<?php echo $edificios_grid->RowIndex ?>_residencia_id" value="<?php echo HtmlEncode($edificios_grid->residencia_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_edificios_residencia_id" class="form-group edificios_residencia_id">
<input type="text" data-table="edificios" data-field="x_residencia_id" name="x<?php echo $edificios_grid->RowIndex ?>_residencia_id" id="x<?php echo $edificios_grid->RowIndex ?>_residencia_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($edificios_grid->residencia_id->getPlaceHolder()) ?>" value="<?php echo $edificios_grid->residencia_id->EditValue ?>"<?php echo $edificios_grid->residencia_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_edificios_residencia_id" class="form-group edificios_residencia_id">
<span<?php echo $edificios_grid->residencia_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($edificios_grid->residencia_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="edificios" data-field="x_residencia_id" name="x<?php echo $edificios_grid->RowIndex ?>_residencia_id" id="x<?php echo $edificios_grid->RowIndex ?>_residencia_id" value="<?php echo HtmlEncode($edificios_grid->residencia_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="edificios" data-field="x_residencia_id" name="o<?php echo $edificios_grid->RowIndex ?>_residencia_id" id="o<?php echo $edificios_grid->RowIndex ?>_residencia_id" value="<?php echo HtmlEncode($edificios_grid->residencia_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($edificios_grid->nombre->Visible) { // nombre ?>
		<td data-name="nombre">
<?php if (!$edificios->isConfirm()) { ?>
<span id="el$rowindex$_edificios_nombre" class="form-group edificios_nombre">
<input type="text" data-table="edificios" data-field="x_nombre" name="x<?php echo $edificios_grid->RowIndex ?>_nombre" id="x<?php echo $edificios_grid->RowIndex ?>_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($edificios_grid->nombre->getPlaceHolder()) ?>" value="<?php echo $edificios_grid->nombre->EditValue ?>"<?php echo $edificios_grid->nombre->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_edificios_nombre" class="form-group edificios_nombre">
<span<?php echo $edificios_grid->nombre->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($edificios_grid->nombre->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="edificios" data-field="x_nombre" name="x<?php echo $edificios_grid->RowIndex ?>_nombre" id="x<?php echo $edificios_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($edificios_grid->nombre->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="edificios" data-field="x_nombre" name="o<?php echo $edificios_grid->RowIndex ?>_nombre" id="o<?php echo $edificios_grid->RowIndex ?>_nombre" value="<?php echo HtmlEncode($edificios_grid->nombre->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$edificios_grid->ListOptions->render("body", "right", $edificios_grid->RowIndex);
?>
<script>
loadjs.ready(["fedificiosgrid", "load"], function() {
	fedificiosgrid.updateLists(<?php echo $edificios_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($edificios->CurrentMode == "add" || $edificios->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $edificios_grid->FormKeyCountName ?>" id="<?php echo $edificios_grid->FormKeyCountName ?>" value="<?php echo $edificios_grid->KeyCount ?>">
<?php echo $edificios_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($edificios->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $edificios_grid->FormKeyCountName ?>" id="<?php echo $edificios_grid->FormKeyCountName ?>" value="<?php echo $edificios_grid->KeyCount ?>">
<?php echo $edificios_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($edificios->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fedificiosgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($edificios_grid->Recordset)
	$edificios_grid->Recordset->Close();
?>
<?php if ($edificios_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $edificios_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($edificios_grid->TotalRecords == 0 && !$edificios->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $edificios_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$edificios_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$edificios_grid->terminate();
?>