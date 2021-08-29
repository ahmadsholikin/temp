<?php namespace App\Controllers\Frontend\Statistik;
use App\Controllers\FrontendController;

class Main extends FrontendController
{
	public $path_view 	= "frontend/statistik/";
	public $theme		= "pages/theme-frontend/render";

	public function __construct()
	{
	}

	public function index()
	{
        $api = get_api("https://sipgan.magelangkab.go.id/sipgan/api/restpdm");
		if($api->status===false)
		{
			$data['data'] = 0;
		}
		else
		{
			$data['data'] = $api->data;
            $data['total'] = 0;
            $data['sudah'] = 0;
            $data['prosentase'] = 0;
            foreach($api->data as $row)
            {
                $data['total'] += $row->jumlah;
                $data['sudah'] += $row->jumlah_rekon;
            }

            $data['prosentase'] = round((($data['sudah']/$data['total'])*100),2);
		}
    
		$param['page'] 	   = view($this->path_view.'page-index',$data);
		return view($this->theme, $param);
	}
}