<?php

namespace App\Http\Controllers;

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
         *       Redirect or show a view? Extract JSON logic to an API controller?
         */
    }

    private function getLinksForUserOrGuest()
    {
        // TODO: Refactor to Resource response.

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

    public function show(Request $request)
    {
        $data = $request->validate(
            array_merge($request->all(),
                ['short' => $request->short]),
            ['short' => 'required']
        );

        $link = Link::getLinkInstanceOrNull($request->short);

        if (!isset($link)) {
            abort(404);
        }

        $link->addClick(Carbon::now());

        return redirect()->to($link->original);
    }
}
