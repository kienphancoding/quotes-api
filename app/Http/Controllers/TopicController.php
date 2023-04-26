<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    //Hiển thị tất cả các nghề nghiệp
    public function index()
    {
        $topic = Topic::all();
        foreach ($topic as $item) {
            unset($item["updated_at"]);
            unset($item["created_at"]);
        }
        return response()->json($topic, 200)->header('Content-Type', 'application/json');
    }

    // Hiển thị tất cả nghề nghiệp theo thứ tự A-Z
    public function order()
    {
        $topic = Topic::orderBy("name")->get();
        foreach ($topic as $item) {
            unset($item["updated_at"]);
            unset($item["created_at"]);
        }
        return response()->json($topic, 200)->header('Content-Type', 'application/json');
    }

    // Hiển thị riêng 1 nghề nghiệp
    public function show($id)
    {
        $topic = Topic::find($id);
        unset($topic["updated_at"]);
        unset($topic["created_at"]);
        
        return response()->json($topic, 200)->header('Content-Type', 'application/json');
    }

    // Example : json
    // {
    //     "name":"Chính trị",
    //     "path":"chinh-tri"
    // }

    //Thêm một nghề nghiệp
    public function create(Request $request)
    {
        $author = new Topic();

        $author->name = $request->name;
        $author->path = $request->path;
        $author->save();
    }

    //Sửa dữ liệu nghề nghiệp
    public function update(Request $request, $id)
    {
        $author = Topic::find($id);

        $author->name = $request->name;
        $author->path = $request->path;
        $author->save();
    }
}
