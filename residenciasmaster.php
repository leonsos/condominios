<?php
namespace PHPMaker2020\condominios;
?>
<?php if ($residencias->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_residenciasmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($residencias->id_residencia->Visible) { // id_residencia ?>
		<tr id="r_id_residencia">
			<td class="<?php echo $residencias->TableLeftColumnClass ?>"><?php echo $residencias->id_residencia->caption() ?></td>
			<td <?php echo $residencias->id_residencia->cellAttributes() ?>>
<span id="el_residencias_id_residencia">
<span<?php echo $residencias->id_residencia->viewAttributes() ?>><?php echo $residencias->id_residencia->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($residencias->nombre->Visible) { // nombre ?>
		<tr id="r_nombre">
			<td class="<?php echo $residencias->TableLeftColumnClass ?>"><?php echo $residencias->nombre->caption() ?></td>
			<td <?php echo $residencias->nombre->cellAttributes() ?>>
<span id="el_residencias_nombre">
<span<?php echo $residencias->nombre->viewAttributes() ?>><?php echo $residencias->nombre->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($residencias->presidente->Visible) { // presidente ?>
		<tr id="r_presidente">
			<td class="<?php echo $residencias->TableLeftColumnClass ?>"><?php echo $residencias->presidente->caption() ?></td>
			<td <?php echo $residencias->presidente->cellAttributes() ?>>
<span id="el_residencias_presidente">
<span<?php echo $residencias->presidente->viewAttributes() ?>><?php echo $residencias->presidente->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($residencias->presidente_telefono->Visible) { // presidente_telefono ?>
		<tr id="r_presidente_telefono">
			<td class="<?php echo $residencias->TableLeftColumnClass ?>"><?php echo $residencias->presidente_telefono->caption() ?></td>
			<td <?php echo $residencias->presidente_telefono->cellAttributes() ?>>
<span id="el_residencias_presidente_telefono">
<span<?php echo $residencias->presidente_telefono->viewAttributes() ?>><?php echo $residencias->presidente_telefono->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($residencias->consecutivo_recibo->Visible) { // consecutivo_recibo ?>
		<tr id="r_consecutivo_recibo">
			<td class="<?php echo $residencias->TableLeftColumnClass ?>"><?php echo $residencias->consecutivo_recibo->caption() ?></td>
			<td <?php echo $residencias->consecutivo_recibo->cellAttributes() ?>>
<span id="el_residencias_consecutivo_recibo">
<span<?php echo $residencias->consecutivo_recibo->viewAttributes() ?>><?php echo $residencias->consecutivo_recibo->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>