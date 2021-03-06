<?php

namespace App\Http\Controllers\Employee;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class EmployeeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        $paginated_employees = Employee::simplePaginate(10);

        // $employees = collect($paginated_employees->items())->map(function($employee) {

        //     return [
        //         'id' => $employee->id,
        //         'name' => $employee->first_name. ' ' .$employee->last_name,
        //         'email' => $employee->email,
        //         'phone_number' => $employee->phone_number,
        //     ];
        // });

        // return response()->json([
        //     'employees' => $employees,
        //     'next_page' => $paginated_employees->nextPageUrl(),
        //     'previous_page' => $paginated_employees->previousPageUrl(),
        // ]);
        // return $this->showAll($employees, 200);

        return view('/employees', [
            'employees' => $paginated_employees,
            'all_employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-employee');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company)
    {
        $rules = [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|email|unique:employees',
            'phone_number' => 'required|Numeric|unique:employees',
            'name' => 'required|exists:companies'
        ];
        // dump($request->company_name);
        $this->validate($request, $rules);

        $data = $request->except('name');

        $data['company_id'] = Company::where('name', $request->name)->first()->id;

        $employee = Employee::create($data);

        return redirect('employees');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('edit-employee', [
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company, Employee $employee)
    {
        // $rules = [
        //     'first_name' => 'min:3',
        //     'last_name' => 'min:3',
        //     'email' => 'email|unique:employees',
        //     'phone_number' => 'Numeric',
        //     'name' => 'exists:companies'
        // ];

        // $Employee = Company::find($company->id)->employees()->where('id', $employee->id)->first();

        if ($request->has('first_name')) {
            $employee->first_name = $request->first_name;
        }

        if ($request->has('last_name')) {
            $employee->last_name = $request->last_name;
        }

        if ($request->has('email') && $employee->email != $request->email) {
            $employee->email = $request->email;
        }

        if ($request->has('phone_number') && $employee->phone_number != $request->phone_number) {
            $employee->phone_number = $request->phone_number;
        }

        if ($request->has('name') && $employee->company->name != $request->name) {
            $employee->company_id = Company::where('name', $request->name)->first()->id;
        }

        if(!$employee->isDirty()) {
            return $this->errorResponse('You need to specify a different value to update',
                 422);
        }

        $employee->updated_at = now();

        $employee->save();

        $employee->refresh();

        return redirect('employees');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company, Employee $employee)
    {
        $employee->delete();

        return redirect('employees');
    }
}
