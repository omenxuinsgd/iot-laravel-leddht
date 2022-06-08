<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\Dht;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DhtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dht = Dht::orderBy('id', 'DESC')->get();
        $response = [
            'message' => 'data lists of dht11',
            'data' => $dht
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'temperature' => ['required'],
            'humidity' => ['required']
        ]);

        if($validator -> fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            //code...
            $dht = Dht::create($request->all());
            $response = [
                'message' => 'Dht Created',
                'data' => $dht
            ];
            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $e) {
            //throw $th;
            return response()->json([
                'message' => 'failed: ' . $e->errorInfo
            ]);
        }
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
