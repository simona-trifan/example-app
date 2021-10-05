<?php

namespace App\Http\Controllers;

use App\Dto\HateoasDto;
use App\Services\LogsService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;

class LogsController extends BaseController
{
    /**
     * @param Request $request
     * @return array
     */
    public function index(Request $request): array
    {
        /** @var LogsService $service */
        $service = App::make(LogsService::class);

        $response = new HateoasDto($service->getLogs($request));

        return $response->toArray();
    }
}
