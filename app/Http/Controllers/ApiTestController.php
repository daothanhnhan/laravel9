<?php

namespace App\Http\Controllers;

use App\Models\ApiTest;
use Illuminate\Http\Request;

class ApiTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ApiTest::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return ApiTest::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\ApiTest  $apiTest
     * @return \Illuminate\Http\Response
     */
    public function show(ApiTest $apitest)
    {
        return $apitest;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\ApiTest  $apiTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApiTest $apitest)
    {
        // return $request->all();

        // return ApiTest::where('id', 2)->update($request->all());
                  
        $apitest->update($request->all());

        return $apitest;

        // $flight = ApiTest::find(2);
 
        // $flight->title = 'Paris to London';
         
        // $flight->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\ApiTest  $apiTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiTest $apitest)
    {
        $apitest->delete();
    }
}
