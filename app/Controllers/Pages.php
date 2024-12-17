<?php

namespace App\Controllers;

class Pages extends BaseController
{
    // menu home
    public function index()
    {
        $data = [
            'title' => 'WEB2-Pertemuan 3',
            'tentang' => 'MVC merupakan sebuah pola desain arsitektur yang umum digunakan dalam pengembangan aplikasi. Tujuannya agar kode program lebih konsisten dan terstruktur. Sehingga kita akan mudah kolaborasi dengan tim.'
        ];
        echo view('pages/home', $data);
    }

    // menu about
    public function about()
    {
        $data = [
            'title' => 'About Me',
            'nama' => 'Syamsul Hidayat',
            'tentang' => 'Nama saya Syamsul Hidayat, seorang mahasiswa dengan fokus pada bidang programming. Saya memiliki pengalaman dalam mengembangkan berbagai aplikasi, baik untuk web maupun mobile, dan terus memperdalam keterampilan di bidang ini. Dengan latar belakang akademis yang solid dan pengalaman praktik yang berkembang.'
        ];
        echo view('pages/about',$data);
    }

    public function contact()
    {
        $data = [
            'title' => 'My Contact',
            'number' => '085225059731',
            'nama' => 'Syamsul Hidayat',
            'alamat' => 'Perumahan Puri Sijono Asri Blok.A28'
        ];
        echo view('pages/contact',$data);
    }
}