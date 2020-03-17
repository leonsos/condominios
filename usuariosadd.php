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
$usuarios_add = new usuarios_add();

// Run the page
$usuarios_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuarios_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusuariosadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fusuariosadd = currentForm = new ew.Form("fusuariosadd", "add");

	// Validate form
	fusuariosadd.validate = function() {
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
			<?php if ($usuarios_add->id_usuario->Required) { ?>
				elm = this.getElements("x" + infix + "_id_usuario");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_add->id_usuario->caption(), $usuarios_add->id_usuario->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_usuario");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($usuarios_add->id_usuario->errorMessage()) ?>");
			<?php if ($usuarios_add->nombre_usuario->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre_usuario");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_add->nombre_usuario->caption(), $usuarios_add->nombre_usuario->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuarios_add->clave->Required) { ?>
				elm = this.getElements("x" + infix + "_clave");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_add->clave->caption(), $usuarios_add->clave->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuarios_add->nombres->Required) { ?>
				elm = this.getElements("x" + infix + "_nombres");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_add->nombres->caption(), $usuarios_add->nombres->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuarios_add->apellidos->Required) { ?>
				elm = this.getElements("x" + infix + "_apellidos");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_add->apellidos->caption(), $usuarios_add->apellidos->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuarios_add->cedula->Required) { ?>
				elm = this.getElements("x" + infix + "_cedula");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_add->cedula->caption(), $usuarios_add->cedula->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_cedula");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($usuarios_add->cedula->errorMessage()) ?>");
			<?php if ($usuarios_add->telefono->Required) { ?>
				elm = this.getElements("x" + infix + "_telefono");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_add->telefono->caption(), $usuarios_add->telefono->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuarios_add->correo->Required) { ?>
				elm = this.getElements("x" + infix + "_correo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_add->correo->caption(), $usuarios_add->correo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuarios_add->perfil_id->Required) { ?>
				elm = this.getElements("x" + infix + "_perfil_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_add->perfil_id->caption(), $usuarios_add->perfil_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_perfil_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($usuarios_add->perfil_id->errorMessage()) ?>");
			<?php if ($usuarios_add->memo->Required) { ?>
				elm = this.getElements("x" + infix + "_memo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuarios_add->memo->caption(), $usuarios_add->memo->RequiredErrorMessage)) ?>");
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
	fusuariosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fusuariosadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fusuariosadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $usuarios_add->showPageHeader(); ?>
<?php
$usuarios_add->showMessage();
?>
<form name="fusuariosadd" id="fusuariosadd" class="<?php echo $usuarios_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuarios">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$usuarios_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($usuarios_add->id_usuario->Visible) { // id_usuario ?>
	<div id="r_id_usuario" class="form-group row">
		<label id="elh_usuarios_id_usuario" for="x_id_usuario" class="<?php echo $usuarios_add->LeftColumnClass ?>"><?php echo $usuarios_add->id_usuario->caption() ?><?php echo $usuarios_add->id_usuario->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_add->RightColumnClass ?>"><div <?php echo $usuarios_add->id_usuario->cellAttributes() ?>>
<span id="el_usuarios_id_usuario">
<input type="text" data-table="usuarios" data-field="x_id_usuario" name="x_id_usuario" id="x_id_usuario" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($usuarios_add->id_usuario->getPlaceHolder()) ?>" value="<?php echo $usuarios_add->id_usuario->EditValue ?>"<?php echo $usuarios_add->id_usuario->editAttributes() ?>>
</span>
<?php echo $usuarios_add->id_usuario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_add->nombre_usuario->Visible) { // nombre_usuario ?>
	<div id="r_nombre_usuario" class="form-group row">
		<label id="elh_usuarios_nombre_usuario" for="x_nombre_usuario" class="<?php echo $usuarios_add->LeftColumnClass ?>"><?php echo $usuarios_add->nombre_usuario->caption() ?><?php echo $usuarios_add->nombre_usuario->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_add->RightColumnClass ?>"><div <?php echo $usuarios_add->nombre_usuario->cellAttributes() ?>>
<span id="el_usuarios_nombre_usuario">
<input type="text" data-table="usuarios" data-field="x_nombre_usuario" name="x_nombre_usuario" id="x_nombre_usuario" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios_add->nombre_usuario->getPlaceHolder()) ?>" value="<?php echo $usuarios_add->nombre_usuario->EditValue ?>"<?php echo $usuarios_add->nombre_usuario->editAttributes() ?>>
</span>
<?php echo $usuarios_add->nombre_usuario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_add->clave->Visible) { // clave ?>
	<div id="r_clave" class="form-group row">
		<label id="elh_usuarios_clave" for="x_clave" class="<?php echo $usuarios_add->LeftColumnClass ?>"><?php echo $usuarios_add->clave->caption() ?><?php echo $usuarios_add->clave->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_add->RightColumnClass ?>"><div <?php echo $usuarios_add->clave->cellAttributes() ?>>
<span id="el_usuarios_clave">
<input type="text" data-table="usuarios" data-field="x_clave" name="x_clave" id="x_clave" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios_add->clave->getPlaceHolder()) ?>" value="<?php echo $usuarios_add->clave->EditValue ?>"<?php echo $usuarios_add->clave->editAttributes() ?>>
</span>
<?php echo $usuarios_add->clave->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_add->nombres->Visible) { // nombres ?>
	<div id="r_nombres" class="form-group row">
		<label id="elh_usuarios_nombres" for="x_nombres" class="<?php echo $usuarios_add->LeftColumnClass ?>"><?php echo $usuarios_add->nombres->caption() ?><?php echo $usuarios_add->nombres->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_add->RightColumnClass ?>"><div <?php echo $usuarios_add->nombres->cellAttributes() ?>>
<span id="el_usuarios_nombres">
<input type="text" data-table="usuarios" data-field="x_nombres" name="x_nombres" id="x_nombres" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios_add->nombres->getPlaceHolder()) ?>" value="<?php echo $usuarios_add->nombres->EditValue ?>"<?php echo $usuarios_add->nombres->editAttributes() ?>>
</span>
<?php echo $usuarios_add->nombres->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_add->apellidos->Visible) { // apellidos ?>
	<div id="r_apellidos" class="form-group row">
		<label id="elh_usuarios_apellidos" for="x_apellidos" class="<?php echo $usuarios_add->LeftColumnClass ?>"><?php echo $usuarios_add->apellidos->caption() ?><?php echo $usuarios_add->apellidos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_add->RightColumnClass ?>"><div <?php echo $usuarios_add->apellidos->cellAttributes() ?>>
<span id="el_usuarios_apellidos">
<input type="text" data-table="usuarios" data-field="x_apellidos" name="x_apellidos" id="x_apellidos" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios_add->apellidos->getPlaceHolder()) ?>" value="<?php echo $usuarios_add->apellidos->EditValue ?>"<?php echo $usuarios_add->apellidos->editAttributes() ?>>
</span>
<?php echo $usuarios_add->apellidos->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_add->cedula->Visible) { // cedula ?>
	<div id="r_cedula" class="form-group row">
		<label id="elh_usuarios_cedula" for="x_cedula" class="<?php echo $usuarios_add->LeftColumnClass ?>"><?php echo $usuarios_add->cedula->caption() ?><?php echo $usuarios_add->cedula->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_add->RightColumnClass ?>"><div <?php echo $usuarios_add->cedula->cellAttributes() ?>>
<span id="el_usuarios_cedula">
<input type="text" data-table="usuarios" data-field="x_cedula" name="x_cedula" id="x_cedula" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($usuarios_add->cedula->getPlaceHolder()) ?>" value="<?php echo $usuarios_add->cedula->EditValue ?>"<?php echo $usuarios_add->cedula->editAttributes() ?>>
</span>
<?php echo $usuarios_add->cedula->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_add->telefono->Visible) { // telefono ?>
	<div id="r_telefono" class="form-group row">
		<label id="elh_usuarios_telefono" for="x_telefono" class="<?php echo $usuarios_add->LeftColumnClass ?>"><?php echo $usuarios_add->telefono->caption() ?><?php echo $usuarios_add->telefono->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_add->RightColumnClass ?>"><div <?php echo $usuarios_add->telefono->cellAttributes() ?>>
<span id="el_usuarios_telefono">
<input type="text" data-table="usuarios" data-field="x_telefono" name="x_telefono" id="x_telefono" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios_add->telefono->getPlaceHolder()) ?>" value="<?php echo $usuarios_add->telefono->EditValue ?>"<?php echo $usuarios_add->telefono->editAttributes() ?>>
</span>
<?php echo $usuarios_add->telefono->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_add->correo->Visible) { // correo ?>
	<div id="r_correo" class="form-group row">
		<label id="elh_usuarios_correo" for="x_correo" class="<?php echo $usuarios_add->LeftColumnClass ?>"><?php echo $usuarios_add->correo->caption() ?><?php echo $usuarios_add->correo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_add->RightColumnClass ?>"><div <?php echo $usuarios_add->correo->cellAttributes() ?>>
<span id="el_usuarios_correo">
<input type="text" data-table="usuarios" data-field="x_correo" name="x_correo" id="x_correo" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuarios_add->correo->getPlaceHolder()) ?>" value="<?php echo $usuarios_add->correo->EditValue ?>"<?php echo $usuarios_add->correo->editAttributes() ?>>
</span>
<?php echo $usuarios_add->correo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_add->perfil_id->Visible) { // perfil_id ?>
	<div id="r_perfil_id" class="form-group row">
		<label id="elh_usuarios_perfil_id" for="x_perfil_id" class="<?php echo $usuarios_add->LeftColumnClass ?>"><?php echo $usuarios_add->perfil_id->caption() ?><?php echo $usuarios_add->perfil_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_add->RightColumnClass ?>"><div <?php echo $usuarios_add->perfil_id->cellAttributes() ?>>
<span id="el_usuarios_perfil_id">
<input type="text" data-table="usuarios" data-field="x_perfil_id" name="x_perfil_id" id="x_perfil_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($usuarios_add->perfil_id->getPlaceHolder()) ?>" value="<?php echo $usuarios_add->perfil_id->EditValue ?>"<?php echo $usuarios_add->perfil_id->editAttributes() ?>>
</span>
<?php echo $usuarios_add->perfil_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuarios_add->memo->Visible) { // memo ?>
	<div id="r_memo" class="form-group row">
		<label id="elh_usuarios_memo" for="x_memo" class="<?php echo $usuarios_add->LeftColumnClass ?>"><?php echo $usuarios_add->memo->caption() ?><?php echo $usuarios_add->memo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuarios_add->RightColumnClass ?>"><div <?php echo $usuarios_add->memo->cellAttributes() ?>>
<span id="el_usuarios_memo">
<textarea data-table="usuarios" data-field="x_memo" name="x_memo" id="x_memo" cols="35" rows="4" placeholder="<?php echo HtmlEncode($usuarios_add->memo->getPlaceHolder()) ?>"<?php echo $usuarios_add->memo->editAttributes() ?>><?php echo $usuarios_add->memo->EditValue ?></textarea>
</span>
<?php echo $usuarios_add->memo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$usuarios_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $usuarios_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $usuarios_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$usuarios_add->showPageFooter();
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
$usuarios_add->terminate();
?>