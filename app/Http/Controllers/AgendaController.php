<?php
 
namespace App\Http\Controllers;
 
use App\Http\Resources\AgendaResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Agenda;
 
class AgendaController extends Controller
{
    /**
     * Show the form to create a new blog post.
     */
    public function index($lang): JsonResource
    {
        $agenda = Agenda::orderBy('order_column','desc')->where('status','published')->get();
        return AgendaResource::collection(
            $agenda
        );
    }
    public function show($slug): JsonResource
    {
        return new AgendaResource(Agenda::where('slug',$slug)->first());
    }
 
    
}