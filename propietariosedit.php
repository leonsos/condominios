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
$propietarios_edit = new propietarios_edit();

// Run the page
$propietarios_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$propietarios_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpropietariosedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpropietariosedit = currentForm = new ew.Form("fpropietariosedit", "edit");

	// Validate form
	fpropietariosedit.validate = function() {
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
			<?php if ($propietarios_edit->id_propietario->Required) { ?>
				elm = this.getElements("x" + infix + "_id_propietario");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $propietarios_edit->id_propietario->caption(), $propietarios_edit->id_propietario->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($propietarios_edit->nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $propietarios_edit->nombre->caption(), $propietarios_edit->nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($propietarios_edit->apellido->Required) { ?>
				elm = this.getElements("x" + infix + "_apellido");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $propietarios_edit->apellido->caption(), $propietarios_edit->apellido->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($propietarios_edit->cedula->Required) { ?>
				elm = this.getElements("x" + infix + "_cedula");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $propietarios_edit->cedula->caption(), $propietarios_edit->cedula->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_cedula");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($propietarios_edit->cedula->errorMessage()) ?>");
			<?php if ($propietarios_edit->telefono_princip->Required) { ?>
				elm = this.getElements("x" + infix + "_telefono_princip");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $propietarios_edit->telefono_princip->caption(), $propietarios_edit->telefono_princip->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_telefono_princip");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($propietarios_edit->telefono_princip->errorMessage()) ?>");
			<?php if ($propietarios_edit->telefono_secund->Required) { ?>
				elm = this.getElements("x" + infix + "_telefono_secund");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $propietarios_edit->telefono_secund->caption(), $propietarios_edit->telefono_secund->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_telefono_secund");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($propietarios_edit->telefono_secund->errorMessage()) ?>");

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
	fpropietariosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpropietariosedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpropietariosedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $propietarios_edit->showPageHeader(); ?>
<?php
$propietarios_edit->showMessage();
?>
<form name="fpropietariosedit" id="fpropietariosedit" class="<?php echo $propietarios_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="propietarios">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$propietarios_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($propietarios_edit->id_propietario->Visible) { // id_propietario ?>
	<div id="r_id_propietario" class="form-group row">
		<label id="elh_propietarios_id_propietario" class="<?php echo $propietarios_edit->LeftColumnClass ?>"><?php echo $propietarios_edit->id_propietario->caption() ?><?php echo $propietarios_edit->id_propietario->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $propietarios_edit->RightColumnClass ?>"><div <?php echo $propietarios_edit->id_propietario->cellAttributes() ?>>
<span id="el_propietarios_id_propietario">
<span<?php echo $propietarios_edit->id_propietario->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($propietarios_edit->id_propietario->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="propietarios" data-field="x_id_propietario" name="x_id_propietario" id="x_id_propietario" value="<?php echo HtmlEncode($propietarios_edit->id_propietario->CurrentValue) ?>">
<?php echo $propietarios_edit->id_propietario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($propietarios_edit->nombre->Visible) { // nombre ?>
	<div id="r_nombre" class="form-group row">
		<label id="elh_propietarios_nombre" for="x_nombre" class="<?php echo $propietarios_edit->LeftColumnClass ?>"><?php echo $propietarios_edit->nombre->caption() ?><?php echo $propietarios_edit->nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $propietarios_edit->RightColumnClass ?>"><div <?php echo $propietarios_edit->nombre->cellAttributes() ?>>
<span id="el_propietarios_nombre">
<input type="text" data-table="propietarios" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($propietarios_edit->nombre->getPlaceHolder()) ?>" value="<?php echo $propietarios_edit->nombre->EditValue ?>"<?php echo $propietarios_edit->nombre->editAttributes() ?>>
</span>
<?php echo $propietarios_edit->nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($propietarios_edit->apellido->Visible) { // apellido ?>
	<div id="r_apellido" class="form-group row">
		<label id="elh_propietarios_apellido" for="x_apellido" class="<?php echo $propietarios_edit->LeftColumnClass ?>"><?php echo $propietarios_edit->apellido->caption() ?><?php echo $propietarios_edit->apellido->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $propietarios_edit->RightColumnClass ?>"><div <?php echo $propietarios_edit->apellido->cellAttributes() ?>>
<span id="el_propietarios_apellido">
<input type="text" data-table="propietarios" data-field="x_apellido" name="x_apellido" id="x_apellido" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($propietarios_edit->apellido->getPlaceHolder()) ?>" value="<?php echo $propietarios_edit->apellido->EditValue ?>"<?php echo $propietarios_edit->apellido->editAttributes() ?>>
</span>
<?php echo $propietarios_edit->apellido->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($propietarios_edit->cedula->Visible) { // cedula ?>
	<div id="r_cedula" class="form-group row">
		<label id="elh_propietarios_cedula" for="x_cedula" class="<?php echo $propietarios_edit->LeftColumnClass ?>"><?php echo $propietarios_edit->cedula->caption() ?><?php echo $propietarios_edit->cedula->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $propietarios_edit->RightColumnClass ?>"><div <?php echo $propietarios_edit->cedula->cellAttributes() ?>>
<span id="el_propietarios_cedula">
<input type="text" data-table="propietarios" data-field="x_cedula" name="x_cedula" id="x_cedula" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($propietarios_edit->cedula->getPlaceHolder()) ?>" value="<?php echo $propietarios_edit->cedula->EditValue ?>"<?php echo $propietarios_edit->cedula->editAttributes() ?>>
</span>
<?php echo $propietarios_edit->cedula->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($propietarios_edit->telefono_princip->Visible) { // telefono_princip ?>
	<div id="r_telefono_princip" class="form-group row">
		<label id="elh_propietarios_telefono_princip" for="x_telefono_princip" class="<?php echo $propietarios_edit->LeftColumnClass ?>"><?php echo $propietarios_edit->telefono_princip->caption() ?><?php echo $propietarios_edit->telefono_princip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $propietarios_edit->RightColumnClass ?>"><div <?php echo $propietarios_edit->telefono_princip->cellAttributes() ?>>
<span id="el_propietarios_telefono_princip">
<input type="text" data-table="propietarios" data-field="x_telefono_princip" name="x_telefono_princip" id="x_telefono_princip" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($propietarios_edit->telefono_princip->getPlaceHolder()) ?>" value="<?php echo $propietarios_edit->telefono_princip->EditValue ?>"<?php echo $propietarios_edit->telefono_princip->editAttributes() ?>>
</span>
<?php echo $propietarios_edit->telefono_princip->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($propietarios_edit->telefono_secund->Visible) { // telefono_secund ?>
	<div id="r_telefono_secund" class="form-group row">
		<label id="elh_propietarios_telefono_secund" for="x_telefono_secund" class="<?php echo $propietarios_edit->LeftColumnClass ?>"><?php echo $propietarios_edit->telefono_secund->caption() ?><?php echo $propietarios_edit->telefono_secund->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $propietarios_edit->RightColumnClass ?>"><div <?php echo $propietarios_edit->telefono_secund->cellAttributes() ?>>
<span id="el_propietarios_telefono_secund">
<input type="text" data-table="propietarios" data-field="x_telefono_secund" name="x_telefono_secund" id="x_telefono_secund" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($propietarios_edit->telefono_secund->getPlaceHolder()) ?>" value="<?php echo $propietarios_edit->telefono_secund->EditValue ?>"<?php echo $propietarios_edit->telefono_secund->editAttributes() ?>>
</span>
<?php echo $propietarios_edit->telefono_secund->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$propietarios_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $propietarios_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $propietarios_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$propietarios_edit->showPageFooter();
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
$propietarios_edit->terminate();
?>