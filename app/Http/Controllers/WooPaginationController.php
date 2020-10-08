<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WooPaginationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $key = env('WOO_API_KEY');
        $secret = env('WOO_API_SECRET');
        $url = 'https://aksel.frb.io/wp-json/wc/v3/';
        $endpoint = 'customers';
        
        $response = Http::withBasicAuth($key, $secret)->get($url);

        $client = new Client([
            'base_uri' => $url,
        ]);

        $response = $client->get($endpoint, [
            'auth' => [
                $key,
                $secret
            ],
            'query' => [
                'per_page' => 2,
            ]
        ]);

        $headers = $response->getHeaders();
        foreach ($headers as $name => $header) {
            if($name == 'X-WP-TotalPages') {
                foreach ($header as $value) {
                    $totalPages = $value;
                }
            }
        }

    for ($i=1; $i <= $totalPages; $i++) { 
        $orders = $client->get( $endpoint, [
            'auth' => [
                $key,
                $secret
            ],
            'query' => [
                'per_page' => 2,
                'page' => $i,
            ]
            ]);
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
