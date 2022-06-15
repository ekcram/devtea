<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $projects = Project::with('user');

        if (request('search')) {
            $projects = Project::query();
            $projects->where('name', 'LIKE', '%'.request('search').'%');
        }

        return Inertia::render('User/Projects/Index', [
            'projects' => $projects->paginate(5)->withQueryString()->setPath('projects'),
            'filters' => request()->all(['search', 'field', 'direction'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filename = $request->file('file_path')->store('', 'google');

        $dir = '/';
        $recursive = false; // Get subdirectories also?
        $file = collect(Storage::disk('google')->listContents($dir, $recursive))
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            ->sortBy('timestamp')
            ->last();

        Storage::disk('google')->get($file['path']);

        $data = Project::create([
            'file_path' => $file['path'],
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->id()
        ]);
        return back()->with('success','File has been uploaded.');

    }

    public function download($id)
    {
        $fileDatabase = Project::find($id);
        $filename = $fileDatabase->file_path;

        $rawData = Storage::disk('google')->get($filename); // raw content
        $file = Storage::disk('google')->getAdapter()->getMetadata($filename); // array with file info
    
        return response($rawData, 200)
            ->header('ContentType', $file['mimetype'])
            ->header('Content-Disposition', "attachment; filename=$filename");
       
    }

}
