<?php

namespace App\Http\Controllers\Pages;

use App\Models\Writer;
use App\Jobs\CreateWriter;
use App\Http\Controllers\Controller;
use App\Http\Requests\WriterRequest;
use App\Http\Requests\StoreWriterRequest;
use App\Http\Requests\UpdateWriterRequest;

class WriterController extends Controller
{
    
    public function index()
    {
        return view('pages.writer.show');
    }

   
}
