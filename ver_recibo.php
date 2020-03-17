<?php
namespace PHPMaker2020\condominios;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();
?>
<?php include_once "autoload.php"; ?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$ver_recibo = new ver_recibo();

// Run the page
$ver_recibo->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<!--CUSTOM_FILE_CONTENT_BEGIN-->
<?php
$id_condo_mensual= $_GET["fk_id_condo_mensual"];
$dbhelper = &DbHelper();

$recibos = $dbhelper->ExecuteRows("SELECT * FROM recibos WHERE condo_mensual_id=$id_condo_mensual" );

	

?>
	
		<table class="table table-borderless table-striped table-hover">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">n condominio mensual</th>
					<th scope="col">id apartamento</th>
					<th scope="col">N recibo</th>
					<th scope="col">monto a pagar</th>
					<th scope="col">monto individual</th>
					<th scope="col">Monto alicuota</th>
				</tr>
			</thead>
			<tbody>
				
							<?php foreach ($recibos as $r) {
								$id = $r['id_recibo'];
								$condmensid = $r['condo_mensual_id'];
								$aptoid = $r['apartamento_id'];
								$nrecibo = $r['n_recibo'];
								$montop = $r['monto_pagar'];
								$montonid = $r['monto_ind'];
								$ali = $r['monto_alicuota']; ?>
								<tr>	
							<th scope="row"><?php echo $id?></th>
							<td><?php echo $condmensid?></td>
							<td><?php echo $aptoid?></td>
							<td><?php echo $nrecibo?></td>
							<td><?php echo $montop?></td>
							<td><?php echo $montonid?></td>
							<td><?php echo $ali?></td>
							</tr>	
							<?php }?>
						
			</tbody>
		</table>
	

<!--CUSTOM_FILE_CONTENT_END-->
<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$ver_recibo->terminate();
?>