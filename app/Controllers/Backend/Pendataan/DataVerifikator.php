<?php namespace App\Controllers\Backend\Pendataan;
use App\Controllers\BackendController;
use App\Models\Pendataan\DataVerifikatorModel;
use App\Models\Pendataan\DataUnorVerifikatorModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DataVerifikator extends BackendController
{
    public $path_view = "backend/pendataan/data-verifikator/";
    public $theme     = "pages/theme-backend/render";

    public function __construct()
    {
        $this->DataVerifikatorModel     = new DataVerifikatorModel();
        $this->DataUnorVerifikatorModel = new DataUnorVerifikatorModel();
    }

    public function index()
    {
        $data['unor']        = $this->DataUnorVerifikatorModel->get();
        $param['menu']       = $this->menu;
        $param['activeMenu'] = $this->activeMenu;

        if ($param['activeMenu']['akses_lihat'] == '0')
        {
            return redirect()->to('denied');
        }

        $param['page'] = view($this->path_view . 'page-index',$data);
        return view($this->theme, $param);
    }

    public function insert()
    {
        $data['unor_id']    = entitiestag($this->request->getPost('unor_id'));
        $data['nama_unor']  = entitiestag($this->request->getPost('nama_unor'));
        $data['nip']        = entitiestag($this->request->getPost('nip'));
        $data['nama']       = entitiestag($this->request->getPost('nama'));
        $data['biro_sdm']   = entitiestag($this->request->getPost('biro_sdm'));

        $verifikator  = entitiestag($this->request->getPost('verifikator'));
        if( $verifikator == 'V')
        {
            $data['status'] = "V";
            $respon = $this->DataVerifikatorModel->insert($data);
        }
        
        $approval  = entitiestag($this->request->getPost('approval'));
        if( $approval == 'A')
        {
            $data['status'] = "A";
            $respon = $this->DataVerifikatorModel->insert($data);
        }
        
        echo $respon;
    }

    public function preview()
	{
		$data['data']        = $this->DataVerifikatorModel->get();
		return view('backend/pendataan/data-verifikator/page-list',$data);
	}

    public function delete()
    {
        $param['activeMenu'] = $this->activeMenu;
        
        if ($param['activeMenu']['akses_hapus'] == '0')
        {
            return redirect()->to('denied');
        }

        $id = $this->request->getGet('id');
        $this->DataVerifikatorModel->delete($id);
        return redirect()->to(backend_url() . '/data-verifikator');
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->setTitle("DetailVerifikator");

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NIP')
            ->setCellValue('B1', 'Nama')
            ->setCellValue('C1', 'Status (Verifikator /Approval)')
            ->setCellValue('D1', 'Status Biro SDM')
            ->setCellValue('E1', 'Unor ID')
            ->setCellValue('F1', 'Nama Unor');
        
        $data        = $this->DataVerifikatorModel->get();
        $column      = 2;

        foreach ($data as $row) {
            $spreadsheet->setActiveSheetIndex(0)->setCellValueExplicit(
                'A'.$column,
                $row['nip'],
                \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
            );
            
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $column, $row['nama'])
                ->setCellValue('C' . $column, $row['status'])
                ->setCellValue('D' . $column, $row['biro_sdm'])
                ->setCellValue('E' . $column, $row['unor_id'])
                ->setCellValue('F' . $column, $row['nama_unor']);
            $column++;
        }

        $writer     = new Xlsx($spreadsheet);
        $filename   = 'Template-User-Verifikator-dan-Approval-'.date('Y-m-d-H-i-s');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

}