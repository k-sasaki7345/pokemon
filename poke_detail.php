<?php
if(isset($_GET["url"])){
    $url = $_GET["url"];
}
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
<?php foreach($data as $key => $value){
    // print("<pre>");
    // var_dump($data);
    // print("</pre>");
    $url2 = $value["url"];
    $response2 = file_get_contents($url2);

    $data2 = json_decode($response2 , true); 
    print("<pre>");
    var_dump($data2);
    print("</pre>"); 
    ?>
    <div class="box">
        <div class="img">
            <img src="<?= $data2['sprites']['front_default'] ?>"><img src="<?= $data2['sprites']['back_default'] ?>"><br>
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

</body>
</html>