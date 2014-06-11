<?php
$con=mysql_connect('localhost','root','') or die('Mysql not connected');
mysql_select_db('drasticdata',$con) or die('DataBase not connected');

$state_id=$_REQUEST['state_id'];

$query="select * from sub_layanan where id_masterlayanan='$state_id'";

?>
<select name="city">
<option value="" selected="selected">- Pilih Sub Layanan -</option>
<?php
$query_result=mysql_query($query)or mysql_error();
while($row=mysql_fetch_array($query_result))
{
?>
<option value="<?php echo $row['id']; ?>"><?php echo $row['jenis']; ?></option>
<?php
}
?>
</select>
