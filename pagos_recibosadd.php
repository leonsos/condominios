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
$pagos_recibos_add = new pagos_recibos_add();

// Run the page
$pagos_recibos_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pagos_recibos_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpagos_recibosadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpagos_recibosadd = currentForm = new ew.Form("fpagos_recibosadd", "add");

	// Validate form
	fpagos_recibosadd.validate = function() {
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
			<?php if ($pagos_recibos_add->pagos_id->Required) { ?>
				elm = this.getElements("x" + infix + "_pagos_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pagos_recibos_add->pagos_id->caption(), $pagos_recibos_add->pagos_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pagos_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pagos_recibos_add->pagos_id->errorMessage()) ?>");
			<?php if ($pagos_recibos_add->recibos_id->Required) { ?>
				elm = this.getElements("x" + infix + "_recibos_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pagos_recibos_add->recibos_id->caption(), $pagos_recibos_add->recibos_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_recibos_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pagos_recibos_add->recibos_id->errorMessage()) ?>");

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
	fpagos_recibosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpagos_recibosadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpagos_recibosadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pagos_recibos_add->showPageHeader(); ?>
<?php
$pagos_recibos_add->showMessage();
?>
<form name="fpagos_recibosadd" id="fpagos_recibosadd" class="<?php echo $pagos_recibos_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pagos_recibos">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$pagos_recibos_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($pagos_recibos_add->pagos_id->Visible) { // pagos_id ?>
	<div id="r_pagos_id" class="form-group row">
		<label id="elh_pagos_recibos_pagos_id" for="x_pagos_id" class="<?php echo $pagos_recibos_add->LeftColumnClass ?>"><?php echo $pagos_recibos_add->pagos_id->caption() ?><?php echo $pagos_recibos_add->pagos_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pagos_recibos_add->RightColumnClass ?>"><div <?php echo $pagos_recibos_add->pagos_id->cellAttributes() ?>>
<span id="el_pagos_recibos_pagos_id">
<input type="text" data-table="pagos_recibos" data-field="x_pagos_id" name="x_pagos_id" id="x_pagos_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($pagos_recibos_add->pagos_id->getPlaceHolder()) ?>" value="<?php echo $pagos_recibos_add->pagos_id->EditValue ?>"<?php echo $pagos_recibos_add->pagos_id->editAttributes() ?>>
</span>
<?php echo $pagos_recibos_add->pagos_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pagos_recibos_add->recibos_id->Visible) { // recibos_id ?>
	<div id="r_recibos_id" class="form-group row">
		<label id="elh_pagos_recibos_recibos_id" for="x_recibos_id" class="<?php echo $pagos_recibos_add->LeftColumnClass ?>"><?php echo $pagos_recibos_add->recibos_id->caption() ?><?php echo $pagos_recibos_add->recibos_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pagos_recibos_add->RightColumnClass ?>"><div <?php echo $pagos_recibos_add->recibos_id->cellAttributes() ?>>
<span id="el_pagos_recibos_recibos_id">
<input type="text" data-table="pagos_recibos" data-field="x_recibos_id" name="x_recibos_id" id="x_recibos_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($pagos_recibos_add->recibos_id->getPlaceHolder()) ?>" value="<?php echo $pagos_recibos_add->recibos_id->EditValue ?>"<?php echo $pagos_recibos_add->recibos_id->editAttributes() ?>>
</span>
<?php echo $pagos_recibos_add->recibos_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$pagos_recibos_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $pagos_recibos_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pagos_recibos_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$pagos_recibos_add->showPageFooter();
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
$pagos_recibos_add->terminate();
?>