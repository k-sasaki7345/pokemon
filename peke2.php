<?php
if(empty($_GET)){
    $offset = 0;
}
else{
    if($_GET["page"] == "次へ"){
        $offset = 10 + $_GET["back_off"];
    }
    else if($_GET["page"] == "前へ"){
        $offset =  $_GET["back_off"] - 10;
    }
}

/**PokeAPI のデータを取得する (URL 末尾の数字はポケモン図鑑の ID) */
$url = "https://pokeapi.co/api/v2/pokemon/?limit=10&offset={$offset}";
$response = file_get_contents($url);
//レスポンスデータは JSON 形式なので、デコードして連想配列にする
$data = json_decode($response , true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<header>
    <div id="header">
        <h1>ポケモン図鑑</h1>
    </div>
</header>
<body>
    <div class="container">
    <?php
        foreach($data["results"] as $key => $value){
            // print("<pre>");
            // var_dump($data["results"]);
            // print("</pre>");

            $url2 = $value["url"];
            $response2 = file_get_contents($url2);
        
            $data2 = json_decode($response2 , true); ?>
            <div class="box">
                <div class="img">
                    <img src="<?= $data2['sprites']['front_default'] ?>"><br>
                </div>
                <div class="name">
                    <p>名前：<?= $value["name"]; ?></p>
                </div>
                <div class="type">
                    <p>タイプ：<?= $data2["types"][0]["type"]["name"]; ?></p>
                </div>
                <div class="height">
                    <p>身長：<?= $data2["height"]; ?></p>
                </div>
                <div class="weight">
                    <p>体重：<?= $data2["weight"]; ?></p>
                </div>
            </div>
        <?php } ?>

        </div>
        <form action="" method="get">
            <?php
        
                if($offset != 0){ //リンクをつけるか判定 ?>
                    <input type="submit" name="page" value="前へ">
                <?php } else {
                    echo '前へ'. '　';  
                } ?>
                    <input type="hidden" value="<?= $offset ?>" name="back_off">
                    <input type="submit" name="page" value="次へ">
        </form>

</body>
</html>