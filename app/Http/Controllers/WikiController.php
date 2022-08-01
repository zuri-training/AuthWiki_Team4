<?php

namespace App\Http\Controllers;

use App\Models\{
    Category,
    Wiki,
    Rating,
    User
};
use App\Http\Requests\{
    StoreWikiRequest,
    UpdateWikiRequest
};
use Illuminate\{
    Database\Eloquent\SoftDeletes,
    Support\Facades\Auth,
    Http\Request,
    Support\Facades\Validator
};

class WikiController extends Controller
{
    use SoftDeletes;

    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except(['index', 'show', 'search', 'searchAPI', 'indexID']);
    }

    public function index()
    {
        $wiki =  Wiki::orderBy('id', 'desc')->paginate(10, ['*'], 'wikis');
        return view('wiki.index', compact('wiki'));
    }

    public function create()
    {
        return view('wiki.create');
    }

    public function store(StorewikiRequest $request)
    {
        Wiki::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'usage' => $request->usage
        ]);
        return redirect(route('user.wiki'))->with('success', 'Wiki created successful!');
    }

    public function show(Wiki $wiki)
    {
        $wiki->touch('viewed_at');
        $wiki->increment('views');
        return view('wiki.show', compact('wiki'));
    }

    public function edit(Wiki $wiki)
    {
        return view('wiki.edit', compact('wiki'));
    }

    public function update(UpdatewikiRequest $request, Wiki $wiki)
    {
        $wiki->update([
            'usage' => $request->input('usage')
        ]);
        return redirect(route('wiki.show', compact('wiki')))->with('success', 'Wiki details updated!');
    }

    public function destroy(Wiki $wiki)
    {
        $wiki->softDelete();
        return redirect(route('user.wiki'))->with('success', 'Wiki deleted!');
    }

    public function destroyPerm(Wiki $wiki)
    {
        $wiki->forceDelete();
        return redirect(route('user.wiki'))->with('success', 'Wiki deleted!');
    }

    public function indexID(User $user)
    {
        $wiki =  Wiki::where('user_id', $user->id)
            ->latest('updated_at')
            ->paginate(10, ['*'], 'wikis');
        return view('user.index', compact('wiki'));
    }

    // public function search($keyword) {
    //     $wiki = Wiki::where('title', 'LIKE', "%{$keyword}%")
    //         // ->where(function($query) {
    //         //     if(request()->has('category')) {
    //         //         $findCategory = Category::where('stack', request()->input('category'))->firstOrFail();
    //         //         $query->where('category_id', $findCategory->id);
    //         //     }
    //         // })
    //         // ->paginate(10, ['*'], 'search_wikis');
    //         ->get();
    //         return $wiki;
    //     return view('wiki.search', [
    //         'wiki' => $wiki
    //     ]);
    // }

    // public function searchAPI(Request $request) {
    //     $validator = Validator::make($request->all(), [
    //         'keyword' => ['required', 'string', 'max:25']
    //     ]);
    //     if($validator->fails()) {
    //         return response()->json([
    //             'status' => false
    //         ]);
    //     }
    //     $wiki = Wiki::select('title')
    //         ->where('title', 'LIKE', "%{$request->keyword}%")
    //         // ->where(function($query) {
    //         //     if(request()->has('category')) {
    //         //         $findCategory = Category::where('stack', request()->input('category'))->firstOr(function(){
    //         //             exit(
    //         //                 json_encode([
    //         //                     'data' => null
    //         //                 ])
    //         //             );
    //         //         });
    //         //         $query->where('category_id', $findCategory->id);
    //         //     }
    //         // })
    //         ->limit(15)
    //         ->get();
    //     return response()->json([
    //         'data' => $wiki
    //     ]);
    // }
    public function rating(Request $request, Wiki $wiki)
    {
        $validator = Validator::make($request->all(), [
            'rating' => ['required', 'numeric', 'min:0', 'max:5']
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => false
            ]);
        }
        Rating::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'wiki_id' => $wiki->id
            ],
            [
                'rating' => $request->rating
            ]
        );
        return response()->json([
            'status' => true,
            'ratings' => $wiki->stars
        ]);
    }
}
