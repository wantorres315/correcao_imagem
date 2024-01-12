<?php
 
namespace App\Http\Controllers;
 
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Projects;
 
class ProjectsController extends Controller
{
    /**
     * Show the form to create a new blog post.
     */
    public function index(): JsonResource
    {
        return ProjectResource::collection(
            Projects::orderBy('order_column','desc')->where('status','published')->get()
        );
    }
    public function show($slug): JsonResource
    {
        return new ProjectResource(Projects::where('slug',$slug)->where('status','published')->first());
    }
 
    
}