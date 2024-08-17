<?php

namespace App\Services;

use App\Repositories\Interfaces\TugasRepositoryInterface;

class TugasService
{
    protected $tugasRepository;

    public function __construct(TugasRepositoryInterface $tugasRepository)
    {
        $this->tugasRepository = $tugasRepository;
    }

    public function getTugas()
    {
        $data = $this->tugasRepository->getAll();
        $mapData = $data->map(function ($item) {
            return $this->formaterBodyJson($item);
        });

        return $mapData;
    }

    public function getSpesificTugas($id)
    {
        $tugas = $this->tugasRepository->find($id);

        return $this->formaterBodyJson($tugas);
    }

    public function createTugas($data)
    {
        $result = $this->tugasRepository->store($data);

        return $this->formaterBodyJson($result);
    }

    public function updateTugas($data, $id)
    {
        return $this->tugasRepository->update($data, $id);
    }


    public function deleteTugas($id)
    {
        $result = $this->tugasRepository->delete($id);

        return $result;
    }

    // method for format response
    private function formaterBodyJson($data)
    {
        return [
            'id' => $data->id,
            'nama_tugas' => $data->nama_tugas,
            'penanggung_jawab' => $data->user->nama,
            'proyek' => $data->proyek->nama_proyek,
            'deskripsi_tugas' => $data->deskripsi_tugas,
        ];
    }
}
