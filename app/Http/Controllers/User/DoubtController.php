<?php

namespace App\Http\Controllers\User;

use App\Models\Doubt;
use Inertia\Inertia;
use App\Models\Message;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\NewDoubtMessageEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class DoubtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doubts = Doubt::with('user');
        
        if (request('search')) {
            $doubts = Doubt::query();
            $doubts->where('name', 'LIKE', '%'.request('search').'%');
        }
        return Inertia::render('User/Doubts/Index', [
            'doubts' => $doubts->paginate(5)->withQueryString()->setPath('doubts'),
            'filters' => request()->all(['search', 'field', 'direction'])
        ]);
    }

     /**
      * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_doubt(Request $request)
    {
        Doubt::create([
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('-'),
            'is_resolved' => $request->is_resolved,
            'user_id' => auth()->id(),  
        ]);
        return Redirect::route('doubts.index');
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doubt  $doubt
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Doubt $doubt)
    {
        $message = $doubt->messages()->create([
            'user_id' => auth()->id(),  
            'content' => $request->content,
        ]);
        broadcast(new NewDoubtMessageEvent($message, auth()->user()))->toOthers();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doubt  $doubt
     * @return \Illuminate\Http\Response
     */
    public function show(Doubt $doubt)
    {
        $messages = Message::where('doubt_id', $doubt->id)->with('user')->oldest()->get();
        return Inertia::render('User/Doubts/Show', [
            'doubt' => $doubt,
            'messages' => $messages,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doubt  $doubt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doubt $doubt)
    {
        $doubt->update([
            'is_resolved' => 1, 
        ]);
        $doubt->save();
        return Redirect::route('doubts.index');
    }

}
