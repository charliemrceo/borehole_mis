<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function createBilling(Request $request){
        $validated= $request->validate([
            'record_date'=>'required|date',
        'meter_reading'=>'required|numeric',
        'units_used'=>'required|numeric',
        'amount'=>'required|numeric',
        'plot_id'=>'required|integer|exits:plots,id',
        ]);

        $billing= new Billing();
        $billing->record_date= $validated('record_date');
        $billing->meter_reading= $validated('meter_reading');
        $billing->units_used= $validated('units_used');
        $billing->amount= $validated('amount');
        $billing->plot_id= $validated('plot_id');
       
        try{
            $billing->save();
            return response()->json([
                'message'=>'Billing saved successfully.',
                'billing'=>$billing
            ], 200);
        } catch(\Execption $e){
            return response()->json([
             'message'=>'Error trying to fetch.',
                'error'=>$e->getMessage()
            ], 500);
            
}

}

    public function readAllBillings(){
        try{
            $billings= Billing::all();
            return response()->json([
                'billings'=>$billings
            ], 200);
        } catch(\Exceptions $e){
            return response()->json([
             'message'=>'Error trying to fetch.',
                'error'=>$e->getMessage()
            ], 500);
        }

    }
    
     public function readBilling(){
        try{
            $billings= Billing::where('id',$id)->first();
            return response()->json([
                'billings'=>$billing
            ], 200);
        } catch(\Exceptions $e){
            return response()->json([
             'message'=>'Error trying to fetch.',
                'error'=>$e->getMessage()
            ], 500);
        }

}

public function updateBilling($id, Request $request){
     $validated= $request->validate([
            'record_date'=>'required|date',
        'meter_reading'=>'required|numeric',
        'units_used'=>'required|numeric',
        'amount'=>'required|numeric',
        'plot_id'=>'required|integer|exits:plots,id',
        ]);

        $billing= new Billing();
        $billing->record_date= $validated('record_date');
        $billing->meter_reading= $validated('meter_reading');
        $billing->units_used= $validated('units_used');
        $billing->amount= $validated('amount');
        $billing->plot_id= $validated('plot_id');
       
        try{
            $billing->save();
            return response()->json([
                'message'=>'Billing saved successfully.',
                'billing'=>$billing
            ], 200);
        } catch(\Execption $e){
            return response()->json([
             'message'=>'Error trying to fetch.',
                'error'=>$e->getMessage()
            ], 500);
        }
}

public function deleteBilling($id){
    try{
        $billing =Billing::where('id, $id')->first();
        if(!$billing){
            return response()->json("Record not found.");
        }

        $billing->delete();
        return response()-json("Record delete successfully.");
    }catch(\Execption $e){
            return response()->json([
             'message'=>'Error trying to fetch.',
                'error'=>$e->getMessage()
            ], 500);
    }
    
}

public function searchBilling($name){
     try{
       $billing = Billings::where('record_date', 'LIKE', "%{$name}%")->first;
            return response()->json([
                'billings'=>$billings
            ], 200);
        } catch(\Execption $e){
            return response()->json([
             'message'=>'Error trying to fetch.',
                'error'=>$e->getMessage()
            ], 500);
        }
}
}