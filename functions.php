<?php

//DB接続
function connectDatabase()
{
  try
  {
    return new PDO(DSN, USER, PASSWORD);
  }
  catch (PDOException $e)
  {
    echo $e->getMessage();
    exit;
  }
}

//エスケープ処理
function h($s)
{
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

// 正規表現（メール）
function is_mail($mail) {
if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)) {
        return TRUE;
    } else {
        return FALSE;
    }
}
