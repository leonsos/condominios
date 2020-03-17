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
$gastos_add = new gastos_add();

// Run the page
$gastos_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gastos_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgastosadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fgastosadd = currentForm = new ew.Form("fgastosadd", "add");

	// Validate form
	fgastosadd.validate = function() {
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
			<?php if ($gastos_add->tipo_gasto_id->Required) { ?>
				elm = this.getElements("x" + infix + "_tipo_gasto_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gastos_add->tipo_gasto_id->caption(), $gastos_add->tipo_gasto_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tipo_gasto_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gastos_add->tipo_gasto_id->errorMessage()) ?>");
			<?php if ($gastos_add->monto->Required) { ?>
				elm = this.getElements("x" + infix + "_monto");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gastos_add->monto->caption(), $gastos_add->monto->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_monto");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gastos_add->monto->errorMessage()) ?>");
			<?php if ($gastos_add->condo_mens_id->Required) { ?>
				elm = this.getElements("x" + infix + "_condo_mens_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gastos_add->condo_mens_id->caption(), $gastos_add->condo_mens_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_condo_mens_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gastos_add->condo_mens_id->errorMessage()) ?>");

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
	fgastosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgastosadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fgastosadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gastos_add->showPageHeader(); ?>
<?php
$gastos_add->showMessage();
?>
<form name="fgastosadd" id="fgastosadd" class="<?php echo $gastos_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gastos">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$gastos_add->IsModal ?>">
<?php if ($gastos->getCurrentMasterTable() == "condo_mensual") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="condo_mensual">
<input type="hidden" name="fk_id_condo_mensual" value="<?php echo $gastos_add->condo_mens_id->getSessionValue() ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($gastos_add->tipo_gasto_id->Visible) { // tipo_gasto_id ?>
	<div id="r_tipo_gasto_id" class="form-group row">
		<label id="elh_gastos_tipo_gasto_id" for="x_tipo_gasto_id" class="<?php echo $gastos_add->LeftColumnClass ?>"><?php echo $gastos_add->tipo_gasto_id->caption() ?><?php echo $gastos_add->tipo_gasto_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gastos_add->RightColumnClass ?>"><div <?php echo $gastos_add->tipo_gasto_id->cellAttributes() ?>>
<span id="el_gastos_tipo_gasto_id">
<input type="text" data-table="gastos" data-field="x_tipo_gasto_id" name="x_tipo_gasto_id" id="x_tipo_gasto_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gastos_add->tipo_gasto_id->getPlaceHolder()) ?>" value="<?php echo $gastos_add->tipo_gasto_id->EditValue ?>"<?php echo $gastos_add->tipo_gasto_id->editAttributes() ?>>
</span>
<?php echo $gastos_add->tipo_gasto_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gastos_add->monto->Visible) { // monto ?>
	<div id="r_monto" class="form-group row">
		<label id="elh_gastos_monto" for="x_monto" class="<?php echo $gastos_add->LeftColumnClass ?>"><?php echo $gastos_add->monto->caption() ?><?php echo $gastos_add->monto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gastos_add->RightColumnClass ?>"><div <?php echo $gastos_add->monto->cellAttributes() ?>>
<span id="el_gastos_monto">
<input type="text" data-table="gastos" data-field="x_monto" name="x_monto" id="x_monto" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($gastos_add->monto->getPlaceHolder()) ?>" value="<?php echo $gastos_add->monto->EditValue ?>"<?php echo $gastos_add->monto->editAttributes() ?>>
</span>
<?php echo $gastos_add->monto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($gastos_add->condo_mens_id->Visible) { // condo_mens_id ?>
	<div id="r_condo_mens_id" class="form-group row">
		<label id="elh_gastos_condo_mens_id" for="x_condo_mens_id" class="<?php echo $gastos_add->LeftColumnClass ?>"><?php echo $gastos_add->condo_mens_id->caption() ?><?php echo $gastos_add->condo_mens_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $gastos_add->RightColumnClass ?>"><div <?php echo $gastos_add->condo_mens_id->cellAttributes() ?>>
<?php if ($gastos_add->condo_mens_id->getSessionValue() != "") { ?>
<span id="el_gastos_condo_mens_id">
<span<?php echo $gastos_add->condo_mens_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gastos_add->condo_mens_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_condo_mens_id" name="x_condo_mens_id" value="<?php echo HtmlEncode($gastos_add->condo_mens_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_gastos_condo_mens_id">
<input type="text" data-table="gastos" data-field="x_condo_mens_id" name="x_condo_mens_id" id="x_condo_mens_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gastos_add->condo_mens_id->getPlaceHolder()) ?>" value="<?php echo $gastos_add->condo_mens_id->EditValue ?>"<?php echo $gastos_add->condo_mens_id->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $gastos_add->condo_mens_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$gastos_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $gastos_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gastos_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$gastos_add->showPageFooter();
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
$gastos_add->terminate();
?>