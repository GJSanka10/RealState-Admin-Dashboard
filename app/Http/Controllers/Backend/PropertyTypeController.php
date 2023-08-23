<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyType;
use App\Models\Amenities;


class PropertyTypeController extends Controller

{
    protected $fillable = ['type_name', 'type_icon'];
    //
    public function AllType(){
        $types=PropertyType::latest()->get();
        return view('backend.type.all_type',compact('types'));
    }

    public function AddType(){
        return view('backend.type.add_type');

    }

    public function StoreType(Request $request){

        $request->validate([
            'type_name'=> 'required|unique:property_types|max:200',
            'type_icon'=> 'required',
        ]);
        PropertyType::insert([
            'type_name'=>$request->type_name,
            'type_icon'=>$request->type_icon,
        ]);
        $notification=array(
            'message'=>'Property type create Successfully',
            'alert-type' =>'success'
        );
        return redirect()->route('all.type')->with($notification);

    }
    public function EditType($id){
        $types=PropertyType::findOrFail($id);
        return view('backend.type.edit_type',compact('types'));
    }

    public function UpdateType(Request $request){

        $pid=$request->id;
        PropertyType::findOrFail($pid)->update([
            'type_name'=>$request->type_name,
            'type_icon'=>$request->type_icon,
        ]);
        $notification=array(
            'message'=>'Property type Updated Successfully',
            'alert-type' =>'success'
        );
        return redirect()->route('all.type')->with($notification);

    }
    public function DeleteType($id){
        PropertyType::findOrFail($id)->delete();

        $notification=array(
            'message'=>'Property type Deleted Successfully',
            'alert-type' =>'success'
        );
        return redirect()->back()->with($notification);

    }//End

    //////////////////Amenities All Method ///////////////////

    public function AllAmenitie(){
        $amenities=Amenities::latest()->get();
        return view('backend.amenities.all_amenities',compact('amenities'));
    }

    public function AddAmenitie(){
        return view('backend.amenities.add_amenities');

    }

    public function StoreAmenitie(Request $request){

        Amenities::insert([
            'amenitis_name'=>$request->amenitis_name,
           
        ]);
        $notification=array(
            'message'=>'Amenities create Successfully',
            'alert-type' =>'success'
        );
        return redirect()->route('all.amenitie')->with($notification);

    }

    public function EditAmenitie($id){
        $amenities=Amenities::findOrFail($id);
        return view('backend.amenities.edit_amenities',compact('amenities'));
    }

    public function UpdateAmenitie(Request $request){

        $ame_id=$request->id;
        Amenities::findOrFail($ame_id)->update([
            'amenitis_name'=>$request->amenitis_name,
        ]);
        $notification=array(
            'message'=>'Property type Updated Successfully',
            'alert-type' =>'success'
        );
        return redirect()->route('all.amenitie')->with($notification);

    }

    public function DeleteAmenitie($id){
        amenities::findOrFail($id)->delete();

        $notification=array(
            'message'=>'Amenities Deleted Successfully',
            'alert-type' =>'success'
        );
        return redirect()->back()->with($notification);

    }//End


}
