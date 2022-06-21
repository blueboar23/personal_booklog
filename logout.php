<?php
session_start();
require_once(dirname(__FILE__) . '/inc/header.php');
?>

<?php if (!$logout = filter_input(INPUT_POST, 'logout')) : ?>
    <?php echo('不正なリクエストです' . '</br>' . 'ログインし直してください'); ?><br>
    <a href="<?php echo URL_ROOT ?>/login_form.php">ログイン</a>
    <?php exit;?>
<?php endif ?>

<?php
$login_user = $_SESSION['login_user'];

$result = UserLogic::checkLogin();
?>


<?php if (!$result) : ?>
    <?php echo('セッションが切れたので、ログインし直してください'); ?><br>
    <a href="<?php echo URL_ROOT ?>/login_form.php">ログイン</a>
    <?php exit; ?>
<?php endif ?>

<?php UserLogic::logout(); ?>
