<?php namespace App\Controllers\Backend\Creator;
use App\Controllers\BackendController;

class TableModel extends BackendController
{
    public $path_view = "backend/creator/table-model/";
    public $theme     = "pages/theme-backend/render";

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $query   = $this->db->query("show tables");
        $results = $query->getResult();        

        $param['menu']       = $this->menu;
        $param['activeMenu'] = $this->activeMenu;

        if ($param['activeMenu']['akses_lihat'] == '0')
        {
            return redirect()->to('denied');
        }
        $data['data']   = $results;
        $param['page']  = view($this->path_view . 'page-index',$data);
        return view($this->theme, $param);
    }

    public function generate()
    {
        if ($this->request->isAJAX())
        {
            $table    = entitiestag($this->request->getPost('table'));
            $query    = $this->db->query("SELECT COLUMN_NAME as kolom FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$table."'");
            $results  = $query->getResult();        
            $response = "";

            foreach ($results as $row)
            {
                $response .= "\t\t\t\t\t\t\t\t\t\t'".$row->kolom."',\n";
            }

            echo "[\n".$response."\t\t\t\t\t\t\t\t\t];";
        }
        else
        {
            echo "Access Denied";
        }
    }
}