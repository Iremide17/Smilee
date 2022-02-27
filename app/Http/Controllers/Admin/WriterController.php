<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['admin', 'auth']);
    }
    
    public function index()
    {
        $this->authorize(UserPolicy::SUPERADMIN, User::class);

        return view('admin.writers.index', [
            'users' => User::where('type', User::WRITER)->paginate(5),
        ]);
    }
}
