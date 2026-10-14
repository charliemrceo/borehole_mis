<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class paymentController extends Controller
{
    public function createPayment(Request $request){
        $validated= $request->validate([
            'record_date'=>'required|date',
        'narration'=>'required|numeric',
        
        'amount'=>'required|numeric',
        'plot_id'=>'required|integer|exits:plots,id',
        ]);

        $payment= new payment();
        $payment->record_date= $validated('record_date');
        $payment->narration= $validated('narration');
    
        $payment->amount= $validated('amount');
        $payment->plot_id= $validated('plot_id');
       
        try{
            $payment->save();
            return response()->json([
                'message'=>'payment saved successfully.',
                'payment'=>$payment
            ], 200);
        } catch(\Execption $e){
            return response()->json([
             'message'=>'Error trying to fetch.',
                'error'=>$e->getMessage()
            ], 500);
            
}

}

    public function readAllPayments(){
        try{
            $payments= payment::all();
            return response()->json([
                'payments'=>$payments
            ], 200);
        } catch(\Exceptions $e){
            return response()->json([
             'message'=>'Error trying to fetch.',
                'error'=>$e->getMessage()
            ], 500);
        }

    }
    
     public function readPayment(){
        try{
            $payments= payment::where('id',$id)->first();
            return response()->json([
                'payments'=>$payment
            ], 200);
        } catch(\Exceptions $e){
            return response()->json([
             'message'=>'Error trying to fetch.',
                'error'=>$e->getMessage()
            ], 500);
        }

}

public function updatePayment($id, Request $request){
     $validated= $request->validate([
            'record_date'=>'required|date',
        'narration'=>'required|numeric',
       
        'amount'=>'required|numeric',
        'plot_id'=>'required|integer|exits:plots,id',
        ]);

        $payment= new payment();
        $payment->record_date= $validated('record_date');
        $payment->narration= $validated('narration');
     
        $payment->amount= $validated('amount');
        $payment->plot_id= $validated('plot_id');
       
        try{
            $payment->save();
            return response()->json([
                'message'=>'payment saved successfully.',
                'payment'=>$payment
            ], 200);
        } catch(\Execption $e){
            return response()->json([
             'message'=>'Error trying to fetch.',
                'error'=>$e->getMessage()
            ], 500);
        }
}

public function deletePayment($id){
    try{
        $payment =payment::where('id, $id')->first();
        if(!$payment){
            return response()->json("Record not found.");
        }

        $payment->delete();
        return response()-json("Record delete successfully.");
    }catch(\Execption $e){
            return response()->json([
             'message'=>'Error trying to fetch.',
                'error'=>$e->getMessage()
            ], 500);
    }
    
}

public function searchPayment($name){
     try{
       $payment = payments::where('record_date', 'LIKE', "%{$name}%")->first;
            return response()->json([
                'payments'=>$payments
            ], 200);
        } catch(\Execption $e){
            return response()->json([
             'message'=>'Error trying to fetch.',
                'error'=>$e->getMessage()
            ], 500);
        }
}
}

