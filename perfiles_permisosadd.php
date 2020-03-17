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
$perfiles_permisos_add = new perfiles_permisos_add();

// Run the page
$perfiles_permisos_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$perfiles_permisos_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fperfiles_permisosadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fperfiles_permisosadd = currentForm = new ew.Form("fperfiles_permisosadd", "add");

	// Validate form
	fperfiles_permisosadd.validate = function() {
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
			<?php if ($perfiles_permisos_add->id_perfil_permisos->Required) { ?>
				elm = this.getElements("x" + infix + "_id_perfil_permisos");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $perfiles_permisos_add->id_perfil_permisos->caption(), $perfiles_permisos_add->id_perfil_permisos->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_perfil_permisos");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($perfiles_permisos_add->id_perfil_permisos->errorMessage()) ?>");
			<?php if ($perfiles_permisos_add->tabla->Required) { ?>
				elm = this.getElements("x" + infix + "_tabla");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $perfiles_permisos_add->tabla->caption(), $perfiles_permisos_add->tabla->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($perfiles_permisos_add->permiso->Required) { ?>
				elm = this.getElements("x" + infix + "_permiso");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $perfiles_permisos_add->permiso->caption(), $perfiles_permisos_add->permiso->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_permiso");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($perfiles_permisos_add->permiso->errorMessage()) ?>");

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
	fperfiles_permisosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fperfiles_permisosadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fperfiles_permisosadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $perfiles_permisos_add->showPageHeader(); ?>
<?php
$perfiles_permisos_add->showMessage();
?>
<form name="fperfiles_permisosadd" id="fperfiles_permisosadd" class="<?php echo $perfiles_permisos_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="perfiles_permisos">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$perfiles_permisos_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($perfiles_permisos_add->id_perfil_permisos->Visible) { // id_perfil_permisos ?>
	<div id="r_id_perfil_permisos" class="form-group row">
		<label id="elh_perfiles_permisos_id_perfil_permisos" for="x_id_perfil_permisos" class="<?php echo $perfiles_permisos_add->LeftColumnClass ?>"><?php echo $perfiles_permisos_add->id_perfil_permisos->caption() ?><?php echo $perfiles_permisos_add->id_perfil_permisos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $perfiles_permisos_add->RightColumnClass ?>"><div <?php echo $perfiles_permisos_add->id_perfil_permisos->cellAttributes() ?>>
<span id="el_perfiles_permisos_id_perfil_permisos">
<input type="text" data-table="perfiles_permisos" data-field="x_id_perfil_permisos" name="x_id_perfil_permisos" id="x_id_perfil_permisos" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($perfiles_permisos_add->id_perfil_permisos->getPlaceHolder()) ?>" value="<?php echo $perfiles_permisos_add->id_perfil_permisos->EditValue ?>"<?php echo $perfiles_permisos_add->id_perfil_permisos->editAttributes() ?>>
</span>
<?php echo $perfiles_permisos_add->id_perfil_permisos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($perfiles_permisos_add->tabla->Visible) { // tabla ?>
	<div id="r_tabla" class="form-group row">
		<label id="elh_perfiles_permisos_tabla" for="x_tabla" class="<?php echo $perfiles_permisos_add->LeftColumnClass ?>"><?php echo $perfiles_permisos_add->tabla->caption() ?><?php echo $perfiles_permisos_add->tabla->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $perfiles_permisos_add->RightColumnClass ?>"><div <?php echo $perfiles_permisos_add->tabla->cellAttributes() ?>>
<span id="el_perfiles_permisos_tabla">
<input type="text" data-table="perfiles_permisos" data-field="x_tabla" name="x_tabla" id="x_tabla" size="30" maxlength="191" placeholder="<?php echo HtmlEncode($perfiles_permisos_add->tabla->getPlaceHolder()) ?>" value="<?php echo $perfiles_permisos_add->tabla->EditValue ?>"<?php echo $perfiles_permisos_add->tabla->editAttributes() ?>>
</span>
<?php echo $perfiles_permisos_add->tabla->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($perfiles_permisos_add->permiso->Visible) { // permiso ?>
	<div id="r_permiso" class="form-group row">
		<label id="elh_perfiles_permisos_permiso" for="x_permiso" class="<?php echo $perfiles_permisos_add->LeftColumnClass ?>"><?php echo $perfiles_permisos_add->permiso->caption() ?><?php echo $perfiles_permisos_add->permiso->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $perfiles_permisos_add->RightColumnClass ?>"><div <?php echo $perfiles_permisos_add->permiso->cellAttributes() ?>>
<span id="el_perfiles_permisos_permiso">
<input type="text" data-table="perfiles_permisos" data-field="x_permiso" name="x_permiso" id="x_permiso" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($perfiles_permisos_add->permiso->getPlaceHolder()) ?>" value="<?php echo $perfiles_permisos_add->permiso->EditValue ?>"<?php echo $perfiles_permisos_add->permiso->editAttributes() ?>>
</span>
<?php echo $perfiles_permisos_add->permiso->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$perfiles_permisos_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $perfiles_permisos_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $perfiles_permisos_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$perfiles_permisos_add->showPageFooter();
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
$perfiles_permisos_add->terminate();
?>