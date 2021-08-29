<?php namespace App\Controllers\Frontend\Rekon;
use App\Controllers\FrontendController;
use App\Models\Rekon\RekonModel;

class Main extends FrontendController
{
	public $path_view 	= "frontend/rekon/";
	public $theme		= "pages/theme-frontend/render";

	public function __construct()
	{
		$this->RekonModel = new RekonModel();
	}

	public function index()
	{
		$param['page'] 	   = view($this->path_view.'page-index');
		return view($this->theme, $param);
	}

	public function cari()
	{
		$nip  = entitiestag($this->request->getPost('nip'));
		$nip = preg_replace('/\s+/', '', $nip);
		
		$api = get_api("https://sipgan.magelangkab.go.id/sipgan/api/restpns/id?nip=".$nip);
		if($api->status===false)
		{
			echo 0;
		}
		else
		{
			echo $api->data[0]->nama;
		}
	}

	public function ajukan()
	{
		$nip  = entitiestag($this->request->getPost('nip'));
		$nip = preg_replace('/\s+/', '', $nip);
		
		$api = get_api("https://sipgan.magelangkab.go.id/sipgan/api/restpns/id?nip=".$nip);
		if($api->status===false)
		{
			session()->setFlashdata('error', "Upps.. NIP yang Anda entri tidak ada didalam database SIMPEG Pemerintah Kabupaten Magelang. Silakan cek kolom entrian NIP-nya");
			return redirect()->back()->withInput();
		}
		else
		{
			//proses validasi
			if(!$this->validate([
				'nip' => [
					'rules'     => 'required|min_length[18]|numeric',
					'errors'    => [
						'required' 		=> 'Wajib diisikan',
						'min_length' 	=> 'Entrian minimal 18 karakter',
						'numeric' 		=> 'Entrian hanya berupa Angka saja',
					]
				],
				'cover' => [
					'rules'     => 'uploaded[cover]|max_size[cover,1024]|mime_in[cover,image/JPG,image/jpg,image/jpeg,image/JPEG,image/png,image/PNG]|ext_in[cover,png,jpg,jpeg]',
					'errors'    => [
						'uploaded' 		=> 'Foto bukti wajib diunggah. Ukuran foto tidak lebih dari 1 Mb. Tipe data yang diunggah harus bertipe data jpeg/jpg/png',
						'max_size' 		=> 'Ukuran foto tidak lebih dari 1 Mb',
						'mime_in' 		=> 'Tipe data yang diunggah harus bertipe data jpeg/jpg/png',
					]
				],
			]))
			{
				session()->setFlashdata('error', $this->validator->listErrors());
				return redirect()->back()->withInput();
			}
			else
			{
				session()->setFlashdata('success',"Terima kasih Sdr. ".$api->data[0]->nama.", telah melakukan rekonsiliasi pemutakhiran data mandiri");
				$data['cover'] 	= $this->request->getFile('cover')->store('gambar');
				$data['nip'] 	= $nip;
				$cover 			= $data['cover'];
				$this->RekonModel->insert($data);
				//
				$posting['nip'] 	= $nip;
				$posting['cover'] 	= $data['cover'];
				$url = "https://sipgan.magelangkab.go.id/sipgan/api/restpdm/post";
				$test = api_post($url, $posting);
				//
				$curl = curl_init();

				curl_setopt_array($curl, array(
				CURLOPT_URL => "https://sipgan.magelangkab.go.id/sipgan/api/restpdm/post",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"nip\"\r\n\r\n$nip\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"cover\"\r\n\r\n$cover\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
				CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
					"postman-token: 4e0e1d20-e592-6c43-bdb2-ea368e7cba4f"
				),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

				if ($err) {
					echo "cURL Error #:" . $err;
				} else {
					//echo $response;
				}
				//dd($test);
				return redirect()->to(base_url() . '/rekon');
			}	
		}
	}
}