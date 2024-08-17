<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProyekRequest;
use App\Services\ProyekService;
use App\Traits\ApiResponse;

class ProyekController extends Controller
{
    use ApiResponse;

    protected $proyekService;

    public function __construct(ProyekService $proyekService)
    {
        $this->proyekService = $proyekService;
    }

    public function index()
    {
        $data = $this->proyekService->getProyek();

        return $this->apiSuccess($data, 200, 'Data retrieved successfully');
    }

    public function show($id)
    {
        $proyek = $this->proyekService->getSpesificProyek($id);

        return $this->apiSuccess($proyek, 200, 'Data retrieved successfully');
    }


    public function store(ProyekRequest $request)
    {
        $data = $request->validated();
        $result = $this->proyekService->createProyek($data);

        return $this->apiSuccess($result, 201, 'Data created successfully');
    }

    public function update(ProyekRequest $request, $id)
    {
        $data = $request->validated();
        $result = $this->proyekService->updateProyek($data, $id);

        if (!$result) {
            return $this->apiError(404, 'Proyek not found');
        }

        $ifSuceess = $this->proyekService->getSpesificProyek($id);

        return $this->apiSuccess($ifSuceess, 200, 'Data updated successfully');
    }

    public function destroy($id)
    {
        $result = $this->proyekService->deleteProyek($id);
        if (!$result) {
            return $this->apiError(404, 'Proyek not found');
        }

        return $this->apiSuccess($result, 200, 'Data deleted successfully');
    }
}
