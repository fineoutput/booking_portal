<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class LogController extends Controller
{


     public function index()
    {
        $logPath = storage_path('logs/laravel.log');

        if (!File::exists($logPath)) {
            return "Log file not found!";
        }

        // File ka content read karo
        $content = File::get($logPath);

        // Browser me properly show karne ke liye <pre> use karo
        return response("<pre>".htmlspecialchars($content)."</pre>");
    }


}
