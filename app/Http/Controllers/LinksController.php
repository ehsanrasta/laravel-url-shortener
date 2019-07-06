<?php

namespace App\Http\Controllers;

use App\Link;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
                'customLink'
            ])->get();

        return $links;

    }

    public function create()
    {
        return view('links.create');
    }

    public function store(Request $request)
    {
        // TODO: Insert a blank row if collision with a custom link?

        $data = $request->validate([
            'original' => 'required|url',
        ]);

        $link = $this->createLinkForUserOrGuest($data);

        return response()->json([
            'id' => $link->id,
            'original' => $link->original,
            'short' => $link->short,
        ]);
    }

    private function createLinkForUserOrGuest($data)
    {
        if (auth()->guest()) {
            return Link::create($data);
        }

        return auth()->user()->links()->create($data);
    }

    public function update(Request $request)
    {
        //todo: validate

        //todo: if previous custom link, delete it and insert new one

        \DB::table('custom_links')
            ->insert([
                'link_id' => app()->encoder->decode($request->short)[0],
                'custom' => $request->custom
            ]);
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
