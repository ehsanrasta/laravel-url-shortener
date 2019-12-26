<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShortLink;
use App\Link;
use Carbon\Carbon;
use App\Http\Resources\Link as LinkResource;

class LinksController extends Controller
{
    public function index()
    {
        $links = $this->getLinksForUserOrGuest();

        return response()->json($links);
    }

    public function create()
    {
        return view('links.create');
    }

    public function store(StoreShortLink $request)
    {
        $data = $request->validated();

        $link = $this->createLinkForUserOrGuest($data);

        return response()->json(new LinkResource($link));
    }

    public function show(Request $request, String $slug)
    {
        $link = Link::where('slug',$slug)->firstOrFail();
        $agent = $request->header('User-Agent');
        $link->addClick($agent);

        return redirect()->to($link->original);
    }

    private function getLinksForUserOrGuest()
    {
        if (auth()->guest()) {
            return collect();
        }

        return auth()->user()->links;
    }

    private function createLinkForUserOrGuest($data)
    {
        if (auth()->guest()) {
            return Link::create($data);
        }

        return auth()->user()->links()->create($data);
    }
}
