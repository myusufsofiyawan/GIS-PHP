<?php
$cari= $_REQUEST["cari"];
if($cari=="")
{
  $query9=mysql_query("SELECT distinct layanan.nama, layanan.alamat, layanan.kecamatan, layanan.daerah, master_layanan.nama, sub_layanan.jenis FROM layanan, master_layanan, sub_layanan where layanan.jenis_layanan=master_layanan.id and layanan.sub_layanan=sub_layanan.id ORDER BY sub_layanan.id ASC");
}
else
{
  $query9=mysql_query("SELECT distinct layanan.nama, layanan.alamat, layanan.kecamatan, layanan.daerah, master_layanan.nama, sub_layanan.jenis FROM layanan, master_layanan, sub_layanan where layanan.jenis_layanan=master_layanan.id and layanan.sub_layanan=sub_layanan.id and sub_layanan.jenis LIKE '%$cari%' ORDER BY sub_layanan.id ASC");
}
?>
<fieldset>
<form id="form1" name="form1" method="post" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td colspan="2" align="center" bgcolor="#0099FF">&nbsp;</td>
    <td colspan="5" align="right" bgcolor="#0099FF"><select name="cari"><option value="" selected="selected">-- Pilih Layanan Yang Dibutuhkan --</option>
    <?php $query100=mysql_query("SELECT * FROM sub_layanan");
		while($data100=mysql_fetch_array($query100)){
			$id = $data100[0];
			$nm = $data100[1];
	?>
    <option value="<?php echo $nm?>"><?php echo $nm;?> </option><?php } ?></select>      
    <input type="submit" name="Submit" value="Cari" /></td>
    </tr>
  <tr bgcolor="#FFFF00">
    <td width="1%" align="center">No</td>
    <td width="14%" align="center">Nama</td>
    <td width="12%" align="center">Alamat</td>
    <td width="18%" align="center">Kecamatan</td>
    <td width="13%" align="center">Daerah</td>
    <td width="22%" align="center">Jenis Layanan </td>
    <td width="20%" align="center">Sub Layanan </td>
  </tr>
  <?php 
  		while($data9=mysql_fetch_array($query9)){
		$no++;$nama1=$data9[0];$alamat=$data9[1];
		$kecamatanz=$data9[2];$daerah=$data9[3];$jenis_layanan=$data9[4];$sub_layanan=$data9[5];?>
  <tr>
    <td><?php echo $no;?></td>
    <td><?php echo $nama1;?></td>
    <td><?php echo $alamat;?></td>
    <td><?php echo $kecamatanz;?></td>
    <td><?php echo $daerah;?></td>
    <td><?php echo $jenis_layanan?></td>
    <td><?php echo $sub_layanan;?></td>
  </tr>
  <?php }?>
</table>
</form>
    