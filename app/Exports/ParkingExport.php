<?php

namespace App\Exports;

use App\Models\Parking;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;

class ParkingExport implements WithCustomValueBinder,FromView,ShouldAutoSize
{
    public function bindValue(Cell $cell, $value)
    {
        $cell->setValueExplicit($value, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        return true;
    }

    public function view(): View
    {
        $parkings = Parking::when(request('search'), function ($query) {
            $query->where('unique_code', 'like', "%{request('search')}%");
            $query->orWhere('license_plate', 'like', "%".request('search')."%");
        })->when(request('start_time'), function ($query) {
            $query->where('start_time', '>=', date('Y-m-d H:i:s',strtotime(request('start_time'))));
        })->when(request('end_time'), function ($query) {
            $query->where('end_time', '<=', date('Y-m-d H:i:s',strtotime(request('end_time'))));
        })->orderBy('start_time','desc')->get();
        return view('parking.export', compact('parkings'));
    }
}
