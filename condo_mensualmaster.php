<?php
namespace PHPMaker2020\condominios;
?>
<?php if ($condo_mensual->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_condo_mensualmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($condo_mensual->id_condo_mensual->Visible) { // id_condo_mensual ?>
		<tr id="r_id_condo_mensual">
			<td class="<?php echo $condo_mensual->TableLeftColumnClass ?>"><?php echo $condo_mensual->id_condo_mensual->caption() ?></td>
			<td <?php echo $condo_mensual->id_condo_mensual->cellAttributes() ?>>
<span id="el_condo_mensual_id_condo_mensual">
<span<?php echo $condo_mensual->id_condo_mensual->viewAttributes() ?>><?php echo $condo_mensual->id_condo_mensual->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($condo_mensual->mes->Visible) { // mes ?>
		<tr id="r_mes">
			<td class="<?php echo $condo_mensual->TableLeftColumnClass ?>"><?php echo $condo_mensual->mes->caption() ?></td>
			<td <?php echo $condo_mensual->mes->cellAttributes() ?>>
<span id="el_condo_mensual_mes">
<span<?php echo $condo_mensual->mes->viewAttributes() ?>><?php echo $condo_mensual->mes->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($condo_mensual->ano->Visible) { // año ?>
		<tr id="r_ano">
			<td class="<?php echo $condo_mensual->TableLeftColumnClass ?>"><?php echo $condo_mensual->ano->caption() ?></td>
			<td <?php echo $condo_mensual->ano->cellAttributes() ?>>
<span id="el_condo_mensual_ano">
<span<?php echo $condo_mensual->ano->viewAttributes() ?>><?php echo $condo_mensual->ano->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($condo_mensual->aux->Visible) { // aux ?>
		<tr id="r_aux">
			<td class="<?php echo $condo_mensual->TableLeftColumnClass ?>"><?php echo $condo_mensual->aux->caption() ?></td>
			<td <?php echo $condo_mensual->aux->cellAttributes() ?>>
<span id="el_condo_mensual_aux">
<span<?php echo $condo_mensual->aux->viewAttributes() ?>><?php echo $condo_mensual->aux->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>