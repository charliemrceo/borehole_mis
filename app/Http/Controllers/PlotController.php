<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlotController extends Controller
{
    public function createPlot(Request $request){
        $validated = $request->validate([
        'name' =>'required|string|unique:plots,name',
        'longtitude' =>'required|string',
        'latitude' =>'required|string',
        'water_rate' =>'required|numeric|min:0|decimal:0,2',//no validate double in laravel
        'meter_number' =>'required|string|unique:plots,meter_number',
        'location_id' =>'required|interger|exists:locations,id'
        ]);

        $plot= new Plot();
        $plot->name=$validated['name'];
        $plot->latitude=$validated['latitude'];
        $plot->water_rate=$validated['water_rate'];
        $plot->longitude=$validated['longitude'];
        $plot->meter_number=$validated['meter_number'];
        $plot->location_id=$validated['location_id'];

            try{
                $plot->save();
                return response()->json([
                    'message'=>'Plot saved successfully.',
                    'plot'=>$plot
                ], 200);
            } catch(\Exception $e){
                return response()->json([
                    'message'=>'Failed to save plot.',
                    'error'=>$ê->getMessage()
                ], 500);
            }
    }


    public function readALlPlots(){
        try{
            $plots= Plot::all();
               return response()->json([
                   'plots'=>$plots
                   
                ], 200);
            } catch(\Exception $e){
                return response()->json([
                    'message'=>'Failed to fetch plots.',
                    'error'=>$ê->getMessage()
                ], 500);
        }
    }

     public function readPlot($id){
        try{
            $plot= Plot::where('id', $id)->first();
               return response()->json([
                   'plot'=>$plot
                   
                ], 200);
            } catch(\Exception $e){
                return response()->json([
                    'message'=>'Failed to fetch plot.',
                    'error'=>$ê->getMessage()
                ], 500);
        }
    }


    public function updatePlot($id, Request $request){
         $validated = $request->validate([
        'name' =>'required|string|unique:plots,name',
        'longtitude' =>'required|string',
        'latitude' =>'required|string',
        'water_rate' =>'required|numeric|min:0|decimal:0,2',
        'meter_number' =>'required|string|unique:plots,meter_number',
        'location_id' =>'required|interger|exists:locations,id'
        ]);

        $plot= Plot::where('id',$id)->first();
        $plot->name=$validated['name'];
        $plot->latitude=$validated['latitude'];
        $plot->water_rate=$validated['water_rate'];
        $plot->longitude=$validated['longitude'];
        $plot->meter_number=$validated['meter_number'];
        $plot->location_id=$validated['location_id'];

            try{
                $plot->save();
                return response()->json([
                    'message'=>'Plot update successfully.',
                    'plot'=>$plot
                ], 200);
            } catch(\Exception $e){
                return response()->json([
                    'message'=>'Failed to update plot.',
                    'error'=>$ê->getMessage()
                ], 500);
            }
    }

    public function deletePlot($id){
        try{
            $plot= Plot::where('id',$id)->first();
            if(!$plot){
                return response()->json("Record does not exist.");
            }

            $plot->delete();
            return response()->json("Plot delete successfully,");
        } catch(\Exception $e){
             return response()->json([
                    'message'=>'Failed to delete plot.',
                    'error'=>$ê->getMessage()
                ], 500);
        }
    }

    public function searchPlot($name){
        try{
            $plots= Plot::where('id', 'LIKE', "%{$name}%")->get();
               return response()->json([
                   'plots'=>$plots
                   
                ], 200);
            } catch(\Exception $e){
                return response()->json([
                    'message'=>'Failed to search plot.',
                    'error'=>$ê->getMessage()
                ], 500);
        }
    }
}
