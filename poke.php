<?php

/**PokeAPI のデータを取得する (URL 末尾の数字はポケモン図鑑の ID) */
$url = 'https://pokeapi.co/api/v2/pokemon/2';
$response = file_get_contents($url);
//レスポンスデータは JSON 形式なので、デコードして連想配列にする
$data = json_decode($response , true);
// print("<pre>");
// var_dump($data);
// print("</pre>");
// print("<pre>");
// var_dump($data['name']); // 名前
// var_dump($data['sprites']['front_default']); // 正面向きのイメージ
// var_dump($data['height']); // たかさ
// var_dump($data['weight']); // おもさ
// print("</pre>")

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <img src="<?= $data['sprites']['front_default']; ?> "  alt="">
    <p> <?= $data["name"]; ?> </p>
    <p><?php echo $data["types"][0]["type"]["name"]; ?></p>
    <p><?php echo $data["height"]; ?></p>
    <p><?php echo $data["weight"]; ?></p>
</body>
</html>




