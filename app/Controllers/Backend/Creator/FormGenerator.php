<?php namespace App\Controllers\Backend\Creator;
use App\Controllers\BackendController;

class FormGenerator extends BackendController
{
    public $path_view = 'backend/creator/form-generator/';
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
            helper('inflector');

            $table    = entitiestag($this->request->getPost('table'));
            $query    = $this->db->query("DESCRIBE $table");
            $results  = $query->getResult();        
            $response = "";

            foreach ($results as $row)
            {
                if(($row->Field<>'created_at')&&($row->Field<>'updated_at')&&($row->Field<>'deleted_at')&&($row->Field<>'id')):
                    $response .= "\t".'<div class="form-row">'."\n";
                    $response .= "\t\t".'<div class="col form-group">'."\n";
                    $response .= "\t\t\t".'<label for="'.camelize($row->Field).'">'.humanize($row->Field).'</label>'."\n";
                    $response .= "\t\t\t".'<input type="text" class="form-control form-control-sm" name="'.camelize($row->Field).'" id="'.camelize($row->Field).'">'."\n";
                    $response .= "\t\t\t".'<div class="help-block with-errors"></div>'."\n";
                    $response .= "\t\t".'</div>'."\n";
                    $response .= "\t".'</div>'."\n";
                endif;
            }

            //button
            $response .= "\t".'<div class="form-row">'."\n";
            $response .= "\t\t".'<div class="col form-group">'."\n";
            $response .= "\t\t\t".'<button type="submit" class="btn btn-sm btn-primary">Simpan</button>'."\n";
            $response .= "\t\t".'</div>'."\n";
            $response .= "\t".'</div>'."\n";

            echo '<table class="">'."\n";
            echo $response;
            echo '</table>';
        }
        else
        {
            echo "Access Denied";
        }
    }
}