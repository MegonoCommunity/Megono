<?php 
class View
{	
	//membuat property
	public $namaView = NULL;
	public $data = array();
	public $isRender = FALSE;
	//membuat method constructor yang di jalankan saat object di buat
	public function __construct($view)
	{
		$this->namaView = $view;
	}

	//membuat method/fungsi bind view / memberikan data ke view
	public function bind($nama, $value = '')
	{
		if(is_array($nama))
		{
			foreach ($nama as $attr => $val) 
			{
				$this->data[$attr] = $val;
			}
		}
		else $this->data[$nama] = $value;
	}

	//membuat method/fungsi forceRender / memaksa rendering
	public function forceRender()
	{
		$this->isRender = TRUE;
		extract($this->data);
		$view = ROOT . DS . 'modules' . DS . 'views' . DS . $this->namaView . '.view.php';
		//melakukan pengecekan file view
		if(file_exists($view)) require_once $view;
		else echo('View tidak di temukan !');
	}

	//membuat fungsi destruct menghacurkan dan mengeksekusi pada akhir data
	public function __destruct()
	{
		if(! $this->isRender) $this->forceRender();
	}

}

 ?>