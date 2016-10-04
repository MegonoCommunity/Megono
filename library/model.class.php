<?php 
class Model
{
	public $db;
	protected $namaTabel;

	//menjalankan koneksi saat object di buat
	public function __construct()
	{
		$this->db = new database();
	}

	//membuat method/fungsi model
	public function model($namaModel)
	{
		require_once ROOT . DS . 'modules' . DS . 'models' . DS . $namaModel . 'Model.php';
		$namaKelas = ucfirst($namaModel) . 'Model';
		$this->$namaModel = new $namaKelas();
	}

	//membuat mthod/fungsi get
	public function get($params = "")
	{
		//mengisi properti sql dengan sintak sql
		$sql = "SELECT * FROM " . $this->namaTabel;
		//melakukan pengecekan parameter
		if(is_array($params))
		{
			if(isset($params["limit"]))
			{
				$sql .= " LIMIT " . $params["limit"];
			}
		}
		//memberi nilai query dengan sintak sql 
		$this->db->query($sql);
		//mengembalikan nilai query dan meng eksekusinya kedalam feth_object
		return $this->db->execute()->toObject();
	}

	//membuat method/fungsi row
	public function rows()
	{	
		return $this->db->getAll($this->namaTabel)->numRows();
	}

	//membuat method/fungsi getwhere
	public function getWhere($params)
	{
		return $this->db->getWhere($this->namaTabel, $params)->toObject();
	}

	//membuat method/fungsi delete atau hapus
	public function delete($where = array())
	{
		return $this->db->delete($this->namaTabel, $where);
	}

	
	

}

 ?>