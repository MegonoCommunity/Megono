<?php 
class Controller
{
	//membuat method/fungsi protected view
	//memanggil sebuah View
	protected function view($namaView)
	{
		$view = new View($namaView);
		return $view;
	}

	//membuat method/fungsi protected model
	//memanggil sebuah Model
	protected function model($namaModel)
	{
		require_once ROOT . DS . 'modules' . DS . 'models' . DS . $namaModel . 'Model.php';
		$namaKelas = ucfirst($namaModel) . 'Model'; //ini cok salah nama kelas 
		$this->$namaModel = new $namaKelas();
	}

	//membuat method/fungsi protected template
	//memanggil sebuah view dengan template yang sudah di buat
	protected function template($namaView, $data = array())
	{
		$view = $this->view('template');
		$view->bind('namaView', $namaView);
		$view->bind('data', $data);
	}

	//membuat method/fungsi back atau kembali
	public function back()
	{
		echo '<script>history.go(-1);</script>';
	}

	//membuat method/fungsi redirect sebuah link url
	public function redirect($url = "")
	{
		header("location:" . $url);
	}

	//membuat method/fungsi falidasi data
	protected function validate($data)
	{
		return htmlentities(trim(strip_tags($data)));
	}

}

 ?>