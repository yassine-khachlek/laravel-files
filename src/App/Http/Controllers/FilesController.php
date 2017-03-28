<?php

namespace Yk\LaravelFiles\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Yk\LaravelFiles\App\File;
use Config;
use Response;
use Validator;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::orderBy('id', 'desc')->paginate(10);

        return view('Yk\LaravelFiles::files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Yk\LaravelFiles::files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required_without:files|file',
            'files' => 'required_without:file|array|min:1',
        ]);

        if ($validator->fails()) {

            if($request->ajax())
            {

                return Response::json($validator->messages(), 400);

            }else{

                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();

            }

        }

        if ($request->hasFile('files')) {
            
            foreach ($request->file('files') as $file) {

                if ($file->isValid()) {
                    
                    $record = new File;
                    $record->disk = 'local';
                    $record->name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $record->extension = $file->extension();
                    $record->size = $file->getSize();
                    $record->mime_type = $file->getMimeType();

                    $record->save();

                    $file->storeAs($record->path,  $record->id.'.'.$file->extension(), 'local');

                }

            }

        }

        if ($request->hasFile('file')) {

            $file = $request->file('file');

            if ($file->isValid()) {
                
                $record = new File;
                $record->disk = 'local';
                $record->name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $record->extension = $file->extension();
                $record->size = $file->getSize();
                $record->mime_type = $file->getMimeType();

                $record->save();

                $file->storeAs($record->path,  $record->id.'.'.$file->extension(), 'local');

            }

        }

        return redirect(route('files.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = File::findOrFail($id);

        return Response::make(Storage::disk('local')->get($file->path.'/'.$file->id.'.'.$file->extension), 200)->header('Content-Type', $file->mime_type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
		//
    }

    /**
     * Download the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $file = File::findOrFail($id);

        return Response::make(Storage::disk('local')->get($file->path.'/'.$file->id.'.'.$file->extension), 200)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Transfer-Encoding', 'binary')
            ->header('Expires', '0')
            ->header('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
            ->header('Pragma', 'public');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::findOrFail($id);

        $file->delete();

        return redirect(route('files.index'));
    }
}
