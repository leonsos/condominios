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
$perfiles_edit = new perfiles_edit();

// Run the page
$perfiles_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$perfiles_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fperfilesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fperfilesedit = currentForm = new ew.Form("fperfilesedit", "edit");

	// Validate form
	fperfilesedit.validate = function() {
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
			<?php if ($perfiles_edit->id_perfil->Required) { ?>
				elm = this.getElements("x" + infix + "_id_perfil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $perfiles_edit->id_perfil->caption(), $perfiles_edit->id_perfil->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_perfil");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($perfiles_edit->id_perfil->errorMessage()) ?>");
			<?php if ($perfiles_edit->descripcion_perfil->Required) { ?>
				elm = this.getElements("x" + infix + "_descripcion_perfil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $perfiles_edit->descripcion_perfil->caption(), $perfiles_edit->descripcion_perfil->RequiredErrorMessage)) ?>");
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
	fperfilesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fperfilesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fperfilesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $perfiles_edit->showPageHeader(); ?>
<?php
$perfiles_edit->showMessage();
?>
<form name="fperfilesedit" id="fperfilesedit" class="<?php echo $perfiles_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="perfiles">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$perfiles_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($perfiles_edit->id_perfil->Visible) { // id_perfil ?>
	<div id="r_id_perfil" class="form-group row">
		<label id="elh_perfiles_id_perfil" for="x_id_perfil" class="<?php echo $perfiles_edit->LeftColumnClass ?>"><?php echo $perfiles_edit->id_perfil->caption() ?><?php echo $perfiles_edit->id_perfil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $perfiles_edit->RightColumnClass ?>"><div <?php echo $perfiles_edit->id_perfil->cellAttributes() ?>>
<input type="text" data-table="perfiles" data-field="x_id_perfil" name="x_id_perfil" id="x_id_perfil" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($perfiles_edit->id_perfil->getPlaceHolder()) ?>" value="<?php echo $perfiles_edit->id_perfil->EditValue ?>"<?php echo $perfiles_edit->id_perfil->editAttributes() ?>>
<input type="hidden" data-table="perfiles" data-field="x_id_perfil" name="o_id_perfil" id="o_id_perfil" value="<?php echo HtmlEncode($perfiles_edit->id_perfil->OldValue != null ? $perfiles_edit->id_perfil->OldValue : $perfiles_edit->id_perfil->CurrentValue) ?>">
<?php echo $perfiles_edit->id_perfil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($perfiles_edit->descripcion_perfil->Visible) { // descripcion_perfil ?>
	<div id="r_descripcion_perfil" class="form-group row">
		<label id="elh_perfiles_descripcion_perfil" for="x_descripcion_perfil" class="<?php echo $perfiles_edit->LeftColumnClass ?>"><?php echo $perfiles_edit->descripcion_perfil->caption() ?><?php echo $perfiles_edit->descripcion_perfil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $perfiles_edit->RightColumnClass ?>"><div <?php echo $perfiles_edit->descripcion_perfil->cellAttributes() ?>>
<span id="el_perfiles_descripcion_perfil">
<input type="text" data-table="perfiles" data-field="x_descripcion_perfil" name="x_descripcion_perfil" id="x_descripcion_perfil" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($perfiles_edit->descripcion_perfil->getPlaceHolder()) ?>" value="<?php echo $perfiles_edit->descripcion_perfil->EditValue ?>"<?php echo $perfiles_edit->descripcion_perfil->editAttributes() ?>>
</span>
<?php echo $perfiles_edit->descripcion_perfil->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$perfiles_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $perfiles_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $perfiles_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$perfiles_edit->showPageFooter();
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
$perfiles_edit->terminate();
?>