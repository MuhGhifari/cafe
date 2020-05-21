<?php 
	// Menampilkan timestamp dalam format nama bulang dalam indonesia(tergantung localize)
	function FormatTanggal($tanggal){
		return \Carbon\Carbon::parse($tanggal)->formatLocalized('dd-mm-yyyy');
	}

	function AmbilTanggal($tanggal){
		return \Carbon\Carbon::parse($tanggal)->formatLocalized('%d');
	}

	function CutBulan($tanggal){
		return substr(\Carbon\Carbon::parse($tanggal)->formatLocalized('%B'), 0, 3);
	}

	function AmbilTahun($tanggal){
		return \Carbon\Carbon::parse($tanggal)->formatLocalized('%Y');
	}

	function CutBulanFull($tanggal){
		$fullCut = AmbilTanggal($tanggal) . " " . CutBulan($tanggal) . " " . AmbilTahun($tanggal);
		return $fullCut;
	}

	function AmbilJam($tanggal){
		return date('g:i A', strtotime($tanggal));
	}

	
 ?>