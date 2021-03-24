<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    //
    public function paid(Request $request, $id)
    {
        $validateData = $request->validate([
            'salary_month' => 'required',

        ]);


        $data = array();
        $data['employee_id'] = $id;

        $month = $request->salary_month;

        $check = DB::table('salaries')
            ->where('employee_id', $id)
            ->where('salary_month', $month)
            ->first();

        if ($check) {
            return response()->json('Salary Already Paid');

        } else {

            $data['salary_month'] = $month;
            $data['amount'] = $request->sallery;
            $data['salary_date'] = date('d,m,Y');
            $data['salary_year'] = date('Y');

            DB::table('salaries')->insert($data);


        }

    }

    public function allSalary()
    {
        $salary = DB::table('salaries')
            ->select('salary_month')
            ->groupBy('salary_month')
            ->get();
        return response()->json($salary);
    }

    public function viewSalary($month)
    {

        $view = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.name', 'salaries.*')
            ->where('salaries.salary_month', $month)
            ->get();
        return response()->json($view);


    }

    public function editSalary($id)
    {
        $view = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.name', 'employees.email', 'salaries.*')
            ->where('salaries.id', $id)
            ->first();

        return response()->json($view);


    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['employee_id'] = $request->employee_id;
        $data['amount'] = $request->amount;
        $data['salary_month'] = $request->salary_month;
        DB::table('salaries')->where('id', $id)->update($data);


    }
}


