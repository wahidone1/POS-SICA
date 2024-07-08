<?php 
/*
  | Source Code Aplikasi Penjualan Barang Kasir dengan PHP & MYSQL
  | 
  | @package   : pos-kasir-php
  | @file	   : index.php 
  | @author    : fauzan1892 / Fauzan Falah
  | @copyright : Copyright (c) 2017-2021 Codekop.com (https://www.codekop.com)
  | @blog      : https://www.codekop.com/read/source-code-aplikasi-penjualan-barang-kasir-dengan-php-amp-mysql-gratis.html
  | 
  | 
  | 
  | 
 */

	@ob_start();
	session_start();

	if(!empty($_SESSION['admin'])){
		require 'config.php';
		include $view;
		$lihat = new view($config);
		$toko = $lihat -> toko();
		//  admin
		include 'admin/template/header.php';
		include 'admin/template/sidebar.php';
			if(!empty($_GET['page'])){
				include 'admin/kasir/'.$_GET['page'].'/index.php';
			}else{
				if ($_SESSION['admin'][7] == "master"){
					include 'admin/kasir/home/index.php';
				}else{
					include 'admin/kasir/jual/index.php';
				}
			}
		include 'admin/template/footer.php';
		
	}else{
		echo '<script>window.location="login.php";</script>';
		exit;
	}
?>

