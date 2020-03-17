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
$generar_condominio = new generar_condominio();

// Run the page
$generar_condominio->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php

$id_condo_mensual= $_GET["fk_id_condo_mensual"];

$dbhelper = &DbHelper();


$resid = $dbhelper->ExecuteRows("SELECT * FROM residencias ");
foreach ($resid as $resi) 
{
	$numrecibo=$resi['consecutivo_recibo'];
}

$aptos = $dbhelper->ExecuteRows("SELECT * FROM apartamentos ");
foreach ($aptos as $apto)
{	
	$numrecibo++;
	$aptoid =$apto['id_apartamento'];
	$alicuota = $apto['alicuota'];
	echo $sql="INSERT INTO recibos (condo_mensual_id,apartamento_id,n_recibo,monto_alicuota) values ('".$id_condo_mensual."','".$aptoid."','".$numrecibo."','".$alicuota."')";
	$dbhelper->execute($sql);
	$sql = "SELECT LAST_INSERT_ID();";
	$insId = $dbhelper->executeRow($sql);
	$insertId = $insId["LAST_INSERT_ID()"];	

	
}
	
	$gastos = $dbhelper->ExecuteRows("SELECT * FROM gastos WHERE condo_mens_id=$id_condo_mensual");
	foreach ($gastos as $gasto)
	{
		$gastoid = $gasto['id_gasto'];
		$monto = $gasto['monto'];
		$montoapto = $monto*$alicuota;
		$sql="INSERT INTO recibo_detalle (recibo_id,gastos_id,cantidad,precio,total) values ('".$insertId."','".$gastoid."','1','".$monto."','".$montoapto."')";
		$dbhelper->execute($sql);
		$montoapto+=$monto;
			
			$sql="SELECT * FROM gastos_ind WHERE apartamento_id =$aptoid";
			$gastosind= $dbhelper->executeRows($sql);			
			foreach ($gastosind as $gastosin)
			{
				//$gastoindid=$gastosin['id_recibo'];
				$montoindv = $gastosin['monto'];
				
			}
			//echo $fin=$alicuota*$montoindv; 
			$sql="UPDATE recibos SET monto_pagar='$fin',monto_ind='$montoindv' WHERE apartamento_id=$aptoid";
			$numrecibo++;
			$sql="UPDATE residencias SET consecutivo_recibo='$numrecibo'";
			//echo $montoindv;
			//echo $sql="INSERT INTO recibos (monto_ind) values ('".$montoindv."')";
			
			
	}
	
?>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$generar_condominio->terminate();
?>