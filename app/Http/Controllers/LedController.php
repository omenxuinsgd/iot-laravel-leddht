<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\Led;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $led = Led::get();
        $response = [
            'message' => 'status untuk on/off lampu',
            'data' => $led
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
        $validator = Validator::make($request->all(), [
            'status' => ['required']
        ]);

        if($validator -> fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            //code...
            $led = Led::create($request->all());
            $response = [
                'message' => 'Led Created',
                'data' => $led
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
        $led = Led::findOrFail($id);
        
        $response = [
            'message' => 'status pada led',
            'data' => $led
        ];
        return response()->json($response, Response::HTTP_OK);
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
        $led = Led::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => ['required'],
        ]);

        if($validator -> fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            //code...
            $led->update($request->all());
            $response = [
                'message' => 'Led Updated',
                'data' => $led
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            //throw $th;
            return response()->json([
                'message' => 'failed: ' . $e->errorInfo
            ]);
        }
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
