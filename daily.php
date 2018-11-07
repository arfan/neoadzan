<?php
include "inc/db.php";
include "inc/NeoAdzan.php";

$stmt = $db->prepare("SELECT * FROM `wilayah_137_v1` WHERE kode=:id");
$stmt->execute(array(':id'=>'31'));
$d = $stmt->fetchObject();
if(empty($d->lat)){
	$r=array('status'=>false,'error'=>'data not found');
}else{
	$lat=$d->lat;
	$lng=$d->lng;
	$tz=$d->tz;
}

if(empty($lat)){
	$r=array('status'=>false,'error'=>'data not found');
}else{
	$neoadzan=new NeoAdzan();
	$neoadzan->setLatLng($lat,$lng);
	$neoadzan->setTimeZone($tz);
	$r=$neoadzan->getDaily($y,$m,$day);
}
header('Content-Type: application/json');
echo json_encode($r);
