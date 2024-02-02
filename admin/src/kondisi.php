<?php
if($data['k1'] == 1){
	$k1 = "Sedikit";
}elseif($data['k1'] == 3){
	$k1 = "Sedang";
}elseif($data['k1'] == 5){
	$k1 = "Banyak";
}

if($data['k2'] == 1){
	$k2 = "Biasa";
}elseif($data['k2'] == 3){
	$k2 = "Serius";
}elseif($data['k2'] == 5){
	$k2 = "Sangat Serius";
}

if($data['k3'] == 1){
	$k3 = "Biasa";
}elseif($data['k3'] == 3){
	$k3 = "Berdampak";
}elseif($data['k3'] == 5){
	$k3 = "Berdampak Besar";
}

if($data['k4'] == 1){
	$k4 = "Penanganan Biasa";
}elseif($data['k4'] == 3){
	$k4 = "Teknisi dan Alat Biasa";
}elseif($data['k4'] == 5){
	$k4 = "Butuh Teknisi dan Alat Tambah";
}


?>