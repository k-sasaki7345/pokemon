<?php

/**PokeAPI のデータを取得する (URL 末尾の数字はポケモン図鑑の ID) */
$url = 'https://pokeapi.co/api/v2/pokemon/?limit=10&offset=0';
$response = file_get_contents($url);
//レスポンスデータは JSON 形式なので、デコードして連想配列にする
$data = json_decode($response , true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <?php
        foreach($data["results"] as $key => $value){
            $url2 = $value["url"];
            $response2 = file_get_contents($url2);
        
            $data2 = json_decode($response2 , true);
            // array_push($name,$value["name"]);
            // array_push($pokeArray,$value["url"]); ?>
            <img src="<?= $data2['sprites']['front_default'] ?>"><br>
            名前：<?= $value["name"]; ?><br>
            タイプ：<?= $data2["types"][0]["type"]["name"]; ?><br>
            身長：<?= $data2["height"]; ?><br>
            体重：<?= $data2["weight"]; ?><br>
        <?php } ?>
</body>
</html>