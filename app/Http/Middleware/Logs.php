<?php

namespace App\Http\Middleware;

use App\Services\LogsService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Logs
{
	/**
	 * @param Request $request
	 * @param Closure $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{
		$this->logRequest($request);

		return $next($request);
	}

	/**
	 * @param Request $request
	 */
	protected function logRequest(Request $request): void
	{
	    /** @var LogsService $service */
		$service = App::make(LogsService::class);

		$service->create($request);
	}
}
