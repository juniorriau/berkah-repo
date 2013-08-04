<?php
/* mod_supplier.php ------------------------------------------------------
   	version: 1.01

	Part of AhadPOS : http://ahadpos.com
	License: GPL v2
			http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
			http://vlsm.org/etc/gpl-unofficial.id.html

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License v2 (links provided above) for more details.
----------------------------------------------------------------*/

include "../config/config.php";
check_user_access(basename($_SERVER['SCRIPT_NAME']));


switch($_GET[act]){
  // Tampil supplier -> menampilkan semua daftar supplier tanpa paging
  default:
    echo "<h2>Data Supplier</h2>
          <form method=POST action='?module=supplier&act=tambahsupplier'>
          <input type=submit value='Tambah Supplier'></form>
          <br/>";
	  // jumlah data yang akan ditampilkan per halaman
			$dataPerPage = 20;
			// apabila $_GET['page'] sudah didefinisikan, gunakan nomor halaman tersebut, 
			// sedangkan apabila belum, nomor halamannya 1.
			if(isset($_GET['page']))
			{
				$noPage = $_GET['page'];
			} 
			else $noPage = 1;
			// perhitungan offset
			$offset = ($noPage - 1) * $dataPerPage;
			// mencari jumlah semua data dalam tabel 
			$sql='SELECT COUNT(*) as jumData FROM supplier';
			$result  = mysql_query($sql);
			$data     = mysql_fetch_assoc($result);
			$jumData = $data['jumData'];
			if(!isset($_GET['act']) && !isset($_GET['id'])){
				$sql="select idSupplier, namaSupplier, alamatSupplier, telpSupplier from supplier LIMIT ".$offset.", ".$dataPerPage."";
				$tampil=mysql_query($sql);
				$cek=mysql_num_rows($tampil);
				$no=1;
				?>
				<table class=tableku>
          		<tr><th>no</th><th>Nama Supplier</th><th>Alamat Supplier</th>
                <th>No.Telp Supplier</th><th>aksi</th></tr>
				<?php
				if($cek==0)
				{
					echo "<tr><td colspan=6 class='data'>No data found in database</td></tr>";
				}
				else
				{
					while ($r=mysql_fetch_array($tampil)){
						//untuk mewarnai tabel menjadi selang-seling
						if(($no % 2) == 0){
							$warna = "#EAF0F7";
						}
						else{
							$warna = "#FFFFFF";
						}
						echo "<tr bgcolor=$warna>";//end warna
					   	 echo "<td align=right class=td>$no</td>
							 <td class=td>$r[namaSupplier]</td>
							 <td align=center class=td>$r[alamatSupplier]</td>
							 <td align=center class=td>$r[telpSupplier]</td>
							 <td class=td width=70><a href=?module=supplier&act=editsupplier&id=$r[idSupplier]>Edit</a> |
								   <a href=./aksi.php?module=supplier&act=hapus&id=$r[idSupplier]>Hapus</a>
							 </td></tr>";
					  $no++;
					}
				}
				// menentukan jumlah halaman yang muncul berdasarkan jumlah semua data
				$jumPage = ceil($jumData/$dataPerPage);
				echo "<div id='paging'>";
				// menampilkan link previous
				echo "Pages (".$jumPage.") : ";
				if ($noPage > 1) echo  "<a class='page' href='?module=supplier&page=".($noPage-1)."'>&lt;Prev</a>";
				// memunculkan nomor halaman dan linknya
				$showPage=0;
				for($page = 1; $page <= $jumPage; $page++)
				{
					if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage)) 
					{   
						if (($showPage == 1) && ($page != 2))
							echo "..."; 
						if (($showPage != ($jumPage - 1)) && ($page == $jumPage))
							echo "...";
						if ($page == $noPage)
							echo " <b>".$page."</b> ";
						else 
							echo " <a class='page' href='?module=supplier&page=".$page."'>".$page."</a> ";
						$showPage = $page;          
					}
				}
				// menampilkan link next
				if ($noPage < $jumPage) echo "<a class='page' href='?module=supplier&page=".($noPage+1)."'>Next&gt;</a>";
				echo "</div>
				</table>
				<p>&nbsp;</p>
                <a href=javascript:history.go(-1)><< Kembali</a>";
			}
    break;

  case "tambahsupplier":
    echo "<h2>Tambah Supplier</h2>
          <form method=POST action='./aksi.php?module=supplier&act=input' name='tambahsupplier'>
          <table>          
          <tr><td>Nama Supplier</td><td> : <input type=text name='namaSupplier' size=40></td></tr>
          <tr><td>Alamat Supplier</td><td> : <textarea name='alamatSupplier' rows='2' cols='35'></textarea></td></tr>
          <tr><td>Telp Supplier</td><td> : <input type=text name='telpSupplier' size=15></td></tr>
          <tr><td>Keterangan</td><td> : <textarea name='Keterangan' rows='4' cols='35'></textarea></td></tr>
          <tr><td colspan=2>&nbsp;</td></tr>
          <tr><td colspan=2 align='right'><input type=submit value=Simpan>&nbsp;&nbsp;&nbsp;
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;

  case "editsupplier":
    $edit=mysql_query("SELECT * FROM supplier WHERE idSupplier='$_GET[id]'");
    $data=mysql_fetch_array($edit);

    echo "<h2>Edit Supplier</h2>
          <form method=POST action=./aksi.php?module=supplier&act=update name='editsupplier'>
          <input type=hidden name='idSupplier' value='$data[idSupplier]'>
          <table>
          <tr><td>Nama Supplier</td><td> : <input type=text name='namaSupplier' size=40 value='$data[namaSupplier]'></td></tr>
          <tr><td>Alamat Supplier</td><td> : <textarea name='alamatSupplier' rows='2' cols='35'>$data[alamatSupplier]</textarea></td></tr>
          <tr><td>Telp Supplier</td><td> : <input type=text name='telpSupplier' size=15 value='$data[telpSupplier]'></td></tr>
          <tr><td>Keterangan</td><td> : <textarea name='Keterangan' rows='4' cols='35'>$data[Keterangan]</textarea></td></tr>
          <tr><td colspan=2>&nbsp;</td></tr>
          <tr><td colspan=2 align='right'><input type=submit value=Simpan>&nbsp;&nbsp;&nbsp;
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}


/* CHANGELOG -----------------------------------------------------------

 1.0.1 / 2010-06-03 : Harry Sufehmi		: various enhancements, bugfixes
 0.6.5		    : Gregorius Arief		: initial release

------------------------------------------------------------------------ */

?>
