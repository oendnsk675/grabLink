<?php


function tmdbDetail($id){
  
  $status = false;
$ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://api.themoviedb.org/3/movie/'.$id.'?api_key=8e6a961e1398dcc6612a00f99a1b06b5&language=en-US');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept: application/json'));
      curl_setopt($ch, CURLOPT_HEADER, false);
      $x = curl_exec($ch);
      
      $data = json_decode($x, true);
      if (count($data) <= 2) {
        return $status;
      }
      return $data;
}

function omdb($id){
  $status = false;
  
$omdb = file_get_contents("http://www.omdbapi.com/?i=".$id."&apikey=938d2c79");
$file = json_decode($omdb, true);
if (!$file["Response"] = "true") {
        return $status;
      }
        return $file;
}

function tmdbImage($id){
  $status = false;
  
$ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://api.themoviedb.org/3/movie/'.$id.'/images?api_key=8e6a961e1398dcc6612a00f99a1b06b5&language=en&include_image_language=null,en');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept: application/json'));
      curl_setopt($ch, CURLOPT_HEADER, false);
      $x = curl_exec($ch);
      
      $data = json_decode($x, true);
      if (count($data) <= 2) {
        return $status;
      }
      return $data;
}

function tmdbVidio($id){
  $vidios = "";
  $status = false;
$ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://api.themoviedb.org/3/movie/'.$id.'/videos?api_key=8e6a961e1398dcc6612a00f99a1b06b5&language=en-US');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept: application/json'));
      curl_setopt($ch, CURLOPT_HEADER, false);
      $x = curl_exec($ch);

      $data = json_decode($x, true);
      if (isset($data["status_code"])) {
        if ($data["status_code"]) {
        return $status;
        }
      }
      $vidio = $data["results"];
    for ($i=0; $i < count($vidio); $i++) { 
      $vidios  .= "[".$data["results"][$i]["key"]."]";
    }
      return $vidios;
}

    $tmdbDetail = tmdbDetail("tt7003976");
    $omdbDetail = omdb("tt7003976");
    $dataTmdbVidio = tmdbVidio("tt7003976");
    $dataTmdbImage = tmdbImage("tt7003976");

    // $youtube = "";
     // $you = $dataTmdbVidio;
    // var_dump($tmdbDetail);
    // var_dump($dataTmdbVidio);
    // var_dump($dataTmdbImage);
     // echo("======================== \n");
    // var_dump($omdbDetail);

 