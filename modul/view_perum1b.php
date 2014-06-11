<?php 
include "koneksi.php";
$id = $_GET["id"];
$query=mysql_query("SELECT * FROM tb_kecamatan where ID_Kecamatan = $id ");
while($data=mysql_fetch_array($query))
{
	$kecamatan= $data[1];
	$lat = $data[2];
	$long = $data[3];
}
?>
<html>
<head>
<title>Bandar Lampung Consumer Service Division - View Perumahan</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript">
//inisialisasi variabel tampung
var peta;
var pertama = 0;
var jenis = "home";
var namaperumx = new Array();
var alamatx = new Array();
var kecx = new Array();
var daerahx = new Array();
var jumlahx = new Array();
var sudahx = new Array();
var namastox = new Array();
var kodestox = new Array();
var alamatstox = new Array();
var namarkx = new Array();
var alamatrkx = new Array();
var idstorkx = new Array();
var namadpx = new Array();
var alamatdpx = new Array();
var kapasitasx = new Array();
var isix = new Array();
var rusakx = new Array();
var wsuccx = new Array();
var kosongx = new Array();
var idrkx = new Array();
var i;
var url;
var gambar_tanda;
//load peta google maps
function peta_awal(){
    var BL = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $long;?>);
    var petaoption = {
        zoom: 15,
        center: BL,
        mapTypeId: google.maps.MapTypeId.satelitte
        };
    peta = new google.maps.Map(document.getElementById("petaku"),petaoption);
    google.maps.event.addListener(peta,'click',function(event){
        //kasihtanda(event.latLng);
    });
    ambildatabase('awal');
	
}

$(document).ready(function(){
    $("#tombol_simpan").click(function(){
        var x = $("#x").val();
        var y = $("#y").val();
		var nama = $("#nama").val();
		var alamat = $("#alamat").val();
		var kec = $("#kec").val();
		var daerah = $("#daerah").val();
		var jumlah = $("#jumlah").val();
		var sudah = $("#sudah").val();
		
		
        $("#loading").show();
        $.ajax({
            url: "simpanperum.php",
            data: "x="+x+"&y="+y+"&nama="+nama+"&alamat="+alamat+"&kec="+kec+"&daerah="+daerah+"&jumlah="+jumlah+"&sudah="+sudah,
            cache: false,
            success: function(msg){
                alert(msg);
                $("#loading").hide();
                $("#x").val("");
                $("#y").val("");
                $("#nama").val("");
				$("#alamat").val("");
				$("#kec").val("");
                $("#daerah").val("");
                $("#jumlah").val("");
                $("#sudah").val("");
                ambildatabase('akhir');
            }
        });
    });
    $("#tutup").click(function(){
        $("#jendelainfo").fadeOut();
    });
	$("#tutup1").click(function(){
        $("#jendelainfo1").fadeOut();
    });
	$("#tutup2").click(function(){
        $("#jendelainfo2").fadeOut();
    });
	$("#tutup3").click(function(){
        $("#jendelainfo3").fadeOut();
    });
});

function set_icon(jenisnya){
    switch(jenisnya){
        case "home":
            gambar_tanda = 'icon/home.png';
            break;
        case "airport":
            gambar_tanda = 'icon/airport.png';
            break;
        case  "masjid":
            gambar_tanda = 'icon/mosque.png';
            break;
    }
}

function ambildatabase(akhir){
    if(akhir=="akhir"){
        url = "ambildataperum.php?akhir=1";
    }else{
        url = "ambildataperum.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namaperumx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kecx[i] = msg.wilayah.petak[i].kec;
                daerahx[i] = msg.wilayah.petak[i].daerah;
                jumlahx[i] = msg.wilayah.petak[i].jumlah;
                sudahx[i] = msg.wilayah.petak[i].sudah;

                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/home.png'
                });
                setinfo(tanda,i);

            }
        }
    });
}


function ambildatasto(akhir){
    if(akhir=="akhir"){
        url = "ambildatasto.php?akhir=1";
    }else{
        url = "ambildatasto.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namastox[i] = msg.wilayah.petak[i].nama;
                kodestox[i] = msg.wilayah.petak[i].kode;
				alamatstox[i] = msg.wilayah.petak[i].alamat;
				
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/telkom1.png'
                });
                setinfosto(tanda,i);
            }
        }
    });
}

