<?php

namespace App\Http\Controllers;

use App\Models\{
    Wiki,
    Reaction,
    User
};
use App\Http\Requests\{
    StoreWikiRequest,
    UpdateWikiRequest
};
use Illuminate\{
    Support\Facades\Auth,
    Http\Request,
    Support\Facades\Validator
};

class ForumController extends Controller
{
}
