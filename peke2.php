<?php

/**PokeAPI のデータを取得する (URL 末尾の数字はポケモン図鑑の ID) */
$url = 'https://pokeapi.co/api/v2/pokemon/?limit=20&offset=0';
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
        define('MAX','10');

        $poke_num = count($data["results"]);
        $max_page = ceil($poke_num / MAX);

        if(!isset($_GET['page_id'])){
            $now = 1;
        }else{
            $now = $_GET['page_id'];
        }
        
        $start_no = ($now - 1) * MAX;
        
        $disp_data = array_slice($data["results"], $start_no, MAX, true);

        foreach($disp_data as $key => $value){
            // print("<pre>");
            // var_dump($disp_data);
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
        <?php } 
        
        echo '全件数'. $poke_num. '件'. '　'; // 全データ数の表示です。
 
        if($now > 1){ // リンクをつけるかの判定
            echo '<a href="peke2.php?page_id='.($now - 1).'")>前へ</a>'. '　';
        } else {
            echo '前へ'. '　';
        }
        
        for($i = 1; $i <= $max_page; $i++){
            if ($i == $now) {
                echo $now. '　'; 
            } else {
                echo '<a href="peke2.php?page_id='. $i. '")>'. $i. '</a>'. '　';
            }
        }
        
        if($now < $max_page){ // リンクをつけるかの判定
            echo '<a href="/paging.php?page_id='.($now + 1).'")>次へ</a>'. '　';
        } else {
            echo '次へ';
        }?>
</body>
</html>