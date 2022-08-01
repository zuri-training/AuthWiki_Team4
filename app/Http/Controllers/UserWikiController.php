<?php

namespace App\Http\Controllers;

use App\Models\{
    Wiki,
    Ratings,
    Comments,
    Votes
};
use App\Http\Requests\{
    StoreWikiRequest,
    UpdateWikiRequest
};
use Illuminate\{
    Database\Eloquent\SoftDeletes,
    Support\Facades\Auth,
    Http\Request
};

class UserWikiController extends Controller
{
    use SoftDeletes;

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

}
