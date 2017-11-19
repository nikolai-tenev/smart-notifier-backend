<?php
/**
 * Created by IntelliJ IDEA.
 * User: bh2o
 * Date: 14.11.17
 * Time: 14:56
 */

namespace App\Http\Controllers;


use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvoiceController extends Controller
{
    public function index()
    {
        return Invoice::all();
    }

    public function show(Invoice $article)
    {
        return $article;
    }

    public function store(Request $request)
    {
        $article = Invoice::create($request->all());

        return response()->json($article, Response::HTTP_CREATED);
    }

    public function update(Request $request, Invoice $article)
    {
        $article->update($request->all());

        return response()->json($article, Response::HTTP_OK);
    }

    public function delete(Invoice $article)
    {
        $article->delete();

        return response()->json($article, Response::HTTP_OK);
    }
}