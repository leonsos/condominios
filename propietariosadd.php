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
$propietarios_add = new propietarios_add();

// Run the page
$propietarios_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$propietarios_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpropietariosadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpropietariosadd = currentForm = new ew.Form("fpropietariosadd", "add");

	// Validate form
	fpropietariosadd.validate = function() {
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
			<?php if ($propietarios_add->nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $propietarios_add->nombre->caption(), $propietarios_add->nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($propietarios_add->apellido->Required) { ?>
				elm = this.getElements("x" + infix + "_apellido");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $propietarios_add->apellido->caption(), $propietarios_add->apellido->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($propietarios_add->cedula->Required) { ?>
				elm = this.getElements("x" + infix + "_cedula");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $propietarios_add->cedula->caption(), $propietarios_add->cedula->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_cedula");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($propietarios_add->cedula->errorMessage()) ?>");
			<?php if ($propietarios_add->telefono_princip->Required) { ?>
				elm = this.getElements("x" + infix + "_telefono_princip");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $propietarios_add->telefono_princip->caption(), $propietarios_add->telefono_princip->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_telefono_princip");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($propietarios_add->telefono_princip->errorMessage()) ?>");
			<?php if ($propietarios_add->telefono_secund->Required) { ?>
				elm = this.getElements("x" + infix + "_telefono_secund");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $propietarios_add->telefono_secund->caption(), $propietarios_add->telefono_secund->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_telefono_secund");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($propietarios_add->telefono_secund->errorMessage()) ?>");

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
	fpropietariosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpropietariosadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpropietariosadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $propietarios_add->showPageHeader(); ?>
<?php
$propietarios_add->showMessage();
?>
<form name="fpropietariosadd" id="fpropietariosadd" class="<?php echo $propietarios_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="propietarios">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$propietarios_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($propietarios_add->nombre->Visible) { // nombre ?>
	<div id="r_nombre" class="form-group row">
		<label id="elh_propietarios_nombre" for="x_nombre" class="<?php echo $propietarios_add->LeftColumnClass ?>"><?php echo $propietarios_add->nombre->caption() ?><?php echo $propietarios_add->nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $propietarios_add->RightColumnClass ?>"><div <?php echo $propietarios_add->nombre->cellAttributes() ?>>
<span id="el_propietarios_nombre">
<input type="text" data-table="propietarios" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($propietarios_add->nombre->getPlaceHolder()) ?>" value="<?php echo $propietarios_add->nombre->EditValue ?>"<?php echo $propietarios_add->nombre->editAttributes() ?>>
</span>
<?php echo $propietarios_add->nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($propietarios_add->apellido->Visible) { // apellido ?>
	<div id="r_apellido" class="form-group row">
		<label id="elh_propietarios_apellido" for="x_apellido" class="<?php echo $propietarios_add->LeftColumnClass ?>"><?php echo $propietarios_add->apellido->caption() ?><?php echo $propietarios_add->apellido->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $propietarios_add->RightColumnClass ?>"><div <?php echo $propietarios_add->apellido->cellAttributes() ?>>
<span id="el_propietarios_apellido">
<input type="text" data-table="propietarios" data-field="x_apellido" name="x_apellido" id="x_apellido" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($propietarios_add->apellido->getPlaceHolder()) ?>" value="<?php echo $propietarios_add->apellido->EditValue ?>"<?php echo $propietarios_add->apellido->editAttributes() ?>>
</span>
<?php echo $propietarios_add->apellido->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($propietarios_add->cedula->Visible) { // cedula ?>
	<div id="r_cedula" class="form-group row">
		<label id="elh_propietarios_cedula" for="x_cedula" class="<?php echo $propietarios_add->LeftColumnClass ?>"><?php echo $propietarios_add->cedula->caption() ?><?php echo $propietarios_add->cedula->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $propietarios_add->RightColumnClass ?>"><div <?php echo $propietarios_add->cedula->cellAttributes() ?>>
<span id="el_propietarios_cedula">
<input type="text" data-table="propietarios" data-field="x_cedula" name="x_cedula" id="x_cedula" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($propietarios_add->cedula->getPlaceHolder()) ?>" value="<?php echo $propietarios_add->cedula->EditValue ?>"<?php echo $propietarios_add->cedula->editAttributes() ?>>
</span>
<?php echo $propietarios_add->cedula->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($propietarios_add->telefono_princip->Visible) { // telefono_princip ?>
	<div id="r_telefono_princip" class="form-group row">
		<label id="elh_propietarios_telefono_princip" for="x_telefono_princip" class="<?php echo $propietarios_add->LeftColumnClass ?>"><?php echo $propietarios_add->telefono_princip->caption() ?><?php echo $propietarios_add->telefono_princip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $propietarios_add->RightColumnClass ?>"><div <?php echo $propietarios_add->telefono_princip->cellAttributes() ?>>
<span id="el_propietarios_telefono_princip">
<input type="text" data-table="propietarios" data-field="x_telefono_princip" name="x_telefono_princip" id="x_telefono_princip" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($propietarios_add->telefono_princip->getPlaceHolder()) ?>" value="<?php echo $propietarios_add->telefono_princip->EditValue ?>"<?php echo $propietarios_add->telefono_princip->editAttributes() ?>>
</span>
<?php echo $propietarios_add->telefono_princip->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($propietarios_add->telefono_secund->Visible) { // telefono_secund ?>
	<div id="r_telefono_secund" class="form-group row">
		<label id="elh_propietarios_telefono_secund" for="x_telefono_secund" class="<?php echo $propietarios_add->LeftColumnClass ?>"><?php echo $propietarios_add->telefono_secund->caption() ?><?php echo $propietarios_add->telefono_secund->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $propietarios_add->RightColumnClass ?>"><div <?php echo $propietarios_add->telefono_secund->cellAttributes() ?>>
<span id="el_propietarios_telefono_secund">
<input type="text" data-table="propietarios" data-field="x_telefono_secund" name="x_telefono_secund" id="x_telefono_secund" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($propietarios_add->telefono_secund->getPlaceHolder()) ?>" value="<?php echo $propietarios_add->telefono_secund->EditValue ?>"<?php echo $propietarios_add->telefono_secund->editAttributes() ?>>
</span>
<?php echo $propietarios_add->telefono_secund->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$propietarios_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $propietarios_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $propietarios_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$propietarios_add->showPageFooter();
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
$propietarios_add->terminate();
?>