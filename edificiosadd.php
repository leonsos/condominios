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
$edificios_add = new edificios_add();

// Run the page
$edificios_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$edificios_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fedificiosadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fedificiosadd = currentForm = new ew.Form("fedificiosadd", "add");

	// Validate form
	fedificiosadd.validate = function() {
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
			<?php if ($edificios_add->residencia_id->Required) { ?>
				elm = this.getElements("x" + infix + "_residencia_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $edificios_add->residencia_id->caption(), $edificios_add->residencia_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_residencia_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($edificios_add->residencia_id->errorMessage()) ?>");
			<?php if ($edificios_add->nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $edificios_add->nombre->caption(), $edificios_add->nombre->RequiredErrorMessage)) ?>");
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
	fedificiosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fedificiosadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fedificiosadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $edificios_add->showPageHeader(); ?>
<?php
$edificios_add->showMessage();
?>
<form name="fedificiosadd" id="fedificiosadd" class="<?php echo $edificios_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="edificios">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$edificios_add->IsModal ?>">
<?php if ($edificios->getCurrentMasterTable() == "residencias") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="residencias">
<input type="hidden" name="fk_id_residencia" value="<?php echo $edificios_add->residencia_id->getSessionValue() ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($edificios_add->residencia_id->Visible) { // residencia_id ?>
	<div id="r_residencia_id" class="form-group row">
		<label id="elh_edificios_residencia_id" for="x_residencia_id" class="<?php echo $edificios_add->LeftColumnClass ?>"><?php echo $edificios_add->residencia_id->caption() ?><?php echo $edificios_add->residencia_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $edificios_add->RightColumnClass ?>"><div <?php echo $edificios_add->residencia_id->cellAttributes() ?>>
<?php if ($edificios_add->residencia_id->getSessionValue() != "") { ?>
<span id="el_edificios_residencia_id">
<span<?php echo $edificios_add->residencia_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($edificios_add->residencia_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_residencia_id" name="x_residencia_id" value="<?php echo HtmlEncode($edificios_add->residencia_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_edificios_residencia_id">
<input type="text" data-table="edificios" data-field="x_residencia_id" name="x_residencia_id" id="x_residencia_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($edificios_add->residencia_id->getPlaceHolder()) ?>" value="<?php echo $edificios_add->residencia_id->EditValue ?>"<?php echo $edificios_add->residencia_id->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $edificios_add->residencia_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($edificios_add->nombre->Visible) { // nombre ?>
	<div id="r_nombre" class="form-group row">
		<label id="elh_edificios_nombre" for="x_nombre" class="<?php echo $edificios_add->LeftColumnClass ?>"><?php echo $edificios_add->nombre->caption() ?><?php echo $edificios_add->nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $edificios_add->RightColumnClass ?>"><div <?php echo $edificios_add->nombre->cellAttributes() ?>>
<span id="el_edificios_nombre">
<input type="text" data-table="edificios" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($edificios_add->nombre->getPlaceHolder()) ?>" value="<?php echo $edificios_add->nombre->EditValue ?>"<?php echo $edificios_add->nombre->editAttributes() ?>>
</span>
<?php echo $edificios_add->nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$edificios_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $edificios_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $edificios_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$edificios_add->showPageFooter();
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
$edificios_add->terminate();
?>