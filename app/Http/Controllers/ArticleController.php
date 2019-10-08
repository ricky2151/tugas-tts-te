<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Article;
use App\Filter;
use App\User;
use Carbon\Carbon;
use App\ArticleFilters;
 
class ArticleController extends Controller
{
    public function index()
    {
        // Article::where('expire_date',null)->update(['expired' => 'permanent']);
        $article =  Article::where('expired','false')->orWhere('expired','permanent')->orderBy('id_article','desc')->paginate(8);
        $filters = Filter::all();
        return view('index',['article'=>$article, 'status' => 'newest', 'filters'=>$filters]);
      
    }
    public function showArticleAdd()
    {
        //menampilkan kategori
        $filters = Filter::all();
        return view('articleStore', ['filters' => $filters]);
    }
    public function showExpired(){
        $article = Article::where('expired','true')->orderBy('id_article','desc')->paginate(8);
        return view('index',['article' => $article, 'status' => 'expired']);
    }
 
    public function show($id)
    {
        $article = Article::where('id_article',$id)->first();
        $user = User::where('username', $article->author)->first();
        return view('articlePost',['article'=>$article, 'author'=>$user]);
    }

    public function store(Request $request)
    {
        
        //return response()->json($request['expire_date']);
        $file = $request->file('foto');
        if(is_null($file))
        {
            $image = '##no-image##';
        }
        else{
            $destinationPath = 'uploads';
            $image = $request->title.'00.'.$file->getClientOriginalExtension();

            $file->move($destinationPath,$image);
        }


        if(is_null($request->link)){
            $request->link = '##no-link##';
        }

        if($request['expire_date'] == ''){
            $request['expire_date'] = null;
            $expired = 'permanent';
        }
        else $expired = 'false';
            
        if($request->body == null)
            $request->body = '';

        if($request->kategori == null)
            $request->kategori = '';

        try{
            $idartikelbaru = Article::create([
                'title' => $request->title,
                'body' => $request->body,
                'author' => $_SESSION['author'],
                'status' => 'preview',
                'image' => $image,
                'link' => $request->link,
                'expire_date' => $request['expire_date'],
                'expired' => $expired
            ])->id;

            $kategori = $request->input('kategori');
            
            foreach($kategori as $filter){
                
                $id_artikelfilter = ArticleFilters::create([
                    'foreignId_article' => $idartikelbaru,
                    'foreignId_filter' => $filter
                ])->id;   
            }
            
        }
        catch(QueryException $e){
            return redirect('/article/add')->with('alert-failed','Gagal tambah pengumuman');
        }
        finally{
            //ArticleController::sendNotification($request);
            //return redirect('/')->with('alert-success','Berhasil tambah pengumuman');
            $lastArticle = Article::latest()->first();
            $user = User::where('username', $lastArticle->author)->first();
            return redirect('/articles/'.$lastArticle->id_article.'/preview')->with('author',$user);
            //return response()->json($id_artikelfilter);
        }
    }

    public function update(Request $request, $id)
    {
        $article = Article::where('id_article',$id);
        $request->replace($request->except('_token'));
        if($request['expire_date'] == ''){
            $request['expire_date'] = null;
            $request['expired'] = 'permanent';
        }
        else{
            $request['expired'] = 'false';
        }
        if($request->foto == "")
            $request->replace($request->except('foto'));
        $article->update($request->all());

        return redirect('articles/'.$id.'/preview')->with('alert-success','Berhasil edit pengumuman');
    }

    public function delete(Request $request, $id)
    {
        $article = Article::where('id_article',$id);
        $article->delete();

        return redirect('/')->with('alert-success','Berhasil hapus pengumuman');
    }

    public function updateForm($id){
        $article = Article::where('id_article',$id)->first();
        return view('articleUpdate',['article'=>$article]);
    }

    public function preview($id){
        $article = Article::where('id_article',$id)->first();
        $user = User::where('username', $article->author)->first();
        $idArticle = ArticleFilters::where('foreignId_article', $id)->get();

        $tempFilter[] = '';
        $i = 0;
        foreach($idArticle as $item){
            
            $filters = Filter::select('kategori')->where('id_filter', $item->foreignId_filter)->first();
            $tempFilter[$i] = $filters;
            $i++;
        }
      
        return view('articlePreview',['article'=>$article, 'author'=>$user, 'articleFilters'=>$idArticle, 'filters'=>$tempFilter]);
        //return response()->json($ff);
    }

    public function post($id){
        Article::where('id_article',$id)->update(['status'=>'posted']);

        $article = Article::where('id_article',$id)->first();
        ArticleController::sendNotification($article);

        

        return redirect('/')->with('alert-success','Berhasil posting pengumuman');
    }

    public function sendNotification($article)
    {
        define('SERVER_KEY', 'AAAA-KMnq9M:APA91bGdWqO3us1aLWC0UBSUU_G8H-hhDR_AtGNoe5QWIKCqRWALzT1bVuf11PSJTHC7M2vtpjxWWYyqKHZ4yI12ybJ9veU8so2-F_HrgXg6sTyrH0Mmoxn29IfkGyikOfqt9MuJ_brY');
        define('DEVICE_TOKEN','dhykaxnmxOI:APA91bGPBk52xD9a2X1nWH-eb-AQoTPQdhXySBNU3FvOBG3X_7-JpyFBUNDz_9kKvUu9AjoNpe4m4V-UWmcYH-dpvMLWxMVDjlEgWer5_nEcefAOJWBCiEg0r4vFc8zHvTpaFwt5DNPF');
        // $registrationIds = array('dhykaxnmxOI:APA91bGPBk52xD9a2X1nWH-eb-AQoTPQdhXySBNU3FvOBG3X_7-JpyFBUNDz_9kKvUu9AjoNpe4m4V-UWmcYH-dpvMLWxMVDjlEgWer5_nEcefAOJWBCiEg0r4vFc8zHvTpaFwt5DNPF');

        $arrNotificationMessage =   array(
            'title'=>$article->title,
            'text'=>$article->body,
            'sound' => "mySound",
            'priority'=>"high"                              
        );

        $extraData  =   array(
        'any_extra_data'    =>"any data"
        );
        $deviceToken    =   DEVICE_TOKEN;
        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
        $header=array('Content-Type: application/json',
        "Authorization: key=".SERVER_KEY);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );

        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \"notification\": ".json_encode($arrNotificationMessage).", \"data\":" . json_encode($extraData) . ", \"to\" : ".json_encode($deviceToken)."}");

        $result =   curl_exec($ch);
        curl_close($ch);

        if ($result === FALSE) {
            //log_message("DEBUG", 'Curl failed: ' . curl_error($ch));
        }
        else{
            $result =   json_decode($result);
            if($result->success ===1){
                return true;
            }
            else{
                return false;
            }
        }
        return response()->json("CCCC");
    }
}