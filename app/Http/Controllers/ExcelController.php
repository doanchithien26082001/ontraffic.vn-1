<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\View;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Exporter;

use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function export()
    {
        $data = [
            // Dữ liệu từ bảng HTML của bạn
        ];

        return Excel::download(new ExportData($data), 'table.xlsx');
    }
}
