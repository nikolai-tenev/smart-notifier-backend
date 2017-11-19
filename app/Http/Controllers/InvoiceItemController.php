<?php
/**
 * Created by IntelliJ IDEA.
 * User: bh2o
 * Date: 14.11.17
 * Time: 14:56
 */

namespace App\Http\Controllers;


use App\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvoiceItemController extends Controller
{
    public function index()
    {
        return InvoiceItem::all();
    }

    public function show(InvoiceItem $article)
    {
        return $article;
    }

    public function store(Request $request)
    {
        $article = InvoiceItem::create($request->all());

        return response()->json($article, Response::HTTP_CREATED);
    }

    public function update(Request $request, InvoiceItem $article)
    {
        $article->update($request->all());

        return response()->json($article, Response::HTTP_OK);
    }

    public function delete(InvoiceItem $article)
    {
        $article->delete();

        return response()->json($article, Response::HTTP_OK);
    }
}