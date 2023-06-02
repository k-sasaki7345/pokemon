<?php

/**PokeAPI のデータを取得する (URL 末尾の数字はポケモン図鑑の ID) */
$url = 'https://pokeapi.co/api/v2/pokemon/?limit=10&offset=0';
$response = file_get_contents($url);
//レスポンスデータは JSON 形式なので、デコードして連想配列にする
$data = json_decode($response , true);
print("<pre>");
var_dump($data["results"]);
$name = array();
$pokeArray = array();
foreach($data["results"] as $key => $value){
    // array_push($name,$value["name"]);
    // array_push($pokeArray,$value["url"]);
    echo $value["types"][0]["type"]["name"]."<br>";
    echo $value["name"]."<br>";
    echo $value["height"]."<br>";
    echo $value["weight"]."<br>";
}
print("</pre>")

?>