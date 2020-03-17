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
$recibo_detalle_add = new recibo_detalle_add();

// Run the page
$recibo_detalle_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$recibo_detalle_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frecibo_detalleadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	frecibo_detalleadd = currentForm = new ew.Form("frecibo_detalleadd", "add");

	// Validate form
	frecibo_detalleadd.validate = function() {
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
			<?php if ($recibo_detalle_add->recibo_id->Required) { ?>
				elm = this.getElements("x" + infix + "_recibo_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibo_detalle_add->recibo_id->caption(), $recibo_detalle_add->recibo_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_recibo_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($recibo_detalle_add->recibo_id->errorMessage()) ?>");
			<?php if ($recibo_detalle_add->gastos_id->Required) { ?>
				elm = this.getElements("x" + infix + "_gastos_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibo_detalle_add->gastos_id->caption(), $recibo_detalle_add->gastos_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_gastos_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($recibo_detalle_add->gastos_id->errorMessage()) ?>");
			<?php if ($recibo_detalle_add->cantidad->Required) { ?>
				elm = this.getElements("x" + infix + "_cantidad");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibo_detalle_add->cantidad->caption(), $recibo_detalle_add->cantidad->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_cantidad");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($recibo_detalle_add->cantidad->errorMessage()) ?>");
			<?php if ($recibo_detalle_add->precio->Required) { ?>
				elm = this.getElements("x" + infix + "_precio");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibo_detalle_add->precio->caption(), $recibo_detalle_add->precio->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_precio");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($recibo_detalle_add->precio->errorMessage()) ?>");
			<?php if ($recibo_detalle_add->total->Required) { ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibo_detalle_add->total->caption(), $recibo_detalle_add->total->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($recibo_detalle_add->total->errorMessage()) ?>");

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
	frecibo_detalleadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frecibo_detalleadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("frecibo_detalleadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $recibo_detalle_add->showPageHeader(); ?>
<?php
$recibo_detalle_add->showMessage();
?>
<form name="frecibo_detalleadd" id="frecibo_detalleadd" class="<?php echo $recibo_detalle_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="recibo_detalle">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$recibo_detalle_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($recibo_detalle_add->recibo_id->Visible) { // recibo_id ?>
	<div id="r_recibo_id" class="form-group row">
		<label id="elh_recibo_detalle_recibo_id" for="x_recibo_id" class="<?php echo $recibo_detalle_add->LeftColumnClass ?>"><?php echo $recibo_detalle_add->recibo_id->caption() ?><?php echo $recibo_detalle_add->recibo_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibo_detalle_add->RightColumnClass ?>"><div <?php echo $recibo_detalle_add->recibo_id->cellAttributes() ?>>
<span id="el_recibo_detalle_recibo_id">
<input type="text" data-table="recibo_detalle" data-field="x_recibo_id" name="x_recibo_id" id="x_recibo_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($recibo_detalle_add->recibo_id->getPlaceHolder()) ?>" value="<?php echo $recibo_detalle_add->recibo_id->EditValue ?>"<?php echo $recibo_detalle_add->recibo_id->editAttributes() ?>>
</span>
<?php echo $recibo_detalle_add->recibo_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($recibo_detalle_add->gastos_id->Visible) { // gastos_id ?>
	<div id="r_gastos_id" class="form-group row">
		<label id="elh_recibo_detalle_gastos_id" for="x_gastos_id" class="<?php echo $recibo_detalle_add->LeftColumnClass ?>"><?php echo $recibo_detalle_add->gastos_id->caption() ?><?php echo $recibo_detalle_add->gastos_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibo_detalle_add->RightColumnClass ?>"><div <?php echo $recibo_detalle_add->gastos_id->cellAttributes() ?>>
<span id="el_recibo_detalle_gastos_id">
<input type="text" data-table="recibo_detalle" data-field="x_gastos_id" name="x_gastos_id" id="x_gastos_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($recibo_detalle_add->gastos_id->getPlaceHolder()) ?>" value="<?php echo $recibo_detalle_add->gastos_id->EditValue ?>"<?php echo $recibo_detalle_add->gastos_id->editAttributes() ?>>
</span>
<?php echo $recibo_detalle_add->gastos_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($recibo_detalle_add->cantidad->Visible) { // cantidad ?>
	<div id="r_cantidad" class="form-group row">
		<label id="elh_recibo_detalle_cantidad" for="x_cantidad" class="<?php echo $recibo_detalle_add->LeftColumnClass ?>"><?php echo $recibo_detalle_add->cantidad->caption() ?><?php echo $recibo_detalle_add->cantidad->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibo_detalle_add->RightColumnClass ?>"><div <?php echo $recibo_detalle_add->cantidad->cellAttributes() ?>>
<span id="el_recibo_detalle_cantidad">
<input type="text" data-table="recibo_detalle" data-field="x_cantidad" name="x_cantidad" id="x_cantidad" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($recibo_detalle_add->cantidad->getPlaceHolder()) ?>" value="<?php echo $recibo_detalle_add->cantidad->EditValue ?>"<?php echo $recibo_detalle_add->cantidad->editAttributes() ?>>
</span>
<?php echo $recibo_detalle_add->cantidad->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($recibo_detalle_add->precio->Visible) { // precio ?>
	<div id="r_precio" class="form-group row">
		<label id="elh_recibo_detalle_precio" for="x_precio" class="<?php echo $recibo_detalle_add->LeftColumnClass ?>"><?php echo $recibo_detalle_add->precio->caption() ?><?php echo $recibo_detalle_add->precio->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibo_detalle_add->RightColumnClass ?>"><div <?php echo $recibo_detalle_add->precio->cellAttributes() ?>>
<span id="el_recibo_detalle_precio">
<input type="text" data-table="recibo_detalle" data-field="x_precio" name="x_precio" id="x_precio" size="30" maxlength="17" placeholder="<?php echo HtmlEncode($recibo_detalle_add->precio->getPlaceHolder()) ?>" value="<?php echo $recibo_detalle_add->precio->EditValue ?>"<?php echo $recibo_detalle_add->precio->editAttributes() ?>>
</span>
<?php echo $recibo_detalle_add->precio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($recibo_detalle_add->total->Visible) { // total ?>
	<div id="r_total" class="form-group row">
		<label id="elh_recibo_detalle_total" for="x_total" class="<?php echo $recibo_detalle_add->LeftColumnClass ?>"><?php echo $recibo_detalle_add->total->caption() ?><?php echo $recibo_detalle_add->total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibo_detalle_add->RightColumnClass ?>"><div <?php echo $recibo_detalle_add->total->cellAttributes() ?>>
<span id="el_recibo_detalle_total">
<input type="text" data-table="recibo_detalle" data-field="x_total" name="x_total" id="x_total" size="30" maxlength="17" placeholder="<?php echo HtmlEncode($recibo_detalle_add->total->getPlaceHolder()) ?>" value="<?php echo $recibo_detalle_add->total->EditValue ?>"<?php echo $recibo_detalle_add->total->editAttributes() ?>>
</span>
<?php echo $recibo_detalle_add->total->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$recibo_detalle_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $recibo_detalle_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $recibo_detalle_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$recibo_detalle_add->showPageFooter();
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
$recibo_detalle_add->terminate();
?>