<?php

namespace App\Http\Controllers;

use App\Models\{
    Wiki
};
use Illuminate\{
    Http\Request,
    Support\Facades\Validator
};

class PageController extends Controller
{
    public function library(Request $request) {
        $validator = Validator::make($request->all(), [
            'keyword' => 'required|string|between:3,25',
            'stack' => 'string|max:10'
        ]);
        $keyword = $request->keyword;
        $wikis = Wiki::where('type', 'wiki')
            ->where(function($query) {
                if(request()->has('keyword')) {
                    $query->where('title', 'LIKE', '%'.request()->keyword.'%');
                }
                if(request()->has('stack')) {
                    $query->where('stack', request()->stack);
                }
            })
            ->paginate(15);
        return view('library', compact('wikis'));
    }
}
