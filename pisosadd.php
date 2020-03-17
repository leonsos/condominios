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
$pisos_add = new pisos_add();

// Run the page
$pisos_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pisos_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpisosadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpisosadd = currentForm = new ew.Form("fpisosadd", "add");

	// Validate form
	fpisosadd.validate = function() {
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
			<?php if ($pisos_add->edificio_id->Required) { ?>
				elm = this.getElements("x" + infix + "_edificio_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pisos_add->edificio_id->caption(), $pisos_add->edificio_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_edificio_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($pisos_add->edificio_id->errorMessage()) ?>");
			<?php if ($pisos_add->nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pisos_add->nombre->caption(), $pisos_add->nombre->RequiredErrorMessage)) ?>");
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
	fpisosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpisosadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpisosadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pisos_add->showPageHeader(); ?>
<?php
$pisos_add->showMessage();
?>
<form name="fpisosadd" id="fpisosadd" class="<?php echo $pisos_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pisos">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$pisos_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($pisos_add->edificio_id->Visible) { // edificio_id ?>
	<div id="r_edificio_id" class="form-group row">
		<label id="elh_pisos_edificio_id" for="x_edificio_id" class="<?php echo $pisos_add->LeftColumnClass ?>"><?php echo $pisos_add->edificio_id->caption() ?><?php echo $pisos_add->edificio_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pisos_add->RightColumnClass ?>"><div <?php echo $pisos_add->edificio_id->cellAttributes() ?>>
<span id="el_pisos_edificio_id">
<input type="text" data-table="pisos" data-field="x_edificio_id" name="x_edificio_id" id="x_edificio_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($pisos_add->edificio_id->getPlaceHolder()) ?>" value="<?php echo $pisos_add->edificio_id->EditValue ?>"<?php echo $pisos_add->edificio_id->editAttributes() ?>>
</span>
<?php echo $pisos_add->edificio_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pisos_add->nombre->Visible) { // nombre ?>
	<div id="r_nombre" class="form-group row">
		<label id="elh_pisos_nombre" for="x_nombre" class="<?php echo $pisos_add->LeftColumnClass ?>"><?php echo $pisos_add->nombre->caption() ?><?php echo $pisos_add->nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pisos_add->RightColumnClass ?>"><div <?php echo $pisos_add->nombre->cellAttributes() ?>>
<span id="el_pisos_nombre">
<input type="text" data-table="pisos" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($pisos_add->nombre->getPlaceHolder()) ?>" value="<?php echo $pisos_add->nombre->EditValue ?>"<?php echo $pisos_add->nombre->editAttributes() ?>>
</span>
<?php echo $pisos_add->nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$pisos_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $pisos_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pisos_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$pisos_add->showPageFooter();
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
$pisos_add->terminate();
?>