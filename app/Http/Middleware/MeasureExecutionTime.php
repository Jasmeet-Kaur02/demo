<?php

namespace App\Http\Middleware;

use App\Models\DemoField;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MeasureExecutionTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = Carbon::now();

        $response = $next($request);

        $endTime = Carbon::now();

        $responseData = json_decode($response->getContent(), true);    

        $demoField = DemoField::find($responseData["data"]['demoField']['id']);

        $demoField->executionTime = $endTime->diffInMilliseconds($startTime);
        $demoField->save();

        return $response;
    }
}
