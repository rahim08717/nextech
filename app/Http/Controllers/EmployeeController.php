<?php

namespace App\Http\Controllers;

use App\Models\Empoloyee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{

    public function index() {
    $employees = Empoloyee::latest()->paginate(5);
    return view('index', compact('employees'));
}


    public function create()
    {
        return view('create');
    }


    public function store(Request $request)
    {
        // Validation Requirement
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:empoloyees,email',
            'phone' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'designation' => 'required',
        ]);

        $input = $request->all();


        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path($destinationPath), $profileImage);
            $input['image'] = "$profileImage";
        }

        Empoloyee::create($input);

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }


    public function edit(Empoloyee $employee)
    {
        return view('edit', compact('employee'));
    }


    public function update(Request $request, Empoloyee $employee)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';

            if ($employee->image && file_exists(public_path($destinationPath . $employee->image))) {
                unlink(public_path($destinationPath . $employee->image));
            }

            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path($destinationPath), $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        $employee->update($input);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }

   public function destroy(Empoloyee $employee) {
    $destinationPath = 'images/';

    if ($employee->image && file_exists(public_path($destinationPath . $employee->image))) {
        unlink(public_path($destinationPath . $employee->image));
    }

    $employee->delete();

    return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
}
}
