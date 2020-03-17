<?php
namespace PHPMaker2020\condominios;
?>
<?php if ($edificios->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_edificiosmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($edificios->nombre->Visible) { // nombre ?>
		<tr id="r_nombre">
			<td class="<?php echo $edificios->TableLeftColumnClass ?>"><?php echo $edificios->nombre->caption() ?></td>
			<td <?php echo $edificios->nombre->cellAttributes() ?>>
<span id="el_edificios_nombre">
<span<?php echo $edificios->nombre->viewAttributes() ?>><?php echo $edificios->nombre->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>