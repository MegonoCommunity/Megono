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
	$namaFile = str_replace("\\", DS, $namaKelas) . '.php';
	if(!file_exists($namaFile))
	{
		return false;
	}
	include $namaFile;
}

//membuat sintak untuk sistem MVC
$page = (isset($_GET['page']) && $_GET['page']) ? $_GET['page'] : 'home';
//mendefinisikan sebuah controller terletak pada /root(namafilekita)/modules/controllers/controller.php
$controller = ROOT . DS . 'modules' . DS . 'controllers' . DS . $page . 'Controller.php';

//melakukan pengecekan file controller
//jika controller ada
if (file_exists($controller))
{
	//melakukan require controller
	require_once $controller;
	//aksi mendapatkan aksi dan aksi mendapatkan url sesuai yang di minta
	$aksi = (isset($_GET['aksi']) && $_GET['aksi']) ? $_GET['aksi'] : 'index';
	//mendefinisikan nama controller
	$namaKontroller = ucfirst($page) . 'Controller';
	//membuat instansiasi atau object
	$obj = new $namaKontroller();
	//melakukan pengecekan method objek
	if(method_exists($obj, $aksi))
	{
		//sett args menjadi array
		$args = array();
		if(count($_GET) > 2)
		{
			$bagian = array_slice($_GET, 2);

			foreach ($bagian as $bag) 
			{
				array_push($args, $bag);
			}
		}
		call_user_func_array(array($obj, $aksi), $args);
	}
	else die(' Aksi tidak di temukan !');
}
else die(' Controller tidak di temukan')

 ?>