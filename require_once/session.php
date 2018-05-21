<?php
/**
 * session.php
 * 
 * セッション
 * 
 * @copyright (c) 2018 Yuki Tsuji
 */

session_start();

header('Expires:-1');
header('Cache-Control:');
header('Pragma:');

//'詳細な検索条件'が押された時
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_criteria'])) {
    $_SESSION['search_criteria'] = 'search_criteria';
}
//'元に戻す'が押された時
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['back_search_criteria'])) {
    $_SESSION['search_criteria'] = "";
}
?>
