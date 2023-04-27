<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Profession;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    //Hiển thị tất cả các người nổi tiếng
    public function index()
    {
        $author = Author::all();
        foreach ($author as $item) {
            unset($item["updated_at"]);
            unset($item["created_at"]);
            unset($item["profession_id"]);
        }
        return response()->json($author, 200)->header('Content-Type', 'application/json');
    }

    // Hiển thị tất cả người nổi tiếng theo thứ tự A-Z
    public function order()
    {
        $author = Author::orderBy("name")->get();
        foreach ($author as $item) {
            unset($item["updated_at"]);
            unset($item["created_at"]);
            unset($item["profession_id"]);
            unset($item["image_link"]);
            unset($item["description"]);
        }
        return response()->json($author, 200)->header('Content-Type', 'application/json');
    }

    public function singleRead($id)
    {
        $author = Author::find($id);

        unset($author["updated_at"]);
        unset($author["created_at"]);
        unset($author["profession_id"]);

        return response()->json($author, 200)->header('Content-Type', 'application/json');
    }

    // {
    //     "name":"Nikola Tesla 2",
    //     "path":"nikola-tesla",
    //     "image_link":"https://i.pinimg.com/564x/e1/8a/9a/e18a9a0befbfcfa17962ff4df9a53b8c.jpg",
    //     "description": "Là thiên tài vật lí",
    //     "profession_id" : 1
    // }

    //Thêm một người nổi tiếng
    public function create(Request $request)
    {
        $author = new Author();

        $author->name = $request->name;
        $author->path = $request->path;
        $author->image_link = $request->image_link;
        $author->description = $request->description;
        $author->profession_id = $request->profession_id;
        $author->save();
    }

    //Sửa dữ liệu người nổi tiếng
    public function update(Request $request, $id)
    {
        $author = Author::find($id);

        $author->name = $request->name;
        $author->path = $request->path;
        $author->image_link = $request->image_link;
        $author->description = $request->description;
        $author->profession_id = $request->profession_id;
        $author->save();
    }

    // Hiển thị các tác giả theo từng nghề nghiệp
    public function profession($path)
    {
        $author = Profession::where("path", $path)->first()->author;

        foreach ($author as $item) {
            unset($item["updated_at"]);
            unset($item["created_at"]);
            unset($item["profession_id"]);
        }

        return response()->json($author, 200)->header('Content-Type', 'application/json');
    }
}
