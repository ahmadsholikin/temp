<?php namespace App\Controllers\Frontend\Formasi;
use App\Controllers\FrontendController;
use App\Models\Konten\FormasiModel;

class Main extends FrontendController
{
	public $path_view 	= "frontend/formasi/";
	public $theme		= "pages/theme-frontend/render";

	public function __construct()
	{
		$this->FormasiModel 	= new FormasiModel();
	}

	public function index($t=null, $j=null)
	{
        if(($t=="cpns")&&(($j=="all")||($j==null)))
        {
            $formasi        = $this->FormasiModel->getCPNSAll();
            $data['judul']  = "Daftar Formasi CPNS";
        }
        else if(($t=="cpns")&&(($j=="teknis")||($j==null)))
        {
            $formasi        = $this->FormasiModel->getCPNSTeknis();
            $data['judul']  = "Daftar Formasi CPNS Tenaga Teknis";
        }
        else if(($t=="cpns")&&(($j=="nonteknis")||($j==null)))
        {
            $formasi        = $this->FormasiModel->getCPNSNonTeknis();
            $data['judul']  = "Daftar Formasi CPNS Tenaga Kesehatan";
        }
        else if(($t=="pppk")&&(($j=="all")||($j==null)))
        {
            $formasi        = $this->FormasiModel->getPPPKAll();
            $data['judul']  = "Daftar Formasi PPPK";
        }
        else if(($t=="pppk")&&(($j=="teknis")||($j==null)))
        {
            $formasi        = $this->FormasiModel->getPPPKTeknis();
            $data['judul']  = "Daftar Formasi PPPK Non Guru";
        }
        else if(($t=="pppk")&&(($j=="nonteknis")||($j==null)))
        {
            $formasi = $this->FormasiModel->getPPPKNonTeknis();
            $data['judul']  = "Daftar Formasi PPPK Guru";
        }
        else
        {
            $formasi = $this->FormasiModel->getAll();
            $data['judul']  = "Daftar Formasi Calon Aparatur Sipil Negara ";
        }

        $data['formasi']   = $formasi;
		$param['page'] 	   = view($this->path_view.'page-index',$data);
		return view($this->theme, $param);
	}
}