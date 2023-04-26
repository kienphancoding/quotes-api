<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    //Hiển thị tất cả các nghề nghiệp
    public function index()
    {
        $profession = Profession::all();
        foreach ($profession as $item) {
            unset($item["updated_at"]);
            unset($item["created_at"]);
        }
        return response()->json($profession, 200)->header('Content-Type', 'application/json');
    }

    //Hiển thị nghề nghiệp cụ thể
    public function show($id)
    {
        $profession = Profession::find($id);
        unset($profession["updated_at"]);
        unset($profession["created_at"]);
        
        return response()->json($profession, 200)->header('Content-Type', 'application/json');
    }

    // Hiển thị tất cả nghề nghiệp theo thứ tự A-Z
    public function order()
    {
        $profession = Profession::orderBy("name")->get();
        foreach ($profession as $item) {
            unset($item["updated_at"]);
            unset($item["created_at"]);
        }
        return response()->json($profession, 200)->header('Content-Type', 'application/json');
    }

    // Example : json
    // {
    //     "name":"Cầu thủ",
    //     "path":"cau-thu"
    // }

    //Thêm một nghề nghiệp
    public function create(Request $request)
    {
        $author = new Profession();

        $author->name = $request->name;
        $author->path = $request->path;
        $author->save();
    }

    //Sửa dữ liệu nghề nghiệp
    public function update(Request $request, $id)
    {
        $author = Profession::find($id);

        $author->name = $request->name;
        $author->path = $request->path;
        $author->save();
    }
}
