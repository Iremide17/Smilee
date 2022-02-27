<?php

namespace App\Http\Controllers\Pages;

use App\Models\Post;
use App\Models\User;
use App\Jobs\CreateWriter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\WriterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Writer;

class AuthorController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'verified']);
    }
    
    public function index()
    {
        return view('pages.authors.index', [
            'authors'   => User::where('type', User::WRITER)->where(function ($query){
                return $query->whereHas('writer', function($query){
                    $query->where('status_id', 4);
                });
            })->get(),
        ]);
    }

    public function show(User $user)
    {
        return view('pages.authors.show', [
            'author'    => $user,
            'posts'     => Post::where('writer_id', $user->writer->id())->where(function ($query){
                return $query->whereHas('status', function($query){
                    $query->where('status_id', 4);
                });
            })->paginate(4),
        ]);
    }

    public function store(WriterRequest $request)
    {
        $check = Writer::where('user_id', Auth::id())->first();

        if(!$check)
        {
            $this->dispatchSync(CreateWriter::fromRequest($request));
            $notification = array(
                'message' => 'You have successfully sent an application to become a writer. Your application will be reviewed and necessary
                documentation will be sent to you on approval',
                'alert-type' => 'success'
            );
            return redirect()->to('/dashboard')->with($notification); 
        }
        else
        {
            $notification = array(
                'message' => 'You have registered already!',
                'alert-type' => 'info',
            );
            return redirect()->to('/dashboard')->with($notification); 
        }        
    }
}
