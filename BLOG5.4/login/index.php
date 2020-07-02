<?php
session_start();
require('../dbconnect.php');

if($_COOKIE !==''){
  $email = $_COOKIE['email'];
}

//ログインボタンが押された時に処理を開始する
if(!empty($_POST)){
  //クッキーで保存されていた値の更新(ログインボタンが押された時のみ)
  $email = $_POST['email'];

  //フォームないがからでない場合の処理を実行
  if($_POST['email']!=='' && $_POST['password']!==''){
    $stmt = $dbh->prepare('SELECT * FROM members WHERE email=? AND password=?');
    $stmt->execute(array($_POST['email'], sha1($_POST['password'])));

    $member= $stmt->fetch(); 
    //ここで値が格納されていればログインが成功しているのでセッションを保存する
    //meberが格納されてる場合に以下の処理を行う
    if($member){
      $_SESSION['id'] = $member['id'];
      $_SESSION['name'] = $member['name'];
      //ログイン時間を保持する
      $_SESSION['time'] = time();

       //チェックボックスにチェックが入っていた時にいかにログイン情報を保持をする(クッキーを利用する)
       if($_POST['save']==='on'){
        //14日間値を保存する
        setcookie('email', $_POST['email'], time()+60*60*24*14);
      }


    

      header('Location: ../top/index.php');
      exit();
    }else{
      //以下はパスワードが違った場合の処理
      $error['email'] = 'mistake';
    }
  }else{
    //値が空欄だった場合の処理
    $error['email'] = 'blank';
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
    <link rel="stylesheet" href="../css/login.css?v=2">

    <title>ログイン</title>
  </head>
  <body>
 
    <div class="container-fluid entry">
      <div class="header-text">
        <h2 class="fonth2">Write</h2>
        <h4 class="fonth4">書くためのテーマ</h4>
      </div>

      <!-- 以下に会員登録の作成 -->
      
        <form action="" method="post">
          <div class="text-center">
          <input type="email" name="email" placeholder="メールアドレス" value=<?php echo $email?>><br>

          <?php if($error['email'] === 'mistake'):?>
          <p style="color:red;">※パスワードかメールアドレスが違います</p>
          <?php endif;?>

          <?php if($error['email'] === 'blank'):?>
          <p style="color:red;">*パスワードとメールアドレスを入力してください</p>
          <?php endif;?>

          <input type="password" name="password" placeholder="パスワード"><br>
          <input type="checkbox" class="checkbox" name="save" value="on">ログイン情報を保持する<br>
          <input type="submit" name="submit" value="ログイン" class="btn"><br>
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