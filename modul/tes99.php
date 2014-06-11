<?php include "koneksi.php";?>
<form name="form1" method="post" action="">
  <select name="select">
    <option>-- Pilih Pelayanan --</option>
  	<?php 
	$query("SELECT * FROM master_layanan");
	while($data=mysql_fetch_array($query)){
		$id_m=$data[0];
		$nama_m=$data[1];?>
	<option value="<?php echo $id_m ?>"><?php echo $nama_m ?></option>
  	<?php }?>
  </select>
</form>