<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'verfied', 'isAdmin']);
  }
  public function create(){
    return view('file');
  }
  public function store(Request $request){
    $request->validate([
      'file' => 'required|mimes:zip|max:2048'
    ]);
    if($request->file()) {
      $id = Auth::id();
      $fileName = time().'_'.$request->file->getClientOriginalName();
      $filePath = $request->file('file')->storeAs("uploads/{$id}/", $fileName, 'public');
      File::create([
        'user_id' => $id,
        'name' => $fileName,
        'file_dir' => '/storage/' . $filePath
      ]);
      return back()
      ->with('success','File has been uploaded.')
      ->with('file', $fileName);
    }
  }
}