<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\Level;
use App\Jobs\CreateBank;
use App\Models\Semester;
use App\Services\SaveFileService;
use App\Http\Requests\BankRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    public function __contruct()
    {
        return $this->middleware(['admin', 'auth']);
    }

    public function index()
    {
        return view('admin.bank.index');
    }

    public function create()
    {
        return view('admin.bank.create',[
            'semesters' => Semester::all(),
            'levels' => Level::all(), 
        ]);
    }

    public function store(BankRequest $request)
    {
        // dd($request);
        $bank = new Bank([
            'name'                 => $request->name,
            'description'          => $request->description,
        ]);

        $bank->authoredBy(Auth::user());
        SaveFileService::uploadFile('content', $request->content, $bank, Bank::TABLE);
        $bank->syncSemesters($request->semesters);
        $bank->syncLevels($request->levels);
        $bank->save();
        // $this->dispatchSync(CreateBank::fromRequest($request));
        $notification = array(
            'message' => 'Question saved successfully',
            'alert-type'    => 'success'
        );
        return redirect()->route('admin.banks.index')->with($notification);
    }
}
