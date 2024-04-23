<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
public function __construct(){
    $this->middleware('auth');
}
public function index(){
    $user=Auth::user();
    $data= Article::all();
    // $data= Listtodo::where('user_id',$user->id)->
    // orderBy('check_id', 'ASC')->latest()->get();

    return view('index',['articles'=> $data,'user'=>$user->id]);
}
public function detail($id){
    return "Contoller  err+artilce Detail = $id";
}
public function create(){
    $validator = validator(request()->all(), [
        'body'=>'required',
    ]);
    if($validator->fails()){
        return back()->withErrors($validator);
    }
    $article = new Article;
    $article->body = request()->body;
    $article->user_id=auth()->user()->id;
    $article->save();
    return redirect('/user');
}
public function delete($id){
    $article = Article::find($id);
    $article->delete();
    return redirect('/user');
}
public function edit($id){
    $article = Article::find($id);
    // return redirect('/user/edit');
    return view('edit',['arti'=>$article]);
}
public function update($id){
    $article = Article::find($id);
    $article->body = request()->body;
    $article->save();

    return redirect('/user');
}
public function removeMulti(Request $request)
{
    $ids = $request->ids;
    Article::whereIn('id',explode(",",$ids))->delete();
    return response()->json(['status'=>true,'message'=>"Articles are successfully removed."]);

}
public function updateItem(Request  $request) //Listtodo $request
{
    $data = $request->id; // Retrieve all data sent in the request

//     $itemId =  $request->id;
//    $check_Id =  $request->check_id;
    $article = Article::find($request->id);
    $article->check_id = $request->check_id;
    $article->save();
    // Perform database update based on checkbox state
    // $item = Item::findOrFail($itemId);
    // $item->update(['checked' => $isChecked]);

    return   response()->json(['success' =>true         // Retrieve all data sent in the request
]);
}
}
