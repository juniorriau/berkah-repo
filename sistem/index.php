<?php
session_start();
/* index.php ------------------------------------------------------
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

?><html>
<head>
<title>Halaman Login</title>
<link href="../config/login-style.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$("#cerceve").hide().fadeIn(500);
	$(".show").hide();
	$(".close").click(function(){
		$("#cerceve").hide(500);
		$(".show").fadeIn(500);
	});
	$(".show").click(function(){
		$("#cerceve").fadeIn(500);
		$(".show").hide(500);
	});
});
</script>

</head>
<body>
<?php
if(isset($_SESSION['namauser']) && isset($_SESSION['iduser'])
	&& isset($_SESSION['leveluser']) && isset($_SESSION['uname'])){
		include "upgrade_check.php";
}
else{ ?>
<div class="show"></div>
<div id="cerceve">
<div class="header"><div class="text" style="float:left">Login Form</div>
<div class="close" style="float:right;margin-right:20px;cursor:pointer;">x</div></div>
<div class="formbody">
<form method="POST" action="cek_login.php">
<input type="text" name="username" placeholder="Username" class="text" style="background:url(../image/username.png) no-repeat;" />
<input type="password" name="password" placeholder="............" class="text" style="background:url(../image/password.png) no-repeat;" />
<input type="submit" value="Sign In" class="submit" style="background:url(../image/login.png) no-repeat;" />
</form>
</div>
</div>	
<?php } ?>
</body>
</html><?php



/* CHANGELOG -----------------------------------------------------------

 1.0.2  : Gregorius Arief		: initial release

------------------------------------------------------------------------ */

?>
