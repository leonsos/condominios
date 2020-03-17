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
$edificios_edit = new edificios_edit();

// Run the page
$edificios_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$edificios_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fedificiosedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fedificiosedit = currentForm = new ew.Form("fedificiosedit", "edit");

	// Validate form
	fedificiosedit.validate = function() {
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
			<?php if ($edificios_edit->id_edificio->Required) { ?>
				elm = this.getElements("x" + infix + "_id_edificio");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $edificios_edit->id_edificio->caption(), $edificios_edit->id_edificio->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($edificios_edit->residencia_id->Required) { ?>
				elm = this.getElements("x" + infix + "_residencia_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $edificios_edit->residencia_id->caption(), $edificios_edit->residencia_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_residencia_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($edificios_edit->residencia_id->errorMessage()) ?>");
			<?php if ($edificios_edit->nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $edificios_edit->nombre->caption(), $edificios_edit->nombre->RequiredErrorMessage)) ?>");
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
	fedificiosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fedificiosedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fedificiosedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $edificios_edit->showPageHeader(); ?>
<?php
$edificios_edit->showMessage();
?>
<form name="fedificiosedit" id="fedificiosedit" class="<?php echo $edificios_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="edificios">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$edificios_edit->IsModal ?>">
<?php if ($edificios->getCurrentMasterTable() == "residencias") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="residencias">
<input type="hidden" name="fk_id_residencia" value="<?php echo $edificios_edit->residencia_id->getSessionValue() ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($edificios_edit->id_edificio->Visible) { // id_edificio ?>
	<div id="r_id_edificio" class="form-group row">
		<label id="elh_edificios_id_edificio" class="<?php echo $edificios_edit->LeftColumnClass ?>"><?php echo $edificios_edit->id_edificio->caption() ?><?php echo $edificios_edit->id_edificio->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $edificios_edit->RightColumnClass ?>"><div <?php echo $edificios_edit->id_edificio->cellAttributes() ?>>
<span id="el_edificios_id_edificio">
<span<?php echo $edificios_edit->id_edificio->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($edificios_edit->id_edificio->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="edificios" data-field="x_id_edificio" name="x_id_edificio" id="x_id_edificio" value="<?php echo HtmlEncode($edificios_edit->id_edificio->CurrentValue) ?>">
<?php echo $edificios_edit->id_edificio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($edificios_edit->residencia_id->Visible) { // residencia_id ?>
	<div id="r_residencia_id" class="form-group row">
		<label id="elh_edificios_residencia_id" for="x_residencia_id" class="<?php echo $edificios_edit->LeftColumnClass ?>"><?php echo $edificios_edit->residencia_id->caption() ?><?php echo $edificios_edit->residencia_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $edificios_edit->RightColumnClass ?>"><div <?php echo $edificios_edit->residencia_id->cellAttributes() ?>>
<?php if ($edificios_edit->residencia_id->getSessionValue() != "") { ?>
<span id="el_edificios_residencia_id">
<span<?php echo $edificios_edit->residencia_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($edificios_edit->residencia_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_residencia_id" name="x_residencia_id" value="<?php echo HtmlEncode($edificios_edit->residencia_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_edificios_residencia_id">
<input type="text" data-table="edificios" data-field="x_residencia_id" name="x_residencia_id" id="x_residencia_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($edificios_edit->residencia_id->getPlaceHolder()) ?>" value="<?php echo $edificios_edit->residencia_id->EditValue ?>"<?php echo $edificios_edit->residencia_id->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $edificios_edit->residencia_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($edificios_edit->nombre->Visible) { // nombre ?>
	<div id="r_nombre" class="form-group row">
		<label id="elh_edificios_nombre" for="x_nombre" class="<?php echo $edificios_edit->LeftColumnClass ?>"><?php echo $edificios_edit->nombre->caption() ?><?php echo $edificios_edit->nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $edificios_edit->RightColumnClass ?>"><div <?php echo $edificios_edit->nombre->cellAttributes() ?>>
<span id="el_edificios_nombre">
<input type="text" data-table="edificios" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($edificios_edit->nombre->getPlaceHolder()) ?>" value="<?php echo $edificios_edit->nombre->EditValue ?>"<?php echo $edificios_edit->nombre->editAttributes() ?>>
</span>
<?php echo $edificios_edit->nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$edificios_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $edificios_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $edificios_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$edificios_edit->showPageFooter();
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
$edificios_edit->terminate();
?>