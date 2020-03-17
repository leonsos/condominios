<?php
namespace PHPMaker2020\condominios;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($apartamentos_grid))
	$apartamentos_grid = new apartamentos_grid();

// Run the page
$apartamentos_grid->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$apartamentos_grid->Page_Render();
?>
<?php if (!$apartamentos_grid->isExport()) { ?>
<script>
var fapartamentosgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fapartamentosgrid = new ew.Form("fapartamentosgrid", "grid");
	fapartamentosgrid.formKeyCountName = '<?php echo $apartamentos_grid->FormKeyCountName ?>';

	// Validate form
	fapartamentosgrid.validate = function() {
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
			<?php if ($apartamentos_grid->id_apartamento->Required) { ?>
				elm = this.getElements("x" + infix + "_id_apartamento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $apartamentos_grid->id_apartamento->caption(), $apartamentos_grid->id_apartamento->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($apartamentos_grid->propietario_id->Required) { ?>
				elm = this.getElements("x" + infix + "_propietario_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $apartamentos_grid->propietario_id->caption(), $apartamentos_grid->propietario_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($apartamentos_grid->piso_id->Required) { ?>
				elm = this.getElements("x" + infix + "_piso_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $apartamentos_grid->piso_id->caption(), $apartamentos_grid->piso_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_piso_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($apartamentos_grid->piso_id->errorMessage()) ?>");
			<?php if ($apartamentos_grid->metros_cuadrados->Required) { ?>
				elm = this.getElements("x" + infix + "_metros_cuadrados");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $apartamentos_grid->metros_cuadrados->caption(), $apartamentos_grid->metros_cuadrados->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($apartamentos_grid->nombre_numero->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre_numero");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $apartamentos_grid->nombre_numero->caption(), $apartamentos_grid->nombre_numero->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($apartamentos_grid->alicuota->Required) { ?>
				elm = this.getElements("x" + infix + "_alicuota");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $apartamentos_grid->alicuota->caption(), $apartamentos_grid->alicuota->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_alicuota");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($apartamentos_grid->alicuota->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fapartamentosgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "propietario_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "piso_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "metros_cuadrados", false)) return false;
		if (ew.valueChanged(fobj, infix, "nombre_numero", false)) return false;
		if (ew.valueChanged(fobj, infix, "alicuota", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fapartamentosgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fapartamentosgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fapartamentosgrid.lists["x_propietario_id"] = <?php echo $apartamentos_grid->propietario_id->Lookup->toClientList($apartamentos_grid) ?>;
	fapartamentosgrid.lists["x_propietario_id"].options = <?php echo JsonEncode($apartamentos_grid->propietario_id->lookupOptions()) ?>;
	loadjs.done("fapartamentosgrid");
});
</script>
<?php } ?>
<?php
$apartamentos_grid->renderOtherOptions();
?>
<?php if ($apartamentos_grid->TotalRecords > 0 || $apartamentos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($apartamentos_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> apartamentos">
<div id="fapartamentosgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_apartamentos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_apartamentosgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$apartamentos->RowType = ROWTYPE_HEADER;

// Render list options
$apartamentos_grid->renderListOptions();

// Render list options (header, left)
$apartamentos_grid->ListOptions->render("header", "left");
?>
<?php if ($apartamentos_grid->id_apartamento->Visible) { // id_apartamento ?>
	<?php if ($apartamentos_grid->SortUrl($apartamentos_grid->id_apartamento) == "") { ?>
		<th data-name="id_apartamento" class="<?php echo $apartamentos_grid->id_apartamento->headerCellClass() ?>"><div id="elh_apartamentos_id_apartamento" class="apartamentos_id_apartamento"><div class="ew-table-header-caption"><?php echo $apartamentos_grid->id_apartamento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_apartamento" class="<?php echo $apartamentos_grid->id_apartamento->headerCellClass() ?>"><div><div id="elh_apartamentos_id_apartamento" class="apartamentos_id_apartamento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $apartamentos_grid->id_apartamento->caption() ?></span><span class="ew-table-header-sort"><?php if ($apartamentos_grid->id_apartamento->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($apartamentos_grid->id_apartamento->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($apartamentos_grid->propietario_id->Visible) { // propietario_id ?>
	<?php if ($apartamentos_grid->SortUrl($apartamentos_grid->propietario_id) == "") { ?>
		<th data-name="propietario_id" class="<?php echo $apartamentos_grid->propietario_id->headerCellClass() ?>"><div id="elh_apartamentos_propietario_id" class="apartamentos_propietario_id"><div class="ew-table-header-caption"><?php echo $apartamentos_grid->propietario_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="propietario_id" class="<?php echo $apartamentos_grid->propietario_id->headerCellClass() ?>"><div><div id="elh_apartamentos_propietario_id" class="apartamentos_propietario_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $apartamentos_grid->propietario_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($apartamentos_grid->propietario_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($apartamentos_grid->propietario_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($apartamentos_grid->piso_id->Visible) { // piso_id ?>
	<?php if ($apartamentos_grid->SortUrl($apartamentos_grid->piso_id) == "") { ?>
		<th data-name="piso_id" class="<?php echo $apartamentos_grid->piso_id->headerCellClass() ?>"><div id="elh_apartamentos_piso_id" class="apartamentos_piso_id"><div class="ew-table-header-caption"><?php echo $apartamentos_grid->piso_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="piso_id" class="<?php echo $apartamentos_grid->piso_id->headerCellClass() ?>"><div><div id="elh_apartamentos_piso_id" class="apartamentos_piso_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $apartamentos_grid->piso_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($apartamentos_grid->piso_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($apartamentos_grid->piso_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($apartamentos_grid->metros_cuadrados->Visible) { // metros_cuadrados ?>
	<?php if ($apartamentos_grid->SortUrl($apartamentos_grid->metros_cuadrados) == "") { ?>
		<th data-name="metros_cuadrados" class="<?php echo $apartamentos_grid->metros_cuadrados->headerCellClass() ?>"><div id="elh_apartamentos_metros_cuadrados" class="apartamentos_metros_cuadrados"><div class="ew-table-header-caption"><?php echo $apartamentos_grid->metros_cuadrados->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="metros_cuadrados" class="<?php echo $apartamentos_grid->metros_cuadrados->headerCellClass() ?>"><div><div id="elh_apartamentos_metros_cuadrados" class="apartamentos_metros_cuadrados">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $apartamentos_grid->metros_cuadrados->caption() ?></span><span class="ew-table-header-sort"><?php if ($apartamentos_grid->metros_cuadrados->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($apartamentos_grid->metros_cuadrados->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($apartamentos_grid->nombre_numero->Visible) { // nombre_numero ?>
	<?php if ($apartamentos_grid->SortUrl($apartamentos_grid->nombre_numero) == "") { ?>
		<th data-name="nombre_numero" class="<?php echo $apartamentos_grid->nombre_numero->headerCellClass() ?>"><div id="elh_apartamentos_nombre_numero" class="apartamentos_nombre_numero"><div class="ew-table-header-caption"><?php echo $apartamentos_grid->nombre_numero->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre_numero" class="<?php echo $apartamentos_grid->nombre_numero->headerCellClass() ?>"><div><div id="elh_apartamentos_nombre_numero" class="apartamentos_nombre_numero">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $apartamentos_grid->nombre_numero->caption() ?></span><span class="ew-table-header-sort"><?php if ($apartamentos_grid->nombre_numero->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($apartamentos_grid->nombre_numero->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($apartamentos_grid->alicuota->Visible) { // alicuota ?>
	<?php if ($apartamentos_grid->SortUrl($apartamentos_grid->alicuota) == "") { ?>
		<th data-name="alicuota" class="<?php echo $apartamentos_grid->alicuota->headerCellClass() ?>"><div id="elh_apartamentos_alicuota" class="apartamentos_alicuota"><div class="ew-table-header-caption"><?php echo $apartamentos_grid->alicuota->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="alicuota" class="<?php echo $apartamentos_grid->alicuota->headerCellClass() ?>"><div><div id="elh_apartamentos_alicuota" class="apartamentos_alicuota">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $apartamentos_grid->alicuota->caption() ?></span><span class="ew-table-header-sort"><?php if ($apartamentos_grid->alicuota->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($apartamentos_grid->alicuota->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$apartamentos_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$apartamentos_grid->StartRecord = 1;
$apartamentos_grid->StopRecord = $apartamentos_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($apartamentos->isConfirm() || $apartamentos_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($apartamentos_grid->FormKeyCountName) && ($apartamentos_grid->isGridAdd() || $apartamentos_grid->isGridEdit() || $apartamentos->isConfirm())) {
		$apartamentos_grid->KeyCount = $CurrentForm->getValue($apartamentos_grid->FormKeyCountName);
		$apartamentos_grid->StopRecord = $apartamentos_grid->StartRecord + $apartamentos_grid->KeyCount - 1;
	}
}
$apartamentos_grid->RecordCount = $apartamentos_grid->StartRecord - 1;
if ($apartamentos_grid->Recordset && !$apartamentos_grid->Recordset->EOF) {
	$apartamentos_grid->Recordset->moveFirst();
	$selectLimit = $apartamentos_grid->UseSelectLimit;
	if (!$selectLimit && $apartamentos_grid->StartRecord > 1)
		$apartamentos_grid->Recordset->move($apartamentos_grid->StartRecord - 1);
} elseif (!$apartamentos->AllowAddDeleteRow && $apartamentos_grid->StopRecord == 0) {
	$apartamentos_grid->StopRecord = $apartamentos->GridAddRowCount;
}

// Initialize aggregate
$apartamentos->RowType = ROWTYPE_AGGREGATEINIT;
$apartamentos->resetAttributes();
$apartamentos_grid->renderRow();
if ($apartamentos_grid->isGridAdd())
	$apartamentos_grid->RowIndex = 0;
if ($apartamentos_grid->isGridEdit())
	$apartamentos_grid->RowIndex = 0;
while ($apartamentos_grid->RecordCount < $apartamentos_grid->StopRecord) {
	$apartamentos_grid->RecordCount++;
	if ($apartamentos_grid->RecordCount >= $apartamentos_grid->StartRecord) {
		$apartamentos_grid->RowCount++;
		if ($apartamentos_grid->isGridAdd() || $apartamentos_grid->isGridEdit() || $apartamentos->isConfirm()) {
			$apartamentos_grid->RowIndex++;
			$CurrentForm->Index = $apartamentos_grid->RowIndex;
			if ($CurrentForm->hasValue($apartamentos_grid->FormActionName) && ($apartamentos->isConfirm() || $apartamentos_grid->EventCancelled))
				$apartamentos_grid->RowAction = strval($CurrentForm->getValue($apartamentos_grid->FormActionName));
			elseif ($apartamentos_grid->isGridAdd())
				$apartamentos_grid->RowAction = "insert";
			else
				$apartamentos_grid->RowAction = "";
		}

		// Set up key count
		$apartamentos_grid->KeyCount = $apartamentos_grid->RowIndex;

		// Init row class and style
		$apartamentos->resetAttributes();
		$apartamentos->CssClass = "";
		if ($apartamentos_grid->isGridAdd()) {
			if ($apartamentos->CurrentMode == "copy") {
				$apartamentos_grid->loadRowValues($apartamentos_grid->Recordset); // Load row values
				$apartamentos_grid->setRecordKey($apartamentos_grid->RowOldKey, $apartamentos_grid->Recordset); // Set old record key
			} else {
				$apartamentos_grid->loadRowValues(); // Load default values
				$apartamentos_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$apartamentos_grid->loadRowValues($apartamentos_grid->Recordset); // Load row values
		}
		$apartamentos->RowType = ROWTYPE_VIEW; // Render view
		if ($apartamentos_grid->isGridAdd()) // Grid add
			$apartamentos->RowType = ROWTYPE_ADD; // Render add
		if ($apartamentos_grid->isGridAdd() && $apartamentos->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$apartamentos_grid->restoreCurrentRowFormValues($apartamentos_grid->RowIndex); // Restore form values
		if ($apartamentos_grid->isGridEdit()) { // Grid edit
			if ($apartamentos->EventCancelled)
				$apartamentos_grid->restoreCurrentRowFormValues($apartamentos_grid->RowIndex); // Restore form values
			if ($apartamentos_grid->RowAction == "insert")
				$apartamentos->RowType = ROWTYPE_ADD; // Render add
			else
				$apartamentos->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($apartamentos_grid->isGridEdit() && ($apartamentos->RowType == ROWTYPE_EDIT || $apartamentos->RowType == ROWTYPE_ADD) && $apartamentos->EventCancelled) // Update failed
			$apartamentos_grid->restoreCurrentRowFormValues($apartamentos_grid->RowIndex); // Restore form values
		if ($apartamentos->RowType == ROWTYPE_EDIT) // Edit row
			$apartamentos_grid->EditRowCount++;
		if ($apartamentos->isConfirm()) // Confirm row
			$apartamentos_grid->restoreCurrentRowFormValues($apartamentos_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$apartamentos->RowAttrs->merge(["data-rowindex" => $apartamentos_grid->RowCount, "id" => "r" . $apartamentos_grid->RowCount . "_apartamentos", "data-rowtype" => $apartamentos->RowType]);

		// Render row
		$apartamentos_grid->renderRow();

		// Render list options
		$apartamentos_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($apartamentos_grid->RowAction != "delete" && $apartamentos_grid->RowAction != "insertdelete" && !($apartamentos_grid->RowAction == "insert" && $apartamentos->isConfirm() && $apartamentos_grid->emptyRow())) {
?>
	<tr <?php echo $apartamentos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$apartamentos_grid->ListOptions->render("body", "left", $apartamentos_grid->RowCount);
?>
	<?php if ($apartamentos_grid->id_apartamento->Visible) { // id_apartamento ?>
		<td data-name="id_apartamento" <?php echo $apartamentos_grid->id_apartamento->cellAttributes() ?>>
<?php if ($apartamentos->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_id_apartamento" class="form-group"></span>
<input type="hidden" data-table="apartamentos" data-field="x_id_apartamento" name="o<?php echo $apartamentos_grid->RowIndex ?>_id_apartamento" id="o<?php echo $apartamentos_grid->RowIndex ?>_id_apartamento" value="<?php echo HtmlEncode($apartamentos_grid->id_apartamento->OldValue) ?>">
<?php } ?>
<?php if ($apartamentos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_id_apartamento" class="form-group">
<span<?php echo $apartamentos_grid->id_apartamento->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($apartamentos_grid->id_apartamento->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="apartamentos" data-field="x_id_apartamento" name="x<?php echo $apartamentos_grid->RowIndex ?>_id_apartamento" id="x<?php echo $apartamentos_grid->RowIndex ?>_id_apartamento" value="<?php echo HtmlEncode($apartamentos_grid->id_apartamento->CurrentValue) ?>">
<?php } ?>
<?php if ($apartamentos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_id_apartamento">
<span<?php echo $apartamentos_grid->id_apartamento->viewAttributes() ?>><?php echo $apartamentos_grid->id_apartamento->getViewValue() ?></span>
</span>
<?php if (!$apartamentos->isConfirm()) { ?>
<input type="hidden" data-table="apartamentos" data-field="x_id_apartamento" name="x<?php echo $apartamentos_grid->RowIndex ?>_id_apartamento" id="x<?php echo $apartamentos_grid->RowIndex ?>_id_apartamento" value="<?php echo HtmlEncode($apartamentos_grid->id_apartamento->FormValue) ?>">
<input type="hidden" data-table="apartamentos" data-field="x_id_apartamento" name="o<?php echo $apartamentos_grid->RowIndex ?>_id_apartamento" id="o<?php echo $apartamentos_grid->RowIndex ?>_id_apartamento" value="<?php echo HtmlEncode($apartamentos_grid->id_apartamento->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="apartamentos" data-field="x_id_apartamento" name="fapartamentosgrid$x<?php echo $apartamentos_grid->RowIndex ?>_id_apartamento" id="fapartamentosgrid$x<?php echo $apartamentos_grid->RowIndex ?>_id_apartamento" value="<?php echo HtmlEncode($apartamentos_grid->id_apartamento->FormValue) ?>">
<input type="hidden" data-table="apartamentos" data-field="x_id_apartamento" name="fapartamentosgrid$o<?php echo $apartamentos_grid->RowIndex ?>_id_apartamento" id="fapartamentosgrid$o<?php echo $apartamentos_grid->RowIndex ?>_id_apartamento" value="<?php echo HtmlEncode($apartamentos_grid->id_apartamento->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($apartamentos_grid->propietario_id->Visible) { // propietario_id ?>
		<td data-name="propietario_id" <?php echo $apartamentos_grid->propietario_id->cellAttributes() ?>>
<?php if ($apartamentos->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_propietario_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="apartamentos" data-field="x_propietario_id" data-value-separator="<?php echo $apartamentos_grid->propietario_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $apartamentos_grid->RowIndex ?>_propietario_id" name="x<?php echo $apartamentos_grid->RowIndex ?>_propietario_id"<?php echo $apartamentos_grid->propietario_id->editAttributes() ?>>
			<?php echo $apartamentos_grid->propietario_id->selectOptionListHtml("x{$apartamentos_grid->RowIndex}_propietario_id") ?>
		</select>
</div>
<?php echo $apartamentos_grid->propietario_id->Lookup->getParamTag($apartamentos_grid, "p_x" . $apartamentos_grid->RowIndex . "_propietario_id") ?>
</span>
<input type="hidden" data-table="apartamentos" data-field="x_propietario_id" name="o<?php echo $apartamentos_grid->RowIndex ?>_propietario_id" id="o<?php echo $apartamentos_grid->RowIndex ?>_propietario_id" value="<?php echo HtmlEncode($apartamentos_grid->propietario_id->OldValue) ?>">
<?php } ?>
<?php if ($apartamentos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_propietario_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="apartamentos" data-field="x_propietario_id" data-value-separator="<?php echo $apartamentos_grid->propietario_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $apartamentos_grid->RowIndex ?>_propietario_id" name="x<?php echo $apartamentos_grid->RowIndex ?>_propietario_id"<?php echo $apartamentos_grid->propietario_id->editAttributes() ?>>
			<?php echo $apartamentos_grid->propietario_id->selectOptionListHtml("x{$apartamentos_grid->RowIndex}_propietario_id") ?>
		</select>
</div>
<?php echo $apartamentos_grid->propietario_id->Lookup->getParamTag($apartamentos_grid, "p_x" . $apartamentos_grid->RowIndex . "_propietario_id") ?>
</span>
<?php } ?>
<?php if ($apartamentos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_propietario_id">
<span<?php echo $apartamentos_grid->propietario_id->viewAttributes() ?>><?php echo $apartamentos_grid->propietario_id->getViewValue() ?></span>
</span>
<?php if (!$apartamentos->isConfirm()) { ?>
<input type="hidden" data-table="apartamentos" data-field="x_propietario_id" name="x<?php echo $apartamentos_grid->RowIndex ?>_propietario_id" id="x<?php echo $apartamentos_grid->RowIndex ?>_propietario_id" value="<?php echo HtmlEncode($apartamentos_grid->propietario_id->FormValue) ?>">
<input type="hidden" data-table="apartamentos" data-field="x_propietario_id" name="o<?php echo $apartamentos_grid->RowIndex ?>_propietario_id" id="o<?php echo $apartamentos_grid->RowIndex ?>_propietario_id" value="<?php echo HtmlEncode($apartamentos_grid->propietario_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="apartamentos" data-field="x_propietario_id" name="fapartamentosgrid$x<?php echo $apartamentos_grid->RowIndex ?>_propietario_id" id="fapartamentosgrid$x<?php echo $apartamentos_grid->RowIndex ?>_propietario_id" value="<?php echo HtmlEncode($apartamentos_grid->propietario_id->FormValue) ?>">
<input type="hidden" data-table="apartamentos" data-field="x_propietario_id" name="fapartamentosgrid$o<?php echo $apartamentos_grid->RowIndex ?>_propietario_id" id="fapartamentosgrid$o<?php echo $apartamentos_grid->RowIndex ?>_propietario_id" value="<?php echo HtmlEncode($apartamentos_grid->propietario_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($apartamentos_grid->piso_id->Visible) { // piso_id ?>
		<td data-name="piso_id" <?php echo $apartamentos_grid->piso_id->cellAttributes() ?>>
<?php if ($apartamentos->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($apartamentos_grid->piso_id->getSessionValue() != "") { ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_piso_id" class="form-group">
<span<?php echo $apartamentos_grid->piso_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($apartamentos_grid->piso_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" name="x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" value="<?php echo HtmlEncode($apartamentos_grid->piso_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_piso_id" class="form-group">
<input type="text" data-table="apartamentos" data-field="x_piso_id" name="x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" id="x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($apartamentos_grid->piso_id->getPlaceHolder()) ?>" value="<?php echo $apartamentos_grid->piso_id->EditValue ?>"<?php echo $apartamentos_grid->piso_id->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="apartamentos" data-field="x_piso_id" name="o<?php echo $apartamentos_grid->RowIndex ?>_piso_id" id="o<?php echo $apartamentos_grid->RowIndex ?>_piso_id" value="<?php echo HtmlEncode($apartamentos_grid->piso_id->OldValue) ?>">
<?php } ?>
<?php if ($apartamentos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($apartamentos_grid->piso_id->getSessionValue() != "") { ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_piso_id" class="form-group">
<span<?php echo $apartamentos_grid->piso_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($apartamentos_grid->piso_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" name="x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" value="<?php echo HtmlEncode($apartamentos_grid->piso_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_piso_id" class="form-group">
<input type="text" data-table="apartamentos" data-field="x_piso_id" name="x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" id="x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($apartamentos_grid->piso_id->getPlaceHolder()) ?>" value="<?php echo $apartamentos_grid->piso_id->EditValue ?>"<?php echo $apartamentos_grid->piso_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($apartamentos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_piso_id">
<span<?php echo $apartamentos_grid->piso_id->viewAttributes() ?>><?php echo $apartamentos_grid->piso_id->getViewValue() ?></span>
</span>
<?php if (!$apartamentos->isConfirm()) { ?>
<input type="hidden" data-table="apartamentos" data-field="x_piso_id" name="x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" id="x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" value="<?php echo HtmlEncode($apartamentos_grid->piso_id->FormValue) ?>">
<input type="hidden" data-table="apartamentos" data-field="x_piso_id" name="o<?php echo $apartamentos_grid->RowIndex ?>_piso_id" id="o<?php echo $apartamentos_grid->RowIndex ?>_piso_id" value="<?php echo HtmlEncode($apartamentos_grid->piso_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="apartamentos" data-field="x_piso_id" name="fapartamentosgrid$x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" id="fapartamentosgrid$x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" value="<?php echo HtmlEncode($apartamentos_grid->piso_id->FormValue) ?>">
<input type="hidden" data-table="apartamentos" data-field="x_piso_id" name="fapartamentosgrid$o<?php echo $apartamentos_grid->RowIndex ?>_piso_id" id="fapartamentosgrid$o<?php echo $apartamentos_grid->RowIndex ?>_piso_id" value="<?php echo HtmlEncode($apartamentos_grid->piso_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($apartamentos_grid->metros_cuadrados->Visible) { // metros_cuadrados ?>
		<td data-name="metros_cuadrados" <?php echo $apartamentos_grid->metros_cuadrados->cellAttributes() ?>>
<?php if ($apartamentos->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_metros_cuadrados" class="form-group">
<input type="text" data-table="apartamentos" data-field="x_metros_cuadrados" name="x<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" id="x<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($apartamentos_grid->metros_cuadrados->getPlaceHolder()) ?>" value="<?php echo $apartamentos_grid->metros_cuadrados->EditValue ?>"<?php echo $apartamentos_grid->metros_cuadrados->editAttributes() ?>>
</span>
<input type="hidden" data-table="apartamentos" data-field="x_metros_cuadrados" name="o<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" id="o<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" value="<?php echo HtmlEncode($apartamentos_grid->metros_cuadrados->OldValue) ?>">
<?php } ?>
<?php if ($apartamentos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_metros_cuadrados" class="form-group">
<input type="text" data-table="apartamentos" data-field="x_metros_cuadrados" name="x<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" id="x<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($apartamentos_grid->metros_cuadrados->getPlaceHolder()) ?>" value="<?php echo $apartamentos_grid->metros_cuadrados->EditValue ?>"<?php echo $apartamentos_grid->metros_cuadrados->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($apartamentos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_metros_cuadrados">
<span<?php echo $apartamentos_grid->metros_cuadrados->viewAttributes() ?>><?php echo $apartamentos_grid->metros_cuadrados->getViewValue() ?></span>
</span>
<?php if (!$apartamentos->isConfirm()) { ?>
<input type="hidden" data-table="apartamentos" data-field="x_metros_cuadrados" name="x<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" id="x<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" value="<?php echo HtmlEncode($apartamentos_grid->metros_cuadrados->FormValue) ?>">
<input type="hidden" data-table="apartamentos" data-field="x_metros_cuadrados" name="o<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" id="o<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" value="<?php echo HtmlEncode($apartamentos_grid->metros_cuadrados->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="apartamentos" data-field="x_metros_cuadrados" name="fapartamentosgrid$x<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" id="fapartamentosgrid$x<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" value="<?php echo HtmlEncode($apartamentos_grid->metros_cuadrados->FormValue) ?>">
<input type="hidden" data-table="apartamentos" data-field="x_metros_cuadrados" name="fapartamentosgrid$o<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" id="fapartamentosgrid$o<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" value="<?php echo HtmlEncode($apartamentos_grid->metros_cuadrados->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($apartamentos_grid->nombre_numero->Visible) { // nombre_numero ?>
		<td data-name="nombre_numero" <?php echo $apartamentos_grid->nombre_numero->cellAttributes() ?>>
<?php if ($apartamentos->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_nombre_numero" class="form-group">
<input type="text" data-table="apartamentos" data-field="x_nombre_numero" name="x<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" id="x<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($apartamentos_grid->nombre_numero->getPlaceHolder()) ?>" value="<?php echo $apartamentos_grid->nombre_numero->EditValue ?>"<?php echo $apartamentos_grid->nombre_numero->editAttributes() ?>>
</span>
<input type="hidden" data-table="apartamentos" data-field="x_nombre_numero" name="o<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" id="o<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" value="<?php echo HtmlEncode($apartamentos_grid->nombre_numero->OldValue) ?>">
<?php } ?>
<?php if ($apartamentos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_nombre_numero" class="form-group">
<input type="text" data-table="apartamentos" data-field="x_nombre_numero" name="x<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" id="x<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($apartamentos_grid->nombre_numero->getPlaceHolder()) ?>" value="<?php echo $apartamentos_grid->nombre_numero->EditValue ?>"<?php echo $apartamentos_grid->nombre_numero->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($apartamentos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_nombre_numero">
<span<?php echo $apartamentos_grid->nombre_numero->viewAttributes() ?>><?php echo $apartamentos_grid->nombre_numero->getViewValue() ?></span>
</span>
<?php if (!$apartamentos->isConfirm()) { ?>
<input type="hidden" data-table="apartamentos" data-field="x_nombre_numero" name="x<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" id="x<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" value="<?php echo HtmlEncode($apartamentos_grid->nombre_numero->FormValue) ?>">
<input type="hidden" data-table="apartamentos" data-field="x_nombre_numero" name="o<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" id="o<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" value="<?php echo HtmlEncode($apartamentos_grid->nombre_numero->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="apartamentos" data-field="x_nombre_numero" name="fapartamentosgrid$x<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" id="fapartamentosgrid$x<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" value="<?php echo HtmlEncode($apartamentos_grid->nombre_numero->FormValue) ?>">
<input type="hidden" data-table="apartamentos" data-field="x_nombre_numero" name="fapartamentosgrid$o<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" id="fapartamentosgrid$o<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" value="<?php echo HtmlEncode($apartamentos_grid->nombre_numero->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($apartamentos_grid->alicuota->Visible) { // alicuota ?>
		<td data-name="alicuota" <?php echo $apartamentos_grid->alicuota->cellAttributes() ?>>
<?php if ($apartamentos->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_alicuota" class="form-group">
<input type="text" data-table="apartamentos" data-field="x_alicuota" name="x<?php echo $apartamentos_grid->RowIndex ?>_alicuota" id="x<?php echo $apartamentos_grid->RowIndex ?>_alicuota" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($apartamentos_grid->alicuota->getPlaceHolder()) ?>" value="<?php echo $apartamentos_grid->alicuota->EditValue ?>"<?php echo $apartamentos_grid->alicuota->editAttributes() ?>>
</span>
<input type="hidden" data-table="apartamentos" data-field="x_alicuota" name="o<?php echo $apartamentos_grid->RowIndex ?>_alicuota" id="o<?php echo $apartamentos_grid->RowIndex ?>_alicuota" value="<?php echo HtmlEncode($apartamentos_grid->alicuota->OldValue) ?>">
<?php } ?>
<?php if ($apartamentos->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_alicuota" class="form-group">
<input type="text" data-table="apartamentos" data-field="x_alicuota" name="x<?php echo $apartamentos_grid->RowIndex ?>_alicuota" id="x<?php echo $apartamentos_grid->RowIndex ?>_alicuota" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($apartamentos_grid->alicuota->getPlaceHolder()) ?>" value="<?php echo $apartamentos_grid->alicuota->EditValue ?>"<?php echo $apartamentos_grid->alicuota->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($apartamentos->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $apartamentos_grid->RowCount ?>_apartamentos_alicuota">
<span<?php echo $apartamentos_grid->alicuota->viewAttributes() ?>><?php echo $apartamentos_grid->alicuota->getViewValue() ?></span>
</span>
<?php if (!$apartamentos->isConfirm()) { ?>
<input type="hidden" data-table="apartamentos" data-field="x_alicuota" name="x<?php echo $apartamentos_grid->RowIndex ?>_alicuota" id="x<?php echo $apartamentos_grid->RowIndex ?>_alicuota" value="<?php echo HtmlEncode($apartamentos_grid->alicuota->FormValue) ?>">
<input type="hidden" data-table="apartamentos" data-field="x_alicuota" name="o<?php echo $apartamentos_grid->RowIndex ?>_alicuota" id="o<?php echo $apartamentos_grid->RowIndex ?>_alicuota" value="<?php echo HtmlEncode($apartamentos_grid->alicuota->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="apartamentos" data-field="x_alicuota" name="fapartamentosgrid$x<?php echo $apartamentos_grid->RowIndex ?>_alicuota" id="fapartamentosgrid$x<?php echo $apartamentos_grid->RowIndex ?>_alicuota" value="<?php echo HtmlEncode($apartamentos_grid->alicuota->FormValue) ?>">
<input type="hidden" data-table="apartamentos" data-field="x_alicuota" name="fapartamentosgrid$o<?php echo $apartamentos_grid->RowIndex ?>_alicuota" id="fapartamentosgrid$o<?php echo $apartamentos_grid->RowIndex ?>_alicuota" value="<?php echo HtmlEncode($apartamentos_grid->alicuota->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$apartamentos_grid->ListOptions->render("body", "right", $apartamentos_grid->RowCount);
?>
	</tr>
<?php if ($apartamentos->RowType == ROWTYPE_ADD || $apartamentos->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fapartamentosgrid", "load"], function() {
	fapartamentosgrid.updateLists(<?php echo $apartamentos_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$apartamentos_grid->isGridAdd() || $apartamentos->CurrentMode == "copy")
		if (!$apartamentos_grid->Recordset->EOF)
			$apartamentos_grid->Recordset->moveNext();
}
?>
<?php
	if ($apartamentos->CurrentMode == "add" || $apartamentos->CurrentMode == "copy" || $apartamentos->CurrentMode == "edit") {
		$apartamentos_grid->RowIndex = '$rowindex$';
		$apartamentos_grid->loadRowValues();

		// Set row properties
		$apartamentos->resetAttributes();
		$apartamentos->RowAttrs->merge(["data-rowindex" => $apartamentos_grid->RowIndex, "id" => "r0_apartamentos", "data-rowtype" => ROWTYPE_ADD]);
		$apartamentos->RowAttrs->appendClass("ew-template");
		$apartamentos->RowType = ROWTYPE_ADD;

		// Render row
		$apartamentos_grid->renderRow();

		// Render list options
		$apartamentos_grid->renderListOptions();
		$apartamentos_grid->StartRowCount = 0;
?>
	<tr <?php echo $apartamentos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$apartamentos_grid->ListOptions->render("body", "left", $apartamentos_grid->RowIndex);
?>
	<?php if ($apartamentos_grid->id_apartamento->Visible) { // id_apartamento ?>
		<td data-name="id_apartamento">
<?php if (!$apartamentos->isConfirm()) { ?>
<span id="el$rowindex$_apartamentos_id_apartamento" class="form-group apartamentos_id_apartamento"></span>
<?php } else { ?>
<span id="el$rowindex$_apartamentos_id_apartamento" class="form-group apartamentos_id_apartamento">
<span<?php echo $apartamentos_grid->id_apartamento->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($apartamentos_grid->id_apartamento->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="apartamentos" data-field="x_id_apartamento" name="x<?php echo $apartamentos_grid->RowIndex ?>_id_apartamento" id="x<?php echo $apartamentos_grid->RowIndex ?>_id_apartamento" value="<?php echo HtmlEncode($apartamentos_grid->id_apartamento->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="apartamentos" data-field="x_id_apartamento" name="o<?php echo $apartamentos_grid->RowIndex ?>_id_apartamento" id="o<?php echo $apartamentos_grid->RowIndex ?>_id_apartamento" value="<?php echo HtmlEncode($apartamentos_grid->id_apartamento->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($apartamentos_grid->propietario_id->Visible) { // propietario_id ?>
		<td data-name="propietario_id">
<?php if (!$apartamentos->isConfirm()) { ?>
<span id="el$rowindex$_apartamentos_propietario_id" class="form-group apartamentos_propietario_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="apartamentos" data-field="x_propietario_id" data-value-separator="<?php echo $apartamentos_grid->propietario_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $apartamentos_grid->RowIndex ?>_propietario_id" name="x<?php echo $apartamentos_grid->RowIndex ?>_propietario_id"<?php echo $apartamentos_grid->propietario_id->editAttributes() ?>>
			<?php echo $apartamentos_grid->propietario_id->selectOptionListHtml("x{$apartamentos_grid->RowIndex}_propietario_id") ?>
		</select>
</div>
<?php echo $apartamentos_grid->propietario_id->Lookup->getParamTag($apartamentos_grid, "p_x" . $apartamentos_grid->RowIndex . "_propietario_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_apartamentos_propietario_id" class="form-group apartamentos_propietario_id">
<span<?php echo $apartamentos_grid->propietario_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($apartamentos_grid->propietario_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="apartamentos" data-field="x_propietario_id" name="x<?php echo $apartamentos_grid->RowIndex ?>_propietario_id" id="x<?php echo $apartamentos_grid->RowIndex ?>_propietario_id" value="<?php echo HtmlEncode($apartamentos_grid->propietario_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="apartamentos" data-field="x_propietario_id" name="o<?php echo $apartamentos_grid->RowIndex ?>_propietario_id" id="o<?php echo $apartamentos_grid->RowIndex ?>_propietario_id" value="<?php echo HtmlEncode($apartamentos_grid->propietario_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($apartamentos_grid->piso_id->Visible) { // piso_id ?>
		<td data-name="piso_id">
<?php if (!$apartamentos->isConfirm()) { ?>
<?php if ($apartamentos_grid->piso_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_apartamentos_piso_id" class="form-group apartamentos_piso_id">
<span<?php echo $apartamentos_grid->piso_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($apartamentos_grid->piso_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" name="x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" value="<?php echo HtmlEncode($apartamentos_grid->piso_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_apartamentos_piso_id" class="form-group apartamentos_piso_id">
<input type="text" data-table="apartamentos" data-field="x_piso_id" name="x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" id="x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($apartamentos_grid->piso_id->getPlaceHolder()) ?>" value="<?php echo $apartamentos_grid->piso_id->EditValue ?>"<?php echo $apartamentos_grid->piso_id->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_apartamentos_piso_id" class="form-group apartamentos_piso_id">
<span<?php echo $apartamentos_grid->piso_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($apartamentos_grid->piso_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="apartamentos" data-field="x_piso_id" name="x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" id="x<?php echo $apartamentos_grid->RowIndex ?>_piso_id" value="<?php echo HtmlEncode($apartamentos_grid->piso_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="apartamentos" data-field="x_piso_id" name="o<?php echo $apartamentos_grid->RowIndex ?>_piso_id" id="o<?php echo $apartamentos_grid->RowIndex ?>_piso_id" value="<?php echo HtmlEncode($apartamentos_grid->piso_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($apartamentos_grid->metros_cuadrados->Visible) { // metros_cuadrados ?>
		<td data-name="metros_cuadrados">
<?php if (!$apartamentos->isConfirm()) { ?>
<span id="el$rowindex$_apartamentos_metros_cuadrados" class="form-group apartamentos_metros_cuadrados">
<input type="text" data-table="apartamentos" data-field="x_metros_cuadrados" name="x<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" id="x<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($apartamentos_grid->metros_cuadrados->getPlaceHolder()) ?>" value="<?php echo $apartamentos_grid->metros_cuadrados->EditValue ?>"<?php echo $apartamentos_grid->metros_cuadrados->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_apartamentos_metros_cuadrados" class="form-group apartamentos_metros_cuadrados">
<span<?php echo $apartamentos_grid->metros_cuadrados->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($apartamentos_grid->metros_cuadrados->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="apartamentos" data-field="x_metros_cuadrados" name="x<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" id="x<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" value="<?php echo HtmlEncode($apartamentos_grid->metros_cuadrados->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="apartamentos" data-field="x_metros_cuadrados" name="o<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" id="o<?php echo $apartamentos_grid->RowIndex ?>_metros_cuadrados" value="<?php echo HtmlEncode($apartamentos_grid->metros_cuadrados->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($apartamentos_grid->nombre_numero->Visible) { // nombre_numero ?>
		<td data-name="nombre_numero">
<?php if (!$apartamentos->isConfirm()) { ?>
<span id="el$rowindex$_apartamentos_nombre_numero" class="form-group apartamentos_nombre_numero">
<input type="text" data-table="apartamentos" data-field="x_nombre_numero" name="x<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" id="x<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($apartamentos_grid->nombre_numero->getPlaceHolder()) ?>" value="<?php echo $apartamentos_grid->nombre_numero->EditValue ?>"<?php echo $apartamentos_grid->nombre_numero->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_apartamentos_nombre_numero" class="form-group apartamentos_nombre_numero">
<span<?php echo $apartamentos_grid->nombre_numero->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($apartamentos_grid->nombre_numero->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="apartamentos" data-field="x_nombre_numero" name="x<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" id="x<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" value="<?php echo HtmlEncode($apartamentos_grid->nombre_numero->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="apartamentos" data-field="x_nombre_numero" name="o<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" id="o<?php echo $apartamentos_grid->RowIndex ?>_nombre_numero" value="<?php echo HtmlEncode($apartamentos_grid->nombre_numero->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($apartamentos_grid->alicuota->Visible) { // alicuota ?>
		<td data-name="alicuota">
<?php if (!$apartamentos->isConfirm()) { ?>
<span id="el$rowindex$_apartamentos_alicuota" class="form-group apartamentos_alicuota">
<input type="text" data-table="apartamentos" data-field="x_alicuota" name="x<?php echo $apartamentos_grid->RowIndex ?>_alicuota" id="x<?php echo $apartamentos_grid->RowIndex ?>_alicuota" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($apartamentos_grid->alicuota->getPlaceHolder()) ?>" value="<?php echo $apartamentos_grid->alicuota->EditValue ?>"<?php echo $apartamentos_grid->alicuota->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_apartamentos_alicuota" class="form-group apartamentos_alicuota">
<span<?php echo $apartamentos_grid->alicuota->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($apartamentos_grid->alicuota->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="apartamentos" data-field="x_alicuota" name="x<?php echo $apartamentos_grid->RowIndex ?>_alicuota" id="x<?php echo $apartamentos_grid->RowIndex ?>_alicuota" value="<?php echo HtmlEncode($apartamentos_grid->alicuota->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="apartamentos" data-field="x_alicuota" name="o<?php echo $apartamentos_grid->RowIndex ?>_alicuota" id="o<?php echo $apartamentos_grid->RowIndex ?>_alicuota" value="<?php echo HtmlEncode($apartamentos_grid->alicuota->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$apartamentos_grid->ListOptions->render("body", "right", $apartamentos_grid->RowIndex);
?>
<script>
loadjs.ready(["fapartamentosgrid", "load"], function() {
	fapartamentosgrid.updateLists(<?php echo $apartamentos_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($apartamentos->CurrentMode == "add" || $apartamentos->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $apartamentos_grid->FormKeyCountName ?>" id="<?php echo $apartamentos_grid->FormKeyCountName ?>" value="<?php echo $apartamentos_grid->KeyCount ?>">
<?php echo $apartamentos_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($apartamentos->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $apartamentos_grid->FormKeyCountName ?>" id="<?php echo $apartamentos_grid->FormKeyCountName ?>" value="<?php echo $apartamentos_grid->KeyCount ?>">
<?php echo $apartamentos_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($apartamentos->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fapartamentosgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($apartamentos_grid->Recordset)
	$apartamentos_grid->Recordset->Close();
?>
<?php if ($apartamentos_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $apartamentos_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($apartamentos_grid->TotalRecords == 0 && !$apartamentos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $apartamentos_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$apartamentos_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$apartamentos_grid->terminate();
?>