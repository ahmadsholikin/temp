<?php namespace App\Controllers\Backend\Pendataan;
use App\Controllers\BackendController;
use App\Models\Pendataan\DataUnorVerifikatorModel;
use App\Models\Pendataan\DataUnorModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DataUnorVerifikator extends BackendController
{
    public $path_view = "backend/pendataan/data-unor-verifikator/";
    public $theme     = "pages/theme-backend/render";

    public function __construct()
    {
        $this->DataUnorVerifikatorModel = new DataUnorVerifikatorModel();
        $this->DataUnorModel            = new DataUnorModel();
    }

    public function index()
    {
        $data['data']        = $this->DataUnorVerifikatorModel->getJoin();
        $param['menu']       = $this->menu;
        $param['activeMenu'] = $this->activeMenu;

        if ($param['activeMenu']['akses_lihat'] == '0')
        {
            return redirect()->to('denied');
        }

        $param['page'] = view($this->path_view . 'page-index',$data);
        return view($this->theme, $param);
    }

    public function update()
    {
        $unorId = entitiestag($this->request->getPost('unorId'));
        $status = entitiestag($this->request->getPost('status'));

        $unor = $this->DataUnorModel->get(['UnorId'=>$unorId]);
        $data['unor_id_verifikator']    = $unorId;
        $data['unor_verifikator']       = $unor[0]['NamaUnor'];
        $exist = $this->DataUnorVerifikatorModel->get(['unor_id_verifikator'=>$unorId]);

        if($status=='V')
        {
            if(empty($exist))
            {
                $data['status_v']       = "V";
                $this->DataUnorVerifikatorModel->insert($data);
            }
            else
            {
                if($exist[0]['status_v']=='V')
                {
                    $data['status_v']   = "";
                }
                else
                {
                    $data['status_v']   = "V";
                }
                $this->DataUnorVerifikatorModel->update( $unorId, $data);
            }
        }
        else
        {
            if(empty($exist))
            {
                $data['status_a']       = "A";
                $this->DataUnorVerifikatorModel->insert($data);
            }
            else
            {
                if($exist[0]['status_a']=='A')
                {
                    $data['status_a']   = "";
                }
                else
                {
                    $data['status_a']   = "A";
                }
                $this->DataUnorVerifikatorModel->update( $unorId, $data);
            }
        }

        return json_encode($data);
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->setTitle("Unor");

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Unor Id Verifikator')
            ->setCellValue('B1', 'Unor Verifikator')
            ->setCellValue('C1', 'Status')
            ->setCellValue('C2', 'V')
            ->setCellValue('D2', 'A');
        
        $spreadsheet->getActiveSheet()->mergeCells('A1:A2');
        $spreadsheet->getActiveSheet()->mergeCells('B1:B2');

        $data        = $this->DataUnorVerifikatorModel->get();
        $column      = 3;

        foreach ($data as $row) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $row['unor_id_verifikator'])
                ->setCellValue('B' . $column, $row['unor_verifikator'])
                ->setCellValue('C' . $column, $row['status_v'])
                ->setCellValue('D' . $column, $row['status_a']);

            $column++;
        }

        $writer     = new Xlsx($spreadsheet);
        $filename   = 'Template-Unor-Verifikator-dan-Approval-'.date('Y-m-d-H-i-s');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

}