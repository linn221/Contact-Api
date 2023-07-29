<?php

namespace App\Http\Controllers;

use App\Models\SearchRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchRecordController extends Controller
{
    //
    public function index()
    {
        $records = Auth::user()->searchRecords;
        return $records;
    }

    public function destroy(SearchRecord $record)
    {
        $record->delete();
        return Auth::user()->searchRecords;
    }
}
