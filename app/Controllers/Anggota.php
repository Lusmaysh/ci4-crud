<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AnggotaModel;

class Anggota extends BaseController
{
    public $AnggotaModel;
    public function __construct()
    {
        $this->AnggotaModel = new AnggotaModel();
    }
    public function index()
    {
        // $currentPage= $this->request->getVar('page_anggota') ? $this->request->getVar('page_anggota') : 1;
        $currentPage = max(1, $this->request->getVar('page_anggota') ?: 1);
        $dataShow = 6;
        log_message('info', 'Current Page: ' . $currentPage);

        $keyword = $this->request->getVar('keyword');
        if($keyword) {
            $anggota = $this->AnggotaModel->search($keyword);
        } else {
            $anggota = $this->AnggotaModel;
        }

        $data = [
            'title' => 'Daftar Anggota',
            //'anggota' => $this->AnggotaModel->getAnggota()
            'anggota' => $anggota->paginate($dataShow,'anggota'),
            // 'anggota' => $this->AnggotaModel->paginate($dataShow,'anggota'),
            'dataShow' => $dataShow,
            'pager' => $this->AnggotaModel->pager,
            'currentPage' => $currentPage
        ];
        return view('anggota/index',$data);
    }
}
