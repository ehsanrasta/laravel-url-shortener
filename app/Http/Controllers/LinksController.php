<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class LinksController extends Controller
{

    public function create()
    {
        return view('links.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'original' => 'required|url',
        ]);

        $link = auth()->user()->links()->create($data);

        return response()->json([
            'id' => $link->id,
            'original' => $link->original,
            'short' => $link->short(),
        ]);
    }

    public function show(Request $request)
    {
        $data = $request->validate(
            array_merge(
                $request->all(),
                ['short' => $request->short]
            ), [
            'short' => 'required',
        ]);

        $link = Link::find(app()->encoder->decode($request->short))
            ->first();

        return redirect()->to($link->original);
    }
}
