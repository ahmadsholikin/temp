<?php namespace App\Controllers\Option;
use App\Controllers\BackendController;

class Profile extends BackendController
{
	public function __construct()
	{

	}

	public function index()
	{
		$param['menu']			= $this->menu;
		$param['activeMenu']	= $this->activeMenu;
		$param['page']	= view("backend/option/pages/page-profile");
		return view('theme/majestic_render',$param);
	}

	public function update()
	{
        return redirect()->to(base_url('profile'));
	}

}