function ambildatark(akhir){
    if(akhir=="akhir"){
        url = "ambildatark.php?akhir=1";
    }else{
        url = "ambildatark.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namarkx[i] = msg.wilayah.petak[i].nama;
				alamatrkx[i] = msg.wilayah.petak[i].alamat;
				idstorkx[i] = msg.wilayah.petak[i].idsto;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/rk.png'
                });
                setinfork(tanda,i);
            }
        }
    });
}

function ambildatadp(akhir){
    if(akhir=="akhir"){
        url = "ambildatadp.php?akhir=1";
    }else{
        url = "ambildatadp.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/gazstation.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata01(akhir){
    if(akhir=="akhir"){
        url = "ambildata01.php?akhir=1";
    }else{
        url = "ambildata01.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}
function ambildata03(akhir){
    if(akhir=="akhir"){
        url = "ambildata03.php?akhir=1";
    }else{
        url = "ambildata03.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/apotek.jpg'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata04(akhir){
    if(akhir=="akhir"){
        url = "ambildata04.php?akhir=1";
    }else{
        url = "ambildata04.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/rs.jpg'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata05(akhir){
    if(akhir=="akhir"){
        url = "ambildata05.php?akhir=1";
    }else{
        url = "ambildata05.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/klinik.jpg'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata06(akhir){
    if(akhir=="akhir"){
        url = "ambildata06.php?akhir=1";
    }else{
        url = "ambildata06.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/atm.jpg'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata07(akhir){
    if(akhir=="akhir"){
        url = "ambildata07.php?akhir=1";
    }else{
        url = "ambildata07.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/bank.jpg'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata08(akhir){
    if(akhir=="akhir"){
        url = "ambildata08.php?akhir=1";
    }else{
        url = "ambildata08.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/pemerintahan.jpg'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata09(akhir){
    if(akhir=="akhir"){
        url = "ambildata09.php?akhir=1";
    }else{
        url = "ambildata09.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata10(akhir){
    if(akhir=="akhir"){
        url = "ambildata10.php?akhir=1";
    }else{
        url = "ambildata10.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/ibadah.jpg'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata11(akhir){
    if(akhir=="akhir"){
        url = "ambildata11.php?akhir=1";
    }else{
        url = "ambildata11.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata12(akhir){
    if(akhir=="akhir"){
        url = "ambildata12.php?akhir=1";
    }else{
        url = "ambildata12.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/pemakaman.jpg'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata13(akhir){
    if(akhir=="akhir"){
        url = "ambildata13.php?akhir=1";
    }else{
        url = "ambildata13.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/polisi.jpg'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata14(akhir){
    if(akhir=="akhir"){
        url = "ambildata14.php?akhir=1";
    }else{
        url = "ambildata14.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/puskesmas.jpg'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata15(akhir){
    if(akhir=="akhir"){
        url = "ambildata15.php?akhir=1";
    }else{
        url = "ambildata15.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}


function ambildata16(akhir){
    if(akhir=="akhir"){
        url = "ambildata16.php?akhir=1";
    }else{
        url = "ambildata16.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata17(akhir){
    if(akhir=="akhir"){
        url = "ambildata17.php?akhir=1";
    }else{
        url = "ambildata17.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata18(akhir){
    if(akhir=="akhir"){
        url = "ambildata18.php?akhir=1";
    }else{
        url = "ambildata18.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata19(akhir){
    if(akhir=="akhir"){
        url = "ambildata19.php?akhir=1";
    }else{
        url = "ambildata19.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata20(akhir){
    if(akhir=="akhir"){
        url = "ambildata20.php?akhir=1";
    }else{
        url = "ambildata20.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata21(akhir){
    if(akhir=="akhir"){
        url = "ambildata21.php?akhir=1";
    }else{
        url = "ambildata21.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}


function ambildata22(akhir){
    if(akhir=="akhir"){
        url = "ambildata22.php?akhir=1";
    }else{
        url = "ambildata22.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata23(akhir){
    if(akhir=="akhir"){
        url = "ambildata23.php?akhir=1";
    }else{
        url = "ambildata23.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata24(akhir){
    if(akhir=="akhir"){
        url = "ambildata24.php?akhir=1";
    }else{
        url = "ambildata24.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata25(akhir){
    if(akhir=="akhir"){
        url = "ambildata25.php?akhir=1";
    }else{
        url = "ambildata25.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata26(akhir){
    if(akhir=="akhir"){
        url = "ambildata26.php?akhir=1";
    }else{
        url = "ambildata26.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}


function ambildata27(akhir){
    if(akhir=="akhir"){
        url = "ambildata27.php?akhir=1";
    }else{
        url = "ambildata27.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata28(akhir){
    if(akhir=="akhir"){
        url = "ambildata28.php?akhir=1";
    }else{
        url = "ambildata28.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata29(akhir){
    if(akhir=="akhir"){
        url = "ambildata29.php?akhir=1";
    }else{
        url = "ambildata29.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata30(akhir){
    if(akhir=="akhir"){
        url = "ambildata30.php?akhir=1";
    }else{
        url = "ambildata30.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata31(akhir){
    if(akhir=="akhir"){
        url = "ambildata31.php?akhir=1";
    }else{
        url = "ambildata31.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata32(akhir){
    if(akhir=="akhir"){
        url = "ambildata32.php?akhir=1";
    }else{
        url = "ambildata32.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata33(akhir){
    if(akhir=="akhir"){
        url = "ambildata33.php?akhir=1";
    }else{
        url = "ambildata33.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata34(akhir){
    if(akhir=="akhir"){
        url = "ambildata34.php?akhir=1";
    }else{
        url = "ambildata34.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata35(akhir){
    if(akhir=="akhir"){
        url = "ambildata35.php?akhir=1";
    }else{
        url = "ambildata35.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata36(akhir){
    if(akhir=="akhir"){
        url = "ambildata36.php?akhir=1";
    }else{
        url = "ambildata36.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function ambildata37(akhir){
    if(akhir=="akhir"){
        url = "ambildata37.php?akhir=1";
    }else{
        url = "ambildata37.php?akhir=0";
    }
    $.ajax({
        url: url,
        dataType: 'json',
        cache: false,
        success: function(msg){
            for(i=0;i<msg.wilayah.petak.length;i++){
                namadpx[i] = msg.wilayah.petak[i].nama;
				alamatx[i] = msg.wilayah.petak[i].alamat;
				kapasitasx[i] = msg.wilayah.petak[i].kapasitas;
				isix[i] = msg.wilayah.petak[i].isi;
				rusakx[i] = msg.wilayah.petak[i].rusak;
				wsuccx[i] = msg.wilayah.petak[i].wsucc;
				kosongx[i] = msg.wilayah.petak[i].kosong;
				idrkx[i] = msg.wilayah.petak[i].idrk;				
                
                set_icon(msg.wilayah.petak[i].jenis);
                var point = new google.maps.LatLng(
                    parseFloat(msg.wilayah.petak[i].x),
                    parseFloat(msg.wilayah.petak[i].y));
                tanda = new google.maps.Marker({
                    position: point,
                    map: peta,
                    icon: 'icon/dp.png'
                });
                setinfodp(tanda,i);
            }
        }
    });
}

function setjenis(jns){
    jenis = jns;
}

function setinfosto(petak, nomor){
    google.maps.event.addListener(petak, 'click', function() {
        $("#jendelainfo1").fadeIn();
        $("#teksnama").html(namastox[nomor]);
        $("#teksalamatsto").html(alamatstox[nomor]);
		$("#tekskode").html(kodestox[nomor]);
        });
}

function setinfork(petak, nomor){
    google.maps.event.addListener(petak, 'click', function() {
        $("#jendelainfo2").fadeIn();
        $("#teksnamark").html(namarkx[nomor]);
        $("#teksalamatrk").html(alamatrkx[nomor]);
		$("#teksidstork").html(idstorkx[nomor]);
        });
}

function setinfodp(petak, nomor){
    google.maps.event.addListener(petak, 'click', function() {
       $("#jendelainfo3").fadeIn();
        $("#teksnamadp").html(namadpx[nomor]);
        $("#teksalamatdp").html(alamatdpx[nomor]);
		$("#tekskapasitas").html(kapasitasx[nomor]);
		$("#teksisi").html(isix[nomor]);
		$("#teksrusak").html(rusakx[nomor]);
		$("#tekswsucc").html(wsuccx[nomor]);
		$("#tekskosong").html(kosongx[nomor]);
	    $("#teksidrk").html(idrkx[nomor]);
    });
}

function setinfo(petak, nomor){
    google.maps.event.addListener(petak, 'click', function() {
        $("#jendelainfo").fadeIn();
        $("#teksnama").html(namaperumx[nomor]);
        $("#teksalamat").html(alamatx[nomor]);
        $("#tekskec").html(kecx[nomor]);
		$("#teksdaerah").html(daerahx[nomor]);
		$("#teksjumlah").html(jumlahx[nomor]);
		$("#tekssudah").html(sudahx[nomor]);
	
    });
}
</script>
</head>
<body onLoad="peta_awal()">
<table id="jendelainfo" border=1 cellpadding="4" cellspacing="0" style="border-collapse: collapse" bordercolor="#FFCC00" width="300" height="136">
  <tr>
    <td><td width="248" bgcolor="#000000" height="19"><font color=white><span id="teksnama"></span></font></td>
    <td><td width="30" bgcolor="#000000" height="19">
    <p align="center"><font color="#FFFFFF"><a href="edit_perum.php" target="_blank" value="perum" onClick="set_icon(this.value)"><b><img src="edit16x16.png"></b></a></font></td>
    <td><td width="30" bgcolor="#000000" height="19">
    <p align="center"><font color="#FFFFFF"><a style="cursor:pointer" id="tutup"><b>X</b></a></font></td>
  </tr>
  <tr>
    <td><td width="300" bgcolor="#FFCC00" height="19" valign="top" colspan="2"><p align="center">Alamat : <span id="teksalamat"></span></td>
  </tr>
  <tr>
  	<td><td width="300" bgcolor="#FFCC00" height="19" valign="top" colspan="2"><p align="center">Kecamatan <span id="tekskec"></span></td>
  </tr>
  <tr>
    <td><td width="300" bgcolor="#FFCC00" height="19" valign="top" colspan="2"><p align="center">Jumlah Dibangun : <span id="teksjumlah"></span></td>
  </tr>
  <tr>
    <td><td width="300" bgcolor="#FFCC00" height="19" valign="top" colspan="2"><p align="center">Sudah Dibangun :<span id="tekssudah"></span></td>
  </tr>
</table>

<table id="jendelainfo1" border=1 cellpadding="4" cellspacing="0" style="border-collapse: collapse" bordercolor="#FFCC00" width="300" height="136">
  <tr>
    <td><td width="248" bgcolor="#000000" height="19"><font color=white><span id="teksnama"></span></font></td>
    <td><td width="30" bgcolor="#000000" height="19">
    <p align="center"><font color="#FFFFFF"><a href="edit_sto.html" target="_blank" value="sto" onClick="set_icon(this.value)"><b><img src="edit16x16.png"></b></a></font></td>
    <td><td width="30" bgcolor="#000000" height="19">
    <p align="center"><font color="#FFFFFF"><a style="cursor:pointer" id="tutup1"><b>X</b></a></font></td>
  </tr>
  <tr>
    <td><td width="300" bgcolor="#FFCC00" height="19" valign="top" colspan="2"><p align="center">Alamat : <span id="teksalamat"></span></td>
  </tr>
  <tr>
  	<td><td width="300" bgcolor="#FFCC00" height="19" valign="top" colspan="2"><p align="center">Kecamatan <span id="tekskec"></span></td>
  </tr>
  <tr>
    <td><td width="300" bgcolor="#FFCC00" height="19" valign="top" colspan="2"><p align="center">Jumlah Dibangun : <span id="teksjumlah"></span></td>
  </tr>
  <tr>
    <td><td width="300" bgcolor="#FFCC00" height="19" valign="top" colspan="2"><p align="center">Sudah Dibangun :<span id="tekssudah"></span></td>
  </tr>
</table>

<table id="jendelainfo2" border=1 cellpadding="4" cellspacing="0" style="border-collapse: collapse" bordercolor="#FFCC00" width="300" height="136">
  <tr>
    <td><td width="248" bgcolor="#000000" height="19"><font color=white><span id="teksnamark"></span></font></td>
    <td><td width="30" bgcolor="#000000" height="19">
    <p align="center"><font color="#FFFFFF"><a href="edit_rk.html" target="_blank" value="rk" onClick="set_icon(this.value)"><b><img src="edit16x16.png"></b></a></font></td>
    <td><td width="30" bgcolor="#000000" height="19">
    <p align="center"><font color="#FFFFFF"><a style="cursor:pointer" id="tutup2"><b>X</b></a></font></td>
  </tr>
  <tr>
    <td><td width="300" bgcolor="#FFCC00" height="19" valign="top" colspan="2"><p align="center">Alamate : <span id="teksalamatrk"></span></td>
  </tr>
  <tr>
    <td><td width="300" bgcolor="#FFCC00" height="19" valign="top" colspan="2"><p align="center">STO : <span id="teksidstork"></span></td>
  </tr>
</table>

<table id="jendelainfo3" border=1 cellpadding="4" cellspacing="0" style="border-collapse: collapse" bordercolor="#FFCC00" width="300" height="136">
  <tr>
    <td><td width="248" bgcolor="#000000" height="19"><font color=white><span id="teksnamadp"></span></font></td>
    <td><td width="30" bgcolor="#000000" height="19">
    <p align="center"><font color="#FFFFFF"><a href="edit_dp.html" target="_blank" value="dp" onClick="set_icon(this.value)"><b><img src="edit16x16.png"></b></a></font></td>
    <td><td width="30" bgcolor="#000000" height="19">
    <p align="center"><font color="#FFFFFF"><a style="cursor:pointer" id="tutup3"><b>X</b></a></font></td>
  </tr>
  <!--<tr>
    <td><td width="300" bgcolor="#FFCC00" height="19" valign="top" colspan="2"><p align="center">Alamat : <span id="teksalamatdp"></span></td>
  </tr>-->
  <tr>
  	<td><td width="300" bgcolor="#FFCC00" height="19" valign="top" colspan="2"><p align="center">Alamat : <span id="tekskapasitas"></span></td>
  </tr>
  <tr>
  	<td><td width="300" bgcolor="#FFCC00" height="19" valign="top" colspan="2"><p align="center">Daerah : <span id="teksisi"></span></td>
  </tr>
  <tr>
  	<!--<td><td width="300" bgcolor="#FFCC00" height="19" valign="top" colspan="2"><p align="center">Rusak : <span id="teksrusak"></span></td>
  </tr>
  <tr>
  	<td><td width="300" bgcolor="#FFCC00" height="19" valign="top" colspan="2"><p align="center">WSUCC : <span id="tekswsucc"></span></td>
  </tr>
  <tr>
  	<td><td width="300" bgcolor="#FFCC00" height="19" valign="top" colspan="2"><p align="center">Kosong : <span id="tekskosong"></span></td>
  </tr>
  <tr>
  	<td><td width="300" bgcolor="#FFCC00" height="19" valign="top" colspan="2"><p align="center">RK : <span id="teksidrk"></span></td>
  </tr>-->
</table>
<div id="main_content">
        
                <div class="clear">
          	      <blockquote>
          	        <p><br>
       	            </p>
       	          </blockquote>
          </div>
          
          
<style>
body {padding:0}
#scroll {
	position:relative;
	height:460px;
	overflow:hidden;
	border:1px solid #ddd;
	width:948px;
	padding:15px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
}


#tools {
	width:9999em;
	position:absolute;
	height:400px;
}

.tool {
	float:left;
	width:1000px;
	height:400px;
	background-repeat:no-repeat;
	background-position:0 -40px;
}

.details {
	background-color:#fff;
	color:#666;
	float:left;
	font-size:20px;
	margin:270px 0 0 0;
	padding:10px 60px;
	width:525px;
}

.demos {
	background-color:#fff;
	background-color:rgba(255, 255, 255, 0.8);
	border-left:1px solid #ddd;
	float:right;
	min-height:365px;
	padding:0 50px 0px 0px;
	width:272px;
}

.demos img {
	padding-left:-20px;
}
.demos h2 {
	color:#065598;
	font-size:22px;
	display:block;
	padding:10px 0;
}

.demos a {
	color:#666;
	font-size:12px;
	text-decoration:none;
}

.demos p {
	margin:0 0 4px;
	background:transparent url(demo-area_files/bullet.png) no-repeat scroll 0 2px;
	padding:2px 0 1px 22px;
}

#thumbs {
	background:url(demo-area_files/demo-navi.jpg) no-repeat;
	height:90px;
	position:absolute;
	top:410px;
	width:990px;
	left:-8px;
}

.t a {
	background:transparent url(demo-area_files/demo-navi.jpg) no-repeat scroll -21px -90px;
	margin-left:11px;
	display:block;
	width:99px;
	float:left;
	height:90px;
	cursor:pointer;
}

.t a.active {
	cursor:default !important;
}

.navi {
	margin-left:314px;
	_margin-left:304px;
}

/* CSS sprite for the navigation */
#t0 		  { margin-left:20px; _margin-left:10px;}
#t0.active { background-position:-21px 0 !important; }
#t0:hover  { background-position:-21px -180px; }
#t0:active { background-position:-21px -270px; }

#t1			{ background-position:-325px -90px; }
#t1:hover 	{ background-position:-325px -180px; }
#t1:active	{ background-position:-325px -270px; }
#t1.active	{ background-position:-325px 0 !important; }

#t2			{ background-position:-435px -90px; }
#t2:hover 	{ background-position:-435px -180px; }
#t2:active	{ background-position:-435px -270px; }
#t2.active	{ background-position:-435px 0 !important; }

#t3			{ background-position:-545px -90px; }
#t3:hover 	{ background-position:-545px -180px; }
#t3:active	{ background-position:-545px -270px; }
#t3.active	{ background-position:-545px 0 !important; }

#t4			{ background-position:-655px -90px; }
#t4:hover 	{ background-position:-655px -180px; }
#t4:active	{ background-position:-655px -270px; }
#t4.active	{ background-position:-655px 0 !important; }

#t5			{ background-position:-765px -90px; }
#t5:hover 	{ background-position:-765px -180px; }
#t5:active	{ background-position:-765px -270px; }
#t5.active	{ background-position:-765px 0 !important; }

#t6			{ background-position:-875px -90px; }
#t6:hover 	{ background-position:-875px -180px; }
#t6:active	{ background-position:-875px -270px; }
#t6.active	{ background-position:-875px 0 !important; }
</style>  
    
     <!------------------------ Masukkan disini untuk slidernya ------------------------------>
	 <div align="center">
   <div id="scroll">

	<!-- scrollable items -->
	<div id="tools">
	
           <div id="petaku" style="width:670; height:600px;" ></div>

		<!-- empty slot -->
		<div class="tool">
		  <blockquote>
		    <p>&nbsp;</p>
	      </blockquote>
		</div>

		<!-- tabs -->
		

		<!-- tooltip -->
		

		<!-- overlay -->
		
		<!-- expose -->
		

		<!-- scrollable -->
	

		<!-- flashembed -->
		<div class="tool" >

			<div class="details"></div>

			<div class="demos">

				<blockquote>
				  <h2>Demos</h2>
				  <p><a href="http://flowplayer.org/tools/demos/flashembed/index.html">Basics of Flash embedding</a></p>
				  <p><a href="http://flowplayer.org/tools/demos/flashembed/jquery.html">Flashembed and jQuery</a></p>
				  <p><a href="http://flowplayer.org/tools/demos/flashembed/onclick.html">Loading Flash on mouse click</a></p>
				  <p><a href="http://flowplayer.org/tools/demos/flashembed/wmode.html">Placing HTML on top of a Flash object</a></p>
				  <p><a href="http://flowplayer.org/tools/demos/flashembed/fail.html">Handling old Flash versions</a></p>
				  <p><a href="http://flowplayer.org/tools/demos/flashembed/flowplayer.html">Flashembed and Flowplayer</a></p>
			  </blockquote>

				
			</div>


		</div>

	</div>

	<!-- intro "page" -->
	<div id="intro" class="tool" style=" -moz-background-clip: border; -moz-background-origin: padding; -moz-background-inline-policy: continuous;">

		<div class="details" style="padding-left: 80px;">
			
		</div>

		<div class="demos" style="position: relative; z-index: 1;">

			<h2 align="center"><?php echo $kecamatan ?></h2>
         

    <p align="left" style="font-size:16px;" onClick="ambildata08('awal')"><img src="icon/pemerintahan.jpg" id="tombol_dp" value="dp" align="left" style="width:40px; height:30px; padding-right:5px;" /> Kantor Pemerintahan</p>
	<br/>
	<p align="left" style="font-size:16px;" onClick="ambildata13('awal')"><img src="icon/polisi.jpg" id="tombol_dp" value="dp" align="left" style="width:40px; height:30px; padding-right:5px;" /> Kantor Polisi</p>
	<br/>
	<p align="left" style="font-size:16px;" onClick="ambildata04('awal')"><img src="icon/rs.jpg" id="tombol_dp" value="dp" align="left" style="width:40px; height:30px; padding-right:5px;" /> Rumah Sakit</p>
	<br/>
	<p align="left" style="font-size:16px;" onClick="ambildata05('awal')"><img src="icon/klinik.jpg" id="tombol_dp" value="dp" align="left" style="width:40px; height:30px; padding-right:5px;" /> Klinik Kesehatan</p>
	<br/>
	<p align="left" style="font-size:16px;" onClick="ambildata03('awal')"><img src="icon/apotek.jpg" id="tombol_dp" value="dp" align="left" style="width:40px; height:30px; padding-right:5px;" /> Apotek</p>
	<br/>
	<p align="left" onClick="ambildata14('awal')" style="font-size:16px;"><img src="icon/puskesmas.jpg" id="tombol_dp" value="dp" align="left" style="width:40px; height:30px; padding-right:5px;" /> Puskesmas</p>
	<br/>
	<p align="left" style="font-size:16px;" onClick="ambildata12('awal')"><img src="icon/pemakaman.jpg" id="tombol_dp" value="dp" align="left" style="width:40px; height:30px; padding-right:5px;" /> Pemakaman</p>
	<br/>
	<p align="left" style="font-size:16px;" onClick="ambildata07('awal')"><img src="icon/bank.jpg" id="tombol_dp" value="dp" align="left" style="width:40px; height:30px; padding-right:5px;"/> Bank</p>
	<br/>
	<p align="left" style="font-size:16px;" onClick="ambildata06('awal')"><img src="icon/atm.jpg" id="tombol_dp" value="dp" align="left" style="width:40px; height:30px; padding-right:5px;"/> ATM</p>
	<br/>
	<p align="left" style="font-size:16px;" onClick="ambildata10('awal')"><img src="icon/ibadah.jpg" id="tombol_dp" value="dp" align="left" style="width:40px; height:30px; padding-right:5px;" /> Tempat Ibadah</p>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr><td width="78%" align="right"><form method="post" action="" > <input type="submit" value="Bersih"  style="background:#000000; color:#00FF00;"/> </form></td>
        <td width="7%"><p align="right" style="font-size:12px"><a href="view_perum1.php?id=<?php echo $id;?>"><em>back</em></a></p></td>
        <td width="15%"><p align="right" style="font-size:12px"><a href="view_perum1b1.php?id=<?php echo $id;?>"><em>next</em></a></p></td>
      </tr>
    </table>
	
	<script>
	symbol1.onPress = function()
{
   getURL("http://stackoverflow.com", "_blank");
}
	</script>
			</object>
		</div>

	</div>

	<blockquote>
	  <p>
	    <!-- required for IE6/IE7 -->
	    <br clear="all">
	    
	    <!-- thumbnails -->
	    </p>
	  </blockquote>
	<div id="thumbs" class="t">

		<!-- intro page navi button -->
		<a id="t0" class="active"></a>

		<!-- scrollable navigator root element -->
		<div class="navi">
			<a class="active" style="display: none;"></a>
			<a id="t1"></a>
			<a id="t2"></a>
			<a id="t3"></a>
			<a id="t4"></a>
			<a id="t5"></a>
			<a id="t6"></a>
		</div>

	</div>

</div>
</div>
<script>
// initialize scrollable and return the programming API
var api = $("#scroll").scrollable({
	items: '#tools',
	size: 1,
	clickable: false

// use the navigator plugin
}).navigator({api: true});


// this callback does the special handling of our "intro page"
api.onStart(function(e, i) {

	// when on the first item: hide the intro
	if (i) {
		$("#intro").fadeOut("slow");

	// otherwise show the intro
	} else {
		$("#intro").fadeIn(1000);
	}

	// toggle activity for the intro thumbnail
	$("#t0").toggleClass("active", i == 0);
});

// a dedicated click event for the intro thumbnail
$("#t0").click(function() {

	// seek to the beginning (the hidden first item)
	$("#scroll").scrollable().begin();

});

</script>
          
          <blockquote>
            <p>Silakan Klik Menu Navigasi Di Bawah Ini Untuk Mengakses Tampilan Peta  Berdasarkan Kategori </p>
            <p>
              <?php include "koneksi.php";?>
              
            </p>
          </blockquote>
         <table width="100%" height="30" border="0">
           <!-- <tr>
               <td width="284">
			   <select name="layanan" onChange="display(this.value)" >
                   <option value="0" selected="selected">- Pilih Layanan -</option>
                   <?php
						$query="select * from master_layanan";
						$query_result=mysql_query($query)or mysql_error();
						while($row=mysql_fetch_array($query_result))
						{
				   ?>
					<option value="<?php echo $row['id']; ?>"><?php echo $row['nama']; ?></option>
					<?php
						}
					?>
                 </select>               </td>
               <td width="248">
			   <div id="show_city">
				<select name="city">
				<option value="" selected="selected">- Pilih Sub Layanan -</option>
				</select>
				</div>               </td>
               <td width="252"><input type="submit" name="Submit" value="Lihat ">
		     <button id="tombol_dp" value="dp" onClick="ambildatadp('awal')">Tampilkan DP</button>            
			 </tr>
			 -->
          <!-- <tr>
			 <td width="10%" height="25%"><form method="post" action="" > <input type="submit" value="Refresh" style="color:#FFFF00;background-color:#990033"" /> </form></td>
             <td width="10%"> <button id="tombol_dp" value="dp" style="width:50px; height:40px;" onClick="ambildatadp('awal')">SPBU</button> </td>
             <td width="10%">  <button id="tombol_dp" value="dp" style="width:50px; height:40px;" onClick="ambildata01('awal')">HALTE</button> </td>
             <td width="10%"> <button id="tombol_dp" value="dp" style="width:50px; height:40px;" onClick="ambildata03('awal')">APOTEK</button> </td>
             <td width="10%"><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata04('awal')">Rm Sakit</button> </td>
             <td width="10%"><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata05('awal')">Klinik</button> </td>
             <td width="10%"><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata06('awal')">ATM</button> </td>
             <td width="10%"><button id="tombol_dp" value="dp"style="width:50px; height:40px;" onClick="ambildata07('awal')">Bank</button> </td>
             <td><button id="tombol_dp" value="dp"style="width:50px; height:40px;" onClick="ambildata08('awal')">K. Pemerintah</button> </td>
             <td width="10%"><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata09('awal')">K. Publik</button> </td>
           </tr>
		   <tr>
             <td><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata10('awal')">T. Ibadah</button> </td>
             <td><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata11('awal')">K. Kcmtan</button> </td>
             <td><button id="tombol_dp" value="dp"style="width:50px; height:40px;" onClick="ambildata12('awal')">Pemakaman</button> </td>
             <td><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata13('awal')">K. Polisi</button> </td>
             <td><button id="tombol_dp" value="dp"style="width:50px; height:40px;" onClick="ambildata14('awal')">Puskesmas</button> </td>
             <td><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata15('awal')">P. Tradisional</button> </td>
             <td><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata16('awal')">Minimarket</button> </td>
             <td><button id="tombol_dp" value="dp"style="width:50px; height:40px;" onClick="ambildata17('awal')">Supermarket</button> </td>
             <td><button id="tombol_dp" value="dp"style="width:50px; height:40px;" onClick="ambildata18('awal')">SD/MI</button> </td>
             <td><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata19('awal')">SMP/MTS</button> </td>
		   </tr>
		   <tr>
		     <td><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata20('awal')">SMA/SMK</button> </td>
		     <td><button id="tombol_dp" value="dp"style="width:50px; height:40px;" onClick="ambildata21('awal')">Bimbel</button> </td>
		     <td><button id="tombol_dp" value="dp"style="width:50px; height:40px;" onClick="ambildata22('awal')">Pondok Pesantren</button> </td>
		     <td><button id="tombol_dp" value="dp"style="width:50px; height:40px;" onClick="ambildata23('awal')">Panti Asuhan</button> </td>
		     <td><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata24('awal')">Toko Buku</button> </td>
		     <td><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata25('awal')">Budaya</button> </td>
		     <td><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata26('awal')">Hiburan</button> </td>
		     <td><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata27('awal')">Kuliner</button> </td>
		     <td><button id="tombol_dp" value="dp"style="width:50px; height:40px;" onClick="ambildata28('awal')">Belanja</button> </td>
	         <td><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata29('awal')">Hotel</button> </td>
		   </tr>
		   <tr>
		     <td><button id="tombol_dp" value="dp"style="width:50px; height:40px;" onClick="ambildata30('awal')">Perumahan</button> </td>
		     <td><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata31('awal')">Universitas</button> </td>
		     <td><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata32('awal')">K. Kelurahan</button> </td>
		     <td><button id="tombol_dp" value="dp"style="width:50px; height:40px;" onClick="ambildata33('awal')">K. Layanan Public</button> </td>
		     <td><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata34('awal')">Stasiun</button> </td>
		     <td><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata35('awal')">Surat Kabar</button> </td>
		     <td><button id="tombol_dp" value="dp" style="width:50px; height:40px;"onClick="ambildata36('awal')">K. PLN</button> </td>
		     <td><button id="tombol_dp" value="dp"style="width:50px; height:40px;" onClick="ambildata37('awal')">PKOR</button> </td>
		     <td>&nbsp;</td>
	         <td>&nbsp;</td>
		   </tr>-->
           </table>
    
  </div>



	
<blockquote>
  <p>
    </div>
    
  </p>
</blockquote>
</body>
</html>