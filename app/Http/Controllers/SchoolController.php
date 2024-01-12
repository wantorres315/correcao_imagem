<?php
 
namespace App\Http\Controllers;
 
use App\Http\Resources\SchoolResource;
use App\Http\Resources\TeamsResource;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Schools;
use App\Models\Teams;
 
class SchoolController extends Controller
{
    /**
     * Show the form to create a new blog post.
     */
    public function index(): JsonResource
    {
        return SchoolResource::collection(
            Schools::orderBy('order_column','desc')->get()
        );
    }
    public function show($slug): JsonResource
    {
        return new SchoolResource(Schools::where('slug',$slug)->first());
    }

    public function teams($slug): JsonResource
    {
        $school = Schools::where('slug',$slug)->first();
        $teams = Teams::where('school_id',$school->id)->get();
        return TeamsResource::collection($teams);
    }
 
    
}