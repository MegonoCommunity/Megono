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

	//membuat method/fungsi get where
	public function getWhere($namaTabel, $where = array())
	{
		//memberi isi pada properti sql
		$this->sql = "SELECT * FROM " . $namaTabel;
		//melakukan array pengecekan 
		if(is_array($where))
		{
			//mengisi sintak sql setelah . dengan WHERE
			$this->sql .= " WHERE ";
			$i = 0;
			foreach ($where as $key => $value) {
				$i++;
				$this->sql .= $key . "='" . $value . "' ";
				if($i < count($where)) $this->sql .= " AND ";
			}
		}
		return $this->execute();
	}

	//membuat method/fungsi delete
	public function delete($namaTabel, $where = array())
	{	
		//memberi isi properti sql
		$this->sql = "DELETE FROM " . $namaTabel;
		//melakukan pengecekan array where
		if(is_array($where))
		{
			$this->sql .= " WHERE ";
			$i = 0;
			foreach ($where as $key => $value) {
				$i++;
				$this->sql .= $key . "='" . $value . "' ";
				if($i < count($where)) $this->sql .= " AND ";
			}
		}
		return $this->execute();
	}

	//membuat method/fungsi insert
	public function insert($namaTabel, $params = array())
	{
		//memberikan isi properti sql
		$this->sql = "INSERT INTO " . $namaTabel . " (";
		//meghibung jumlah parameter
		$total = count($params);
		$i = 0;

		foreach ($params as $key => $value) {
			$i++;
			$this->sql = $this->sql . $key;
			//melakukan pengecekan , param
			if($i < $total)
			{
				$this->sql = $this->sql . ',';
			}
		}
		//memberikan isiproperti sql
		$this->sql = $this->sql .") VALUES (";
		$i = 0;
		foreach ($params as $key => $value) {
			$i++;
			$this->sql = $this->sql . "'" . $value . "'";

			if($i < $total)
			{
				$this->sql = $this->sql . ',';
			}
		}
		$this->sql = $this->sql . ")";
		return $this->execute();
	}

	//membuat method/fungsi update
	public function update($namaTabel, $data = array(), $wher = array())
	{
		$this->sql = "UPDATE " . $namaTabel . " SET ";
		//menghitung jumlah data
		$total = count($data);
		$i = 0;

		foreach ($data as $key => $value) {
			$i++;
			$this->sql = $this->sql . $key . " = '" . $value . "'";

			//melakukan pengecekan data
			if($i < $total)
			{
				$this->sql = $this->sql . ',';
			}
		}
		if(is_array($where) && count($where) > 0)
		{
			$this->sql .= " WHERE ";
			$i = 0;

			foreach ($where as $key => $value) {
				$i++;
				$this->sql .= $key . "='" . $value . "' ";
				// melakukan pengecekan jumlah i terhadap  where
				if($i < count($where)) $this->sql .= " AND ";
			}
		}
		return $this->execute();
	}

	//membuat method/fungsi bindparam
	public function bindParams($values)
	{	
		//melakukan pengecekan
		if(is_array($values))
		{
			foreach ($values as $v) 
			{
				$this->replaceParam($v);
			}
		}
		else
		{
			$this->replaceParam($values);
		}
	}

	//membuat method/fungsi execute
	public function execute()
	{
		$query = mysqli_query($this->instance, $this->sql);
		return new ResultSet($query);
	}

	//membuat method/fungsi replaceparam
	public function replaceParam($v)
	{	
		//melakukan perulangan
		for($i = 0; $i < strlen($this->sql); $i++)
		{
			//pengecekan array index sql
			if($this->sql[$i] == '?')
			{
				$this->sql - substr_replace($this->sql, mysql_escape_string($v), $i, 1);
				break;
			}
		}
	}
}

 ?>