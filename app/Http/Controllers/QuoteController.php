<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Quote;
use App\Models\Topic;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index(Request $request)
    {
        $quote = Quote::take($request->count)->skip(($request->page - 1) * $request->count)->get();

        foreach ($quote as $item) {
            unset($item["updated_at"]);
            unset($item["created_at"]);
        }

        return response()->json($quote, 200)->header('Content-Type', 'application/json');
    }

    // Hiển thị tất cả các quotes của một tác giả nào đó
    public function author($path)
    {
        $quote = Author::where("path", $path)->first()->quotes;

        foreach ($quote as $item) {
            unset($item["updated_at"]);
            unset($item["created_at"]);
        }

        return response()->json($quote, 200)->header('Content-Type', 'application/json');
    }

    //Hiển thị tất cả các quotes theo chủ để nào đó
    public function topic($path)
    {
        $quote = Topic::where("path", $path)->first()->quotes;

        foreach ($quote as $item) {
            $item["author"] = Author::find($item->author_id);
            unset($item["author"]["updated_at"]);
            unset($item["author"]["created_at"]);
            unset($item["author"]["profession_id"]);

            unset($item["updated_at"]);
            unset($item["created_at"]);
            unset($item["topic_id"]);
            unset($item["author_id"]);
        }

        return response()->json($quote, 200)->header('Content-Type', 'application/json');
    }

    //Xem riêng một quote
    public function show($id)
    {
        $quote = Quote::find($id);

        return response()->json($quote, 200)->header('Content-Type', 'application/json');
    }

    //Tạo quotes mới
    public function create(Request $request)
    {
        $quote = new Quote();

        $quote->content = $request->content;
        $quote->topic_id = $request->topic_id;
        $quote->author_id = $request->author_id;
        $quote->save();
    }

    //Sửa quotes
    public function update(Request $request,$id)
    {
        $quote = Quote::find($id);

        $quote->content = $request->content;
        $quote->topic_id = $request->topic_id;
        $quote->author_id = $request->author_id;
        $quote->save();
    }

    //Xóa quote
    public function delete($id)
    {
        Quote::destroy($id);
    }
}
