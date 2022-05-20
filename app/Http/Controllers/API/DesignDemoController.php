<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DesignDemo;
use Validator;

class DesignDemoController extends Controller
{
    // all design demo
    public function index()
    {
        $designs = DesignDemo::all()->toArray();
        return array_reverse($designs);
    }

    // store design
    public function store(Request $request)
    {	
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|unique:design_demos',
            'file' => 'required',
        ],[
            'name.required' => 'The Template name field is required.',
            'name.unique' => 'The Template name has already been taken.',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ],201);
        }
        if ($request->file->getClientOriginalExtension() != 'vue') {
            return response()->json([
                'errors' => ['file' => 'The file must be a file of type: vue.'],
            ],201);
        }
    	//store and get filepath
    	$filename = time().'_'.$request->file->getClientOriginalName();
        $filepath = $request->file('file')->move(resource_path('js/components/Uploads/'), $filename);
        $design = DesignDemo::create([
            'name' => $request->name,
            'filepath' => 'components/Uploads/'.$filename
        ]);
        

        return response()->json('The Design successfully added');
    }
    public function getDemo($demo){
    	$demo = DesignDemo::where('name',$demo)->first()->toArray();
    	return response()->json($demo);
    }

    // edit design
    public function edit($id)
    {
        $design = DesignDemo::find($id);
        return response()->json($design);
    }

    // update design
    public function update($id, Request $request)
    {
        $design = DesignDemo::find($id);
        $design->update($request->all());

        return response()->json('The Design successfully updated');
    }

    // delete design
    public function delete($id)
    {
        $design = DesignDemo::find($id);
        $design->delete();

        return response()->json('The Design successfully deleted');
    }
}
