<?php 
$page = (isset($_GET['page']) && $_GET['page']) ? $_GET['page'] : '';

//melakukan konfigurasi path atau lokasii untuk website kita
define('PATH', ''); //isi path website kita atau (/)
define('SITE_URL', PATH . 'index.php'); // path mengarah ke index
define('POSITION_URL', PATH . '?page=' . $page); // jika di jabarkan namafolderweb/index.php?page=namapage


//melakukkan konfigurasi untuk database 
define('DB_HOST', ''); //nama host yang di gunakan
define('DB_USERNAME', ''); //nama username yang digunakan
define('DB_PASSWORD', ''); //nama password yang diguanakan
define('DB_NAME', ''); //nama database yang digunakan


 ?>