<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BukuModel;


class Buku extends BaseController
{
    protected $BukuModel;
    public function __construct()
    {
        $this->BukuModel = new BukuModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Buku',
            'buku' => $this->BukuModel->getBuku()
        ];
        return view('buku/index', $data);
    }
    
    public function detail($idbuku)
    {
        $data = [
            'title' => 'Detail Buku',
            'buku' => $this->BukuModel->getBuku($idbuku)
        ];
        return view('buku/detail', $data);
    }

    public function tambah()
    {
        //mengambil data input saat melakukan validasi 
        session();
        $data = [
            'title' => 'Tambah Buku',
            'validation' => session()->get('validation'),
            // 'fileError' => session()->getFlashdata('fileError')
        ];
        // dd($data['validate']);
        return view('buku/tambah', $data);
    }

    public function simpan()
    {
        $fileSampul = $this->request->getFile('sampul');

        // Jika file sampul diunggah
        $rulesSampul = 'is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[sampul,2024]';
        if ($fileSampul && $fileSampul->getError() != 4) {
            // Tambahkan aturan 'uploaded' hanya jika ada file yang diunggah
            $rulesSampul = 'uploaded[sampul]|' . $rulesSampul;
        }
    
        $validasiTeks = $this->validate([
            'judul' => [
                'rules' => 'required|is_unique[buku.judul]',
                'errors' => [
                    'required' => '{field} buku harus diisi',
                    'is_unique' => '{field} buku sudah terdaftar',
                ]
            ],
            'pengarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi',
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi',
                ]
            ],
            'tahun_terbit' => [
                'rules' => 'required|valid_date[Y]',
                'errors' => [
                    'required' => 'tahun terbit buku harus diisi',
                ]
            ],
            'sampul' => [
                'rules' => $rulesSampul,
                'errors' => [
                    'uploaded' => 'File belum diunggah atau tidak valid',
                    'is_image' => 'File yang diunggah harus berupa gambar',
                    'mime_in' => 'Format gambar harus jpg, jpeg, atau png',
                    'max_size' => 'Ukuran file tidak boleh lebih dari 2MB'
                ]
            ]
        ]);

        // Jika validasi gagal
        if (!$validasiTeks) {
            // Jika ada file yang diunggah, simpan sementara
            if ($fileSampul && $fileSampul->isValid() && !$fileSampul->hasMoved()) {
                $namaSampulSementara = $fileSampul->getRandomName();
                $fileSampul->move('img/tmp', $namaSampulSementara); // Pindahkan ke folder sementara

                // Simpan nama file sementara ke session untuk digunakan nanti
                session()->set('sampulSementara', $namaSampulSementara);
            }

            // Redirect kembali dengan input dan validasi
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        // Jika file sampul ada di session (saat validasi gagal sebelumnya)
        $namaSampul = session()->get('sampulSementara') ?? '';

        // Pindahkan file dari folder tmp ke folder img
        if ($namaSampul) {
            rename('img/tmp/' . $namaSampul, 'img/' . $namaSampul);
            session()->remove('sampulSementara'); // Hapus session file sementara setelah digunakan
        } elseif ($fileSampul && $fileSampul->isValid() && !$fileSampul->hasMoved()) {
            // Jika file diunggah baru
            $namaSampul = $fileSampul->getRandomName();
            $fileSampul->move('img', $namaSampul); // Pindahkan file ke folder img
        }

        // Simpan data buku ke database
        $this->BukuModel->save([
            'judul' => $this->request->getVar('judul'),
            'pengarang' => $this->request->getVar('pengarang'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('/buku');
    }

    public function hapus($id_buku) {
         // Cari data buku berdasarkan ID
        $buku = $this->BukuModel->find($id_buku);

        // Cek jika file sampul ada di folder img
        if ($buku['sampul'] != '') {
            if (file_exists('img/' . $buku['sampul'])) {
                unlink('img/' . $buku['sampul']);  // Hapus file sampul
            }
        }

        $this->BukuModel->delete($id_buku);

        session()->setFlashdata('pesan', 'Data berhasil dihapus!');
        return redirect()->to('buku');
    }

    public function ubah($id_buku) {
        session();
        $data = [
            'title' =>'Ubah data buku',
            // 'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'validation' => session()->getFlashdata('validation'),
            // 'fileError' => session()->getFlashdata('fileError'), // Tambahkan pesan error file ke data
            'buku' => $this->BukuModel->getBuku($id_buku),
        ];

        return view('buku/ubah', $data);
    }

    public function update($id_buku) {
        // Dapatkan buku berdasarkan id_buku yang sedang diubah
        $bukuLama = $this->BukuModel->getBuku($id_buku);
    
        // Jika judul yang baru sama dengan judul yang lama, maka tidak perlu validasi is_unique
        $rule_judul = $this->request->getVar('judul') == $bukuLama['judul'] ? 'required' : 'required|is_unique[buku.judul]';
    
        // Validasi input data
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} buku harus diisi',
                    'is_unique' => '{field} buku sudah terdaftar',
                ]
            ],
            'pengarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi',
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi',
                ]
            ],
            'tahun_terbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tahun terbit buku harus diisi',
                ]
            ],
            'sampul' => [
                'rules' => 'is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]|max_size[sampul,2024]',
                'errors' => [
                    'is_image' => 'File yang diunggah harus berupa gambar',
                    'mime_in' => 'Format gambar harus jpg, jpeg, atau png',
                    'max_size' => 'Ukuran file tidak boleh lebih dari 2MB'
                ]
            ],
        ])) {
            // Jika validasi gagal, kembali ke halaman ubah dengan input dan error
            session()->setFlashdata('validation', $this->validator->getErrors());
            return redirect()->to('/buku/ubah/' . $id_buku)->withInput();
        }
    
        $fileSampul = $this->request->getFile('sampul');
        $namaSampul = $bukuLama['sampul']; // Default menggunakan sampul lama
    
        // Cek jika file diunggah dan valid
        if ($fileSampul && $fileSampul->getError() == 0) {
            // Jika file valid, pindahkan file baru ke folder img dan simpan nama file
            $namaSampul = $fileSampul->getRandomName(); // Nama acak file baru
            $fileSampul->move('img', $namaSampul); // Pindahkan file baru ke folder img
            
            // Hapus file sampul lama jika bukan default.jpg
            if ($bukuLama['sampul'] != '' && $bukuLama['sampul'] != $namaSampul ) {
                unlink('img/' . $bukuLama['sampul']);
            }
        }
        
        if (!empty($fileError)) {
            session()->setFlashdata('fileError', $fileError);
            return redirect()->back()->withInput();
        }
    
        // Update data buku di database
        $this->BukuModel->update($id_buku, [
            'judul' => $this->request->getVar('judul'),
            'pengarang' => $this->request->getVar('pengarang'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'sampul' => $namaSampul, // Pastikan nama sampul yang diperbarui disimpan
        ]);
    
        // Set flashdata pesan
        session()->setFlashdata('pesan', 'Data sudah berhasil diubah!');
    
        // Redirect ke halaman daftar buku
        return redirect()->to('/buku');
    }
    
    
}