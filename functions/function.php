<?php

/**
 * XSS対策：エスケープ処理
 *
 * @param string $str 対象の文字列
 * @return string $str 処理された文字列
 */
function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * テキスト入力欄の改行を反映
 *
 * @param string $str 対象の文字列
 * @return string $str 処理された文字列
 */
function lineBreak($string) {
    return nl2br($string);
}


/**
 * CSRF対策
 * @param void
 * @return string $csrf_token
 */
function setToken() {
    $csrf_token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrf_token;

    return $csrf_token;
}
?>
