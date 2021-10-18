<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookPostRequest;
use App\Models\Bay;
use App\Models\Book;
use App\Models\Car;
use Carbon\Carbon;

class BookController extends Controller
{
    public function bookBay(BookPostRequest $request)
    {
        $bay = Bay::where('bay_code', $request->bay_code)->first();

        $car = Car::create([
            'license_plate' => $request->license_plate,
        ]);

        $book = Book::create([
            'start_session' => $request->time,
            'car_id' => $car->id,
            'bay_id' => $bay->id,
        ]);

        $bay->status = 'occupied';
        $bay->save();

        $data = [
            'bay' => $bay,
            'car' => $car,
            'book' => $book,
        ];

        return response()->json($data);

    }

    public function a()
    {
        //$s = \DB::table('cars')->where('id', '<', 100)->get();
        //foreach ($s as $key => $value) {
        //  $value->license_plate = $key;
        // dd($value->license_plate);
        // $value->update();
        //}
        $now = Carbon::parse(date('Y-m-d H:i:s'));
        $pay = Carbon::parse(Book::where('id', 1)->first()->start_session);
        $minutes = $now->diffInMinutes($pay);
        $hours = $now->diffInMinutes($pay) / 60;

    }
}
