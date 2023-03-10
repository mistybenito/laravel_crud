<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $employees = Employee::orderBy('id','asc')->paginate(10);
        return view('employees.index', compact('employees'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('employees.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        Employee::create($request->post());

        return redirect()->route('employees.index')->with('success','An employee has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function show(Employee $employee)
    {
        return view('employees.show',compact('employee'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function edit($id=null)
    {
        // dd($employee->where('id', $id)->get(), $id);
        $employee=Employee::where('id', $id)->first();
        return view('employees.edit',compact('employee'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */

    public function update(Request $request, Employee $employee)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $employee = Employee::where('id', $request->id)->first();
        $employee->update($request->all());
        $employee->save();
        return redirect()->route('employees.index')->with('success','An employee Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function destroy($id=null)
    {
        // dd($id);
        $employee = Employee::where('id', $id)->first();
        // dd($employee);
        $employee->delete();
        return redirect()->route('employees.index')->with('success','An employee has been deleted successfully');
    }
}
