<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShortLinkController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        return view('create-short-link');
    }

    public function createLink(Request $request)
    {
        $this->authorize('create', ShortLink::class);

        $request->validate([
            'url' => 'required|url|max:1000'
        ]);

        $code = Str::random(6);

        if (ShortLink::where('code', $code)->exists()) {
            $code = Str::random(6);
        }

        ShortLink::create([
            'original_url' => trim($request->url),
            'code' => $code,
            'user_id' => auth()->id(),
            'company_id' => auth()->user()->company_id,
        ]);

        return redirect()->route(auth()->user()->role . ".dashboard");
    }

    public function viewShortLinks()
    {
        $name = auth()->user()->name;
        $role = auth()->user()->role;

        $query = ShortLink::with('user', 'company');

        if (auth()->user()->role === 'admin') {
            $query->where('company_id', auth()->user()->company_id);
        } elseif (auth()->user()->role === 'member') {
            $query->where('user_id', auth()->id());
        }

        $links = $query->get();

        return view('short-links', compact(
            'links',
        ));
    }

    public function redirectLink($code)
    {
        $link = ShortLink::with('user', 'company')->where('code', $code)->first();

        if (!$link) {
            return back()->with('invalid_url', 'Invalid link!');
        }
        $link->increment('clicks');

        return redirect($link->original_url);
    }

    public function showAllShortLinks()
    {
        $links = ShortLink::with('user', 'company')->get();
        return view('dashboard', compact('links'));
    }
}
