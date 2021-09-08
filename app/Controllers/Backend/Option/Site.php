<?php namespace App\Controllers\Backend\Option;
use App\Controllers\BackendController;
use App\Models\Option\AppModel;

class Site extends BackendController
{
	public $path_view   = "backend/option/pages/";
	public $theme       = "pages/theme-backend/render";
	
	public function __construct()
	{	
		$this->AppModel = new AppModel();
	}

	public function index()
	{
		$param['menu']			= $this->menu;
		$param['activeMenu']	= $this->activeMenu;

		if($param['activeMenu']['akses_lihat']=='0')
		{
			return redirect()->to('denied');	
		}
		
		$data['site'] 	= $this->AppModel->get();
		$param['page'] 	= view($this->path_view . 'page-site',$data);
        return view($this->theme, $param);
	}

	public function update()
	{
		$id = "1";

        $data['nama'] 			  = entitiestag($this->request->getPost('nama'));
        $data['pengembang'] 	  = entitiestag($this->request->getPost('pengembang'));
		$data['versi']            = entitiestag($this->request->getPost('versi'));
		$data['site']             = entitiestag($this->request->getPost('site'));
		$data['alamat']           = entitiestag($this->request->getPost('alamat'));
		$data['email']            = entitiestag($this->request->getPost('email'));
		$data['kontak']           = entitiestag($this->request->getPost('kontak'));
		$data['deskripsi']        = ($this->request->getPost('deskripsi'));
		$data['tentang']    	  = ($this->request->getPost('tentang'));

        //proses validasi
        if(!$this->validate([
			'nama' => [
			    'rules'     => 'required',
			    'errors'    => [
	                'required' 		=> 'Entrian nama site wajib diisikan',
			    ]
			],
            'pengembang' => [
			    'rules'     => 'required',
			    'errors'    => [
	                'required' 		=> 'Entrian pengembang wajib diisikan',
			    ]
			],
			'versi' => [
			    'rules'     => 'required',
			    'errors'    => [
	                'required' 		=> 'Entrian versi wajib diisikan',
			    ]
			],
			'email' => [
			    'rules'     => 'required|valid_email',
			    'errors'    => [
	                'required' 		=> 'Entrian email wajib diisikan',
					'valid_email' 	=> 'Entrian email harus valid dengan format email xxxxx@namadomain.com',
			    ]
			],
			'kontak' => [
			    'rules'     => 'required',
			    'errors'    => [
	                'required' 		=> 'Entrian kontak wajib diisikan',
			    ]
			],
			'alamat' => [
			    'rules'     => 'required',
			    'errors'    => [
	                'required' 		=> 'Entrian alamat wajib diisikan',
			    ]
			],
			'site' => [
			    'rules'     => 'required',
			    'errors'    => [
	                'required' 		=> 'Entrian Link URL site wajib diisikan',
			    ]
			],
		]))
		{
			$validation = \Config\Services::validation();
			return redirect()->back()->withInput()->with('validation',$validation);
        }

        $this->AppModel->update($id, $data);
        return redirect()->back();
	}

}