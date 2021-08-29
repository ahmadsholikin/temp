<?php namespace App\Controllers\Backend\Pendataan;
use App\Controllers\BackendController;
use App\Models\Pendataan\DataRelasiUnorModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DataRelasiUnor extends BackendController
{
    public $path_view = "backend/pendataan/data-relasi-unor/";
    public $theme     = "pages/theme-backend/render";

    public function __construct()
    {
        $this->DataRelasiUnorModel = new DataRelasiUnorModel();
    }

    public function index()
    {
        $data['data']        = $this->DataRelasiUnorModel->get();
        $param['menu']       = $this->menu;
        $param['activeMenu'] = $this->activeMenu;

        if ($param['activeMenu']['akses_lihat'] == '0')
        {
            return redirect()->to('denied');
        }

        $param['page'] = view($this->path_view . 'page-index',$data);
        return view($this->theme, $param);
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->setTitle("Relasi");

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Unor Id Verifikator')
            ->setCellValue('B1', 'Unor Verifikator')
            ->setCellValue('C1', 'Unor Id Approval')
            ->setCellValue('D1', 'Unor Approval');
        
        $data        = $this->DataRelasiUnorModel->get();
        $column      = 2;

        foreach ($data as $row) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $row['unor_id_verifikator'])
                ->setCellValue('B' . $column, $row['unor_verifikator'])
                ->setCellValue('C' . $column, $row['unor_id_approval'])
                ->setCellValue('D' . $column, $row['unor_approval']);

            $column++;
        }

        $writer     = new Xlsx($spreadsheet);
        $filename   = 'Template-Relasi-Unor-'.date('Y-m-d-H-i-s');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

}