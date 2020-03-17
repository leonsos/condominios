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
$apartamentos_edit = new apartamentos_edit();

// Run the page
$apartamentos_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$apartamentos_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fapartamentosedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fapartamentosedit = currentForm = new ew.Form("fapartamentosedit", "edit");

	// Validate form
	fapartamentosedit.validate = function() {
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
			<?php if ($apartamentos_edit->id_apartamento->Required) { ?>
				elm = this.getElements("x" + infix + "_id_apartamento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $apartamentos_edit->id_apartamento->caption(), $apartamentos_edit->id_apartamento->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($apartamentos_edit->propietario_id->Required) { ?>
				elm = this.getElements("x" + infix + "_propietario_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $apartamentos_edit->propietario_id->caption(), $apartamentos_edit->propietario_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_propietario_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($apartamentos_edit->propietario_id->errorMessage()) ?>");
			<?php if ($apartamentos_edit->piso_id->Required) { ?>
				elm = this.getElements("x" + infix + "_piso_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $apartamentos_edit->piso_id->caption(), $apartamentos_edit->piso_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_piso_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($apartamentos_edit->piso_id->errorMessage()) ?>");
			<?php if ($apartamentos_edit->metros_cuadrados->Required) { ?>
				elm = this.getElements("x" + infix + "_metros_cuadrados");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $apartamentos_edit->metros_cuadrados->caption(), $apartamentos_edit->metros_cuadrados->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($apartamentos_edit->nombre_numero->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre_numero");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $apartamentos_edit->nombre_numero->caption(), $apartamentos_edit->nombre_numero->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($apartamentos_edit->alicuota->Required) { ?>
				elm = this.getElements("x" + infix + "_alicuota");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $apartamentos_edit->alicuota->caption(), $apartamentos_edit->alicuota->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_alicuota");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($apartamentos_edit->alicuota->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fapartamentosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fapartamentosedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fapartamentosedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $apartamentos_edit->showPageHeader(); ?>
<?php
$apartamentos_edit->showMessage();
?>
<form name="fapartamentosedit" id="fapartamentosedit" class="<?php echo $apartamentos_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="apartamentos">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$apartamentos_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($apartamentos_edit->id_apartamento->Visible) { // id_apartamento ?>
	<div id="r_id_apartamento" class="form-group row">
		<label id="elh_apartamentos_id_apartamento" class="<?php echo $apartamentos_edit->LeftColumnClass ?>"><?php echo $apartamentos_edit->id_apartamento->caption() ?><?php echo $apartamentos_edit->id_apartamento->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $apartamentos_edit->RightColumnClass ?>"><div <?php echo $apartamentos_edit->id_apartamento->cellAttributes() ?>>
<span id="el_apartamentos_id_apartamento">
<span<?php echo $apartamentos_edit->id_apartamento->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($apartamentos_edit->id_apartamento->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="apartamentos" data-field="x_id_apartamento" name="x_id_apartamento" id="x_id_apartamento" value="<?php echo HtmlEncode($apartamentos_edit->id_apartamento->CurrentValue) ?>">
<?php echo $apartamentos_edit->id_apartamento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($apartamentos_edit->propietario_id->Visible) { // propietario_id ?>
	<div id="r_propietario_id" class="form-group row">
		<label id="elh_apartamentos_propietario_id" for="x_propietario_id" class="<?php echo $apartamentos_edit->LeftColumnClass ?>"><?php echo $apartamentos_edit->propietario_id->caption() ?><?php echo $apartamentos_edit->propietario_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $apartamentos_edit->RightColumnClass ?>"><div <?php echo $apartamentos_edit->propietario_id->cellAttributes() ?>>
<span id="el_apartamentos_propietario_id">
<input type="text" data-table="apartamentos" data-field="x_propietario_id" name="x_propietario_id" id="x_propietario_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($apartamentos_edit->propietario_id->getPlaceHolder()) ?>" value="<?php echo $apartamentos_edit->propietario_id->EditValue ?>"<?php echo $apartamentos_edit->propietario_id->editAttributes() ?>>
</span>
<?php echo $apartamentos_edit->propietario_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($apartamentos_edit->piso_id->Visible) { // piso_id ?>
	<div id="r_piso_id" class="form-group row">
		<label id="elh_apartamentos_piso_id" for="x_piso_id" class="<?php echo $apartamentos_edit->LeftColumnClass ?>"><?php echo $apartamentos_edit->piso_id->caption() ?><?php echo $apartamentos_edit->piso_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $apartamentos_edit->RightColumnClass ?>"><div <?php echo $apartamentos_edit->piso_id->cellAttributes() ?>>
<span id="el_apartamentos_piso_id">
<input type="text" data-table="apartamentos" data-field="x_piso_id" name="x_piso_id" id="x_piso_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($apartamentos_edit->piso_id->getPlaceHolder()) ?>" value="<?php echo $apartamentos_edit->piso_id->EditValue ?>"<?php echo $apartamentos_edit->piso_id->editAttributes() ?>>
</span>
<?php echo $apartamentos_edit->piso_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($apartamentos_edit->metros_cuadrados->Visible) { // metros_cuadrados ?>
	<div id="r_metros_cuadrados" class="form-group row">
		<label id="elh_apartamentos_metros_cuadrados" for="x_metros_cuadrados" class="<?php echo $apartamentos_edit->LeftColumnClass ?>"><?php echo $apartamentos_edit->metros_cuadrados->caption() ?><?php echo $apartamentos_edit->metros_cuadrados->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $apartamentos_edit->RightColumnClass ?>"><div <?php echo $apartamentos_edit->metros_cuadrados->cellAttributes() ?>>
<span id="el_apartamentos_metros_cuadrados">
<input type="text" data-table="apartamentos" data-field="x_metros_cuadrados" name="x_metros_cuadrados" id="x_metros_cuadrados" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($apartamentos_edit->metros_cuadrados->getPlaceHolder()) ?>" value="<?php echo $apartamentos_edit->metros_cuadrados->EditValue ?>"<?php echo $apartamentos_edit->metros_cuadrados->editAttributes() ?>>
</span>
<?php echo $apartamentos_edit->metros_cuadrados->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($apartamentos_edit->nombre_numero->Visible) { // nombre_numero ?>
	<div id="r_nombre_numero" class="form-group row">
		<label id="elh_apartamentos_nombre_numero" for="x_nombre_numero" class="<?php echo $apartamentos_edit->LeftColumnClass ?>"><?php echo $apartamentos_edit->nombre_numero->caption() ?><?php echo $apartamentos_edit->nombre_numero->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $apartamentos_edit->RightColumnClass ?>"><div <?php echo $apartamentos_edit->nombre_numero->cellAttributes() ?>>
<span id="el_apartamentos_nombre_numero">
<input type="text" data-table="apartamentos" data-field="x_nombre_numero" name="x_nombre_numero" id="x_nombre_numero" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($apartamentos_edit->nombre_numero->getPlaceHolder()) ?>" value="<?php echo $apartamentos_edit->nombre_numero->EditValue ?>"<?php echo $apartamentos_edit->nombre_numero->editAttributes() ?>>
</span>
<?php echo $apartamentos_edit->nombre_numero->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($apartamentos_edit->alicuota->Visible) { // alicuota ?>
	<div id="r_alicuota" class="form-group row">
		<label id="elh_apartamentos_alicuota" for="x_alicuota" class="<?php echo $apartamentos_edit->LeftColumnClass ?>"><?php echo $apartamentos_edit->alicuota->caption() ?><?php echo $apartamentos_edit->alicuota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $apartamentos_edit->RightColumnClass ?>"><div <?php echo $apartamentos_edit->alicuota->cellAttributes() ?>>
<span id="el_apartamentos_alicuota">
<input type="text" data-table="apartamentos" data-field="x_alicuota" name="x_alicuota" id="x_alicuota" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($apartamentos_edit->alicuota->getPlaceHolder()) ?>" value="<?php echo $apartamentos_edit->alicuota->EditValue ?>"<?php echo $apartamentos_edit->alicuota->editAttributes() ?>>
</span>
<?php echo $apartamentos_edit->alicuota->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$apartamentos_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $apartamentos_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $apartamentos_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$apartamentos_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$apartamentos_edit->terminate();
?>