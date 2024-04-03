<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        return $response->json();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::post('https://jsonplaceholder.typicode.com/posts',$request);
        return $response->json();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts/'.$id);
        $data = $response->json();
        return ['title' => $data['title']];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //$response = Http::put('https://jsonplaceholder.typicode.com/posts/'.$id,$request);
        $response = Http::patch('https://jsonplaceholder.typicode.com/posts/'.$id,$request);

        return $response->json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = Http::delete('https://jsonplaceholder.typicode.com/posts/'.$id);
        if ($response->successful()){
            return ['mensaje' => 'Post Eliminado Correctamente'];
        } else {
            return ['mensaje' => 'Ocurrió un error al eliminar'];
        }

    }

    public function filteringResources(String $id){
        $response = Http::get("https://jsonplaceholder.typicode.com/posts?userId=$id");
        return $response->json();
    }

    public function listingNestedResources(String $id){
        $response = Http::get("https://jsonplaceholder.typicode.com/posts/$id/comments");
        return $response->json();
    }
}
