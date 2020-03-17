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
$recibos_add = new recibos_add();

// Run the page
$recibos_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$recibos_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frecibosadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	frecibosadd = currentForm = new ew.Form("frecibosadd", "add");

	// Validate form
	frecibosadd.validate = function() {
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
			<?php if ($recibos_add->condo_mensual_id->Required) { ?>
				elm = this.getElements("x" + infix + "_condo_mensual_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibos_add->condo_mensual_id->caption(), $recibos_add->condo_mensual_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_condo_mensual_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($recibos_add->condo_mensual_id->errorMessage()) ?>");
			<?php if ($recibos_add->apartamento_id->Required) { ?>
				elm = this.getElements("x" + infix + "_apartamento_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibos_add->apartamento_id->caption(), $recibos_add->apartamento_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_apartamento_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($recibos_add->apartamento_id->errorMessage()) ?>");
			<?php if ($recibos_add->n_recibo->Required) { ?>
				elm = this.getElements("x" + infix + "_n_recibo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibos_add->n_recibo->caption(), $recibos_add->n_recibo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($recibos_add->monto_pagar->Required) { ?>
				elm = this.getElements("x" + infix + "_monto_pagar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibos_add->monto_pagar->caption(), $recibos_add->monto_pagar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_monto_pagar");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($recibos_add->monto_pagar->errorMessage()) ?>");
			<?php if ($recibos_add->monto_ind->Required) { ?>
				elm = this.getElements("x" + infix + "_monto_ind");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibos_add->monto_ind->caption(), $recibos_add->monto_ind->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_monto_ind");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($recibos_add->monto_ind->errorMessage()) ?>");
			<?php if ($recibos_add->monto_alicuota->Required) { ?>
				elm = this.getElements("x" + infix + "_monto_alicuota");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibos_add->monto_alicuota->caption(), $recibos_add->monto_alicuota->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_monto_alicuota");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($recibos_add->monto_alicuota->errorMessage()) ?>");

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
	frecibosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frecibosadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("frecibosadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $recibos_add->showPageHeader(); ?>
<?php
$recibos_add->showMessage();
?>
<form name="frecibosadd" id="frecibosadd" class="<?php echo $recibos_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="recibos">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$recibos_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($recibos_add->condo_mensual_id->Visible) { // condo_mensual_id ?>
	<div id="r_condo_mensual_id" class="form-group row">
		<label id="elh_recibos_condo_mensual_id" for="x_condo_mensual_id" class="<?php echo $recibos_add->LeftColumnClass ?>"><?php echo $recibos_add->condo_mensual_id->caption() ?><?php echo $recibos_add->condo_mensual_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibos_add->RightColumnClass ?>"><div <?php echo $recibos_add->condo_mensual_id->cellAttributes() ?>>
<span id="el_recibos_condo_mensual_id">
<input type="text" data-table="recibos" data-field="x_condo_mensual_id" name="x_condo_mensual_id" id="x_condo_mensual_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($recibos_add->condo_mensual_id->getPlaceHolder()) ?>" value="<?php echo $recibos_add->condo_mensual_id->EditValue ?>"<?php echo $recibos_add->condo_mensual_id->editAttributes() ?>>
</span>
<?php echo $recibos_add->condo_mensual_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($recibos_add->apartamento_id->Visible) { // apartamento_id ?>
	<div id="r_apartamento_id" class="form-group row">
		<label id="elh_recibos_apartamento_id" for="x_apartamento_id" class="<?php echo $recibos_add->LeftColumnClass ?>"><?php echo $recibos_add->apartamento_id->caption() ?><?php echo $recibos_add->apartamento_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibos_add->RightColumnClass ?>"><div <?php echo $recibos_add->apartamento_id->cellAttributes() ?>>
<span id="el_recibos_apartamento_id">
<input type="text" data-table="recibos" data-field="x_apartamento_id" name="x_apartamento_id" id="x_apartamento_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($recibos_add->apartamento_id->getPlaceHolder()) ?>" value="<?php echo $recibos_add->apartamento_id->EditValue ?>"<?php echo $recibos_add->apartamento_id->editAttributes() ?>>
</span>
<?php echo $recibos_add->apartamento_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($recibos_add->n_recibo->Visible) { // n_recibo ?>
	<div id="r_n_recibo" class="form-group row">
		<label id="elh_recibos_n_recibo" for="x_n_recibo" class="<?php echo $recibos_add->LeftColumnClass ?>"><?php echo $recibos_add->n_recibo->caption() ?><?php echo $recibos_add->n_recibo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibos_add->RightColumnClass ?>"><div <?php echo $recibos_add->n_recibo->cellAttributes() ?>>
<span id="el_recibos_n_recibo">
<input type="text" data-table="recibos" data-field="x_n_recibo" name="x_n_recibo" id="x_n_recibo" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($recibos_add->n_recibo->getPlaceHolder()) ?>" value="<?php echo $recibos_add->n_recibo->EditValue ?>"<?php echo $recibos_add->n_recibo->editAttributes() ?>>
</span>
<?php echo $recibos_add->n_recibo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($recibos_add->monto_pagar->Visible) { // monto_pagar ?>
	<div id="r_monto_pagar" class="form-group row">
		<label id="elh_recibos_monto_pagar" for="x_monto_pagar" class="<?php echo $recibos_add->LeftColumnClass ?>"><?php echo $recibos_add->monto_pagar->caption() ?><?php echo $recibos_add->monto_pagar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibos_add->RightColumnClass ?>"><div <?php echo $recibos_add->monto_pagar->cellAttributes() ?>>
<span id="el_recibos_monto_pagar">
<input type="text" data-table="recibos" data-field="x_monto_pagar" name="x_monto_pagar" id="x_monto_pagar" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($recibos_add->monto_pagar->getPlaceHolder()) ?>" value="<?php echo $recibos_add->monto_pagar->EditValue ?>"<?php echo $recibos_add->monto_pagar->editAttributes() ?>>
</span>
<?php echo $recibos_add->monto_pagar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($recibos_add->monto_ind->Visible) { // monto_ind ?>
	<div id="r_monto_ind" class="form-group row">
		<label id="elh_recibos_monto_ind" for="x_monto_ind" class="<?php echo $recibos_add->LeftColumnClass ?>"><?php echo $recibos_add->monto_ind->caption() ?><?php echo $recibos_add->monto_ind->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibos_add->RightColumnClass ?>"><div <?php echo $recibos_add->monto_ind->cellAttributes() ?>>
<span id="el_recibos_monto_ind">
<input type="text" data-table="recibos" data-field="x_monto_ind" name="x_monto_ind" id="x_monto_ind" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($recibos_add->monto_ind->getPlaceHolder()) ?>" value="<?php echo $recibos_add->monto_ind->EditValue ?>"<?php echo $recibos_add->monto_ind->editAttributes() ?>>
</span>
<?php echo $recibos_add->monto_ind->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($recibos_add->monto_alicuota->Visible) { // monto_alicuota ?>
	<div id="r_monto_alicuota" class="form-group row">
		<label id="elh_recibos_monto_alicuota" for="x_monto_alicuota" class="<?php echo $recibos_add->LeftColumnClass ?>"><?php echo $recibos_add->monto_alicuota->caption() ?><?php echo $recibos_add->monto_alicuota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibos_add->RightColumnClass ?>"><div <?php echo $recibos_add->monto_alicuota->cellAttributes() ?>>
<span id="el_recibos_monto_alicuota">
<input type="text" data-table="recibos" data-field="x_monto_alicuota" name="x_monto_alicuota" id="x_monto_alicuota" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($recibos_add->monto_alicuota->getPlaceHolder()) ?>" value="<?php echo $recibos_add->monto_alicuota->EditValue ?>"<?php echo $recibos_add->monto_alicuota->editAttributes() ?>>
</span>
<?php echo $recibos_add->monto_alicuota->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$recibos_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $recibos_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $recibos_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$recibos_add->showPageFooter();
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
$recibos_add->terminate();
?>