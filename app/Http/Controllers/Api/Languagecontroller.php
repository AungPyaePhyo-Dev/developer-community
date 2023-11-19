<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class Languagecontroller extends Controller
{
    public function index()
    {
        $languages = Language::get();
        return $languages;
    }


    public function store(StoreLanguageRequest $request)
    {
        Language::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Language successfully stored'
        ]);
    }
}
