<?php 
class ResultSet
{
	private $quer;

	//membuat method/fungsi query yang langsung di jalankan ketika object di panggil
	public function __construct($namaQuery)
	{
		$this->query = $namaQuery;
	}

	//membuat method/fungsi to Array =m mendapatkan data dalalm bentuk array
	public function toArray()
	{
		$data = array();

		if($this->query)
		{
			while($rekam = mysqli_fetch_assoc($this->query))
			{
				array_push($data, $rekam);
			}
		}
		return $data;
	}

	//membuat fungsi to Objek = mendapatkan data dalam bentuk objek
	public function toObject()
	{
		$data = array();

		if($this->query)
		{
			while($rekam = mysqli_fetch_object($this->query))
			{
				array_push($data, $rekam);
			}
		}
		return $data;
	}

	//membuat method fungsi num row = menghitung total data yang di dapatkan 
	public function numRows()
	{
		return mysqli_num_rows($this->query);
	}
}

 ?>