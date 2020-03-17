<?php
namespace PHPMaker2020\condominios;
?>
<?php if ($apartamentos->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_apartamentosmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($apartamentos->id_apartamento->Visible) { // id_apartamento ?>
		<tr id="r_id_apartamento">
			<td class="<?php echo $apartamentos->TableLeftColumnClass ?>"><?php echo $apartamentos->id_apartamento->caption() ?></td>
			<td <?php echo $apartamentos->id_apartamento->cellAttributes() ?>>
<span id="el_apartamentos_id_apartamento">
<span<?php echo $apartamentos->id_apartamento->viewAttributes() ?>><?php echo $apartamentos->id_apartamento->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($apartamentos->propietario_id->Visible) { // propietario_id ?>
		<tr id="r_propietario_id">
			<td class="<?php echo $apartamentos->TableLeftColumnClass ?>"><?php echo $apartamentos->propietario_id->caption() ?></td>
			<td <?php echo $apartamentos->propietario_id->cellAttributes() ?>>
<span id="el_apartamentos_propietario_id">
<span<?php echo $apartamentos->propietario_id->viewAttributes() ?>><?php echo $apartamentos->propietario_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($apartamentos->piso_id->Visible) { // piso_id ?>
		<tr id="r_piso_id">
			<td class="<?php echo $apartamentos->TableLeftColumnClass ?>"><?php echo $apartamentos->piso_id->caption() ?></td>
			<td <?php echo $apartamentos->piso_id->cellAttributes() ?>>
<span id="el_apartamentos_piso_id">
<span<?php echo $apartamentos->piso_id->viewAttributes() ?>><?php echo $apartamentos->piso_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($apartamentos->metros_cuadrados->Visible) { // metros_cuadrados ?>
		<tr id="r_metros_cuadrados">
			<td class="<?php echo $apartamentos->TableLeftColumnClass ?>"><?php echo $apartamentos->metros_cuadrados->caption() ?></td>
			<td <?php echo $apartamentos->metros_cuadrados->cellAttributes() ?>>
<span id="el_apartamentos_metros_cuadrados">
<span<?php echo $apartamentos->metros_cuadrados->viewAttributes() ?>><?php echo $apartamentos->metros_cuadrados->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($apartamentos->nombre_numero->Visible) { // nombre_numero ?>
		<tr id="r_nombre_numero">
			<td class="<?php echo $apartamentos->TableLeftColumnClass ?>"><?php echo $apartamentos->nombre_numero->caption() ?></td>
			<td <?php echo $apartamentos->nombre_numero->cellAttributes() ?>>
<span id="el_apartamentos_nombre_numero">
<span<?php echo $apartamentos->nombre_numero->viewAttributes() ?>><?php echo $apartamentos->nombre_numero->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($apartamentos->alicuota->Visible) { // alicuota ?>
		<tr id="r_alicuota">
			<td class="<?php echo $apartamentos->TableLeftColumnClass ?>"><?php echo $apartamentos->alicuota->caption() ?></td>
			<td <?php echo $apartamentos->alicuota->cellAttributes() ?>>
<span id="el_apartamentos_alicuota">
<span<?php echo $apartamentos->alicuota->viewAttributes() ?>><?php echo $apartamentos->alicuota->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>