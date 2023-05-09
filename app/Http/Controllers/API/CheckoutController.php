<?php

namespace App\Http\Controllers\API;

use App\Checkout;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function getCity()
    {
        $cities = DB::table('cities')->where('provinceId', request()->provinceId)->get();
        return response()->json(['status' => 'success', 'data' => $cities]);
    }
    public function getDistrict()
    {
        $districts = DB::table('district')->where('cityId', request()->cityId)->get();
        return response()->json(['status' => 'success', 'data' => $districts]);
    }
    public function getSubDistrict()
    {
        $subdistricts = DB::table('subdistrict')->where('districtId', request()->districtId)->get();
        return response()->json(['status' => 'success', 'data' => $subdistricts]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function getCourier(Request $request)
    {

        // $this->validate($request, [
        //     'destination_postal_code' => 'required',
        //     // 'weight' => 'required|integer'
        // ]);
        $url = ('https://api.biteship.com/v1/rates/couriers');
        $headers = [
            'Authorization' => 'Bearer biteship_live.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoicGlhbiIsInVzZXJJZCI6IjYyZjc3NTY2ZjJhYTA4M2U1MTQyYThjMSIsImlhdCI6MTY2MTg1ODE0MH0.dE8jwOtbSbjbRn4uhytjwgXYwifsslX2yTeYaVunZ7w',
            'content-type' => 'application/json',
        ];
        // $r = $request->postalcode;
        $dt = ([
            "origin_postal_code" => 17433,
            "destination_postal_code" => $request->destination_postal_code,
            "couriers" => $request->couriers,
            "items" => [
                [
                    "weight" => $request->weight
                ]
            ]
        ]);
        $requests = HTTP::withBody(json_encode($dt), 'application/json')->withOptions(['headers' => $headers])
            ->post($url);

        $responseBody = json_decode($requests->getBody()->getContents(), true);

        return response()->json(['status' => 'success', 'data' => $responseBody]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
