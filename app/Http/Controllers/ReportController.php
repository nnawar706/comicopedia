<?php

namespace App\Http\Controllers;

use App\Exports\ItemExport;
use App\Exports\VolumeExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function exportSeries()
    {
        $file = 'series-list-' . date('dis') . '.xlsx';

        return Excel::download(new ItemExport, $file);
    }

    public function exportVolumes()
    {
        $file = 'volumes-list-' . date('dis') . '.xlsx';

        return Excel::download(new VolumeExport, $file);
    }
}
