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
$pagos_recibos_edit = new pagos_recibos_edit();

// Run the page
$pagos_recibos_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pagos_recibos_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpagos_recibosedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpagos_recibosedit = currentForm = new ew.Form("fpagos_recibosedit", "edit");

	// Validate form
	fpagos_recibosedit.validate = function() {
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
			<?php if ($pagos_recibos_edit->id_pagos_recibos->Required) { ?>
				elm = this.getElements("x" + infix + "_id_pagos_recibos");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pagos_recibos_edit->id_pagos_recibos->caption(), $pagos_recibos_edit->id_pagos_recibos->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pagos_recibos_edit->pagos_id->Required) { ?>
				elm = this.getElements("x" + infix + "_pagos_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pagos_recibos_edit->pagos_id->caption(), $pagos_recibos_edit->pagos_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pagos_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pagos_recibos_edit->pagos_id->errorMessage()) ?>");
			<?php if ($pagos_recibos_edit->recibos_id->Required) { ?>
				elm = this.getElements("x" + infix + "_recibos_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pagos_recibos_edit->recibos_id->caption(), $pagos_recibos_edit->recibos_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_recibos_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pagos_recibos_edit->recibos_id->errorMessage()) ?>");

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
	fpagos_recibosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpagos_recibosedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpagos_recibosedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pagos_recibos_edit->showPageHeader(); ?>
<?php
$pagos_recibos_edit->showMessage();
?>
<form name="fpagos_recibosedit" id="fpagos_recibosedit" class="<?php echo $pagos_recibos_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pagos_recibos">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$pagos_recibos_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($pagos_recibos_edit->id_pagos_recibos->Visible) { // id_pagos_recibos ?>
	<div id="r_id_pagos_recibos" class="form-group row">
		<label id="elh_pagos_recibos_id_pagos_recibos" class="<?php echo $pagos_recibos_edit->LeftColumnClass ?>"><?php echo $pagos_recibos_edit->id_pagos_recibos->caption() ?><?php echo $pagos_recibos_edit->id_pagos_recibos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pagos_recibos_edit->RightColumnClass ?>"><div <?php echo $pagos_recibos_edit->id_pagos_recibos->cellAttributes() ?>>
<span id="el_pagos_recibos_id_pagos_recibos">
<span<?php echo $pagos_recibos_edit->id_pagos_recibos->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pagos_recibos_edit->id_pagos_recibos->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="pagos_recibos" data-field="x_id_pagos_recibos" name="x_id_pagos_recibos" id="x_id_pagos_recibos" value="<?php echo HtmlEncode($pagos_recibos_edit->id_pagos_recibos->CurrentValue) ?>">
<?php echo $pagos_recibos_edit->id_pagos_recibos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pagos_recibos_edit->pagos_id->Visible) { // pagos_id ?>
	<div id="r_pagos_id" class="form-group row">
		<label id="elh_pagos_recibos_pagos_id" for="x_pagos_id" class="<?php echo $pagos_recibos_edit->LeftColumnClass ?>"><?php echo $pagos_recibos_edit->pagos_id->caption() ?><?php echo $pagos_recibos_edit->pagos_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pagos_recibos_edit->RightColumnClass ?>"><div <?php echo $pagos_recibos_edit->pagos_id->cellAttributes() ?>>
<span id="el_pagos_recibos_pagos_id">
<input type="text" data-table="pagos_recibos" data-field="x_pagos_id" name="x_pagos_id" id="x_pagos_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($pagos_recibos_edit->pagos_id->getPlaceHolder()) ?>" value="<?php echo $pagos_recibos_edit->pagos_id->EditValue ?>"<?php echo $pagos_recibos_edit->pagos_id->editAttributes() ?>>
</span>
<?php echo $pagos_recibos_edit->pagos_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pagos_recibos_edit->recibos_id->Visible) { // recibos_id ?>
	<div id="r_recibos_id" class="form-group row">
		<label id="elh_pagos_recibos_recibos_id" for="x_recibos_id" class="<?php echo $pagos_recibos_edit->LeftColumnClass ?>"><?php echo $pagos_recibos_edit->recibos_id->caption() ?><?php echo $pagos_recibos_edit->recibos_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pagos_recibos_edit->RightColumnClass ?>"><div <?php echo $pagos_recibos_edit->recibos_id->cellAttributes() ?>>
<span id="el_pagos_recibos_recibos_id">
<input type="text" data-table="pagos_recibos" data-field="x_recibos_id" name="x_recibos_id" id="x_recibos_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($pagos_recibos_edit->recibos_id->getPlaceHolder()) ?>" value="<?php echo $pagos_recibos_edit->recibos_id->EditValue ?>"<?php echo $pagos_recibos_edit->recibos_id->editAttributes() ?>>
</span>
<?php echo $pagos_recibos_edit->recibos_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$pagos_recibos_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $pagos_recibos_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pagos_recibos_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$pagos_recibos_edit->showPageFooter();
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
$pagos_recibos_edit->terminate();
?>