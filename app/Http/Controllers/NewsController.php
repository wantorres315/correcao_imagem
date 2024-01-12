<?php
 
namespace App\Http\Controllers;
 
use App\Http\Resources\NewsResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\News;
 
class NewsController extends Controller
{
    /**
     * Show the form to create a new blog post.
     */
    public function index(): JsonResource
    {
        return NewsResource::collection(
            News::orderBy('date','desc')->where('status','published')->get()
        );
    }
    public function show($slug): JsonResource
    {
        return new NewsResource(News::where('slug',$slug)->first());
    }
 
    
}