<?php
namespace PHPMaker2020\condominios;
?>
<?php if ($pisos->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_pisosmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($pisos->id_piso->Visible) { // id_piso ?>
		<tr id="r_id_piso">
			<td class="<?php echo $pisos->TableLeftColumnClass ?>"><?php echo $pisos->id_piso->caption() ?></td>
			<td <?php echo $pisos->id_piso->cellAttributes() ?>>
<span id="el_pisos_id_piso">
<span<?php echo $pisos->id_piso->viewAttributes() ?>><?php echo $pisos->id_piso->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pisos->edificio_id->Visible) { // edificio_id ?>
		<tr id="r_edificio_id">
			<td class="<?php echo $pisos->TableLeftColumnClass ?>"><?php echo $pisos->edificio_id->caption() ?></td>
			<td <?php echo $pisos->edificio_id->cellAttributes() ?>>
<span id="el_pisos_edificio_id">
<span<?php echo $pisos->edificio_id->viewAttributes() ?>><?php echo $pisos->edificio_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pisos->nombre->Visible) { // nombre ?>
		<tr id="r_nombre">
			<td class="<?php echo $pisos->TableLeftColumnClass ?>"><?php echo $pisos->nombre->caption() ?></td>
			<td <?php echo $pisos->nombre->cellAttributes() ?>>
<span id="el_pisos_nombre">
<span<?php echo $pisos->nombre->viewAttributes() ?>><?php echo $pisos->nombre->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>