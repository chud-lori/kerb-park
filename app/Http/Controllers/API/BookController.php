<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookPostRequest;
use App\Models\Bay;
use App\Models\Book;
use App\Models\Car;
use Illuminate\Http\Request;

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
            'status' => 1,
            'data' => [$bay, $car, $book],
            'message' => 'book success',
        ];

        return response()->json($data);

    }

    public function pay(Request $request)
    {
        $car = Car::where('license_plate', $request->license_plate)->first();
        $book = Book::where(['car_id' => $car->id, 'payment' => 'unpaid'])->first();
        if (!$book) {
            return response()->json(
                ['status' => 0,
                    'message' => 'book not found']
            );
        }

        if ($request->pay < $book->bill) {
            return response()->json([
                'status' => 0,
                'message' => 'payment is not enough',
            ]);
        }

        $book->payment = 'paid';
        $book->save();
        Bay::where('id', $book->bay_id)->update(['status' => 'available']);

        return response()->json([
            'status' => 1,
            'message' => 'payment succesful',
        ]);
    }
}
