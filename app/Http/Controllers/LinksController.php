<?php

namespace App\Http\Controllers;

use App\Link;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Link as LinkResource;
use App\Http\Resources\LinkCollection;
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

        $links = auth()->user()
            ->links()
            ->orderBy('created_at', 'DESC')
            ->with([
                'clicks' => function ($query) {
                    $query->groupBy(\DB::raw('month, link_id'))
                        ->selectRaw('MONTH(created_at) as month, count(id) as click_count, link_id');
                },
            ])->get();

        return $links;
    }

    public function create()
    {
        return view('links.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'original' => 'required|url',
        ]);

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
