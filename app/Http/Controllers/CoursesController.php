<?php
 
namespace App\Http\Controllers;
 
use App\Http\Resources\CoursesResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Courses;
 
class CoursesController extends Controller
{
    /**
     * Show the form to create a new blog post.
     */
    public function index($lang): JsonResource
    {
        $courses = Courses::orderBy('order_column','desc')->where('status','published')->get();
        return CoursesResource::collection(
            $courses
        );
    }
    public function show($slug): JsonResource
    {
        return new CoursesResource(Courses::where('slug',$slug)->first());
    }
 
    
}