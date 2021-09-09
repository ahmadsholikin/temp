<?php namespace App\Controllers\Backend\Creator;
use App\Controllers\BackendController;

class CRUDGenerator extends BackendController
{
    public $path_view = 'backend/creator/crudgenerator/';
    public $theme     = 'pages/theme-backend/render';

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
            $query    = $this->db->query("DESCRIBE $table");
            $results  = $query->getResult();        
            $response = "";
            $insert   = "";

            foreach ($results as $row)
            {
                if(($row->Field<>'created_at')&&($row->Field<>'updated_at')&&($row->Field<>'deleted_at')&&($row->Field<>'id')):
                    $response .= "\t\$data['".camelize($row->Field)."'] = entitiestag(\$this->request->getPost('".camelize($row->Field)."'));"."\n";
                endif;
            }

            $insert.="public function insert()"."\n";
            $insert.="{"."\n";
            $insert.="\tif(\$param['activeMenu']['akses_tambah'] == '0')"."\n";
            $insert.="\t{"."\n";
            $insert.="\t\treturn redirect()->to('denied');"."\n";
            $insert.="\t}"."\n"."\n";
            $insert.=$response."\n";
            $insert.="\t\$this->".pascalize($table)."Model->insert(\$data);"."\n";
            $insert.="\treturn redirect()->to(backend_url() . '/');"."\n";
            $insert.="}"."\n"."\n";
            $return['insert'] = $insert;
            echo json_encode($return);
        }
        else
        {
            echo "Access Denied";
        }
    }
}