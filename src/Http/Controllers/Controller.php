<?php

namespace Credpal\CPInvest\Http\Controllers;

use App\Helpers\Datatable;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use DispatchesJobs;
    use ValidatesRequests;
    use AuthorizesRequests;

    /**
     * @param mixed $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function successResponse(
        $data,
        string $message = "Operation Successful",
        $statusCode = Response::HTTP_OK
    ): JsonResponse
    {
        return response()->json([
            "success" => true,
            "data" => $data,
            "message" => $message
        ], $statusCode);
    }

    public function datatable($query, array $config = [], $resourceClass = null)
    {
        $data = config('cpinvest.datatable_class')::make($query, $config, $resourceClass);

        if ($data instanceof BinaryFileResponse) {
            return $data;
        }

        return response()->json([
            "success" => true,
            "datatable" => $data,
            "message" => 'Data Fetched Successfully'
        ], Response::HTTP_OK);
    }
}
