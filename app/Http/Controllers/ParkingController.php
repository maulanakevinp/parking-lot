<?php

namespace App\Http\Controllers;

use App\Exports\ParkingExport;
use App\Models\Parking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parkings = Parking::when($request->search, function ($query) use ($request) {
            $query->where('unique_code', 'like', "%{$request->search}%");
            $query->orWhere('license_plate', 'like', "%{$request->search}%");
        })->when($request->start_time, function ($query) use ($request) {
            $query->where('start_time', '>=', date('Y-m-d H:i:s',strtotime($request->start_time)));
        })->when($request->end_time, function ($query) use ($request) {
            $query->where('end_time', '<=', date('Y-m-d H:i:s',strtotime($request->end_time)));
        })->orderBy('start_time','desc')->paginate(2);
        $parkings->appends($request->all());
        return view('parking.index', compact('parkings'));
    }

    public function export(Request $request)
    {
        return Excel::download(new ParkingExport, 'Parkir.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'license_plate' => ['required','string','max:16'],
        ]);
        $data['unique_code'] = Str::random(10);
        $data['start_time'] = date('Y-m-d H:i:s');
        $parking = Parking::create($data);
        return back()->with('success', "Parkir berhasil ditambahkan dengan nomor karcis {$parking->unique_code}");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parking $parking)
    {
        $parking->update([
            'end_time' => date('Y-m-d H:i:s')
        ]);
        return back()->with('success', "Parkir berhasil ditutup");
    }
}
