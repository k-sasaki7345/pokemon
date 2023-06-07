<?php
if(empty($_GET)){
    /**PokeAPI のデータを取得する (URL 末尾の数字はポケモン図鑑の ID) */
    $url = "https://pokeapi.co/api/v2/pokemon/?limit=10&offset=0";
}
else{
    if($_GET["page"] == "次へ"){
        $url = $_GET["next"];
    }
    else if($_GET["page"] == "前へ"){
        $url = $_GET["previous"];
    }
}

// if(!impty($_GET["limit"])){
//     if($_GET["limit"] == 1){
//         $limit = 10;
//     }
//     else if($_GET["limit"] == 3){
//         $limit = 30;
//     }
//     else if($_GET["limit"] == 5){
//         $limit = 50;
//     }
// }


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
            // var_dump($data);
            // print("</pre>");
            $url2 = $value["url"];

            $response2 = file_get_contents($url2);
        
            $data2 = json_decode($response2 , true); 
            // print("<pre>");
            // var_dump($data2);
            // print("</pre>"); 
            ?>
            <div class="box">
                <div class="img">
                    <img src="<?= $data2['sprites']['front_default'] ?>"><br>
                </div>

                <div class="name">
                    <strong><a href="peko_detail.php?url='<?= $value["url"] ?>'"><?= $value["name"]; ?></a></strong>
                </div>
                <div class="type">
                    <p>タイプ：<?= $data2["types"][0]["type"]["name"]; ?></p>
                </div>
                <div class="height">
                    <p>たかさ：<?= $data2["height"]; ?></p>
                </div>
                <div class="weight">
                    <p>おもさ：<?= $data2["weight"]; ?></p>
                </div>
            </div>
        <?php } ?>

    </div>
    <div class="button">
        <form action="" method="get">
            <?php
        
                if($data["previous"] != NULL){  ?>
                    <input type="hidden" value="<?= $data["previous"] ?>" name="previous">
                    <input type="submit" name="page" value="前へ" class="button-previous">
                <?php }
                if($data["next"] != NULL ) { ?>
                    <input type="hidden" value="<?= $data["next"] ?>" name="next">
                    <input type="submit" name="page" value="次へ" class="button-next">
                <?php } ?>
        </form>
    </div>
</body>
</html>