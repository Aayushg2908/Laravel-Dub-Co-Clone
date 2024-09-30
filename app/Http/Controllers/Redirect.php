<?php

namespace App\Http\Controllers;

use App\Models\Shortlink;

class Redirect extends Controller
{
    public function redirect($slug)
    {
        $shortlink = Shortlink::where('slug', $slug)->firstOrFail();
        $shortlink->click_count++;
        $shortlink->save();
        return redirect($shortlink->original_url);
    }
}
