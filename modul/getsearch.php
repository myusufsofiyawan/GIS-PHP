<?php include "koneksi.php"?>

<?php
$state_id=$_REQUEST['state_id'];
$query="select * from sub_layanan where id_masterlayanan='$state_id'";

?>
<select name="sub_layanan">
<option value="" selected="selected">-- Pilih Sub Layanan --</option>
<?php
while($row=mysql_fetch_array($query))
{
?>
<option value="<?php echo $row['id']; ?>"><?php echo $row['jenis']; ?></option>
<?php
}
?>
</select>
