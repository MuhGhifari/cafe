<?php 
	// Menghitung jumlah hari dari dua timestampm
	function interval($start, $end){
		$from_date = new DateTime($start);
	    $to_date = new DateTime($end);
	    return $from_date->diff($to_date)->days;
	}

 ?>