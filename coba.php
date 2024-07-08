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
	$hasil = $lihat -> coba_print_sj();
	// $halaman = 3;
	// $mulai = ($i>1) ? ($i * $halaman) - $halaman : 0;
						
?>



<html>
<head>
<title>Surat Jalan</title>
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
<body style='font-family:tahoma; font-size:14pt;'>
<script>window.print();setTimeout(function(){ window.location = 'index.php?page=jual&sj-success=ok'; }, 3000);</script>
<center>
<table style='width:900px; font-size:10pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='90%' align='left' style='padding-right:80px; vertical-align:top'>
<img src="assets/img/logo.jpg" width="60px" alt="">
<span style='font-size:30pt; font-family:lobster;color:#FF0000;'><b>Nunut Mandiri</b></span></br>
Jl. Merpati Raya Blok A No.10, Sawah Lama, Kec. Ciputat, Kota Tangerang Selatan, Banten 15413 </br>
Telp : 0852‑1532‑7400 - 0813-1851-7363
</td>
<td style='vertical-align:top' width='30%' align='left'>
Page............................... (<?php echo $i ?> / <?php echo $p ?>)<br>
<b><span style='font-size:14pt'>SURAT JALAN</span></b></br>
No Trans. : <?php echo $cdnota ;?></br>
<?php  echo date("j F Y, G:i");?></br>
Kasir : <?php  echo htmlentities($_GET['nm_member']);?><br>
Customer : <?php echo $_GET['customer']; ?>
</td>
</table>
<table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border = '0'>
</table>
<table cellspacing='0' style='width:900px; font-size:11pt; font-family:calibri;  border-collapse: collapse;' border='1'>
 
<tr align='center'>
<td width='2%'>No</td>
<td width='10%'>Kode Barang</td>
<td width='40%'>Nama Barang</td>
<td width='4%'>Satuan Barang</td>
<td width='4%'>Qty</td>
<tr><?php $no=$c+1; foreach($hasil as $isi){?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $isi['id_barang'];?></td>
							<td>
							<?php $n = $no - 1; ?>
							<?php  echo $isi['nama_kategori']; ?>
								<?php  echo $isi['nama_barang']; ?>
								<?php  echo $isi['merk']; ?>
							</td>
							<td><?php echo $isi['satuan_barang'];?></td>
							<td><?php echo $isi['jumlah'];?></td>
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
									</tr>";
								} ?>
								<?php } ?>
</table>
<table cellspacing='0' style='width:900px; font-size:11pt; font-family:calibri;  border-collapse: collapse;' border='0'>
	
<tr>
<td align='left' width="360px">No Rek BCA : 6800 748354</td>
<td rowspan="3" style="font-size: 8px;font-style:oblique;font-weight:800;">
	<div style="border: 1px,solid;border-radius:8px;text-align:center;padding:6px;width:fit-content;">PERHATIAN! <br> BARANG YANG SUDAH DIBELI TIDAK BISA DITUKAR!</div>
</td>
</tr>
<tr>
<td align='left'>No Rek Mandiri : 1640 0040 92450</td>
</tr>
<tr>
<td align='left'>A.N David Tampubolon </td>
</tr>
</table>
<br>

<table style='width:550; font-size:7pt;' cellspacing='2'>

</table>

<table style='width:900; font-size:9pt;' cellspacing='2'>
<tr>
<td align='center'>Diterima Oleh,</br></br><u>(............)</u></td>
<td align='center'>Driver,</br></br><u>(............)</u></td>
<td align='center'>TTD,</br></br><u>(...........)</u></td>
</tr>
</table>
<br>
<br>
<br>
</center>
</body>
</html>
