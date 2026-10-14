<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
public function createLocation(Request $request){
        $validated =$request->validate([
            'name'=>'required|string|unique:locations,name',
            'description'=> 'nullable|string|max:1000'
        ]);

        $location = new Location();
        $location->name = $validated['name'];
        $location->description = $validated['description'];

    try{
        $location->save();
        return response()->json([
            'message'=>'Location saved successfully.',
            'location'=>$location
        ], 200);
    } catch(\Exception $e){
            return response()->json([
                'message'=>'Error trying to save.',
                'error'=>$e->getMessage()
            ], 500);
    }
}
 public function readAllLocations()
    {
        try{
            $locations = Location::all();
        
        return response()->json([
            'locations'=>$locations
        ], 200);
    } catch(\Exception $e){
            return response()->json([
                'message'=>'Error trying to fetch.',
                'error'=>$e->getMessage()
            ], 500);
    }
}


public function readLocation($id)
{
     try{
            $locations = Location::where('id', $id)->first();
        return response()->json([
            $locations
        ], 200);
    } catch(\Exception $e){
            return response()->json([
                'message'=>'Error trying to fetch.',
                'error'=>$e->getMessage()
            ], 500);
    }
}

public function updateLocation($id, Request $request){
        
            $validated = $request->validate([
                'name'=>'required|string|unique:locations,name,'.$id,
                'description'=> 'nullable|string|max:1000'
            ]);
            $location = Location:: where('id',$id)->first();
            $location->name = $validated['name'];
            $location->description = $validated['description'];
        try{
            $location->save();
            return response()->json([
                'message'=>'Location updated successfully.',
                'location'=>$location
            ], 200);
        } catch(\Exception $e){
            return response()->json([
                'message'=>'Error trying to update.',
                'error'=>$e->getMessage()
            ], 500);
        }
    }

    public function deleteLocation($id){
        try{
            $location = Location::where('id', $id)->first();


            if($location){
                return response()->json(["Record not found"]);
            }

            $location->delete();
            return response()->json("Record deleted successfully");

        } catch(\Exception $e){
            return response()->json([
                'message'=>'Error trying to delete.',
                'error'=>$e->getMessage()
            ], 500);
        }
    }

    public function searchLocation($name)
    {
        try{
            $locations = Location::where('name', 'like', '%'.$name.'%')->get();
            return response()->json([
                $locations
            ], 200);
        } catch(\Exception $e){
            return response()->json([
                'message'=>'Error trying to search.',
                'error'=>$e->getMessage()
            ], 500);
        }
    }
}