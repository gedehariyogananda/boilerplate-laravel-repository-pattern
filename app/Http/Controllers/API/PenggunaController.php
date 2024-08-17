<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenggunaRequest;
use App\Services\PenggunaService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    use ApiResponse;

    protected $penggunaService;

    public function __construct(PenggunaService $penggunaService)
    {
        $this->penggunaService = $penggunaService;
    }

    public function index()
    {
        try {
            $pengguna = $this->penggunaService->getPengguna();
            return $this->apiSuccess($pengguna, 200, 'successfully returned');
        } catch (Exception $e) {
            return $this->apiError($e->getMessage(), 400);
        }
    }

    public function show($id)
    {
        try {
            $pengguna = $this->penggunaService->getSpesificPengguna($id);
            return $this->apiSuccess($pengguna, 200, 'successfully returned');
        } catch (Exception $e) {
            return $this->apiError($e->getMessage(), 400);
        }
    }

    public function store(PenggunaRequest $request)
    {
        try {
            $data = $request->validated();
            // hashing request password
            $data['password'] = bcrypt($data['password']);
            $pengguna = $this->penggunaService->createPengguna($data);
            return $this->apiSuccess($pengguna, 200, 'successfully created');
        } catch (Exception $e) {
            return $this->apiError($e->getMessage(), 400);
        }
    }

    public function update(PenggunaRequest $request)
    {
        try {
            $data = $request->validated();
            // hashing request password
            $data['password'] = bcrypt($data['password']);
            $pengguna = $this->penggunaService->updatePengguna($data, $request->id);
            if (!$pengguna) {
                return $this->apiError(404, 'NOT UR DATAS');
            }

            $dataBaruPengguna = $this->penggunaService->getSpesificPengguna($request->id);


            return $this->apiSuccess($dataBaruPengguna, 200, 'successfully updated');
        } catch (Exception $e) {
            return $this->apiError(400, $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $pengguna = $this->penggunaService->deletePengguna($id);
            if (!$pengguna) {
                return $this->apiError(404, 'NOT UR DATAS');
            }

            return $this->apiSuccess($pengguna, 200, 'successfully deleted');
        } catch (Exception $e) {
            return $this->apiError(400, $e->getMessage());
        }
    }
}
