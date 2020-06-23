<?php 
require 'vendor/autoload.php';
require('inc/cariLink.php');

$cli = new League\CLImate\CLImate;



$cli->draw('fancy-bender');
$cli->br();
echo "Created By.Sayidina ahmadal qososyi";
$cli->br();
$cli->br();


$options = ['preview', 'confirm', 'convert'];
$c = 1;
echo("menu tool : \r\n");
foreach ($options as $value) {
  echo("\n".$c.'.'.$value."\n");
  $c++;
}

$input = $cli->input("\nPilih nomer tool?");
$input->accept([1, 2,3]);

$response = $input->prompt();

$cli->br();

//echo($response);
switch ($response) {
  case 1:
    
    echo("pastikan menggunakan internet yg stabil!!!");
    $cli->br();
    $cli->br();
    $inputUrl = $cli->input("Paste link disini gayn")->prompt();
    file_put_contents('tes.txt', "");
    tulisBaner("preview link sebelum grab",$inputUrl);
    $cli->br();
    
    // code...
    //var_dump($inputUrl);
    ambilLinkPage($inputUrl, "class=\"item\"> <a href=\"", "\"><div class=\"image\">",null);
    $resultPre = file_get_contents('tes.txt');
    echo("------Preview Res Link----\r\n\r\n".$resultPre."\r\n--------------------");
    break;
  case 3:
    $res = fungsiConvert();
    echo('done gayn,silahkan cek file di folder '.$res."\n jan lupa import di link ini: http://thedarks.xyz\r\n");
    $cli->br();
    break;
  case 2:
    
    echo("pastikan menggunakan internet yg stabil!!!");
    $cli->br();
    $cli->br();
    hapus();
    $inputUrl = $cli->input("Paste link disini gayn")->prompt();
    hapusSql();
    tulisBaner("Confirm to grab",$inputUrl);
    $cli->br();
     ambilLinkPage($inputUrl, "class=\"item\"> <a href=\"", "\"><div class=\"image\">",1);
     $cli->br();
    break;
  
  default:
    echo('tq gayn sudah menggunakan tool ini');
    break;
}

//ambilLinkPage($input, "class=\"item\"> <a href=\"", "\"><div class=\"image\">");
function fungsiConvert(){
  $dir = "inc/res";
 date_default_timezone_set('Asia/Jakarta');
  
  $dirTemp = "inc/res/convert/res_".date('Y_m_d h').".xml";
$format = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>

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
		
		";
  

	$file = scandir($dir);

file_put_contents($dirTemp, $format);
for ($i=2; $i < count($file); $i++) {
	
	$filegetwrite = file_get_contents($dir.'/'.$file[$i]);
	$ex = explode("</generator>", $filegetwrite);
	$ex2 = explode("</channel>", $ex[1]);
	$fileopen = fopen($dirTemp, "a");
				fwrite($fileopen, $ex2[0]);
				fclose($fileopen);
}
$filend = fopen($dirTemp, "a");
				fwrite($filend, "</channel>
</rss> 
");
				fclose($filend);
				$status = $dirTemp;
				return $status;

}
function tulisBaner($tool, $link){
  global $cli;
  $cli->br();
  echo "description tool: ". $tool."\r\n";
	echo "Link page :".$link."\r\n";
	echo "Tekan CTRL + C kalau mau keluar \r\n";
	echo "Proccessing wait... \r\n";
	$cli->br();
}
function hapus(){
  global $cli;
  $input = $cli->confirm('Hapus Res sebelumnya,klo sudah di upload rekomen hapus aja?');

// Continue? [y/n]
if ($input->confirmed()) {
    // Do your thing here
    $dir = scandir("inc/res");
    for ($k = 2; $k < count($dir); $k++) {
       $info = pathinfo($dir[$k]);
       if ($info["basename"] != $info["filename"]) 
       {
				 unlink("inc/res/".$dir[$k]);
				 
			 }
      }
  echo("done terhapus \r\n\r\n");
  } else {
      // Don't do your thing
      echo("anda tidak menghapus res sebelumnya \r\n\r\n");
  }
}

function hapusSql(){
  global $cli;
  $input = $cli->confirm("\r\nHapus data sql yg sebelumnya?,klo masih percobaan yg sebelumnya rekomen di hapus,tapi terserah ente gayn....?");

// Continue? [y/n]
if ($input->confirmed()) {
    // Do your thing here
    $namaFileSql = 'filesql_'.date('Y-m-d').'.txt';
  
      file_put_contents($namaFileSql, "");
  echo("done terhapus \r\n\r\n");
  } else {
      // Don't do your thing
      echo("anda tidak menghapus res sebelumnya \r\n\r\n");
  }
}