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
$gastos_ind_edit = new gastos_ind_edit();

// Run the page
$gastos_ind_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gastos_ind_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgastos_indedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fgastos_indedit = currentForm = new ew.Form("fgastos_indedit", "edit");

	// Validate form
	fgastos_indedit.validate = function() {
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
			<?php if ($gastos_ind_edit->id_gasto_ind->Required) { ?>
				elm = this.getElements("x" + infix + "_id_gasto_ind");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gastos_ind_edit->id_gasto_ind->caption(), $gastos_ind_edit->id_gasto_ind->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gastos_ind_edit->tipo_gasto_id->Required) { ?>
				elm = this.getElements("x" + infix + "_tipo_gasto_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gastos_ind_edit->tipo_gasto_id->caption(), $gastos_ind_edit->tipo_gasto_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tipo_gasto_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gastos_ind_edit->tipo_gasto_id->errorMessage()) ?>");
			<?php if ($gastos_ind_edit->monto->Required) { ?>
				elm = this.getElements("x" + infix + "_monto");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gastos_ind_edit->monto->caption(), $gastos_ind_edit->monto->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_monto");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gastos_ind_edit->monto->errorMessage()) ?>");
			<?php if ($gastos_ind_edit->desde->Required) { ?>
				elm = this.getElements("x" + infix + "_desde");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gastos_ind_edit->desde->caption(), $gastos_ind_edit->desde->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_desde");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gastos_ind_edit->desde->errorMessage()) ?>");
			<?php if ($gastos_ind_edit->hasta->Required) { ?>
				elm = this.getElements("x" + infix + "_hasta");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gastos_ind_edit->hasta->caption(), $gastos_ind_edit->hasta->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_hasta");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gastos_ind_edit->hasta->errorMessage()) ?>");
			<?php if ($gastos_ind_edit->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gastos_ind_edit->status->caption(), $gastos_ind_edit->status->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gastos_ind_edit->status->errorMessage()) ?>");
			<?php if ($gastos_ind_edit->apartamento_id->Required) { ?>
				elm = this.getElements("x" + infix + "_apartamento_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gastos_ind_edit->apartamento_id->caption(), $gastos_ind_edit->apartamento_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_apartamento_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gastos_ind_edit->apartamento_id->errorMessage()) ?>");

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
	fgastos_indedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgastos_indedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fgastos_indedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gastos_ind_edit->showPageHeader(); ?>
<?php
$gastos_ind_edit->showMessage();
?>
<form name="fgastos_indedit" id="fgastos_indedit" class="<?php echo $gastos_ind_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gastos_ind">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$gastos_ind_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($gastos_ind_edit->id_gasto_ind->Visible) { // id_gasto_ind ?>
	<div id="r_id_gasto_ind" class="form-group row">
		<label id="elh_gastos_ind_id_gasto_ind" class="<?php echo $gastos_ind_edit->LeftColumnClass ?>"><?php echo $gastos_ind_edit->id_gasto_ind->caption() ?><?php echo $gastos_ind_edit->id_gasto_ind->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gastos_ind_edit->RightColumnClass ?>"><div <?php echo $gastos_ind_edit->id_gasto_ind->cellAttributes() ?>>
<span id="el_gastos_ind_id_gasto_ind">
<span<?php echo $gastos_ind_edit->id_gasto_ind->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gastos_ind_edit->id_gasto_ind->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="gastos_ind" data-field="x_id_gasto_ind" name="x_id_gasto_ind" id="x_id_gasto_ind" value="<?php echo HtmlEncode($gastos_ind_edit->id_gasto_ind->CurrentValue) ?>">
<?php echo $gastos_ind_edit->id_gasto_ind->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gastos_ind_edit->tipo_gasto_id->Visible) { // tipo_gasto_id ?>
	<div id="r_tipo_gasto_id" class="form-group row">
		<label id="elh_gastos_ind_tipo_gasto_id" for="x_tipo_gasto_id" class="<?php echo $gastos_ind_edit->LeftColumnClass ?>"><?php echo $gastos_ind_edit->tipo_gasto_id->caption() ?><?php echo $gastos_ind_edit->tipo_gasto_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gastos_ind_edit->RightColumnClass ?>"><div <?php echo $gastos_ind_edit->tipo_gasto_id->cellAttributes() ?>>
<span id="el_gastos_ind_tipo_gasto_id">
<input type="text" data-table="gastos_ind" data-field="x_tipo_gasto_id" name="x_tipo_gasto_id" id="x_tipo_gasto_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gastos_ind_edit->tipo_gasto_id->getPlaceHolder()) ?>" value="<?php echo $gastos_ind_edit->tipo_gasto_id->EditValue ?>"<?php echo $gastos_ind_edit->tipo_gasto_id->editAttributes() ?>>
</span>
<?php echo $gastos_ind_edit->tipo_gasto_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gastos_ind_edit->monto->Visible) { // monto ?>
	<div id="r_monto" class="form-group row">
		<label id="elh_gastos_ind_monto" for="x_monto" class="<?php echo $gastos_ind_edit->LeftColumnClass ?>"><?php echo $gastos_ind_edit->monto->caption() ?><?php echo $gastos_ind_edit->monto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gastos_ind_edit->RightColumnClass ?>"><div <?php echo $gastos_ind_edit->monto->cellAttributes() ?>>
<span id="el_gastos_ind_monto">
<input type="text" data-table="gastos_ind" data-field="x_monto" name="x_monto" id="x_monto" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($gastos_ind_edit->monto->getPlaceHolder()) ?>" value="<?php echo $gastos_ind_edit->monto->EditValue ?>"<?php echo $gastos_ind_edit->monto->editAttributes() ?>>
</span>
<?php echo $gastos_ind_edit->monto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gastos_ind_edit->desde->Visible) { // desde ?>
	<div id="r_desde" class="form-group row">
		<label id="elh_gastos_ind_desde" for="x_desde" class="<?php echo $gastos_ind_edit->LeftColumnClass ?>"><?php echo $gastos_ind_edit->desde->caption() ?><?php echo $gastos_ind_edit->desde->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gastos_ind_edit->RightColumnClass ?>"><div <?php echo $gastos_ind_edit->desde->cellAttributes() ?>>
<span id="el_gastos_ind_desde">
<input type="text" data-table="gastos_ind" data-field="x_desde" name="x_desde" id="x_desde" maxlength="10" placeholder="<?php echo HtmlEncode($gastos_ind_edit->desde->getPlaceHolder()) ?>" value="<?php echo $gastos_ind_edit->desde->EditValue ?>"<?php echo $gastos_ind_edit->desde->editAttributes() ?>>
<?php if (!$gastos_ind_edit->desde->ReadOnly && !$gastos_ind_edit->desde->Disabled && !isset($gastos_ind_edit->desde->EditAttrs["readonly"]) && !isset($gastos_ind_edit->desde->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fgastos_indedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fgastos_indedit", "x_desde", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $gastos_ind_edit->desde->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gastos_ind_edit->hasta->Visible) { // hasta ?>
	<div id="r_hasta" class="form-group row">
		<label id="elh_gastos_ind_hasta" for="x_hasta" class="<?php echo $gastos_ind_edit->LeftColumnClass ?>"><?php echo $gastos_ind_edit->hasta->caption() ?><?php echo $gastos_ind_edit->hasta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gastos_ind_edit->RightColumnClass ?>"><div <?php echo $gastos_ind_edit->hasta->cellAttributes() ?>>
<span id="el_gastos_ind_hasta">
<input type="text" data-table="gastos_ind" data-field="x_hasta" name="x_hasta" id="x_hasta" maxlength="10" placeholder="<?php echo HtmlEncode($gastos_ind_edit->hasta->getPlaceHolder()) ?>" value="<?php echo $gastos_ind_edit->hasta->EditValue ?>"<?php echo $gastos_ind_edit->hasta->editAttributes() ?>>
<?php if (!$gastos_ind_edit->hasta->ReadOnly && !$gastos_ind_edit->hasta->Disabled && !isset($gastos_ind_edit->hasta->EditAttrs["readonly"]) && !isset($gastos_ind_edit->hasta->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fgastos_indedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fgastos_indedit", "x_hasta", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $gastos_ind_edit->hasta->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gastos_ind_edit->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_gastos_ind_status" for="x_status" class="<?php echo $gastos_ind_edit->LeftColumnClass ?>"><?php echo $gastos_ind_edit->status->caption() ?><?php echo $gastos_ind_edit->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gastos_ind_edit->RightColumnClass ?>"><div <?php echo $gastos_ind_edit->status->cellAttributes() ?>>
<span id="el_gastos_ind_status">
<input type="text" data-table="gastos_ind" data-field="x_status" name="x_status" id="x_status" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gastos_ind_edit->status->getPlaceHolder()) ?>" value="<?php echo $gastos_ind_edit->status->EditValue ?>"<?php echo $gastos_ind_edit->status->editAttributes() ?>>
</span>
<?php echo $gastos_ind_edit->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gastos_ind_edit->apartamento_id->Visible) { // apartamento_id ?>
	<div id="r_apartamento_id" class="form-group row">
		<label id="elh_gastos_ind_apartamento_id" for="x_apartamento_id" class="<?php echo $gastos_ind_edit->LeftColumnClass ?>"><?php echo $gastos_ind_edit->apartamento_id->caption() ?><?php echo $gastos_ind_edit->apartamento_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gastos_ind_edit->RightColumnClass ?>"><div <?php echo $gastos_ind_edit->apartamento_id->cellAttributes() ?>>
<span id="el_gastos_ind_apartamento_id">
<input type="text" data-table="gastos_ind" data-field="x_apartamento_id" name="x_apartamento_id" id="x_apartamento_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gastos_ind_edit->apartamento_id->getPlaceHolder()) ?>" value="<?php echo $gastos_ind_edit->apartamento_id->EditValue ?>"<?php echo $gastos_ind_edit->apartamento_id->editAttributes() ?>>
</span>
<?php echo $gastos_ind_edit->apartamento_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$gastos_ind_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gastos_ind_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gastos_ind_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gastos_ind_edit->showPageFooter();
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
$gastos_ind_edit->terminate();
?>