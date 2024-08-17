<?php

namespace App\Services;

use App\Repositories\Interfaces\ProyekRepositoryInterface;

class ProyekService
{
    protected $proyekRepository;

    public function __construct(ProyekRepositoryInterface $proyekRepository)
    {
        $this->proyekRepository = $proyekRepository;
    }

    public function getProyek()
    {
        $data = $this->proyekRepository->getAll();
        $mapData = $data->map(function ($item) {
            return $this->formaterBodyJson($item);
        });

        return $mapData;
    }

    public function getSpesificProyek($id)
    {
        $proyek = $this->proyekRepository->find($id);

        return $this->formaterBodyJson($proyek);
    }


    public function createProyek($data)
    {
        $result = $this->proyekRepository->store($data);

        return $this->formaterBodyJson($result);
    }

    public function updateProyek($data, $id)
    {
        return $this->proyekRepository->update($data, $id);
    }


    public function deleteProyek($id)
    {
        $result = $this->proyekRepository->delete($id);

        return $result;
    }

    // method for format response
    private function formaterBodyJson($data)
    {
        return [
            'id' => $data->id,
            'nama_proyek' => $data->nama_proyek,
            'biaya_proyek' => $this->formatRupiah($data->biaya_proyek),
            'tanggal_mulai' => $data->tanggal_mulai,
            'tanggal_selesai' => $data->tanggal_selesai,
            'category' => $data->categoryProyek->nama_category,
            'status_proyek' => $data->status_proyek,
        ];
    }

    private function formatRupiah($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
