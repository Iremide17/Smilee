<?php

namespace App\Http\Controllers\Pages;

use App\Models\Agent;
use App\Models\Property;
use App\Jobs\CreateAgent;
use App\Jobs\CreateVendor;
use App\Jobs\CreateWriter;
use Illuminate\Http\Request;
use App\Http\Requests\AgentRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Http\Requests\WriterRequest;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        return view('pages.agent.index');
    }

    public function agent(AgentRequest $request)
    {
        $check = Agent::where('user_id', Auth::id())->first();

        if(!$check)
        {
            $this->dispatchSync(CreateAgent::fromRequest($request));
            $notification = array(
                'message' => 'You have successfully sent an application to become an agent. Your application will be reviewed and necessary
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

    
    public function show(Agent $agent)
    {
        return view('pages.agent.show',[
            'agent' => $agent
        ]);
    }

    public function property(Agent $agent)
    {
        return view('pages.agent.property.index',[
            'agent' => $agent
        ]);
    }

    public function prop(Property $property)
    {
        return view('pages.agent.property.show',[
            'property' => $property
        ]);
    }

}
