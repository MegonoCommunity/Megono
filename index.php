<?php 
session_start();
//mendefinisikan konfigurasi kita
//mendefinisikan root folder kita
define('ROOT', dirname(__FILE__));
//mendefinisikan separation atau garis miring / atau \
define('DS', DIRECTORY_SEPARATOR);

//melakukan require file yang di butuhkan 
require_once "config.php";  
require_once "library/database.class.php";
require_once "library/model.class.php";
require_once "library/view.class.php";
require_once "library/controller.class.php";

//melakukan autoload file
function __autoload($namaKelas)
{
	//menseting nama kelas dengan menghapus tanda dan separator serta .php
	$namaKelas = str_replace("\\", DS, $namaKelass) . '.php';
	if(!file_exists($namaKelas))
	{
		return false;
	}
	include $namaKelas;
}

 ?>