<?php

namespace App\Http\Controllers;

use App\Imports\Users;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    function __construct()
    {
        ini_set('max_execution_time', 300);
    }
    public function index()
    {
        return view('Temporary.excelimporter');
    }
    public function importUsers(Request $request)
    {
        $file = $request->file('excel_file');

        // Validate the uploaded file as needed

        Excel::import(new Users(), $file);

        return redirect()->back()->with('success', 'داده‌ها با موفقیت وارد شدند.');
    }
}
