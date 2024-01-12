<?php
 
namespace App\Http\Controllers;
 
use App\Http\Resources\TestimonialResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Testimonials;
 
class TestimonialController extends Controller
{
    /**
     * Show the form to create a new blog post.
     */
    public function index(): JsonResource
    {
        return TestimonialResource::collection(
            Testimonials::orderBy('order_column','desc')->where('status','published')->get()
        );
    }
    public function show($slug): JsonResource
    {
        return new TestimonialResource(Testimonials::where('slug',$slug)->first());
    }
}