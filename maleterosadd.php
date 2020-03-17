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
$maleteros_add = new maleteros_add();

// Run the page
$maleteros_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$maleteros_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmaleterosadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmaleterosadd = currentForm = new ew.Form("fmaleterosadd", "add");

	// Validate form
	fmaleterosadd.validate = function() {
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
			<?php if ($maleteros_add->nombre_numero->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre_numero");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $maleteros_add->nombre_numero->caption(), $maleteros_add->nombre_numero->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($maleteros_add->apartamento_id->Required) { ?>
				elm = this.getElements("x" + infix + "_apartamento_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $maleteros_add->apartamento_id->caption(), $maleteros_add->apartamento_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_apartamento_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($maleteros_add->apartamento_id->errorMessage()) ?>");

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
	fmaleterosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmaleterosadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmaleterosadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $maleteros_add->showPageHeader(); ?>
<?php
$maleteros_add->showMessage();
?>
<form name="fmaleterosadd" id="fmaleterosadd" class="<?php echo $maleteros_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="maleteros">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$maleteros_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($maleteros_add->nombre_numero->Visible) { // nombre_numero ?>
	<div id="r_nombre_numero" class="form-group row">
		<label id="elh_maleteros_nombre_numero" for="x_nombre_numero" class="<?php echo $maleteros_add->LeftColumnClass ?>"><?php echo $maleteros_add->nombre_numero->caption() ?><?php echo $maleteros_add->nombre_numero->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $maleteros_add->RightColumnClass ?>"><div <?php echo $maleteros_add->nombre_numero->cellAttributes() ?>>
<span id="el_maleteros_nombre_numero">
<input type="text" data-table="maleteros" data-field="x_nombre_numero" name="x_nombre_numero" id="x_nombre_numero" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($maleteros_add->nombre_numero->getPlaceHolder()) ?>" value="<?php echo $maleteros_add->nombre_numero->EditValue ?>"<?php echo $maleteros_add->nombre_numero->editAttributes() ?>>
</span>
<?php echo $maleteros_add->nombre_numero->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($maleteros_add->apartamento_id->Visible) { // apartamento_id ?>
	<div id="r_apartamento_id" class="form-group row">
		<label id="elh_maleteros_apartamento_id" for="x_apartamento_id" class="<?php echo $maleteros_add->LeftColumnClass ?>"><?php echo $maleteros_add->apartamento_id->caption() ?><?php echo $maleteros_add->apartamento_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $maleteros_add->RightColumnClass ?>"><div <?php echo $maleteros_add->apartamento_id->cellAttributes() ?>>
<span id="el_maleteros_apartamento_id">
<input type="text" data-table="maleteros" data-field="x_apartamento_id" name="x_apartamento_id" id="x_apartamento_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($maleteros_add->apartamento_id->getPlaceHolder()) ?>" value="<?php echo $maleteros_add->apartamento_id->EditValue ?>"<?php echo $maleteros_add->apartamento_id->editAttributes() ?>>
</span>
<?php echo $maleteros_add->apartamento_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$maleteros_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $maleteros_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $maleteros_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$maleteros_add->showPageFooter();
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
$maleteros_add->terminate();
?>