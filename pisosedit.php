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
$pisos_edit = new pisos_edit();

// Run the page
$pisos_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pisos_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpisosedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpisosedit = currentForm = new ew.Form("fpisosedit", "edit");

	// Validate form
	fpisosedit.validate = function() {
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
			<?php if ($pisos_edit->id_piso->Required) { ?>
				elm = this.getElements("x" + infix + "_id_piso");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pisos_edit->id_piso->caption(), $pisos_edit->id_piso->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($pisos_edit->edificio_id->Required) { ?>
				elm = this.getElements("x" + infix + "_edificio_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pisos_edit->edificio_id->caption(), $pisos_edit->edificio_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_edificio_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pisos_edit->edificio_id->errorMessage()) ?>");
			<?php if ($pisos_edit->nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pisos_edit->nombre->caption(), $pisos_edit->nombre->RequiredErrorMessage)) ?>");
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
	fpisosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpisosedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpisosedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pisos_edit->showPageHeader(); ?>
<?php
$pisos_edit->showMessage();
?>
<form name="fpisosedit" id="fpisosedit" class="<?php echo $pisos_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pisos">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$pisos_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($pisos_edit->id_piso->Visible) { // id_piso ?>
	<div id="r_id_piso" class="form-group row">
		<label id="elh_pisos_id_piso" class="<?php echo $pisos_edit->LeftColumnClass ?>"><?php echo $pisos_edit->id_piso->caption() ?><?php echo $pisos_edit->id_piso->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pisos_edit->RightColumnClass ?>"><div <?php echo $pisos_edit->id_piso->cellAttributes() ?>>
<span id="el_pisos_id_piso">
<span<?php echo $pisos_edit->id_piso->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($pisos_edit->id_piso->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="pisos" data-field="x_id_piso" name="x_id_piso" id="x_id_piso" value="<?php echo HtmlEncode($pisos_edit->id_piso->CurrentValue) ?>">
<?php echo $pisos_edit->id_piso->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pisos_edit->edificio_id->Visible) { // edificio_id ?>
	<div id="r_edificio_id" class="form-group row">
		<label id="elh_pisos_edificio_id" for="x_edificio_id" class="<?php echo $pisos_edit->LeftColumnClass ?>"><?php echo $pisos_edit->edificio_id->caption() ?><?php echo $pisos_edit->edificio_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pisos_edit->RightColumnClass ?>"><div <?php echo $pisos_edit->edificio_id->cellAttributes() ?>>
<span id="el_pisos_edificio_id">
<input type="text" data-table="pisos" data-field="x_edificio_id" name="x_edificio_id" id="x_edificio_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($pisos_edit->edificio_id->getPlaceHolder()) ?>" value="<?php echo $pisos_edit->edificio_id->EditValue ?>"<?php echo $pisos_edit->edificio_id->editAttributes() ?>>
</span>
<?php echo $pisos_edit->edificio_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pisos_edit->nombre->Visible) { // nombre ?>
	<div id="r_nombre" class="form-group row">
		<label id="elh_pisos_nombre" for="x_nombre" class="<?php echo $pisos_edit->LeftColumnClass ?>"><?php echo $pisos_edit->nombre->caption() ?><?php echo $pisos_edit->nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pisos_edit->RightColumnClass ?>"><div <?php echo $pisos_edit->nombre->cellAttributes() ?>>
<span id="el_pisos_nombre">
<input type="text" data-table="pisos" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($pisos_edit->nombre->getPlaceHolder()) ?>" value="<?php echo $pisos_edit->nombre->EditValue ?>"<?php echo $pisos_edit->nombre->editAttributes() ?>>
</span>
<?php echo $pisos_edit->nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$pisos_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $pisos_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pisos_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$pisos_edit->showPageFooter();
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
$pisos_edit->terminate();
?>