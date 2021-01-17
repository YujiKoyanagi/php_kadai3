<?php
//1. POSTデータ取得
$bookname   = $_POST["bookname"];
$url  = $_POST["url"];
$review = $_POST["review"];
// $age    = $_POST["age"]; //追加されています


//2. DB接続します
//*** function化する！  *****************
try {
    $db_name = "php03_kadai";    //データベース名
    $db_id   = "root";      //アカウント名
    $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
    $db_host = "localhost"; //DBホスト
    $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:'.$e->getMessage());
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(bookname,url,review,indate)VALUES(:bookname,:url,:review,sysdate())");
$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':review', $review, PDO::PARAM_INT);        //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    //*** function化する！*****************
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}else{
    //*** function化する！*****************
    header("Location: bm_update_view.php");
    exit();
}
?>
