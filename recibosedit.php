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
$recibos_edit = new recibos_edit();

// Run the page
$recibos_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$recibos_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frecibosedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	frecibosedit = currentForm = new ew.Form("frecibosedit", "edit");

	// Validate form
	frecibosedit.validate = function() {
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
			<?php if ($recibos_edit->id_recibo->Required) { ?>
				elm = this.getElements("x" + infix + "_id_recibo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibos_edit->id_recibo->caption(), $recibos_edit->id_recibo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($recibos_edit->condo_mensual_id->Required) { ?>
				elm = this.getElements("x" + infix + "_condo_mensual_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibos_edit->condo_mensual_id->caption(), $recibos_edit->condo_mensual_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_condo_mensual_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($recibos_edit->condo_mensual_id->errorMessage()) ?>");
			<?php if ($recibos_edit->apartamento_id->Required) { ?>
				elm = this.getElements("x" + infix + "_apartamento_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibos_edit->apartamento_id->caption(), $recibos_edit->apartamento_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_apartamento_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($recibos_edit->apartamento_id->errorMessage()) ?>");
			<?php if ($recibos_edit->n_recibo->Required) { ?>
				elm = this.getElements("x" + infix + "_n_recibo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibos_edit->n_recibo->caption(), $recibos_edit->n_recibo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($recibos_edit->monto_pagar->Required) { ?>
				elm = this.getElements("x" + infix + "_monto_pagar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibos_edit->monto_pagar->caption(), $recibos_edit->monto_pagar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_monto_pagar");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($recibos_edit->monto_pagar->errorMessage()) ?>");
			<?php if ($recibos_edit->monto_ind->Required) { ?>
				elm = this.getElements("x" + infix + "_monto_ind");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibos_edit->monto_ind->caption(), $recibos_edit->monto_ind->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_monto_ind");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($recibos_edit->monto_ind->errorMessage()) ?>");
			<?php if ($recibos_edit->monto_alicuota->Required) { ?>
				elm = this.getElements("x" + infix + "_monto_alicuota");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $recibos_edit->monto_alicuota->caption(), $recibos_edit->monto_alicuota->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_monto_alicuota");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($recibos_edit->monto_alicuota->errorMessage()) ?>");

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
	frecibosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frecibosedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("frecibosedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $recibos_edit->showPageHeader(); ?>
<?php
$recibos_edit->showMessage();
?>
<form name="frecibosedit" id="frecibosedit" class="<?php echo $recibos_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="recibos">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$recibos_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($recibos_edit->id_recibo->Visible) { // id_recibo ?>
	<div id="r_id_recibo" class="form-group row">
		<label id="elh_recibos_id_recibo" class="<?php echo $recibos_edit->LeftColumnClass ?>"><?php echo $recibos_edit->id_recibo->caption() ?><?php echo $recibos_edit->id_recibo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibos_edit->RightColumnClass ?>"><div <?php echo $recibos_edit->id_recibo->cellAttributes() ?>>
<span id="el_recibos_id_recibo">
<span<?php echo $recibos_edit->id_recibo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($recibos_edit->id_recibo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="recibos" data-field="x_id_recibo" name="x_id_recibo" id="x_id_recibo" value="<?php echo HtmlEncode($recibos_edit->id_recibo->CurrentValue) ?>">
<?php echo $recibos_edit->id_recibo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($recibos_edit->condo_mensual_id->Visible) { // condo_mensual_id ?>
	<div id="r_condo_mensual_id" class="form-group row">
		<label id="elh_recibos_condo_mensual_id" for="x_condo_mensual_id" class="<?php echo $recibos_edit->LeftColumnClass ?>"><?php echo $recibos_edit->condo_mensual_id->caption() ?><?php echo $recibos_edit->condo_mensual_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibos_edit->RightColumnClass ?>"><div <?php echo $recibos_edit->condo_mensual_id->cellAttributes() ?>>
<span id="el_recibos_condo_mensual_id">
<input type="text" data-table="recibos" data-field="x_condo_mensual_id" name="x_condo_mensual_id" id="x_condo_mensual_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($recibos_edit->condo_mensual_id->getPlaceHolder()) ?>" value="<?php echo $recibos_edit->condo_mensual_id->EditValue ?>"<?php echo $recibos_edit->condo_mensual_id->editAttributes() ?>>
</span>
<?php echo $recibos_edit->condo_mensual_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($recibos_edit->apartamento_id->Visible) { // apartamento_id ?>
	<div id="r_apartamento_id" class="form-group row">
		<label id="elh_recibos_apartamento_id" for="x_apartamento_id" class="<?php echo $recibos_edit->LeftColumnClass ?>"><?php echo $recibos_edit->apartamento_id->caption() ?><?php echo $recibos_edit->apartamento_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibos_edit->RightColumnClass ?>"><div <?php echo $recibos_edit->apartamento_id->cellAttributes() ?>>
<span id="el_recibos_apartamento_id">
<input type="text" data-table="recibos" data-field="x_apartamento_id" name="x_apartamento_id" id="x_apartamento_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($recibos_edit->apartamento_id->getPlaceHolder()) ?>" value="<?php echo $recibos_edit->apartamento_id->EditValue ?>"<?php echo $recibos_edit->apartamento_id->editAttributes() ?>>
</span>
<?php echo $recibos_edit->apartamento_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($recibos_edit->n_recibo->Visible) { // n_recibo ?>
	<div id="r_n_recibo" class="form-group row">
		<label id="elh_recibos_n_recibo" for="x_n_recibo" class="<?php echo $recibos_edit->LeftColumnClass ?>"><?php echo $recibos_edit->n_recibo->caption() ?><?php echo $recibos_edit->n_recibo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibos_edit->RightColumnClass ?>"><div <?php echo $recibos_edit->n_recibo->cellAttributes() ?>>
<span id="el_recibos_n_recibo">
<input type="text" data-table="recibos" data-field="x_n_recibo" name="x_n_recibo" id="x_n_recibo" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($recibos_edit->n_recibo->getPlaceHolder()) ?>" value="<?php echo $recibos_edit->n_recibo->EditValue ?>"<?php echo $recibos_edit->n_recibo->editAttributes() ?>>
</span>
<?php echo $recibos_edit->n_recibo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($recibos_edit->monto_pagar->Visible) { // monto_pagar ?>
	<div id="r_monto_pagar" class="form-group row">
		<label id="elh_recibos_monto_pagar" for="x_monto_pagar" class="<?php echo $recibos_edit->LeftColumnClass ?>"><?php echo $recibos_edit->monto_pagar->caption() ?><?php echo $recibos_edit->monto_pagar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibos_edit->RightColumnClass ?>"><div <?php echo $recibos_edit->monto_pagar->cellAttributes() ?>>
<span id="el_recibos_monto_pagar">
<input type="text" data-table="recibos" data-field="x_monto_pagar" name="x_monto_pagar" id="x_monto_pagar" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($recibos_edit->monto_pagar->getPlaceHolder()) ?>" value="<?php echo $recibos_edit->monto_pagar->EditValue ?>"<?php echo $recibos_edit->monto_pagar->editAttributes() ?>>
</span>
<?php echo $recibos_edit->monto_pagar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($recibos_edit->monto_ind->Visible) { // monto_ind ?>
	<div id="r_monto_ind" class="form-group row">
		<label id="elh_recibos_monto_ind" for="x_monto_ind" class="<?php echo $recibos_edit->LeftColumnClass ?>"><?php echo $recibos_edit->monto_ind->caption() ?><?php echo $recibos_edit->monto_ind->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibos_edit->RightColumnClass ?>"><div <?php echo $recibos_edit->monto_ind->cellAttributes() ?>>
<span id="el_recibos_monto_ind">
<input type="text" data-table="recibos" data-field="x_monto_ind" name="x_monto_ind" id="x_monto_ind" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($recibos_edit->monto_ind->getPlaceHolder()) ?>" value="<?php echo $recibos_edit->monto_ind->EditValue ?>"<?php echo $recibos_edit->monto_ind->editAttributes() ?>>
</span>
<?php echo $recibos_edit->monto_ind->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($recibos_edit->monto_alicuota->Visible) { // monto_alicuota ?>
	<div id="r_monto_alicuota" class="form-group row">
		<label id="elh_recibos_monto_alicuota" for="x_monto_alicuota" class="<?php echo $recibos_edit->LeftColumnClass ?>"><?php echo $recibos_edit->monto_alicuota->caption() ?><?php echo $recibos_edit->monto_alicuota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $recibos_edit->RightColumnClass ?>"><div <?php echo $recibos_edit->monto_alicuota->cellAttributes() ?>>
<span id="el_recibos_monto_alicuota">
<input type="text" data-table="recibos" data-field="x_monto_alicuota" name="x_monto_alicuota" id="x_monto_alicuota" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($recibos_edit->monto_alicuota->getPlaceHolder()) ?>" value="<?php echo $recibos_edit->monto_alicuota->EditValue ?>"<?php echo $recibos_edit->monto_alicuota->editAttributes() ?>>
</span>
<?php echo $recibos_edit->monto_alicuota->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$recibos_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $recibos_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $recibos_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$recibos_edit->showPageFooter();
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
$recibos_edit->terminate();
?>