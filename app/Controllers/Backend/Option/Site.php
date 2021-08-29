<?php namespace App\Controllers\Backend\Option;
use App\Controllers\BackendController;

class Site extends BackendController
{
	public $path_view   = "backend/option/pages/";
	public $theme       = "pages/theme-backend/render";
	
	public function __construct()
	{

	}

	public function index()
	{
		$param['menu']			= $this->menu;
		$param['activeMenu']	= $this->activeMenu;

		if($param['activeMenu']['akses_lihat']=='0')
		{
			return redirect()->to('denied');	
		}
		
		$param['page'] = view($this->path_view . 'page-site');
        return view($this->theme, $param);
	}

}