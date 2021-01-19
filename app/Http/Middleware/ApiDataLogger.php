<?php

namespace App\Http\Middleware;
use Closure;
class ApiDataLogger
{
    private $startTime;
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {
        $this->startTime = microtime(true);
        return $next($request);
    }
    public function terminate($request, $response)
    {
       if (env('API_DATALOGGER', false)) {
        return;
       }
       $end_time = microtime(true);
       $filename = 'api_datalogger_' . date('d-m-y') . '.log';
       /*$data = 'Time: ' . gmdate("F j, Y, g:i a") . "\n";*/
       $data = 'Time: ' . date("d-m-y H:i a") . "\n";
       $data .= 'Duration: ' . number_format($end_time - LARAVEL_START, 3) . "\n";
       $data.= 'IP Address: ' . $request->ip() . "\n";
       $data.= 'URL: ' . $request->fullUrl() . "\n";
       $data.= 'Method: ' . $request->method() . "\n";
       $data.= 'Input: ' . $request->getContent() . "\n";
       $data.= 'Output: ' . $response->getContent() . "\n";
       \File::append(storage_path('logs' . DIRECTORY_SEPARATOR . $filename), $data. "\n" . str_repeat("=", 20) . "\n\n");
    }
}
