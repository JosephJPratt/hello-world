<?php

if (isset($_POST ['insert'])) {
		
		$xml = new DomDocument ("1.0","UTF-8");
		$xml->load ('studentdb.xml');
		
		$cname = $_POST ['c_name'];
		$hadd = $_POST ['h_add'];
		
		$rootTag = $xml->getElementsByTagName('root')->item(0);
		
		$infoTag = $xml->createElement ("info");
			$nameTag = $xml->createElement ("name", $cname);
			$addTag = $xml->createElement ("address", $hadd);
			
			$infoTag->appendChild($nameTag);
			$infoTag->appendChild($addTag);
			
		$rootTag->appendChild($infoTag);
		$xml->save('studentdb.xml');
}





?>

