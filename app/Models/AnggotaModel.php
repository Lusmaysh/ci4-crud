<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table = 'anggota';
    protected $primaryKey = 'id_anggota';
    protected $allowedFields = ['nama','alamat','hp',];
    
    public function search ($keyword)
    {
        return $this->table('angota')->like('nama',$keyword)->orlike('alamat',$keyword);
    }

    // public function getAnggota($id = false)
    // {
    //     if ($id == false)
    //     {
    //         return $this->findAll();
    //         // return $this->paginate(10, 'anggota');
    //     }
    //     return $this->where(['id_anggota' => $id])->first();
    // }

    public function getAnggota($id = false, $limit = 6)
    {
        if ($id == false) {
            // Menggunakan paginate untuk mengatur pagination
            return $this->paginate($limit, 'anggota');
        }
        return $this->where(['id_anggota' => $id])->first();
    }
    // protected $useAutoIncrement = true;
    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;
    // protected $protectFields    = true;

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;

    // protected array $casts = [];
    // protected array $castHandlers = [];

    // // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];
}
