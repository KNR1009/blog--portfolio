<?php
//データベース接続を行う
require('../dbconnect.php');
session_start();


if(!empty($_POST)){
  //入力値のエラーチェックを行う

  //まずは名前が空欄だった場合の処理
  if(empty($_POST['name'])){
    $error['name'] = 'blank';
  }

  //メールアドレスのエラー処b 理
  if(empty($_POST['email'])){
    $error['email'] = 'blank';
  }

  //パスワードのエラー処理
  if(empty($_POST['password'])){
    $error['password'] = 'blank';
  }

  //パスワードの長さが4文字以下の場合
  if(mb_strlen($_POST['password'])<4){
    $error['password'] = 'notEnought';
  }




  if(empty($error)){
    //以下では重複登録を避けるコードを記載する
  //データベースにあるメールアドレスと一致するものがあればエラー処理を行う
  //まずはデータベースより値を取得する(emailが一致するもにのみ)
  
  $stmt = $dbh->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');
  $stmt->execute(array($_POST['email']));

  //返り値が個数として返ってくるのでそれを受け取る
  $record = $stmt->fetch();

  if($record['cnt']>0){

  $error['email']='double';

  }
  }
  //エラーの処理が全て完了した時にセッションの保存を行う

  if(empty($error)){
   //入力されたポストの値をセッションに保存する
   $_SESSION['join'] =$_POST;

   //確認フォームへ移動する
   header('Location: ../confirm');
   exit();
  }

}
    



//いかに書き直し画面から遷移してきた時に
//初期値がセッションで保存された値となるように設定する

if($_REQUEST['action']==='rewrite'){
  $_POST = $_SESSION['join'];
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
    <link rel="stylesheet" href="../css/entry.css">

    <title>会員登録ページ</title>
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

          <input type="text" name="name" placeholder="&nbsp;&nbsp;ユーザー名" maxlength="255" 
          value=<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES);?>><br>
          <?php if($error['name'] === 'blank'):?>
          <p style="color:red; font-size:18px;">※ユーザー名を入力してください</p>
          <?php endif;?>

          <input type="email" name="email" placeholder="&nbsp;&nbsp;メールアドレス" maxlength="255"
          value=<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES);?>><br>
          <?php if($error['email'] === 'blank'):?>
          <p style="color:red; font-size:18px;">※メールアドレスを入力してください</p>
          <?php endif;?>

          <?php if($error['email'] === 'double'):?>
          <p style="color:red; font-size:18px;">※登録済みのメールアドレスです</p>
          <?php endif;?>

          <input type="password" name="password" placeholder="&nbsp;&nbsp;パスワード&nbsp;&nbsp;(半角英数字)" maxlength="100" value=""><br>
          <?php if($error['password'] === 'blank'):?>
          <p style="color:red; font-size:18px;">※パスワードを入力してください</p>
          <?php endif;?>

          <?php if($error['password'] === 'notEnought'):?>
          <p style="color:red; font-size:18px;">※パスワードは4文字以上です</p>
          <?php endif;?>
          

          <input type="submit" name="submit" value="入力内容の確認" class="btn"><br>
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