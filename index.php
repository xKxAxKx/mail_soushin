<?php
require_once('config.php');
require_once('functions.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $name = $_POST['name'];
  $mail = $_POST['mail'];
  $title = $_POST['title'];
  $honbun = $_POST['honbun'];
  $errors = array();

  // バリデーション
  if ($name == '')
  {
    $errors['name'] = 'お名前が未入力です！';
  }

  if ($mail == '')
  {
    $errors['mail'] = 'メールアドレス';
  }

  if (!is_mail($mail)){
    $errors['mail'] = 'メールアドレスが正しくありません';
  }

  if ($title == '')
  {
    $errors['title'] = '件名が未入力です！';
  }

  if ($honbun == '')
  {
    $errors['honbun'] = '本文が未入力です！';
  }
  //バリデーション突破後
  if(empty($errors)){
    mb_language("japanese");
    mb_internal_encoding("EUC-JP");

    $to = "example@example.com";
    $subject = $title;
    $body = $honbun;
    $from = $mail;

    mb_send_mail($to,$subject,$body,"From:".$from);

    header('Location: thanks.php');
    exit;
  }
}

// var_dump($_POST);
// var_dump(is_mail($mail));
// var_dump(mb_send_mail($to,$subject,$body,"From:".$from));


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>index.php</title>
  </head>
  <body>
    <h1>お問い合わせページ</h1>
    <hr>
    <!-- form領域-->
    <form action="" method="post">
      <p>
      お名前:<input type="text" name="name">
        <?php if($errors['name']) :?>
          <?php echo h($errors['name']) ?>
        <?php endif ?>
      </p>
      <p>
      メールアドレス:<input type="text" name="mail">
        <?php if($errors['mail']) :?>
          <?php echo h($errors['mail']) ?>
        <?php endif ?>
      </p>
      <p>
      件名:<input type="text" name="title">
        <?php if($errors['title']) :?>
          <?php echo h($errors['title']) ?>
        <?php endif ?>
      </p>
      <p>お問い合わせ内容</p>
      <textarea name="honbun" cols="100" rows="10"></textarea>
        <?php if($errors['honbun']) :?>
          <?php echo h($errors['honbun']) ?>
        <?php endif ?>
      <br>
      <input type="submit" value="メールを送信する">
      <!-- form領域ここまで -->
    </form>
  </body>
</html>
