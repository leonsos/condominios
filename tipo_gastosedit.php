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
$tipo_gastos_edit = new tipo_gastos_edit();

// Run the page
$tipo_gastos_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tipo_gastos_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftipo_gastosedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	ftipo_gastosedit = currentForm = new ew.Form("ftipo_gastosedit", "edit");

	// Validate form
	ftipo_gastosedit.validate = function() {
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
			<?php if ($tipo_gastos_edit->id_tipo_gasto->Required) { ?>
				elm = this.getElements("x" + infix + "_id_tipo_gasto");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tipo_gastos_edit->id_tipo_gasto->caption(), $tipo_gastos_edit->id_tipo_gasto->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tipo_gastos_edit->nombre->Required) { ?>
				elm = this.getElements("x" + infix + "_nombre");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tipo_gastos_edit->nombre->caption(), $tipo_gastos_edit->nombre->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($tipo_gastos_edit->tipo_gasto->Required) { ?>
				elm = this.getElements("x" + infix + "_tipo_gasto");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tipo_gastos_edit->tipo_gasto->caption(), $tipo_gastos_edit->tipo_gasto->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tipo_gasto");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($tipo_gastos_edit->tipo_gasto->errorMessage()) ?>");
			<?php if ($tipo_gastos_edit->operacion->Required) { ?>
				elm = this.getElements("x" + infix + "_operacion");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $tipo_gastos_edit->operacion->caption(), $tipo_gastos_edit->operacion->RequiredErrorMessage)) ?>");
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
	ftipo_gastosedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftipo_gastosedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftipo_gastosedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tipo_gastos_edit->showPageHeader(); ?>
<?php
$tipo_gastos_edit->showMessage();
?>
<form name="ftipo_gastosedit" id="ftipo_gastosedit" class="<?php echo $tipo_gastos_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tipo_gastos">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$tipo_gastos_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($tipo_gastos_edit->id_tipo_gasto->Visible) { // id_tipo_gasto ?>
	<div id="r_id_tipo_gasto" class="form-group row">
		<label id="elh_tipo_gastos_id_tipo_gasto" class="<?php echo $tipo_gastos_edit->LeftColumnClass ?>"><?php echo $tipo_gastos_edit->id_tipo_gasto->caption() ?><?php echo $tipo_gastos_edit->id_tipo_gasto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tipo_gastos_edit->RightColumnClass ?>"><div <?php echo $tipo_gastos_edit->id_tipo_gasto->cellAttributes() ?>>
<span id="el_tipo_gastos_id_tipo_gasto">
<span<?php echo $tipo_gastos_edit->id_tipo_gasto->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($tipo_gastos_edit->id_tipo_gasto->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="tipo_gastos" data-field="x_id_tipo_gasto" name="x_id_tipo_gasto" id="x_id_tipo_gasto" value="<?php echo HtmlEncode($tipo_gastos_edit->id_tipo_gasto->CurrentValue) ?>">
<?php echo $tipo_gastos_edit->id_tipo_gasto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tipo_gastos_edit->nombre->Visible) { // nombre ?>
	<div id="r_nombre" class="form-group row">
		<label id="elh_tipo_gastos_nombre" for="x_nombre" class="<?php echo $tipo_gastos_edit->LeftColumnClass ?>"><?php echo $tipo_gastos_edit->nombre->caption() ?><?php echo $tipo_gastos_edit->nombre->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tipo_gastos_edit->RightColumnClass ?>"><div <?php echo $tipo_gastos_edit->nombre->cellAttributes() ?>>
<span id="el_tipo_gastos_nombre">
<input type="text" data-table="tipo_gastos" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($tipo_gastos_edit->nombre->getPlaceHolder()) ?>" value="<?php echo $tipo_gastos_edit->nombre->EditValue ?>"<?php echo $tipo_gastos_edit->nombre->editAttributes() ?>>
</span>
<?php echo $tipo_gastos_edit->nombre->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tipo_gastos_edit->tipo_gasto->Visible) { // tipo_gasto ?>
	<div id="r_tipo_gasto" class="form-group row">
		<label id="elh_tipo_gastos_tipo_gasto" for="x_tipo_gasto" class="<?php echo $tipo_gastos_edit->LeftColumnClass ?>"><?php echo $tipo_gastos_edit->tipo_gasto->caption() ?><?php echo $tipo_gastos_edit->tipo_gasto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tipo_gastos_edit->RightColumnClass ?>"><div <?php echo $tipo_gastos_edit->tipo_gasto->cellAttributes() ?>>
<span id="el_tipo_gastos_tipo_gasto">
<input type="text" data-table="tipo_gastos" data-field="x_tipo_gasto" name="x_tipo_gasto" id="x_tipo_gasto" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($tipo_gastos_edit->tipo_gasto->getPlaceHolder()) ?>" value="<?php echo $tipo_gastos_edit->tipo_gasto->EditValue ?>"<?php echo $tipo_gastos_edit->tipo_gasto->editAttributes() ?>>
</span>
<?php echo $tipo_gastos_edit->tipo_gasto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tipo_gastos_edit->operacion->Visible) { // operacion ?>
	<div id="r_operacion" class="form-group row">
		<label id="elh_tipo_gastos_operacion" for="x_operacion" class="<?php echo $tipo_gastos_edit->LeftColumnClass ?>"><?php echo $tipo_gastos_edit->operacion->caption() ?><?php echo $tipo_gastos_edit->operacion->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $tipo_gastos_edit->RightColumnClass ?>"><div <?php echo $tipo_gastos_edit->operacion->cellAttributes() ?>>
<span id="el_tipo_gastos_operacion">
<input type="text" data-table="tipo_gastos" data-field="x_operacion" name="x_operacion" id="x_operacion" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($tipo_gastos_edit->operacion->getPlaceHolder()) ?>" value="<?php echo $tipo_gastos_edit->operacion->EditValue ?>"<?php echo $tipo_gastos_edit->operacion->editAttributes() ?>>
</span>
<?php echo $tipo_gastos_edit->operacion->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tipo_gastos_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $tipo_gastos_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tipo_gastos_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$tipo_gastos_edit->showPageFooter();
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
$tipo_gastos_edit->terminate();
?>