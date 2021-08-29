<?php namespace App\Controllers\Backend\Pendataan;
use App\Controllers\BackendController;
use App\Models\Pendataan\DataUnorModel;

class DataUnor extends BackendController
{
    public $path_view = "backend/pendataan/data-unor/";
    public $theme     = "pages/theme-backend/render";

    public function __construct()
    {
        $this->DataUnorModel = new DataUnorModel();
    }

    public function index()
    {
        $data['data']        = $this->DataUnorModel->getKueri();
        $param['menu']       = $this->menu;
        $param['activeMenu'] = $this->activeMenu;

        if ($param['activeMenu']['akses_lihat'] == '0')
        {
            return redirect()->to('denied');
        }

        $param['page'] = view($this->path_view . 'page-index',$data);
        return view($this->theme, $param);
    }

}