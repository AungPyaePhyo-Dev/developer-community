<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOpportunityRequest;
use App\Models\Opportunity;
use Illuminate\Http\Request;

class OpportunityController extends Controller
{
    public function index()
    {
        $data = Opportunity::where('status', 1)->get();

        return $data;
    }

    public function store(StoreOpportunityRequest $request)
    {
       $opportunity =  Opportunity::create([
            'generated_id' => "user-" .$request->generated_id,
            'name' => $request->name
        ]);

        if($opportunity) {
            return response()->json([
                'status' => true,
                'message' => "Opportunity successfully created"
            ]);
        }else {
            return response()->json([
                'status' => false,
                'message' => "Something was wrong"
            ]);
        }
    }
}
