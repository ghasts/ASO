<?php
//�����R�[�h�̐ݒ�
mb_language('Japanese');
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
?>


<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>�t�H�[�����e�m�F</title>
</head>
<body>
<h1>���͂������̊m�F</h1>
<p>���e���m�F���Ă��������B</p>
<?php
// ���͒l�̎擾
$uname = $_POST["uname"];
$email = $_POST["email"];
$sex = $_POST["sex"];
$tellno = $_POST["tellno"];
$pass = $_POST["pass1"];
$zip = $_POST["zip"];
$addr1 = $_POST["addr1"];
$addr2 = $_POST["addr2"];
$addr3 = $_POST["addr3"];

?>
<form method="POST" action="submit.php">
  <table border="1">
    <tr>
      <td>�����O</td>
<!-- ���͓��e�̊m�F�\�� -->
      <td><?php echo $uname; ?></td>
    </tr>

	<tr>
		<td>����</td>
		<td><?php echo $sex; ?></td>
	</tr>

    <tr>
      <td>���[���A�h���X</td>
      <td><?php echo $email; ?></td>
    </tr>
    <tr>
      <td>�X�֔ԍ�</td>
      <td><?php echo $zip; ?></td>
    </tr>
	<tr>
	  <td>�s���{�� �s��Q</td>
	  <td><?php echo $addr1; ?></td>
	</tr>
	<tr>
	  <td>�����Ԓn�i�������j</td>
	  <td><?php echo $addr2; ?> <?php echo $addr3; ?></td>
	</tr>
	<tr>
	  <td>���d�b�ԍ�</td>
	  <td><?php echo $tellno; ?></td>
	</tr>
    <tr>
      <td colspan="2">
        <input type="submit" name="sub1" value="���M����">
      </td>
    </tr>
  </table>
<!-- hidden�t�B�[���h -->
<input type="hidden" name="uname" value="<?php echo $uname; ?>">
<input type="hidden" name="email" value="<?php echo $sex; ?>">
<input type="hidden" name="uname" value="<?php echo $email; ?>">
<input type="hidden" name="uname" value="<?php echo $pass1; ?>">
<input type="hidden" name="uname" value="<?php echo $zip; ?>">
<input type="hidden" name="uname" value="<?php echo $addr1; ?>">
<input type="hidden" name="uname" value="<?php echo $addr2; ?>">
<input type="hidden" name="uname" value="<?php echo $addr3; ?>">
<input type="hidden" name="uname" value="<?php echo $tellno; ?>">

</form>
</body>
</html>