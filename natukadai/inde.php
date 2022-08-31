<?php
define('FILENAME', './message.txt');

$current_date = null;
$data = null;
$file_handle = null;
$split_data = null;
$message = array();
$message_array = array();

if( !empty($_POST['btn_submit'])) {
    
    if( $file_handle = fopen( FILENAME, "a")){
        $date = "'".$_POST['view_name']."'「".$_POST['message']."」\n";
        fwrite( $file_handle, $date);
        fclose( $file_handle);
    }
    
}

if( $file_handle = fopen( FILENAME,'r')) {
    while( $data = fgets($file_handle)) {
        $split_data = preg_split( '/\'/', $data);

        $message = array(
            'view_name' => $split_data[1],
            'message' => $split_data[2],
        );
        array_unshift($message_array, $message);
    }
    fclose( $file_handle);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ひと言掲示板</title>
<style>

</style>
</head>
<body>
<h1>ひと言掲示板</h1>
<!-- ここにメッセージの入力フォームを設置 -->
<hr>
<section>
<!-- ここに投稿されたメッセージを表示 -->
</section>
<?php if( !empty($message_array) ): ?>
<?php foreach( $message_array as $value ): ?>
<article>
    <div class="info">
        <p><?php echo $value['view_name']; ?></p>
    </div>
    <p><?php echo $value['message']; ?></p>
</article>
<?php endforeach; ?>
<?php endif; ?>
<li><a href="logout.php" class="btn btn-danger ml-3">サインアウト</a></li>
</body>
</html>
<form method="post">
	<div>
		<label for="view_name">なまえ</label>
		<input id="view_name" type="text" name="view_name" value="">
	</div>
	<div>
		<label for="message">ひと言メッセージ</label>
		<textarea id="message" name="message"></textarea>
	</div>
	<input type="submit" name="btn_submit" value="書き込む">
</form>