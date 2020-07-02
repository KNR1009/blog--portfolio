<?php
  require('../dbconnect.php');
  session_start();

  //セッションが保存されていなかった場合に会員登録ページに遷移する
  if(!isset($_SESSION['join'])){
    header('Location: ../entry');
    exit();
  }

  //セッションが保存されていた場合はデータベースへ値を格納する
  // if(isset($_SESSION['join'])){
  // $stmt = $dbh->$prepare('INSERT INTO members SET name=?, email=?, password=?, created=NOW()');
  // $stmt->execute(array($SESSION['join']['name'], $SESSION['join']['email'], sha1($SESSION['join']['name'])));
  // }

  //登録ボタンが押された時にデータベースへ保存を行う
  if(!empty($_POST)){

    $stmt = $dbh->prepare('INSERT INTO members SET name=?, email=?, password=?, created=NOW()');
    $stmt->execute(array($_SESSION['join']['name'], $_SESSION['join']['email'], sha1($_SESSION['join']['password'])));
    header('Location:../confirm/tanks.php');
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

    <title>確認ページ</title>
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
          <form action="" method="post">
           <h3>ユーザー名</h3>
           <h5><?php echo $_SESSION['join']['name']?></h5>
           <h3>メールアドレス</h3>
           <h5><?php echo $_SESSION['join']['email']?></h5>
           <h3>パスワード</h3>
           <h5>【表示されません】</h5>
           <div><a href="../entry/index.php?action=rewrite" class="btn">書き直す</a></div>
           <input type="submit" name="submit" value="登録" class="btn">
           
         </form>
      </div>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>