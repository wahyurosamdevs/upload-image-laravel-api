<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Document;
use Validator;
class DocumentController extends Controller
{
    public function index(){
       $documents=Document::all();
       return response()->json($documents);
    }
    public function url(){
        return response()->json(asset('/image/11.jpg'));
     }
    public function store(Request $request){
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
                'detail' => 'required',
            ]
        );
        if ($files = $request->file('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('image'), $imageName);
            $documents = Document::create(
                [
                    'name' => $request->name,
                    'image' => $imageName,
                    'detail' => $request->detail,
                ]
            );
            return response()->json([
                "success" => true,
                "message" => 'Berhasil Upload',
                'image'   => $imageName,
            ]);
        };
    }
}
