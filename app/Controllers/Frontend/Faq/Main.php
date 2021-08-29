<?php namespace App\Controllers\Frontend\Faq;
use App\Controllers\FrontendController;
use App\Models\Frontend\PertanyaanModel;

class Main extends FrontendController
{
	public $path_view 	= "frontend/faq/";
	public $theme		= "pages/theme-frontend/render";

	public function __construct()
	{
		$this->PertanyaanModel 	= new PertanyaanModel();
	}

	public function index()
	{
        $data['data']   = $this->PertanyaanModel->get();
		$param['page'] 	= view($this->path_view.'page-index',$data);
		return view($this->theme, $param);
	}

    public function ask()
    {
        if ($this->request->isAJAX())
        {
            $nama       = entitiestag($this->request->getPost('nama'));
            $email      = entitiestag($this->request->getPost('email'));
            $kontak     = entitiestag($this->request->getPost('kontak'));
            $kategori   = entitiestag($this->request->getPost('kategori'));
            $pertanyaan = entitiestag($this->request->getPost('pertanyaan'));

            //proses validasi
            if(!$this->validate([
                'nama' => [
                    'rules'     => 'required|min_length[10]',
                    'errors'    => [
                        'required' 		=> 'Wajib diisikan',
                        'min_length'    => 'Nama harus sesuai',
                    ]
                ],
                'email' => [
                    'rules'     => 'required|valid_email|min_length[10]',
                    'errors'    => [
                        'required' 		=> 'Wajib diisikan',
                        'valid_email'   => 'Email harus sesuai',
                        'min_length'    => 'Email harus sesuai',
                    ]
                ],
                'kontak' => [
                    'rules'     => 'required|min_length[10]',
                    'errors'    => [
                        'required' 		=> 'Wajib diisikan',
                        'min_length'    => 'Nomor Kontak harus sesuai',
                    ]
                ],
                'pertanyaan' => [
                    'rules'     => 'required',
                    'errors'    => [
                        'required' 		=> 'Wajib diisikan',
                    ]
                ],
            ]))
            {
                $validation = \Config\Services::validation();
                echo $validation;
            }
            else
            {
                $data['nama']        = $nama;
                $data['email']       = $email;
                $data['kontak']      = $kontak;
                $data['kategori_id'] = $kategori;
                $data['pertanyaan']  = $pertanyaan;
                $this->PertanyaanModel->insert($data);

                if($kategori=='email')
                {
                    $info    = array(
                        "nohp"  => '085727064162',
                        "pesan" => "Mohon dilakukan perbaikan email di SAPK \n\nNIP ".$nama."\nEmail aktif : \n".$email."\n\n\n*Terima kasih* :)",
                        "tipe"  => "text" 
                    );
                    //send WA
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL             => "https://apibot.magelangkab.go.id/Api/wa/send",
                        CURLOPT_RETURNTRANSFER  => true,
                        CURLOPT_ENCODING        => "",
                        CURLOPT_MAXREDIRS       => 10,
                        CURLOPT_TIMEOUT         => 30,
                        CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST   => "POST",
                        CURLOPT_POSTFIELDS      => json_encode($info),
                        CURLOPT_HTTPHEADER      => array(
                            "cache-control: no-cache",
                            "service: sipgan",
                            "token: 0ba9aab0887c801aacb89660e92cb17c"
                        ),
                    ));

                    $response   = curl_exec($curl);
                    $err        = curl_error($curl);
                    curl_close($curl);
                }
                echo "true";
            }
        }
        else
        {
            echo "Access Denied :P";
        }
    }
}