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
$usuarios_edit = new usuarios_edit();

// Run the page
$usuarios_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuarios_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusuariosedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fusuariosedit = currentForm = new ew.Form("fusuariosedit", "edit");

	// Validate form
	fusuariosedit.validate = function() {
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
			<?php if ($usuarios_edit->id_usuario->Required) { ?>
				elm = this.getElements("x" + infix + "_id_usuario");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_edit->id_usuario->caption(), $usuarios_edit->id_usuario->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_usuario");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($usuarios_edit->id_usuario->errorMessage()) ?>");
			<?php if ($usuarios_edit->nombre_usuario->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre_usuario");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_edit->nombre_usuario->caption(), $usuarios_edit->nombre_usuario->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuarios_edit->clave->Required) { ?>
				elm = this.getElements("x" + infix + "_clave");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_edit->clave->caption(), $usuarios_edit->clave->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuarios_edit->nombres->Required) { ?>
				elm = this.getElements("x" + infix + "_nombres");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_edit->nombres->caption(), $usuarios_edit->nombres->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuarios_edit->apellidos->Required) { ?>
				elm = this.getElements("x" + infix + "_apellidos");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_edit->apellidos->caption(), $usuarios_edit->apellidos->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuarios_edit->cedula->Required) { ?>
				elm = this.getElements("x" + infix + "_cedula");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_edit->cedula->caption(), $usuarios_edit->cedula->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_cedula");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($usuarios_edit->cedula->errorMessage()) ?>");
			<?php if ($usuarios_edit->telefono->Required) { ?>
				elm = this.getElements("x" + infix + "_telefono");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_edit->telefono->caption(), $usuarios_edit->telefono->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuarios_edit->correo->Required) { ?>
				elm = this.getElements("x" + infix + "_correo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_edit->correo->caption(), $usuarios_edit->correo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuarios_edit->perfil_id->Required) { ?>
				elm = this.getElements("x" + infix + "_perfil_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_edit->perfil_id->caption(), $usuarios_edit->perfil_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_perfil_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($usuarios_edit->perfil_id->errorMessage()) ?>");
			<?php if ($usuarios_edit->memo->Required) { ?>
				elm = this.getElements("x" + infix + "_memo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_edit->memo->caption(), $usuarios_edit->memo->RequiredErrorMessage)) ?>");
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
	fusuariosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fusuariosedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fusuariosedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $usuarios_edit->showPageHeader(); ?>
<?php
$usuarios_edit->showMessage();
?>
<form name="fusuariosedit" id="fusuariosedit" class="<?php echo $usuarios_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuarios">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$usuarios_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($usuarios_edit->id_usuario->Visible) { // id_usuario ?>
	<div id="r_id_usuario" class="form-group row">
		<label id="elh_usuarios_id_usuario" for="x_id_usuario" class="<?php echo $usuarios_edit->LeftColumnClass ?>"><?php echo $usuarios_edit->id_usuario->caption() ?><?php echo $usuarios_edit->id_usuario->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_edit->RightColumnClass ?>"><div <?php echo $usuarios_edit->id_usuario->cellAttributes() ?>>
<input type="text" data-table="usuarios" data-field="x_id_usuario" name="x_id_usuario" id="x_id_usuario" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($usuarios_edit->id_usuario->getPlaceHolder()) ?>" value="<?php echo $usuarios_edit->id_usuario->EditValue ?>"<?php echo $usuarios_edit->id_usuario->editAttributes() ?>>
<input type="hidden" data-table="usuarios" data-field="x_id_usuario" name="o_id_usuario" id="o_id_usuario" value="<?php echo HtmlEncode($usuarios_edit->id_usuario->OldValue != null ? $usuarios_edit->id_usuario->OldValue : $usuarios_edit->id_usuario->CurrentValue) ?>">
<?php echo $usuarios_edit->id_usuario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_edit->nombre_usuario->Visible) { // nombre_usuario ?>
	<div id="r_nombre_usuario" class="form-group row">
		<label id="elh_usuarios_nombre_usuario" for="x_nombre_usuario" class="<?php echo $usuarios_edit->LeftColumnClass ?>"><?php echo $usuarios_edit->nombre_usuario->caption() ?><?php echo $usuarios_edit->nombre_usuario->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_edit->RightColumnClass ?>"><div <?php echo $usuarios_edit->nombre_usuario->cellAttributes() ?>>
<span id="el_usuarios_nombre_usuario">
<input type="text" data-table="usuarios" data-field="x_nombre_usuario" name="x_nombre_usuario" id="x_nombre_usuario" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios_edit->nombre_usuario->getPlaceHolder()) ?>" value="<?php echo $usuarios_edit->nombre_usuario->EditValue ?>"<?php echo $usuarios_edit->nombre_usuario->editAttributes() ?>>
</span>
<?php echo $usuarios_edit->nombre_usuario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_edit->clave->Visible) { // clave ?>
	<div id="r_clave" class="form-group row">
		<label id="elh_usuarios_clave" for="x_clave" class="<?php echo $usuarios_edit->LeftColumnClass ?>"><?php echo $usuarios_edit->clave->caption() ?><?php echo $usuarios_edit->clave->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_edit->RightColumnClass ?>"><div <?php echo $usuarios_edit->clave->cellAttributes() ?>>
<span id="el_usuarios_clave">
<input type="text" data-table="usuarios" data-field="x_clave" name="x_clave" id="x_clave" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios_edit->clave->getPlaceHolder()) ?>" value="<?php echo $usuarios_edit->clave->EditValue ?>"<?php echo $usuarios_edit->clave->editAttributes() ?>>
</span>
<?php echo $usuarios_edit->clave->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_edit->nombres->Visible) { // nombres ?>
	<div id="r_nombres" class="form-group row">
		<label id="elh_usuarios_nombres" for="x_nombres" class="<?php echo $usuarios_edit->LeftColumnClass ?>"><?php echo $usuarios_edit->nombres->caption() ?><?php echo $usuarios_edit->nombres->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_edit->RightColumnClass ?>"><div <?php echo $usuarios_edit->nombres->cellAttributes() ?>>
<span id="el_usuarios_nombres">
<input type="text" data-table="usuarios" data-field="x_nombres" name="x_nombres" id="x_nombres" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios_edit->nombres->getPlaceHolder()) ?>" value="<?php echo $usuarios_edit->nombres->EditValue ?>"<?php echo $usuarios_edit->nombres->editAttributes() ?>>
</span>
<?php echo $usuarios_edit->nombres->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_edit->apellidos->Visible) { // apellidos ?>
	<div id="r_apellidos" class="form-group row">
		<label id="elh_usuarios_apellidos" for="x_apellidos" class="<?php echo $usuarios_edit->LeftColumnClass ?>"><?php echo $usuarios_edit->apellidos->caption() ?><?php echo $usuarios_edit->apellidos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_edit->RightColumnClass ?>"><div <?php echo $usuarios_edit->apellidos->cellAttributes() ?>>
<span id="el_usuarios_apellidos">
<input type="text" data-table="usuarios" data-field="x_apellidos" name="x_apellidos" id="x_apellidos" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios_edit->apellidos->getPlaceHolder()) ?>" value="<?php echo $usuarios_edit->apellidos->EditValue ?>"<?php echo $usuarios_edit->apellidos->editAttributes() ?>>
</span>
<?php echo $usuarios_edit->apellidos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_edit->cedula->Visible) { // cedula ?>
	<div id="r_cedula" class="form-group row">
		<label id="elh_usuarios_cedula" for="x_cedula" class="<?php echo $usuarios_edit->LeftColumnClass ?>"><?php echo $usuarios_edit->cedula->caption() ?><?php echo $usuarios_edit->cedula->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_edit->RightColumnClass ?>"><div <?php echo $usuarios_edit->cedula->cellAttributes() ?>>
<span id="el_usuarios_cedula">
<input type="text" data-table="usuarios" data-field="x_cedula" name="x_cedula" id="x_cedula" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($usuarios_edit->cedula->getPlaceHolder()) ?>" value="<?php echo $usuarios_edit->cedula->EditValue ?>"<?php echo $usuarios_edit->cedula->editAttributes() ?>>
</span>
<?php echo $usuarios_edit->cedula->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_edit->telefono->Visible) { // telefono ?>
	<div id="r_telefono" class="form-group row">
		<label id="elh_usuarios_telefono" for="x_telefono" class="<?php echo $usuarios_edit->LeftColumnClass ?>"><?php echo $usuarios_edit->telefono->caption() ?><?php echo $usuarios_edit->telefono->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_edit->RightColumnClass ?>"><div <?php echo $usuarios_edit->telefono->cellAttributes() ?>>
<span id="el_usuarios_telefono">
<input type="text" data-table="usuarios" data-field="x_telefono" name="x_telefono" id="x_telefono" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios_edit->telefono->getPlaceHolder()) ?>" value="<?php echo $usuarios_edit->telefono->EditValue ?>"<?php echo $usuarios_edit->telefono->editAttributes() ?>>
</span>
<?php echo $usuarios_edit->telefono->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_edit->correo->Visible) { // correo ?>
	<div id="r_correo" class="form-group row">
		<label id="elh_usuarios_correo" for="x_correo" class="<?php echo $usuarios_edit->LeftColumnClass ?>"><?php echo $usuarios_edit->correo->caption() ?><?php echo $usuarios_edit->correo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_edit->RightColumnClass ?>"><div <?php echo $usuarios_edit->correo->cellAttributes() ?>>
<span id="el_usuarios_correo">
<input type="text" data-table="usuarios" data-field="x_correo" name="x_correo" id="x_correo" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios_edit->correo->getPlaceHolder()) ?>" value="<?php echo $usuarios_edit->correo->EditValue ?>"<?php echo $usuarios_edit->correo->editAttributes() ?>>
</span>
<?php echo $usuarios_edit->correo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_edit->perfil_id->Visible) { // perfil_id ?>
	<div id="r_perfil_id" class="form-group row">
		<label id="elh_usuarios_perfil_id" for="x_perfil_id" class="<?php echo $usuarios_edit->LeftColumnClass ?>"><?php echo $usuarios_edit->perfil_id->caption() ?><?php echo $usuarios_edit->perfil_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_edit->RightColumnClass ?>"><div <?php echo $usuarios_edit->perfil_id->cellAttributes() ?>>
<span id="el_usuarios_perfil_id">
<input type="text" data-table="usuarios" data-field="x_perfil_id" name="x_perfil_id" id="x_perfil_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($usuarios_edit->perfil_id->getPlaceHolder()) ?>" value="<?php echo $usuarios_edit->perfil_id->EditValue ?>"<?php echo $usuarios_edit->perfil_id->editAttributes() ?>>
</span>
<?php echo $usuarios_edit->perfil_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_edit->memo->Visible) { // memo ?>
	<div id="r_memo" class="form-group row">
		<label id="elh_usuarios_memo" for="x_memo" class="<?php echo $usuarios_edit->LeftColumnClass ?>"><?php echo $usuarios_edit->memo->caption() ?><?php echo $usuarios_edit->memo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_edit->RightColumnClass ?>"><div <?php echo $usuarios_edit->memo->cellAttributes() ?>>
<span id="el_usuarios_memo">
<textarea data-table="usuarios" data-field="x_memo" name="x_memo" id="x_memo" cols="35" rows="4" placeholder="<?php echo HtmlEncode($usuarios_edit->memo->getPlaceHolder()) ?>"<?php echo $usuarios_edit->memo->editAttributes() ?>><?php echo $usuarios_edit->memo->EditValue ?></textarea>
</span>
<?php echo $usuarios_edit->memo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$usuarios_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $usuarios_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $usuarios_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$usuarios_edit->showPageFooter();
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
$usuarios_edit->terminate();
?>