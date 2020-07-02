<?php
session_start();
require('../dbconnect.php');

//プロフィールのデータベースより値を取得する
$stmt = $dbh->prepare('SELECT * FROM profiles WHERE member_id=?');
$stmt->execute(array($_SESSION['id']));
$profile = $stmt->fetch();

//プロフィールの作成が行われていないときは初期値として新規登録の名前を入れる
$stmt = $dbh->prepare('SELECT * FROM members WHERE id=?');
$stmt -> execute(array($_SESSION['id']));
$member = $stmt->fetch();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/top.css?v=2">
    

    <title>プロフィール</title>
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


    <!--  以下の部分よりプロフィール画面の作成を行う(カードを利用する) -->
    


 <div class="container-fluid profile01" style="width:80%;">
     <div class="profile row">
      <img src="../img/img_8757.jpg" alt="" class="profileImg" style="width:50%; height:350px;">
        <div class="card-body w-50">
          <?php if($profile):?>
          <h3 class="card-title">名前:<?php echo $profile['name'];?></h3>
          <?php else:?>
          <h3 class="card-title">名前:<?php echo $member['name'];?></h3>
          <?php endif;?>

          <?php if($profile):?>
          <h4>自己紹介</h4>
          <p><?php echo $profile['profile_text'];?></p>
          <?php else:?>
          <h4>自己紹介</h4>
          <p>自己紹介が入ります</p>
          <?php endif;?>

          <button type="button" class="btn btn-outline-secondary" onclick="location.href='profileedit.php'">プロフィールを編集する</button>
        
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