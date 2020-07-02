<?php
  session_start();
  require('../dbconnect.php');
  //ログインしてきた場合と、それ以外の場合でナビゲーションの値を変える
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/top.css">

    <title>Write</title>
  </head>
  <body>

    <!-- 以下のヘッダー部分はセッションがある場合のみに表示させる -->
    <!-- 以下はヘッダー部分 -->
    <!-- ログインしていた場合は以下のナビゲーションを表示する -->
    <?php if(isset($_SESSION['id'])):?>
    <nav class="navbar navbar-expand-md  navbar-light header pt-4 pb-4">
      <a class="navbar-brand col-6" href="/"><img src="../img/logo.jpg" alt="WEBST8ロゴ" class="w-50"></a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#bs-navi" aria-controls="bs-navi" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="collapse navbar-collapse header-var" id="bs-navi">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="../top">トップ&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
          <li class="nav-item"><a class="nav-link" href="">新規投稿&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
          <li class="nav-item"><a class="nav-link" href="profile.php">プロフィール&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
          <!-- 以下はphpでログインされている場合のみに表示させる -->
          <li class="nav-item"><a class="nav-link" href="#">ログアウト&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
          <!-- ログインされていない場合にはログインボタンが表示されるようにする -->
        </ul>
      </div>
    </nav>
    <!-- ログインしていなかった場合の処理を以下に書く -->
   <?php else:?>
    <nav class="navbar navbar-expand-md  navbar-light header pt-4 pb-4">
      <a class="navbar-brand col-6" href=""><img src="../img/logo.jpg" alt="WEBST8ロゴ" class="w-50"></a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#bs-navi" aria-controls="bs-navi" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="collapse navbar-collapse header-var" id="bs-navi">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="../top">トップ&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
          <li class="nav-item"><a class="nav-link" href="">投稿一覧&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
          <li class="nav-item"><a class="nav-link" href="">お問い合わせ&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
          <li class="nav-item"><a class="nav-link" href="">会員登録&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
         
        </ul>
      </div>
    </nav>
   <?php endif;?>

    <!-- ヘッダー部分終了 -->

    <div class="container main-image">
      <img src="../img/top.jpg" alt="" class="w-75">
    </div>

    <!-- いかに投稿記事一覧を表示する -->
    <div class="container main">
    <h2 class="text-center main-text">List of articles</h2>

     <div class="main-article　card row pb-5">
       <img src="../img/sampl1.jpg" alt="" class="article-img">
       <div class="card-body">
         <a style="color:#444444;" href=""><h3>タイトル</h3></a><br>
         <!-- 見出し部分のみで文字数制限をphpで作成する -->
         <h5>今回は初めてのプログラミングについて解説していきたい</h5><br>
         <a style="color:black;" href="../detail/index.html?id=1"><span class="date">2020/4/26</span></a>
         <a style="color:black;" class="pl-3 delete" href=""><span class="delete">編集</span></a>
         <a style="color:black;" class="pl-3 delete" href=""><span class="delete">削除</span></a>
       </div>
     </div>

     <div class="main-article　card row pb-5">
      <img src="../img/sample3.jpg" alt="" class="article-img">
      <div class="card-body">
        <a style="color:#444444;" href=""><h3>この春オススメのタピオカ屋</h3></a><br>
        <!-- 見出し部分のみで文字数制限をphpで作成する -->
        <h5>今回は初めてのプログラミングについて解説していきたい</h5><br>
        <a style="color:black;" href=""><span class="date">2020/4/26</span></a>
        <a style="color:black;" class="pl-3 delete" href=""><span class="delete">編集</span></a>
        <a style="color:black;" class="pl-3 delete" href=""><span class="delete">削除</span></a>
      </div>
    </div>

    <div class="main-article　card row">
      <img src="../img/sampl2.jpg" alt="" class="article-img">
      <div class="card-body">
        <a style="color:#444444;"  class="title" href=""><h3>勉強がしやすいカフェ</h3></a><br>
        <!-- 見出し部分のみで文字数制限をphpで作成する -->
        <h5 class="text">今回は初めてのプログラミングについて解説していきたい</h5><br>
        <a style="color:black;" href=""><span class="date">2020/4/26</span></a>
        <a style="color:black;" class="pl-3 delete" href=""><span class="delete">編集</span></a>
        <a style="color:black;" class="pl-3 delete" href=""><span class="delete">削除</span></a>
        
      </div>
    </div>


    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>