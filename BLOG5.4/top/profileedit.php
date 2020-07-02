<?php
session_start();
require('../dbconnect.php');

//編集ボタンが押された時の処理を行う
if(!empty($_POST)){
//プロフィールのデータベースより値の取得を行う
$stmt = $dbh->prepare('SELECT * FROM profiles WHERE member_id=?');
$stmt->execute(array($_SESSION['id']));
$member = $stmt->fetch();

if($member){
  //もしあった場合は編集を行う
  $stmt=$dbh->prepare('UPDATE profiles SET name=?, profile_text=?, picture=?, edit_date=NOW() WHERE member_id=?');
  $stmt->execute(array($_POST['name'], $_POST['profile_text'], $_POST['profile_img'], $_SESSION['id']));

  //同時にmembersテーブルの方の名前を変える
  $stmt=$dbh->prepare('UPDATE members SET name=? WHERE id=?');
  $stmt->execute(array($_POST['name'], $_SESSION['id']));


  header('Location:profile.php');
  exit();

}else{
      //データベースにmember_idがなかった場合にデータを格納する
  $stmt = $dbh->prepare('INSERT INTO profiles SET name=?, profile_text=?, picture=?, member_id=?, edit_date=NOW()');
  $stmt->execute(array($_POST['name'], $_POST['profile_text'], $_POST['profile_img'], $_SESSION['id']));

    //同時にmembersテーブルの方の名前を変える
    $stmt=$dbh->prepare('UPDATE members SET name=? modified=NOW() WHERE id=?');
    $stmt->execute(array($_POST['name'], $_SESSION['id']));

  header('Location:profile.php');
  exit();

  }
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

    <link rel="stylesheet" href="../css/profileedit.css?v=2">

    <title>プロフィール編集</title>
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
    
    <!-- いかにプロフィールの編集画面を設計する -->

    <div class="container-fluid profile01" style="width:80%;">
      <h2 class="text-center pb-3">プロフィール編集</h2>
     <form action="" method="post">
     <div class="card-body w-100">
          <h3 class="card-title">名前:<input type="text" name="name" class="name" value="<?php echo $name;?>"></h3>
          <h4>自己紹介</h4>
          <textarea name="profile_text" id="" class="text" maxlength="255"></textarea><br>
          <label>
            <input type="file" name="profile_img" class="">プロフィール画像の編集
          </label><br>
          <!-- 以下でもし画像が選択された場合に表示するコードをはる(php) -->
          <input type="submit" class="submit btn" value="編集">
        </div> 

     </form>
   </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>