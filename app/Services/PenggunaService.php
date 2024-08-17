<?php

namespace App\Services;

use App\Repositories\Interfaces\PenggunaRepositoryInterface;

class PenggunaService
{
    protected $penggunaRepository;

    public function __construct(PenggunaRepositoryInterface $penggunaRepository)
    {
        $this->penggunaRepository = $penggunaRepository;
    }

    public function getPengguna()
    {
        $data = $this->penggunaRepository->getAll();
        $mapData = $data->map(function ($item) {
            return $this->formaterBodyJson($item);
        });

        return $mapData;
    }

    public function getSpesificPengguna($id)
    {
        $pengguna = $this->penggunaRepository->find($id);

        return $this->formaterBodyJson($pengguna);
    }

    public function createPengguna($data)
    {
        $result = $this->penggunaRepository->store($data);

        return $this->formaterBodyJson($result);
    }

    public function updatePengguna($data, $id)
    {
        if ($id != auth()->user()->id) {
            return false;
        }

        return $this->penggunaRepository->update($data, $id);
    }

    public function deletePengguna($id)
    {
        if ($id != auth()->user()->id) {
            return false;
        }

        $result = $this->penggunaRepository->delete($id);

        return $result;
    }

    // method for format 
    public function formaterBodyJson($data)
    {
        return [
            'id' => $data->id,
            'nama' => $data->nama,
            'email' => $data->email,
            'photo_profile' => $data->photo_profile,
            'divisi' => $data->division->nama_divisi,
        ];
    }
}
