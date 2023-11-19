<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeveloperRequest;
use App\Models\Developer;
use App\Models\UsedDevLanguage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeveloperController extends Controller
{
    public function show($id) 
    {
        $developer = Developer::with('used_dev_languages')->where('id', $id)->first();

        if($developer) {
            return response()->json([
                'status' => true,
                'data' => $developer,
            ]);
        }else {
            return response()->json([
                'status' => false,
                'message' => "No data found",
            ]);
        }
    }

    public function store(StoreDeveloperRequest $request)
    {
        try {
            DB::beginTransaction();

            $alreadyExist = Developer::where('user_id', $request->user_id)->first();
            if($alreadyExist) {
                return response()->json([
                    'status' => false,
                    'message' => "Already exists for this user id"
                ]);
            } else {

                $developer = Developer::create([
                    'user_id' => $request->user_id,
                    'profile' => $request->profile,
                    'opportunity_id' => $request->opportunity_id,
                    'level' => $request->level,
                    'experience' => $request->experience,
                    'contact_info' => $request->contact_info,
                    'gender' => $request->gender,
                    'age' => $request->age
                ]);

                $languages = explode(',', $request->language_ids);
                foreach($languages as $usedDevLang) {
                    UsedDevLanguage::create([
                        'developer_id' => $developer->id,
                        'language_id' => $usedDevLang
                    ]);
                }
            }

             DB::commit();
     
             return response()->json([
                 'status' => true,
                 'message' => 'Developer successfully created'
             ]);


        } catch(Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => "Something was wrong, Please try again"
            ]);

        }

     
        
    }


    public function update(StoreDeveloperRequest $request, $id)
    {
        Developer::where('id', $id)
                    ->update([
                        'user_id' => $request->user_id,
                        'name' => $request->name,
                        'profile' => $request->profile,
                        'opportunity_id' => $request->opportunity_id,
                        'level' => $request->level,
                        'experience' => $request->experience,
                        'contact_info' => $request->contact_info,
                        'gender' => $request->gender,
                        'age' => $request->age
                    ]);

        UsedDevLanguage::where('developer_id', $id)->delete();

        foreach($request->language_ids as $usedDevLang) {
            UsedDevLanguage::create([
                'developer_id' => $id,
                'language_id' => $usedDevLang
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Developer successfully updated'
        ]);
        
    }
}
