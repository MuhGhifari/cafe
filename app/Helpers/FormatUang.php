<?php 

	function rupiah($number){
		$hasil = "Rp " . number_format($number, 0, ',', '.');
		return $hasil;
	}

	function minimum($number, $field){
		$minimum = $number->min($field);
		return $minimum;
	}

 ?>