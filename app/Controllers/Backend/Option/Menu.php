<?php namespace App\Controllers\Backend\Option;
use App\Controllers\BackendController;
use App\Models\Option\MenuModel;

class Menu extends BackendController
{
    public $path_view = "backend/option/menu/";
    public $theme     = "pages/theme-backend/render";

    public function __construct()
    {
        $this->MenuModel = new MenuModel();
    }

    public function index()
    {
        $param['menu']       = $this->menu;
        $param['activeMenu'] = $this->activeMenu;

        if ($param['activeMenu']['akses_lihat'] == '0')
        {
            return redirect()->to('denied');
        }

        $param['page'] = view($this->path_view . 'page-index');
        return view($this->theme, $param);
    }

    // deklarasi
    private function _variabel()
    {
        $slug                 = url_title(strip_tags($this->request->getPost('menu_nama')), '-', true);
        $root_menu            = explode("#", $this->request->getPost('induk_id'));
        $param['menu_nama']   = entitiestag(strip_tags($this->request->getPost('menu_nama')));
        $param['deskripsi']   = entitiestag(strip_tags($this->request->getPost('deskripsi')));
        $param['link']        = entitiestag(strip_tags($this->request->getPost('link')));
        $param['ikon']        = entitiestag(strip_tags($this->request->getPost('ikon')));
        $param['induk_id']    = $root_menu[0];
        $param['root_nama']   = $root_menu[1];
        $param['hirarki']     = entitiestag(strip_tags($this->request->getPost('hirarki')));
        $param['sub']         = entitiestag(strip_tags($this->request->getPost('sub')));
        $param['aktif']       = entitiestag(strip_tags($this->request->getPost('aktif')));
        $param['prefik']      = $slug;
        $param['nama_tabel']  = entitiestag(strip_tags($this->request->getPost('nama_tabel')));
        $param['primary_key'] = entitiestag(strip_tags($this->request->getPost('primary_key')));
        $param['urutan']      = $this->MenuModel->lastSortingUrutan(strip_tags($this->request->getPost('induk_id')));
        return $param;
    }

    /* Daftar Function Memuat Halaman */
    //Memuat form halaman baru
    public function add()
    {
        $db                     = db_connect();
        $data['table']          = $db->listTables();
        $data['MenuModel']      = $this->MenuModel->where('hirarki', 1)->findAll();
        $param['menu']          = $this->menu;
        $param['activeMenu']    = $this->activeMenu;

        if ($param['activeMenu']['akses_tambah'] == '0')
        {
            return redirect()->to('denied');
        }
        $param['page'] = view($this->path_view . 'page-add',$data);
        return view($this->theme, $param);
    }

    //Memuat form halaman untuk mengedit data
    public function edit()
    {
        $id     = entitiestag($this->request->getGet('menu_id'));
        $result = $this->MenuModel->get(['menu_id' => $id]);

        if (empty($result))
        {
            return redirect()->to(base_url() . '/404');
        }

        $db                  = db_connect();
        $data['table']       = $db->listTables();
        $data['MenuModel']   = $this->MenuModel->where('hirarki', 1)->findAll();
        $data['var']         = $this->MenuModel->getMenu(['menu_id' => $this->request->getGet('menu_id')]);

        $param['menu']       = $this->menu;
        $param['activeMenu'] = $this->activeMenu;

        if ($param['activeMenu']['akses_ubah'] == '0')
        {
            return redirect()->to('denied');
        }

        $param['page'] = view($this->path_view . 'page-edit',$data);
        return view($this->theme, $param);
    }

    /* Daftar Function Proses */
    // menampilkan daftar menu dalam bentuk table list
    public function get_list_menu()
    {
        if ($this->request->isAJAX())
        {
            $param['MenuModel'] = $this->MenuModel->get();
            echo view("backend/option/menu/page-list", $param);
        } 
        else
        {
            echo "No access permits";
        }
    }

    // Proses Menambahkan menu baru
    public function insert()
    {
        $param               = $this->_variabel();
        $param['created_at'] = date('Y-m-d H: i: s');
        $this->MenuModel->insert($param);
        return redirect()->to(backend_url() . '/menu');
    }

    // Proses Mengedit menu baru
    public function update()
    {
        $param               = $this->_variabel();
        $param['updated_at'] = date('Y-m-d H: i: s');
        $this->MenuModel->update(strip_tags($this->request->getPost('menu_id')), $param);
        return redirect()->to(backend_url() . '/menu');
    }

    //Bagian pengurutan menu
    public function sorting()
    {
        if ($this->request->isAJAX())
        {
            $pk             = strip_tags($this->request->getPost('menu_id'));
            $data['urutan'] = strip_tags($this->request->getPost('urutan'));
            $hasil          = $this->MenuModel->update($pk, $data);
            echo $hasil;
        } 
        else
        {
            echo "No access permits";
        }
    }

    //hapus menu
    public function delete()
    {
        $param['activeMenu'] = $this->activeMenu;

        if ($param['activeMenu']['akses_hapus'] == '0')
        {
            return redirect()->to('denied');
        }

        $pk = $this->request->getGet('menu_id');
        $this->MenuModel->where('menu_id', $pk)->delete();
        return redirect()->to(backend_url() . '/menu');
    }

    // mengatur urutan menu
    public function get_primary_key()
    {
        if ($this->request->isAJAX())
        {
            $db          = db_connect();
            $table       = strip_tags($this->request->getPost('pilihan'));
            $fields      = $db->getFieldData($table);

            $primary_key = "";

            foreach ($fields as $field)
            {
                if ($field->primary_key == 1)
                {
                    $primary_key = $field->name;
                }
            }
            echo $primary_key;
        } 
        else
        {
            echo "No access permits";
        }
    }
}
