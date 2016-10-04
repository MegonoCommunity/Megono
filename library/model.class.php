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

	//membuat method/fungsi getjoin table
	public function getJoin($namaTabel, $params, $join = "JOIN", $where = "")
	{
		$sql = "SELECT * FROM " . $this->namaTabel;
		//melakukan pengecekan nama tabel yang join
		if(is_array($joinTabel))
		{
			foreach ($joinTabel as $tabel) 
			{
				$sql .= " " . $join . " " . $tabel . " ";
			}
		}
		else
		{
			$sql .= " " . $join . " " . $joinTabel . " ";
		}

		foreach ($params as $key => $value) 
		{
			$sql .= " ON " . $key . " = " . $value . " ";
		}

		// melakukan pengecekan where
		if($where && is_array($where))
		{
			$sql .= " WHERE ";
			$i = 0;

			foreach ($where as $key => $value) {
				$sql .= " " . $key . " = '" . $value . "' ";
				$i++;
				//melakukan pengecekan jumlah where
				if($i < count($where))
				{
					$sql .= " AND ";
				}
			}
		}
		$this->db->query($sql);

		return $this->db->execute()->toObject();
	}

	//membuat method/fungsi insert data
	public function insert($data = array())
	{
		//memanggil fungsi insert pada database
		$insert = $this->db->insert($this->namaTabel, $data);
		//jika melakukan insert
		if($insert)
		{
			return true;
		}
		return false;
	}

	//membuat method atau fungsi update
	public function update($data = array(), $where = array())
	{
		$update = $this->db->update($this->namaTabel, $data, $where);
		//jika melakukan update
		if($update)
		{
			return true;
		}
		return false;
	}

}

 ?>