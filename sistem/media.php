<?php
/* media.php ------------------------------------------------------
   	version: 1.0.2

	Part of AhadPOS : http://AhadPOS.com
	License: GPL v2
			http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
			http://vlsm.org/etc/gpl-unofficial.id.html

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License v2 (links provided above) for more details.
----------------------------------------------------------------*/

session_start();
include "../config/config.php";
if (empty($_SESSION[namauser]) AND empty($_SESSION[passuser])){
  echo "<link href='../config/adminstyle.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Berkah Swalayan</title>
<link href="../config/adminstyle.css" rel="stylesheet" type="text/css" />
<link href="../config/metro-bootstrap.css" rel="stylesheet" type="text/css" />
<link href="../config/style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="../js/jquery-1.8.0.js"></script>
  <script type="text/javascript" src="../js/bootstrap-tooltip.js"></script>
  <script type="text/javascript" src="../js/bootstrap-alert.js"></script>
  <script type="text/javascript" src="../js/bootstrap-button.js"></script>
  <script type="text/javascript" src="../js/bootstrap-carousel.js"></script>
  <script type="text/javascript" src="../js/bootstrap-collapse.js"></script>
  <script type="text/javascript" src="../js/bootstrap-dropdown.js"></script>
  <script type="text/javascript" src="../js/bootstrap-modal.js"></script>
  <script type="text/javascript" src="../js/bootstrap-popover.js"></script>
  <script type="text/javascript" src="../js/bootstrap-scrollspy.js"></script>
  <script type="text/javascript" src="../js/bootstrap-tab.js"></script>
  <script type="text/javascript" src="../js/bootstrap-transition.js"></script>
  <script type="text/javascript" src="../js/bootstrap-typeahead.js"></script>
  <script type="text/javascript" src="../js/jquery.validate.js"></script>
  <script type="text/javascript" src="../js/jquery.validate.unobtrusive.js"></script>
  <script type="text/javascript" src="../js/jquery.unobtrusive-ajax.js"></script>
  <script type="text/javascript" src="../js/metro-bootstrap/metro-docs.js"></script>
	<script type="text/javascript" src="../js/interface.js"></script>
	<script type="text/javascript" src="../js/jquery.form.js"></script>
    <script type="text/javascript">
	function popupform(myform, windowname)
	{
		if (! window.focus)return true;
		window.open('', windowname, 'type=fullWindow,fullscreen,scrollbars=yes');
		myform.target=windowname;
		return true;
	}

	</script>
</head>

<body>
<div class="header">
    <div class="container">
      <div class="subnav span8">
          <ul class="nav nav-pills">
            <li><a class="brand" href="index.php">Berkah Swalayan</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Master <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="media.php?module=satuan_barang">Satuan</a></li>                
                <li><a href="media.php?module=kategori_barang">Kategori</a></li>
                <li><a href="media.php?module=barang">Barang</a></li>
                <li><a href="media.php?module=rak">Rak Barang</a></li>                
                <li><a href="media.php?module=supplier">Supplier</a></li>
                <li><a href="media.php?module=customer">Pelanggan</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Transaksi <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="media.php?module=pembelian_barang">Pembelian</a></li>
                  <li><a href="modul/js_jual_barang.php?act=caricustomer" target="_new" >Penjualan</a></li>
                  <li><a href="media.php?module=hutang">Hutang</a></li>
                  <li><a href="media.php?module=piutang">Piutang</a></li>                  
                  <li><a href="media.php?module=kasir">Kasir</a></li>
                </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Laporan <b class="caret"></b></a>
              <ul class="dropdown-menu">
                
                <li><a href="media.php?module=laporan&act=penjualan1">Laporan Penjualan</a></li>
                <li><a href="media.php?module=laporan&act=pembelian1">Laporan Pembelian</a></li>
                <li><a href="media.php?module=laporan&act=total1">Total Stock</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Utilities <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="media.php?module=ganti-password">Ganti Password</a></li>
                <li><a href="media.php?module=user">Manajemen User</a></li>
                <li><a href="media.php?module=modul">Manajemen Modul</a></li>
            </li>
          </ul>
      </div>   
      <div class="span3 kanan panel-user">
        Selamat Datang Admin | <a href="logout.php">Logout</a>
      </div>

    </div>
  </div>  
 <div class="container abu2">
    <div class="row">
      <div class="span3 sidebar">
        <ul class="nav nav-pills nav-stacked">
          <li><a href=?module=home>&#187; Home</a></li>
          <?php include "menu.php"; ?>
          <li><a href=logout.php>&#187; Logout</a></li>
        </ul>       
      </div>
      <div class="span9 content-kanan">
        <ul class="breadcrumb">
          <li><a href="#">Home</a> <span class="divider">/</span></li>
          <li><a href="#">Library</a> <span class="divider">/</span></li>
          <li class="active">Data</li>
        </ul>
        <div class="padding40">
    <?php include "content.php"; ?>

        <div>
   
          </div>   
          
        </div>
      </div>
    </div>
  </div>  
 <div class="footer">
    <div class="row">
      <div class="span12">Copyright &copy; 2013 Berkah Swalayan Pekanbaru</div>
    </div>
  </div>
</body>
</html>

<?php
}



/* CHANGELOG -----------------------------------------------------------

 1.0.2  : Gregorius Arief		: initial release

------------------------------------------------------------------------ */


?>
