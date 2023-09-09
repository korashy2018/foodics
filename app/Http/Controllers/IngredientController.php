<?php

namespace App\Http\Controllers;

use App\Domains\Ingreditents\Models\Ingredient;
use App\Http\Requests\Ingredients\StoreIngredientRequest;
use App\Http\Requests\Ingredients\UpdateIngredientRequest;
use Illuminate\Routing\Controller;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix('api/v1/ingredients')]
class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[Get(uri: '/',name: 'index')]
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    #[Post(uri:'/',name:'store')]
    public function store(StoreIngredientRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIngredientRequest $request, Ingredient $ingredient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        //
    }
}
