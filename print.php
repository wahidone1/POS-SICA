<?php 
	@ob_start();
	session_start();
	if(!empty($_SESSION['admin'])){ }else{
		echo '<script>window.location="login.php";</script>';
        exit;
	}
	require 'config.php';
	include $view;
	$lihat = new view($config);
	$toko = $lihat -> toko();
	$hsl = $lihat -> penjualan();
	$cdnota = $lihat -> nota_id();
	$hasils = $lihat -> jumlah();
	// $halaman = 3;
	// $mulai = ($i>1) ? ($i * $halaman) - $halaman : 0;
	$id_member = htmlentities($_GET['nm_meber']);
?>

<html>
<head>
<title>Faktur Pembayaran</title>
  
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=Lobster&family=Poppins:ital,wght@0,100;0,400;0,700;1,300&display=swap" rel="stylesheet">
<style>
	#tabel
	{
	font-size:15px;
	border-collapse:collapse;
	}
	#tabel  td
	{
	padding-left:5px;
	border: 1px solid black;
	}
</style>
</head>
<body style='font-family:tahoma; font-size:14pt; height:50%'>
	 <!-- <script>window.print();setTimeout(function(){ window.location = 'fungsi/hapus/hapus.php?penjualan=jual'; }, 3000);</script> -->
<?php $p = ceil(count($hsl)/13); ?>
		<?php for ($i=1;$i<=$p;$i++){  
			$c = ($i>1) ? ($i * 13) - 13 : 0;
			$hasil = $lihat -> coba_print($c);
		?>
<center>
<table style='width:900px; font-size:10pt; font-family:calibri; border-collapse: collapse;' border = '0'>
     <td width='90%' align='left' style='padding-right:80px; vertical-align:top'>
<img src="assets/img/logo.jpg" width="60px" alt="">
<span style='font-size:30pt; font-family:lobster;color:#FF0000;'><b>Nunut Mandiri</b></span></br>
Jl. Merpati Raya Blok A No.10, Sawah Lama, Kec. Ciputat, Kota Tangerang Selatan, Banten 15413 </br>
Telp : 0812-8675-8525
</td>
<td style='vertical-align:top' width='30%' align='left'>
Page............................... (<?php echo $i ?> / <?php echo $p ?>)<br>
<b><span style='font-size:11pt'>FAKTUR PENJUALAN</span></b></br>
No Trans. : <?php echo $cdnota; ?></br>
<?php  echo date("j F Y, G:i");?></br>
Kasir : <?php  echo $id_member;?>
</td>
</table>
<table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
</table>
<table cellspacing='0' style='width:900px; font-size:11pt; font-family:calibri;  border-collapse: collapse;' border='1'>
 
<tr align='center'>
<td width='2%'>No</td>
<td width='10%'>Kode Barang</td>
<td width='20%'>Nama Barang</td>
<td width='13%'>Harga</td>
<td width='4%'>Qty</td>
<td width='13%'>Total Harga</td>
<tr><?php $no=$c+1; foreach($hasil as $isi){?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $isi['id_barang'];?></td>
							<td>
							<?php $n = $no - 1; ?>
								<?php  echo $hsl[$n]['merk']; ?>
								<?php  echo $hsl[$n]['nama_barang']; ?>
								<?php  echo $hsl[$n]['nama_kategori']; ?>
							</td>
							<td>Rp.<?php echo number_format($isi['total']/$isi['jumlah']);?></td>
							<td><?php echo $isi['jumlah'];?></td>
							<td style='text-align:right'>Rp.<?php echo number_format($isi['total']);?></td>
						</tr>
						<?php $no++; }?></tr>
						<?php if (count($hasil) < 13){
								$t = 13 - count($hasil);
								for ($q=1;$q<=$t;$q++){
									echo "<tr height='15px'>
									<td height='2%' width='2%'></td>
									<td height='2%' width='10%'></td>
									<td height='2%' width='20%'></td>
									<td height='2%' width='13%'></td>
									<td height='2%' width='4%'></td>
									<td height='2%' width='13%'></td>
									</tr>";
								} ?>
								<?php } ?>
</table>
<table cellspacing='0' style='width: 900px; font-size:11pt; font-family:calibri;  border-collapse: collapse;' border='0'>
							<?php if (count($hasil) < 13){ ?>
<tr>
<td align='left'>No Rek BCA : 6800 748354</td>
<td colspan = '5'><div style='text-align:right'>SUB TOTAL : </div></td>
<td style='text-align:right;border:1px solid grey;width:20.8%;'>Rp.<?php echo (number_format($hasils['bayar']));?></td>
</tr>
<tr>
<td align='left'>No Rek Mandiri : 1640 0040 92450</td>
<td colspan = '5'><div style='text-align:right'>Cash : </div></td>
<td style='text-align:right;border:1px solid grey;'>Rp.<?php echo (number_format($_GET['bayar']));?></td>
</tr>
<tr>
<td align='left'>A.N David Tampubolon </td>
<td colspan = '5'><div style='text-align:right'>Kembalian : </div></td>
<td style='text-align:right;border:1px solid grey;'>Rp.<?php echo (number_format($_GET['kembali']));?></td>
</tr>
<?php }else{ ?>
	<tr>
	<td align='left'>No Rek BCA : 6800 748354</td>
<td colspan = '5'><div style='text-align:right'>SUB TOTAL : </div></td>
<td style='text-align:right;border:1px solid grey;width:20.8%;'></td>
</tr>
<tr>
<td align='left'>No Rek Mandiri : 1640 0040 92450</td>
<td colspan = '5'><div style='text-align:right'>Cash : </div></td>
<td style='text-align:right;border:1px solid grey;'></td>
</tr>
<tr>
<td align='left'>A.N David Tampubolon </td>
<td colspan = '5'><div style='text-align:right'>Kembalian : </div></td><td style='text-align:right;border:1px solid grey;'></td>
</tr>
<?php } ?>
</table>
<br>

<table style='width:550; font-size:7pt;' cellspacing='2'>

</table>

<table style='width:900px; font-size:9pt;' cellspacing='2'>
<tr>
<td align='center'>Diterima Oleh,</br></br><u>(............)</u></td>
<td align='center'>Driver,</br></br><u>(............)</u></td>
<td align='center'>TTD,</br></br><u>(...........)</u></td>
</tr>
</table>
</center>
<?php } ?>
</body>
</html>
