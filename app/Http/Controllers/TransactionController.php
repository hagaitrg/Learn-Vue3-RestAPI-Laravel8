<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::orderBy('time','DESC')->get();

        if ($transaction) {
            $response = [
                'message' => 'List transaction order by time',
                'data' => $transaction
            ];
    
            return response()->json($response, 200);
        }else{
            $response = [
                'message' => 'Data not Found',
            ];
    
            return response()->json($response, 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'=>['required'],
            'amount'=>['required','numeric'],
            'type' =>['required', 'in:expense,revenue']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $transaction = Transaction::create($request->all());
            $response = [
                'message' => 'Transaction created',
                'data' => $transaction
            ];

            return response()->json($response, 200);

        } catch (QueryException $e) {
            return response()->json([
                'message' =>"Failed". $e->errorInfo
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
        $transaction = Transaction::findOrFail($id);
        $validator = Validator::make($request->all(),[
            'title'=>['required'],
            'amount'=>['required','numeric'],
            'type' =>['required', 'in:expense,revenue']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $transaction->update($request->all());
            $response = [
                'message' => 'Transaction updated',
                'data' => $transaction
            ];

            return response()->json($response, 200);

        } catch (QueryException $e) {
            return response()->json([
                'message' =>"Failed". $e->errorInfo
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
