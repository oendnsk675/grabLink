<?php  
 //require_once 'apiMovie/grab.php';

function kangConvertSpasi($quality1)
    {
    	$data = str_replace(" ", "-", $quality1);
    	return $data;
    }

function tulisCategory($namaFile,$category){

// $category = ["cozyyyy gans","mantapu","jiwa"];


foreach ($category as $categorys) {
	$file = fopen($namaFile, "a");
			fwrite($file, "		<category domain=\"category\" nicename=\"".$categorys."\"><![CDATA[".$categorys."]]></category> \r\n");
			fclose($file);
}
	
}
function tulisCast($namaFile, $cast){

// $cast = "cozyyyy ";
	if (is_array($cast)) {
		foreach ($cast as $casts) {
			$file = fopen($namaFile, "a");
				fwrite($file, "		<category domain=\"cast\" nicename=\"".$casts."\"><![CDATA[".$casts."]]></category>   \r\n");
				fclose($file);
		}
	}else{
		$file = fopen($namaFile, "a");
				fwrite($file, "		<category domain=\"cast\" nicename=\"".$cast."\"><![CDATA[".$cast."]]></category>   \r\n");
				fclose($file);
	}

	
}
function tulisStar($namaFile, $cast){

// $cast = "cozyyyy gans";

	if (is_array($cast)) {
		foreach ($cast as $casts) {
			$file = fopen($namaFile, "a");
					fwrite($file, "		<category domain=\"star\" nicename=\"".$casts."\"><![CDATA[".$casts."]]></category>\r\n");
					fclose($file);
		}
	}else{
			$file = fopen($namaFile, "a");
					fwrite($file, "		<category domain=\"star\" nicename=\"".$cast."\"><![CDATA[".$cast."]]></category>\r\n");
					fclose($file);
	}
}
function tulisDirector($namaFile, $director){

// $director = "cozyyyy gans";

	if (is_array($director)) {
		foreach ($director as $directors) {
			$file = fopen($namaFile, "a");
					fwrite($file, "		<category domain=\"director\" nicename=\"".$directors."\"><![CDATA[".$directors."]]></category> \r\n");
					fclose($file);
		}
	}else{
			$file = fopen($namaFile, "a");
					fwrite($file, "		<category domain=\"director\" nicename=\"".$director."\"><![CDATA[".$director."]]></category> \r\n");
					fclose($file);
	}
}
function tulisXml2($namaFile, $imdb){

// $imdb = 1;

	$file = fopen($namaFile, "a");
			fwrite($file, "		<wp:postmeta>
			<wp:meta_key><![CDATA[_edit_last]]></wp:meta_key>
			<wp:meta_value><![CDATA[4]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[Checkbx2]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$imdb."]]></wp:meta_value>
		</wp:postmeta> \r\n");
			fclose($file);
}

function tulisXml3($namaFile, $poster_url, $fondo_player, $imagenes){


	$file = fopen($namaFile, "a");
			fwrite($file, "		 <wp:postmeta>
				<wp:meta_key><![CDATA[poster_url]]></wp:meta_key>
				<wp:meta_value><![CDATA[https://image.tmdb.org/t/p/w185".$poster_url."]]></wp:meta_value>
			</wp:postmeta>
			<wp:postmeta>
				<wp:meta_key><![CDATA[fondo_player]]></wp:meta_key>
				<wp:meta_value><![CDATA[https://image.tmdb.org/t/p/w780".$fondo_player."]]></wp:meta_value>
			</wp:postmeta>
			<wp:postmeta>
				<wp:meta_key><![CDATA[imagenes]]></wp:meta_key>
				<wp:meta_value><![CDATA[".$imagenes."]]></wp:meta_value>
			</wp:postmeta> \r\n");
			fclose($file);
}

function tulisDownload($formatUrl, $server, $quality){
	$formatUrl = $formatUrl;
	$server = $server;
	$quality = $quality;
	$datas = "";
		for ($i=0; $i < count($formatUrl) ; $i++) { 
			$datas .= "<wp:postmeta>
			<wp:meta_key><![CDATA[ddw_".$i."_op1]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$formatUrl[$i]."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[_ddw_".$i."_op1]]></wp:meta_key>
			<wp:meta_value><![CDATA[field_5ee3b20ee79d1]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[ddw_".$i."_op2]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$server[$i]."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[_ddw_".$i."_op2]]></wp:meta_key>
			<wp:meta_value><![CDATA[field_5ee3b2e37b5af]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[ddw_".$i."_op3]]></wp:meta_key>
			<wp:meta_value><![CDATA[subtitle indonesia]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[_ddw_".$i."_op3]]></wp:meta_key>
			<wp:meta_value><![CDATA[field_5ee3b20ee7adb]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[ddw_".$i."_op4]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$quality[$i]."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[_ddw_".$i."_op4]]></wp:meta_key>
			<wp:meta_value><![CDATA[field_5ee3b20ee7b4f]]></wp:meta_value>
		</wp:postmeta> \r\n";
		}
		return $datas;
}


function tulisXml4($namaFile,$url, $server, $quality,$youtube,$imdbRating,$imdbVotes,$title,$rated,$released,$runtime,$awards,$country,$vote_average,$vote_count,$budget,$revenue,$popularity,$idTmdb,$tagline){

$banyakInput = count($url);

$director = "cozyyyy gans";


	$file = fopen($namaFile, "a");
			fwrite($file, "		<wp:postmeta>
			<wp:meta_key><![CDATA[youtube_id]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$youtube."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[imdbRating]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$imdbRating."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[imdbVotes]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$imdbVotes."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[Title]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$title."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[Rated]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$rated."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[Released]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$released."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[Runtime]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$runtime."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[Awards]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$awards."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[Country]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$country."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[vote_average]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$vote_average."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[vote_count]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$vote_count."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[budget]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$budget."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[revenue]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$revenue."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[popularity]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$popularity."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[id]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$idTmdb."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[status]]></wp:meta_key>
			<wp:meta_value><![CDATA[Released]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[tagline]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$tagline."]]></wp:meta_value>
		</wp:postmeta>
		".tulisDownload($url, $server, $quality)."
		<wp:postmeta>
			<wp:meta_key><![CDATA[ddw]]></wp:meta_key>
			<wp:meta_value><![CDATA[".$banyakInput."]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[_ddw]]></wp:meta_key>
			<wp:meta_value><![CDATA[field_5ee3b20ee3962]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[voo]]></wp:meta_key>
			<wp:meta_value><![CDATA[0]]></wp:meta_value>
		</wp:postmeta>
		<wp:postmeta>
			<wp:meta_key><![CDATA[_voo]]></wp:meta_key>
			<wp:meta_value><![CDATA[field_5ee3b20ee3a49]]></wp:meta_value>
		</wp:postmeta>
	</item>
</channel>
</rss> \r\n");
			fclose($file);
}


//$dir = "reshadi";
//$dirTemp = $dir."/template/data_film.xml";
	
//fungsiConvert($dir, $dirTemp);


?>
