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
</head>
<body>
    <?php

        foreach($data["results"] as $key => $value){
            // print("<pre>");
            // var_dump($data["results"]);
            // print("</pre>");

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