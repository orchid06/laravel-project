<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function AllType()
    {
        $types = PropertyType::latest()->get();

        return view('backend.type.all_type' , compact('types'));
    } //End method

    public function AddType()
    {
        return view('backend.type.add_type');
    } //End method

    public function StoreType(Request $request)
    {
        //validation
        $request->validate([
            'type_name' => 'required|unique:property_types|max:200',
            'type_icon' => 'required'
        ]);

        PropertyType::insert([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,

        ]);

        $notification = [
            'message'       => 'Property type created successfully',
            'alert-type'    => 'success'
        ];

        return redirect()->route('all.type')->with($notification);

    } //End method

    public function EditType($id)
    {
        $type = PropertyType::findOrFail($id);

        return view('backend.type.edit_type' , compact('type'));
    } //End method

    public function UpdateType(Request $request)
    {

        $pid = $request->id;

        PropertyType::findOrFail($pid)->update([
            'type_name' => $request->type_name,
            'type_icon' => $request->type_icon,

        ]);

        $notification = [
            'message'       => 'Property type updated successfully',
            'alert-type'    => 'success'
        ];

        return redirect()->route('all.type')->with($notification);

    } //End method

    public function DeleteType($id)
    {
        PropertyType::findOrFail($id)->delete;

        $notification = [
            'message'       => 'Property type deleted successfully',
            'alert-type'    => 'success'
        ];

        return redirect()->route('all.type')->with($notification);
    } //End method


}
