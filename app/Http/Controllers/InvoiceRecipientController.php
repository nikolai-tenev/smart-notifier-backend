<?php
/**
 * Created by IntelliJ IDEA.
 * User: bh2o
 * Date: 14.11.17
 * Time: 14:56
 */

namespace App\Http\Controllers;


use App\Invoice;
use App\InvoiceRecipient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvoiceRecipientController extends Controller
{
    public function index()
    {
        return InvoiceRecipient::all();
    }

    public function show(InvoiceRecipient $article)
    {
        return $article;
    }

    public function store(Request $request)
    {
        $article = InvoiceRecipient::create($request->all());

        return response()->json($article, Response::HTTP_CREATED);
    }

    public function update(Request $request, InvoiceRecipient $article)
    {
        $article->update($request->all());

        return response()->json($article, Response::HTTP_OK);
    }

    public function delete(InvoiceRecipient $article)
    {
        $article->delete();

        return response()->json($article, Response::HTTP_OK);
    }
}