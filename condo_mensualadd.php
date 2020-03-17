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
$condo_mensual_add = new condo_mensual_add();

// Run the page
$condo_mensual_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$condo_mensual_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcondo_mensualadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcondo_mensualadd = currentForm = new ew.Form("fcondo_mensualadd", "add");

	// Validate form
	fcondo_mensualadd.validate = function() {
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
			<?php if ($condo_mensual_add->mes->Required) { ?>
				elm = this.getElements("x" + infix + "_mes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $condo_mensual_add->mes->caption(), $condo_mensual_add->mes->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_mes");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($condo_mensual_add->mes->errorMessage()) ?>");
			<?php if ($condo_mensual_add->ano->Required) { ?>
				elm = this.getElements("x" + infix + "_ano");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $condo_mensual_add->ano->caption(), $condo_mensual_add->ano->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ano");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($condo_mensual_add->ano->errorMessage()) ?>");
			<?php if ($condo_mensual_add->aux->Required) { ?>
				elm = this.getElements("x" + infix + "_aux");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $condo_mensual_add->aux->caption(), $condo_mensual_add->aux->RequiredErrorMessage)) ?>");
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
	fcondo_mensualadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcondo_mensualadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcondo_mensualadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $condo_mensual_add->showPageHeader(); ?>
<?php
$condo_mensual_add->showMessage();
?>
<form name="fcondo_mensualadd" id="fcondo_mensualadd" class="<?php echo $condo_mensual_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="condo_mensual">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$condo_mensual_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($condo_mensual_add->mes->Visible) { // mes ?>
	<div id="r_mes" class="form-group row">
		<label id="elh_condo_mensual_mes" for="x_mes" class="<?php echo $condo_mensual_add->LeftColumnClass ?>"><?php echo $condo_mensual_add->mes->caption() ?><?php echo $condo_mensual_add->mes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $condo_mensual_add->RightColumnClass ?>"><div <?php echo $condo_mensual_add->mes->cellAttributes() ?>>
<span id="el_condo_mensual_mes">
<input type="text" data-table="condo_mensual" data-field="x_mes" name="x_mes" id="x_mes" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($condo_mensual_add->mes->getPlaceHolder()) ?>" value="<?php echo $condo_mensual_add->mes->EditValue ?>"<?php echo $condo_mensual_add->mes->editAttributes() ?>>
</span>
<?php echo $condo_mensual_add->mes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($condo_mensual_add->ano->Visible) { // año ?>
	<div id="r_ano" class="form-group row">
		<label id="elh_condo_mensual_ano" for="x_ano" class="<?php echo $condo_mensual_add->LeftColumnClass ?>"><?php echo $condo_mensual_add->ano->caption() ?><?php echo $condo_mensual_add->ano->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $condo_mensual_add->RightColumnClass ?>"><div <?php echo $condo_mensual_add->ano->cellAttributes() ?>>
<span id="el_condo_mensual_ano">
<input type="text" data-table="condo_mensual" data-field="x_ano" name="x_ano" id="x_ano" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($condo_mensual_add->ano->getPlaceHolder()) ?>" value="<?php echo $condo_mensual_add->ano->EditValue ?>"<?php echo $condo_mensual_add->ano->editAttributes() ?>>
</span>
<?php echo $condo_mensual_add->ano->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($condo_mensual_add->aux->Visible) { // aux ?>
	<div id="r_aux" class="form-group row">
		<label id="elh_condo_mensual_aux" for="x_aux" class="<?php echo $condo_mensual_add->LeftColumnClass ?>"><?php echo $condo_mensual_add->aux->caption() ?><?php echo $condo_mensual_add->aux->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $condo_mensual_add->RightColumnClass ?>"><div <?php echo $condo_mensual_add->aux->cellAttributes() ?>>
<span id="el_condo_mensual_aux">
<input type="text" data-table="condo_mensual" data-field="x_aux" name="x_aux" id="x_aux" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($condo_mensual_add->aux->getPlaceHolder()) ?>" value="<?php echo $condo_mensual_add->aux->EditValue ?>"<?php echo $condo_mensual_add->aux->editAttributes() ?>>
</span>
<?php echo $condo_mensual_add->aux->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("gastos", explode(",", $condo_mensual->getCurrentDetailTable())) && $gastos->DetailAdd) {
?>
<?php if ($condo_mensual->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("gastos", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "gastosgrid.php" ?>
<?php } ?>
<?php if (!$condo_mensual_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $condo_mensual_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $condo_mensual_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$condo_mensual_add->showPageFooter();
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
$condo_mensual_add->terminate();
?>