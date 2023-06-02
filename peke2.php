<?php

/**PokeAPI のデータを取得する (URL 末尾の数字はポケモン図鑑の ID) */
$url = 'https://pokeapi.co/api/v2/pokemon/?limit=10&offset=0';
$response = file_get_contents($url);
//レスポンスデータは JSON 形式なので、デコードして連想配列にする
$data = json_decode($response , true);
print("<pre>");
var_dump($data);
print("</pre>");
print("<pre>");
var_dump($data["results"]);
foreach($data["results"] as $key => $value){
    var_dump($value["name"]);
}
print("</pre>")

?>