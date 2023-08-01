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

    public function destroy(string $id)
    {
        $record = SearchRecord::find($id);
        if (is_null($record)) {
            return response()->json([
                'message' => 'record not found'
            ], 404);
        }
        $record->delete();
        return response()->json([
            'message' => 'record deleted'
        ], 204);
    }

    public function reset()
    {
        SearchRecord::where('user_id', Auth::id())->delete();
        return response()->json([
            'message' => 'search history deleted'
        ], 204);
    }

}
