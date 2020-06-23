<?php  
require('functionXml2.php');
//require('function.php');

$status = "tv show";

function cariServer($cariLink){
	$servers = [];
	// ambil server
	foreach ($cariLink as $links) {
		if (preg_match("/gm21.download/", $links)) {
			$servers [] .= "gdrive.com";
		}else if (preg_match("/acefile.co/", $links)) {
			$servers [] .= "acefile.co";
		}else if (preg_match("/uptobox.com/", $links)){
			$servers [] .= "uptobox.com";
		}else if (preg_match("/gudangmovies21asli.xyz/", $links)) {
			$servers [] .= "fembed.com";
		}else if (preg_match("/racaty.com/", $links)) {
			$servers [] .= "racaty.com";
		}
	}
	return $servers;
		
}

function tulis($url, $no,$pre){
		global $status;
		$qualitys = [];
		
		$title =  cariOther($url, "<title>Nonton Film", "Subtitle Indonesia - GudangMovies21</title>");
		$quality = cariOther($url, "class=\"calidad2\">", "</span> <noscript>");
		$idImdb = cariOther($url, "href=\"https://www.imdb.com/title/", "/\" target=\"_blank\"><div class=\"a\">");
		// ambil link ,kembalian array
		$cariLink = cariLink($url, "<li class=\"elemento\"> <a href=\"", "\" target=\"_blank\"> <span class=\"a\">", $pre);
		echo("proccess write brayn santuy \r\n\r\n");
		//echo($title);
		if ($title === $status || $quality === $status || $idImdb === $status || $cariLink === $status) {
			return;
		}else{
		  if ($pre === null) {
        $file = fopen("tes.txt", "a");
  				fwrite($file, $no.".".$title." ".$quality."\r\n".$cariLink."\r\n");
  				fclose($file);
  				echo("film: [".$title."]done \r\n\r\n");
		  }else {
		      
            echo("proccess write xml film:".$title."...\r\n");
        		$servers = cariServer($cariLink);
        		// buat quality jadi array
        		for ($i=0; $i < count($cariLink) ; $i++) { 
        			$qualitys [] .= $quality;
        		}
        	//	var_dump($cariLink);
        		//var_dump($servers);
        	//	var_dump($qualitys);
        		//var_dump($idImdb);
        	if ($pre === null) {
        	 xmlFile($cariLink, $servers, $qualitys, $idImdb, null);
        	}else {
            xmlFile($cariLink, $servers, $qualitys, $idImdb, 1);
        	}
        		
        		echo("film: ".$title." done \r\n\r\n");
		    
		  }
        
			
			// $arrayLink [] .= $cariLink;
		}
		
}

function cariLink($url ,$start, $end, $pre){
	global $status;
	$handle = file_get_contents($url);
	if (preg_match_all("/EPISODE-01/", $handle)) {
		return $status;
	}else{
		// cari link download ,dan kembaliannya berbentuk array
		$ex = [];
		$ress = [];
		$res = "";
		$ex = explode($start, $handle);
		for ($i=1; $i < 6 ; $i++) { 
			$ex2 [] = explode($end, $ex[$i]);

		}
		if($pre === null){
		  for ($o=0; $o <= 4 ; $o++) {
  		  $res .= $ex2[$o][0]."\r\n";
  		  //var_dump($res);
  		  //echo("tai");
  		  
		  }
		  return $res;
		}else{
  		for ($o=0; $o <= 4 ; $o++) { 
  			$ress [] .= $ex2[$o][0]."\r\n";
  		}
		 return $ress;
		}
		// var_dump($res);
	}

}

function cariOther($url ,$start, $end){
	global $status;
	$handle = file_get_contents($url);
	if (preg_match_all("/EPISODE-01/", $handle)) {
		return $status;
	}else{
		$ex = explode($start, $handle);
		$ex2 = explode($end, $ex[1]);
		$data = $ex2[0];
		return $data;
	}

}
function ambilLinkPage($url ,$start, $end,$pre){
	$handle = file_get_contents($url);
	$ex2 = [];
	$ex = explode($start, $handle);
	echo("proccess ambil link per page...\r\n\r\n");
	for ($i=1; $i < 31 ; $i++) { 
		$ex2 [] = explode($end, $ex[$i]);
	}
	for ($z=0; $z < count($ex2) ; $z++) { 
		$url = $ex2[$z][0];
		tulis($url,$z+1,$pre);
		// var_dump($ex[1]);
	}
	
}




//ambilLinkPage("https://gudangmovies21.casa/category/comedy/page/5/", "class=\"item\"> <a href=\"", "\"><div class=\"image\">");

//converter();


?>