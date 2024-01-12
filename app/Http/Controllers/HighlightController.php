<?php
 
namespace App\Http\Controllers;
 
use App\Http\Resources\HighlightResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Highlight;
 
class HighlightController extends Controller
{
    /**
     * Show the form to create a new blog post.
     */
    public function index(): JsonResource
    {
        return HighlightResource::collection(
            Highlight::orderBy('order_column','desc')->where('status','published')->get(),
        );
    }
    public function show($slug): JsonResource
    {
        return new HighlightResource(Highlight::where('slug',$slug)->first());
    }
 
    
}