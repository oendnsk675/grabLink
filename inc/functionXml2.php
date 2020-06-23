<?php
require_once 'function.php';
require_once 'apiMovie/grab.php';
//require 'inc/conf.php';


date_default_timezone_set('Asia/Aden');

function xmlFile($url, $server, $quality, $imdb, $pre){

  $resDir = date('Y-m-d').".txt";
	/*==============================================*/
		$dataTmdbDetail = tmdbDetail($imdb);
    	$dataTmdbImage = tmdbImage($imdb);
		$dataO = omdb($imdb);
		$dataTmdbVidio = tmdbVidio($imdb);
		if ($dataTmdbDetail == false || $dataTmdbImage == false || $dataO == false || $dataTmdbVidio == false) {
			echo "id imdb ini:".$imdb." error,salah,atau tidak ditemukan,atau mungkin itu id tv shows bukan movie,coba cek nanti di tool testing imdb,jika true berarti jaringan bermasalah,masukin filmnya di list";
			return;
		}
	/*==============================================*/

    /*=======================tempat====+=====ambil=data=======================*/

    $namaFileSql = 'filesql_'.date('Y-m-d').'.txt';
    $title = $dataTmdbDetail["original_title"]; //ambil title dari tmdb
  
	$formatUrl = [];
	for($x=0; $x < count($url);$x++) {
		$hash = md5($url[$x]);
		
		
		$writeSql = fopen($namaFileSql, "a");
		if ($pre === 1) {
		  fwrite($writeSql," ,".$hash.",".$url[$x].",".$title."\r\n<n>");
		}
		          
		//$res = query("INSERT INTO link VALUES ('', '$hash', '$url[$x]','$title')");
		//if ($res = false) {
			//die("input ke mysqli gagal");
		//}
		$formatUrl [] .= "http://thedarks.xyz/shortlink/index.php?url=".$hash;
	}
	

    if (preg_match_all("/:/", $title)) {
    	$linkPath = str_replace(":", "-", $title);
    	$titleTag = str_replace(":", "-", $title);
    }else if (preg_match("/ /", $title)) {
    	$titleTag = str_replace(" ", "-", $title);
    }else{$titleTag = $title;}
    if (preg_match("/ /", $quality[0])) {
    	$qualityFilm = kangConvertSpasi($quality[0]);
    }else{$qualityFilm = $quality[0];}
    
    $linkPath = $title;
	$sinopsis = $dataTmdbDetail["overview"];	//ambil sinopsis dari tmdb
	$idPost = rand(1000,1999); //ambil id dari db
	$date = date('Y-m-d H:i:s'); //ambil time zone dan date
	$year = date('Y'); //ambil date

	//ambil category dari tmdb
	$arrayCategory = $dataTmdbDetail["genres"];
     for ($i=0; $i < count($dataTmdbDetail["genres"]) ; $i++) { 
       $category [] = $arrayCategory[$i]["name"]; //ini nama var category
     }

    //ambil Actor dari omdb
    if (preg_match("/, /", $dataO["Actors"])) {
    	$excast = $dataO["Actors"];
    	$cast = explode(", ", $excast);
    }else{
    	$cast = $dataO["Actors"];
    }
    if (preg_match("/, /", $dataO["Director"])) {
    	$exdir = $dataO["Director"];
    	$director = explode(", ", $exdir);
    }else{
    	$director = $dataO["Director"];
    }
    $poster_url = $dataTmdbDetail["poster_path"];
    $fondo_player = $dataTmdbDetail["backdrop_path"];
    // ambil backdrops
    $imagenes = "";
    $img = $dataTmdbImage["backdrops"];
     for ($i=0; $i < count($img) ; $i++) { 
       $imgs [] = "https://image.tmdb.org/t/p/w300".$img[$i]["file_path"]; 
     }
     for ($z=0; $z < count($imgs) ; $z++) { 
       $imagenes .= $imgs[$z]."\r\n";
     }
     $youtube = $dataTmdbVidio;
     $imdbRating = $dataO["imdbRating"];
     $imdbVotes = $dataO["imdbVotes"];
     $rated = $dataO["Rated"];
     $released = $dataO["Released"];
     $runtime = $dataO["Runtime"];
     $awards = $dataO["Awards"];
     $country = $dataO["Country"];
     $vote_average =  $dataTmdbDetail["vote_average"];
     $vote_count = $dataTmdbDetail["vote_count"];
     $budget = $dataTmdbDetail["vote_count"];
     $revenue = $dataO["BoxOffice"];
     $popularity = $dataTmdbDetail["popularity"];
     $idTmdb = $dataTmdbDetail["belongs_to_collection"]["id"];
     $tagline = $dataTmdbDetail["tagline"];
     $datePathLink = date("Y/m/d");
     if (preg_match("/:/", $title)) {
       $title = str_replace(":", "_", $title);
     }
    // var_dump($img);
    
    
    /*===================================================================================*/
	$xml1 = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>

	<rss version=\"2.0\"
		xmlns:excerpt=\"http://wordpress.org/export/1.2/excerpt/\"
		xmlns:content=\"http://purl.org/rss/1.0/modules/content/\"
		xmlns:wfw=\"http://wellformedweb.org/CommentAPI/\"
		xmlns:dc=\"http://purl.org/dc/elements/1.1/\"
		xmlns:wp=\"http://wordpress.org/export/1.2/\"
	>

	<channel>
		<title>Thedark</title>
		<link>http://thedarks.xyz</link>
		<description>pengunjung adalah raja</description>
		<pubDate>Sat, 13 Jun 2020 15:51:58 +0000</pubDate>
		<language>id-ID</language>
		<wp:wxr_version>1.2</wp:wxr_version>
		<wp:base_site_url>http://thedarks.xyz</wp:base_site_url>
		<wp:base_blog_url>http://thedarks.xyz</wp:base_blog_url>

		<wp:author>
			<wp:author_id>2</wp:author_id>
			<wp:author_login><![CDATA[cozy]]></wp:author_login>
			<wp:author_email><![CDATA[oendnsk1@gmail.com]]></wp:author_email>
			<wp:author_display_name><![CDATA[cozy osyi]]></wp:author_display_name>
			<wp:author_first_name><![CDATA[cozy]]></wp:author_first_name>
			<wp:author_last_name><![CDATA[osyi]]></wp:author_last_name>
		</wp:author>

		<wp:category>
			<wp:term_id>94</wp:term_id>
			<wp:category_nicename><![CDATA[crime]]></wp:category_nicename>
			<wp:category_parent><![CDATA[]]></wp:category_parent>
			<wp:cat_name><![CDATA[Crime]]></wp:cat_name>
		</wp:category>

		<generator>https://wordpress.org/?v=4.9.15</generator>
		
		<item>
			<title>".$title."</title>
			<link>http://thedarks.xyz/".$datePathLink."/".$linkPath."/</link>
			<pubDate>Sat, 13 Jun 2020 15:51:58 +0000</pubDate>
			<dc:creator><![CDATA[cozy]]></dc:creator>
			<guid isPermaLink=\"false\">http://thedarks.xyz/?p=1396</guid>
			<description></description>
			<content:encoded><![CDATA[".$sinopsis."

			Free download movie,and streaming only in the darks movie, like lk21,Layarkaca21,cinema-21-movies,filmapik,gudangmovie21,drakorindo,indoxxi]]></content:encoded>
			<excerpt:encoded><![CDATA[]]></excerpt:encoded>
			<wp:post_id>".$idPost."</wp:post_id>
			<wp:post_date><![CDATA[".$date."]]></wp:post_date>
			<wp:post_date_gmt><![CDATA[".$date."]]></wp:post_date_gmt>
			<wp:comment_status><![CDATA[open]]></wp:comment_status>
			<wp:ping_status><![CDATA[open]]></wp:ping_status>
			<wp:post_name><![CDATA[".$title."]]></wp:post_name>
			<wp:status><![CDATA[publish]]></wp:status>
			<wp:post_parent>0</wp:post_parent>
			<wp:menu_order>0</wp:menu_order>
			<wp:post_type><![CDATA[post]]></wp:post_type>
			<wp:post_password><![CDATA[]]></wp:post_password>
			<wp:is_sticky>0</wp:is_sticky>
			<category domain=\"release-year\" nicename=\"".$year."\"><![CDATA[".$year."]]></category>
			<category domain=\"quality\" nicename=\"".$qualityFilm."\"><![CDATA[".$qualityFilm."]]></category>
			<category domain=\"post_tag\" nicename=\"drakorindo\"><![CDATA[drakorindo]]></category>
			<category domain=\"post_tag\" nicename=\"dunia21\"><![CDATA[Dunia21]]></category>
			<category domain=\"post_tag\" nicename=\"filmapik\"><![CDATA[filmapik]]></category>
			<category domain=\"post_tag\" nicename=\"ganool-movies\"><![CDATA[Ganool Movies]]></category>
			<category domain=\"post_tag\" nicename=\"indoxxi\"><![CDATA[indoxxi]]></category>
			<category domain=\"post_tag\" nicename=\"".$titleTag."\"><![CDATA[".$titleTag."]]></category>
			<category domain=\"post_tag\" nicename=\"".$titleTag."-bioskopkeren-nonton\"><![CDATA[".$titleTag." - Bioskopkeren Nonton]]></category>
			<category domain=\"post_tag\" nicename=\"".$titleTag."-cinemaindo-download\"><![CDATA[".$titleTag." - Cinemaindo Download]]></category>
			<category domain=\"post_tag\" nicename=\"".$titleTag."-cinema-21-layarkaca21\"><![CDATA[".$titleTag." Cinema 21 Layarkaca21 -]]></category>
			<category domain=\"post_tag\" nicename=\"".$titleTag."-cinema-21-movies\"><![CDATA[".$titleTag." Cinema 21 Movies]]></category>
			<category domain=\"post_tag\" nicename=\"".$titleTag."-download-full-movie-".$titleTag."-download-subtitle-indonesia-".$titleTag."-film-bioskop\"><![CDATA[".$titleTag." Download Full Movie ".$titleTag." Download Subtitle Indonesia ".$titleTag." Film Bioskop]]></category>
			<category domain=\"post_tag\" nicename=\"".$titleTag."-nonton\"><![CDATA[".$titleTag." Nonton]]></category>
			<category domain=\"post_tag\" nicename=\"".$titleTag."-sub-indo-nonton-movie\"><![CDATA[".$titleTag." Sub Indo Nonton Movie]]></category>
			<category domain=\"post_tag\" nicename=\"".$titleTag."-subscene\"><![CDATA[".$titleTag." Subscene]]></category>
			<category domain=\"post_tag\" nicename=\"".$titleTag."-subtitle-indonesia-download-film\"><![CDATA[".$titleTag." Subtitle Indonesia Download Film]]></category>
			<category domain=\"post_tag\" nicename=\"".$titleTag."-subtitle-indonesia-nonton-film-online\"><![CDATA[".$titleTag." Subtitle Indonesia Nonton Film Online]]></category>
			<category domain=\"post_tag\" nicename=\"".$titleTag."-subtitle-indonesia-nonton-streaming\"><![CDATA[".$titleTag." Subtitle Indonesia Nonton Streaming]]></category>
			<category domain=\"post_tag\" nicename=\"lk21\"><![CDATA[LK21]]></category>
			<category domain=\"post_tag\" nicename=\"ns21\"><![CDATA[NS21]]></category>
			 \r\n";
			 
		
		file_put_contents("inc/res/".$title.".xml", $xml1);
		// nulis meta kategori
		tulisCategory("inc/res/".$title.".xml", $category);
		// nulis meta cast
		tulisCast("inc/res/".$title.".xml", $cast);
		// nulis meta star
		tulisStar("inc/res/".$title.".xml", $cast);
		// nulis meta director
		tulisDirector("inc/res/".$title.".xml", $director);

		tulisXml2("inc/res/".$title.".xml", $imdb);

		tulisXml3("inc/res/".$title.".xml", $poster_url, $fondo_player, $imagenes);
			// =========================================================
			// <wp:postmeta>
			// 	<wp:meta_key><![CDATA[poster_url]]></wp:meta_key>
			// 	<wp:meta_value><![CDATA[https://image.tmdb.org/t/p/w185/6TaQdmCvuJx6VqC4CsGlpO5lD0P.jpg]]></wp:meta_value>
			// </wp:postmeta>
			// <wp:postmeta>
			// 	<wp:meta_key><![CDATA[fondo_player]]></wp:meta_key>
			// 	<wp:meta_value><![CDATA[https://image.tmdb.org/t/p/w780/sx9dBw5dvbXtXIx2mO9VyzujgS2.jpg]]></wp:meta_value>
			// </wp:postmeta>
			// <wp:postmeta>
			// 	<wp:meta_key><![CDATA[imagenes]]></wp:meta_key>
			// 	<wp:meta_value>
			// 		<![CDATA[https://image.tmdb.org/t/p/w300/sx9dBw5dvbXtXIx2mO9VyzujgS2.jpg
			// 		https://image.tmdb.org/t/p/w300/xV9s1q35MqXwSYa3W32GSZ8A3Rb.jpg
			// 		https://image.tmdb.org/t/p/w300/sLp231vjeGOXMVenPTjOT3XPlF7.jpg
			// 		https://image.tmdb.org/t/p/w300/3fwhk4i8T2wlBdzCo64fzKTns9r.jpg
			// 		https://image.tmdb.org/t/p/w300/m3PmXUgcStmKaaawtjqcHX062hQ.jpg]]>
			// 	</wp:meta_value>
			// </wp:postmeta>

			// ====================================================================
		tulisXml4("inc/res/".$title.".xml",$formatUrl, $server, $quality,$youtube,$imdbRating,$imdbVotes,$title,$rated,$released,$runtime,$awards,$country,$vote_average,$vote_count,$budget,$revenue,$popularity,$idTmdb,$tagline);
    


}


$url1 = "tes";
	$url2 = "judy";
	$url3 = "tes";
	$server1 =  "tes";
	$server2 = "tes";
	$server3 = "tes";
	$quality1 =  "tes";
	$quality2 =  "tes";
	$quality3 =  "tes";
	$imdb = "tt1564777";
	
// xmlFile($url1,$url2,$url3, $server1,$server2,$server3, $quality1,$quality2,$quality3, $imdb);	



?>