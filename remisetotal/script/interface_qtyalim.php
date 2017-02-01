<?php

	require('../config.php');
	dol_include_once('/comm/propal/class/propal.class.php');
	dol_include_once('/commande/class/commande.class.php');
	dol_include_once('/compta/facture/class/facture.class.php');
	
	$qtypcef = GETPOST('qtypcef');
	$qtypcec = GETPOST('qtypcec');

	$fk_object = GETPOST('fk_object', 'int');
	$className = GETPOST('element', 'alpha');
	$className = ucfirst($className);
	$className = strtolower($className);

	if(($className == 'propal')) {
		$doli_det = "doli_propaldet";
		$chtotal = 'total';
	} elseif(($className == 'commande')) {
		$doli_det = "doli_commandedet";
		$chtotal = 'total_ttc';
	}	

	global $db;
	
	$reqqtypcef = $db->query("SELECT dpd.rowid as rowida, dpd.tva_tx as tvaa, dpd.subprice as subpricea , dpd.total_ht as totalhta, dpd.total_tva as totaltvaa, dpd.total_ttc as totalttca FROM $doli_det as dpd, doli_product as dp WHERE dpd.fk_$className = $fk_object and dpd.fk_product = dp.rowid and dp.ref like 'A1%'");
	
	foreach ($reqqtypcef as $datapcef) {

		$rowida = $datapcef['rowida'];
		$subpricea = $datapcef['subpricea'];
		$totalhta = $subpricea*$qtypcef;
		$tvaa = $datapcef['tvaa'];
		$totalttca = ($totalhta*$tvaa/100)+$totalhta;
		$totaltvaa = $totalttca-$totalhta;
		$db->query("UPDATE $doli_det SET qty = $qtypcef, total_ht = $totalhta, total_ttc = $totalttca, total_tva = $totaltvaa where rowid = $rowida ");
	}

	$reqqtypcec = $db->query("SELECT dpd.rowid as rowida, dpd.tva_tx as tvaa, dpd.subprice as subpricea , dpd.total_ht as totalhta, dpd.total_tva as totaltvaa, dpd.total_ttc as totalttca FROM $doli_det as dpd, doli_product as dp WHERE dpd.fk_$className = $fk_object and dpd.fk_product = dp.rowid and dp.ref like 'A2%'");
	
	foreach ($reqqtypcec as $datapcec) {

		$rowida = $datapcec['rowida'];
		$subpricea = $datapcec['subpricea'];
		$totalhta = $subpricea*$qtypcec;
		$tvaa = $datapcec['tvaa'];
		$totalttca = ($totalhta*$tvaa/100)+$totalhta;
		$totaltvaa = $totalttca-$totalhta;
		$db->query("UPDATE $doli_det SET qty = $qtypcec, total_ht = $totalhta, total_ttc = $totalttca, total_tva = $totaltvaa where rowid = $rowida ");
	}

	$reqsumt = $db->query("SELECT SUM(total_ht) as sumtht, SUM(total_tva) as sumtva, SUM(total_ttc) as sumttc FROM $doli_det where fk_$className = $fk_object");
	$sumt = $reqsumt->fetch_assoc();	
	$total_ht = round($sumt['sumtht'], 2, PHP_ROUND_HALF_UP);
	$tva = round($sumt['sumtva'], 2, PHP_ROUND_HALF_UP);
	$total = round($sumt['sumttc'], 2, PHP_ROUND_HALF_UP);
	
	
	//$db->query("UPDATE doli_".$className."_customfields set nombre_d_invites = $newTotal ");	
	$db->query("UPDATE doli_".$className." set total_ht = $total_ht, tva = $tva, $chtotal = $total where rowid = $fk_object ");






	
