

  <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="18%">
	  <form action="view_perum1.php?id=<?php echo $id;?>&abc=<?php echo $id_m;?>" method="post">
	  <select name="master_layanan" onChange="this.form.submit()">
        <option value="" selected="selected">--Pilih Layanan--</option>
        <?php //include "koneksi.php";
  		$query=mysql_query("SELECT * FROM master_layanan");
		while($data=mysql_fetch_array($query)){
			$id_m=$data[0];
			$nama_m=$data[1];?>
        <option value="<?php echo $id_m?>"><?php echo $nama_m?></option>
        <?php }?>
      </select>
	  </form> </td>
      <td width="82%">
	<div id="show_city">
	<select name="sub_layanan">
	<option value="" selected="selected">-- Pilih Sub Layanan --</option>
	</select>
	</div>
      </td>
    </tr>
  </table>

