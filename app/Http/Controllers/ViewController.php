<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ViewController extends Controller
{
	public function goHome()
	{
		return view('home');
	}
    public function goViewArticle()
    {
    	$dataarticle = DB::table('articles')->get();

    	$data['articles'] = json_decode($dataarticle, true);

    	return view('read_article', $data);
    }
    public function goViewCategory()
    {
    	$datacategory = DB::table('categories')->get();
    	$data['categories'] = json_decode($datacategory, true);

    	return view('read_category', $data);
    }
    public function goEditArticle($id)
    {
    	if($id)
    	{
    		$dataarticle = DB::table('articles')->select(['id', 'title', 'body'])->where('id',$id)->first();
    		$dataarticlecategory = DB::table('article_category')->where('article_id', $id)->join('categories', 'categories.id', 'article_category.category_id')->select(['article_category.id', 'article_category.category_id', 'categories.name'])->get();
    		$datacategory = DB::table('categories')->get();
    		$data['article'] = $dataarticle;
    		$data['article_category'] = json_decode($dataarticlecategory, true);
    		$data['category'] = json_decode($datacategory, true);
    		return view('add_edit_article', compact('data'));
    	}
    	else
    	{
    		dd("id harus ada");
    	}
    }
    public function goAddArticle()
    {
    	$datacategory = DB::table('categories')->get();
    	$data['category'] = json_decode($datacategory, true);
    	//dd($data['category']);
    	return view('add_edit_article', $data);
    }



    public function goEditCategory($id)
    {
    	if($id)
    	{
    		$category = DB::table('categories')->where('id', $id)->first();
    		//dd($datacategory);
    		
    		//$result['category'] = json_decode($data, true);
    		//dd($data);
    		return view('add_edit_category', compact('category'));
    	}
    	else
    	{
    		dd("id harus ada");
    	}
    }
    public function goAddCategory()
    {
    	return view('add_edit_category');
    }

}
