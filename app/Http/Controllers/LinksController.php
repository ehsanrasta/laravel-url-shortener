<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowShortLink;
use App\Http\Requests\StoreShortLink;
use App\Link;
use Carbon\Carbon;
use DB;
use App\Http\Resources\Link as LinkResource;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    public function index()
    {
        $links = $this->getLinksForUserOrGuest();

        if (request()->wantsJson()) {
            return $links->toJson();
        }

        /**
         * TODO: Do something when the request does not want JSON.
         */
    }

    private function getLinksForUserOrGuest()
    {
        if (auth()->guest()) {
            return collect();
        }

        $links = auth()->user()->links()->get();

        return $links;
    }

    public function create()
    {
        return view('links.create');
    }

    // TODO: This is more like a CreateShortLinkRequest
    public function store(StoreShortLink $request)
    {
        $data = $request->validated();

        $link = $this->createLinkForUserOrGuest($data);

        return response()->json(new LinkResource($link));
    }

    private function createLinkForUserOrGuest($data)
    {
        if (auth()->guest()) {
            return Link::create($data);
        }

        return auth()->user()->links()->create($data);
    }

    public function show(ShowShortLink $request, $short)
    {
        $data = $request->validated();

        $link = Link::getLinkInstanceOrNull($request->short);

        if (!isset($link)) {
            abort(404);
        }

        $link->addClick(Carbon::now());

        return redirect()->to($link->original);
    }
}
