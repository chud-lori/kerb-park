<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BayPostRequest;
use App\Models\Bay;

class BayController extends Controller
{
    public function getAllBays()
    {
        $bays = Bay::with('book')->get();
        $data = [
            'status' => 1,
            'data' => $bays,
            'message' => 'all bays records',

        ];

        if (count($bays) < 1) {
            $data['status'] = 0;
            $data['data'] = null;
            $data['message'] = "no bays records";
        };

        return response()->json($data);
    }

    public function getAvailableBays()
    {
        $bays = Bay::where('status', 'available')->get();

        $data = [
            'status' => 1,
            'data' => $bays,
            'message' => 'all available bays',

        ];

        if (count($bays) < 1) {
            $data['status'] = 0;
            $data['data'] = null;
            $data['message'] = "no bay available";
        };

        return response()->json($data);
    }

    public function getOccupiedBays()
    {
        $bays = Bay::with('book')->where('status', 'occupied')->get();

        $data = [
            'status' => 1,
            'data' => $bays,
            'message' => 'all occupied bays',
        ];

        if (count($bays) < 1) {
            $data['status'] = 0;
            $data['data'] = null;
            $data['message'] = "no bay occupied";
        };

        return response()->json($data);
    }

    public function checkAvailablity($bayCode)
    {
        $bay = Bay::where('bay_code', $bayCode)->first();

        $data = [
            'status' => 1,
            'data' => $bay,
            'message' => 'bay available',
        ];

        if (!$bay) {
            $data['status'] = 0;
            $data['message'] = 'error not found';
            unset($data['data']);

            return response()->json($data);
        }

        if ($bay->status == 'occupied') {
            $data['status'] = 0;
            $data['message'] = 'bay not available';
        }

        return response()->json($data);
    }

    public function addBay(BayPostRequest $request)
    {
        $bay = Bay::create(['bay_code' => $request->bay_code]);

        return response()->json([
            'status' => 1,
            'data' => $bay,
            'message' => 'bay added',
        ]);
    }
}
