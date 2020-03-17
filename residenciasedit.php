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
$residencias_edit = new residencias_edit();

// Run the page
$residencias_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$residencias_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fresidenciasedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fresidenciasedit = currentForm = new ew.Form("fresidenciasedit", "edit");

	// Validate form
	fresidenciasedit.validate = function() {
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
			<?php if ($residencias_edit->id_residencia->Required) { ?>
				elm = this.getElements("x" + infix + "_id_residencia");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $residencias_edit->id_residencia->caption(), $residencias_edit->id_residencia->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($residencias_edit->nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $residencias_edit->nombre->caption(), $residencias_edit->nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($residencias_edit->direccion->Required) { ?>
				elm = this.getElements("x" + infix + "_direccion");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $residencias_edit->direccion->caption(), $residencias_edit->direccion->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($residencias_edit->presidente->Required) { ?>
				elm = this.getElements("x" + infix + "_presidente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $residencias_edit->presidente->caption(), $residencias_edit->presidente->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($residencias_edit->presidente_telefono->Required) { ?>
				elm = this.getElements("x" + infix + "_presidente_telefono");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $residencias_edit->presidente_telefono->caption(), $residencias_edit->presidente_telefono->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_presidente_telefono");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($residencias_edit->presidente_telefono->errorMessage()) ?>");
			<?php if ($residencias_edit->consecutivo_recibo->Required) { ?>
				elm = this.getElements("x" + infix + "_consecutivo_recibo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $residencias_edit->consecutivo_recibo->caption(), $residencias_edit->consecutivo_recibo->RequiredErrorMessage)) ?>");
			<?php } ?>

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
	fresidenciasedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fresidenciasedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fresidenciasedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $residencias_edit->showPageHeader(); ?>
<?php
$residencias_edit->showMessage();
?>
<form name="fresidenciasedit" id="fresidenciasedit" class="<?php echo $residencias_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="residencias">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$residencias_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($residencias_edit->id_residencia->Visible) { // id_residencia ?>
	<div id="r_id_residencia" class="form-group row">
		<label id="elh_residencias_id_residencia" class="<?php echo $residencias_edit->LeftColumnClass ?>"><?php echo $residencias_edit->id_residencia->caption() ?><?php echo $residencias_edit->id_residencia->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $residencias_edit->RightColumnClass ?>"><div <?php echo $residencias_edit->id_residencia->cellAttributes() ?>>
<span id="el_residencias_id_residencia">
<span<?php echo $residencias_edit->id_residencia->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($residencias_edit->id_residencia->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="residencias" data-field="x_id_residencia" name="x_id_residencia" id="x_id_residencia" value="<?php echo HtmlEncode($residencias_edit->id_residencia->CurrentValue) ?>">
<?php echo $residencias_edit->id_residencia->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($residencias_edit->nombre->Visible) { // nombre ?>
	<div id="r_nombre" class="form-group row">
		<label id="elh_residencias_nombre" for="x_nombre" class="<?php echo $residencias_edit->LeftColumnClass ?>"><?php echo $residencias_edit->nombre->caption() ?><?php echo $residencias_edit->nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $residencias_edit->RightColumnClass ?>"><div <?php echo $residencias_edit->nombre->cellAttributes() ?>>
<span id="el_residencias_nombre">
<input type="text" data-table="residencias" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($residencias_edit->nombre->getPlaceHolder()) ?>" value="<?php echo $residencias_edit->nombre->EditValue ?>"<?php echo $residencias_edit->nombre->editAttributes() ?>>
</span>
<?php echo $residencias_edit->nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($residencias_edit->direccion->Visible) { // direccion ?>
	<div id="r_direccion" class="form-group row">
		<label id="elh_residencias_direccion" for="x_direccion" class="<?php echo $residencias_edit->LeftColumnClass ?>"><?php echo $residencias_edit->direccion->caption() ?><?php echo $residencias_edit->direccion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $residencias_edit->RightColumnClass ?>"><div <?php echo $residencias_edit->direccion->cellAttributes() ?>>
<span id="el_residencias_direccion">
<textarea data-table="residencias" data-field="x_direccion" name="x_direccion" id="x_direccion" cols="35" rows="4" placeholder="<?php echo HtmlEncode($residencias_edit->direccion->getPlaceHolder()) ?>"<?php echo $residencias_edit->direccion->editAttributes() ?>><?php echo $residencias_edit->direccion->EditValue ?></textarea>
</span>
<?php echo $residencias_edit->direccion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($residencias_edit->presidente->Visible) { // presidente ?>
	<div id="r_presidente" class="form-group row">
		<label id="elh_residencias_presidente" for="x_presidente" class="<?php echo $residencias_edit->LeftColumnClass ?>"><?php echo $residencias_edit->presidente->caption() ?><?php echo $residencias_edit->presidente->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $residencias_edit->RightColumnClass ?>"><div <?php echo $residencias_edit->presidente->cellAttributes() ?>>
<span id="el_residencias_presidente">
<input type="text" data-table="residencias" data-field="x_presidente" name="x_presidente" id="x_presidente" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($residencias_edit->presidente->getPlaceHolder()) ?>" value="<?php echo $residencias_edit->presidente->EditValue ?>"<?php echo $residencias_edit->presidente->editAttributes() ?>>
</span>
<?php echo $residencias_edit->presidente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($residencias_edit->presidente_telefono->Visible) { // presidente_telefono ?>
	<div id="r_presidente_telefono" class="form-group row">
		<label id="elh_residencias_presidente_telefono" for="x_presidente_telefono" class="<?php echo $residencias_edit->LeftColumnClass ?>"><?php echo $residencias_edit->presidente_telefono->caption() ?><?php echo $residencias_edit->presidente_telefono->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $residencias_edit->RightColumnClass ?>"><div <?php echo $residencias_edit->presidente_telefono->cellAttributes() ?>>
<span id="el_residencias_presidente_telefono">
<input type="text" data-table="residencias" data-field="x_presidente_telefono" name="x_presidente_telefono" id="x_presidente_telefono" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($residencias_edit->presidente_telefono->getPlaceHolder()) ?>" value="<?php echo $residencias_edit->presidente_telefono->EditValue ?>"<?php echo $residencias_edit->presidente_telefono->editAttributes() ?>>
</span>
<?php echo $residencias_edit->presidente_telefono->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($residencias_edit->consecutivo_recibo->Visible) { // consecutivo_recibo ?>
	<div id="r_consecutivo_recibo" class="form-group row">
		<label id="elh_residencias_consecutivo_recibo" for="x_consecutivo_recibo" class="<?php echo $residencias_edit->LeftColumnClass ?>"><?php echo $residencias_edit->consecutivo_recibo->caption() ?><?php echo $residencias_edit->consecutivo_recibo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $residencias_edit->RightColumnClass ?>"><div <?php echo $residencias_edit->consecutivo_recibo->cellAttributes() ?>>
<span id="el_residencias_consecutivo_recibo">
<input type="text" data-table="residencias" data-field="x_consecutivo_recibo" name="x_consecutivo_recibo" id="x_consecutivo_recibo" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($residencias_edit->consecutivo_recibo->getPlaceHolder()) ?>" value="<?php echo $residencias_edit->consecutivo_recibo->EditValue ?>"<?php echo $residencias_edit->consecutivo_recibo->editAttributes() ?>>
</span>
<?php echo $residencias_edit->consecutivo_recibo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("edificios", explode(",", $residencias->getCurrentDetailTable())) && $edificios->DetailEdit) {
?>
<?php if ($residencias->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("edificios", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "edificiosgrid.php" ?>
<?php } ?>
<?php if (!$residencias_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $residencias_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $residencias_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$residencias_edit->showPageFooter();
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
$residencias_edit->terminate();
?>