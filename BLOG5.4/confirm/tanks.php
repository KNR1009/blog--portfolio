<?php
  session_start();
  //セッションが保存されていなかったらエントリー部分へ遷移させる
 if(!isset($_SESSION['join'])){
  header('Location: ../entry');
  exit();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/confirm.css">

    <title>会員登録完了</title>
  </head>
  <body>
 
    <div class="container-fluid confirm">
      <div class="header-text">
        <h2 class="fonth2">Write</h2>
        <h4 class="fonth4">書くためのテーマ</h4>
      </div>

      <!-- 以下に会員登録確認画面の作成 -->
      <!-- phpより受け取ったもの表示を以下に行う -->

      <div class="container confirmScreen text-center">
        <h2><span style="border-left: 15px solid black; opacity: 0.8;" class="pl-3">会員登録確認<span></h2>
            <h3 style="color:#444444;">登録完了</h3>
           <div><a href="../login/index.php" class="btn">ログインする</a></div>
           
           
         </form>
      </div>
  </div>