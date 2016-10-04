<?php 
class database
{
	private $instance;
	private $sql;

	public function __construct()
	{
		//mlakukan require file resultset pada direktory library
		require_once ROOT . DS . 'library' . DS . 'resultet.class.php';
		$this->instance = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

		//melakukan pengecekan error pada koneksi mysqli
		if(mysqli_connect_errno())
		{
			echo "Tidak dapat koneksi ke MySQL : " . mysqli_connect_error(); 
		}
	}

	//membuat method/fungsi query terpisah
	public function query($sql)
	{
		//query berisi properti sql
		$this->query = $sql;
	}

	//membuat method/fungsi get table databese terpisah
	public function getALL($namaTabel)
	{
		//memberi isi pada properti sql
		$this->sql = "SELECT * FROM " . $namaTabel;
		return $this->execute();
	}
}

 ?>