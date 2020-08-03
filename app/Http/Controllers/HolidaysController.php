<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HolidaysMaster;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HolidaysController extends Controller
{
    public function GetHolidays(Request $request)
    {
        $holidays = HolidaysMaster::selectRaw('*, ROUND(UNIX_TIMESTAMP(holiday_date) * 1000) as date_unix')->get();

        return response()->json(['data' => $holidays, 'status' => 'success', 'message' => 'Holidays fectched Successfully'], 200);
    }

    public function AddHoliday(Request $request)
    {
        $new_holiday = $request->get('Holidays');

        if(array_key_exists('id', $new_holiday))
        {
            if(HolidaysMaster::where('holiday_date', $new_holiday['holiday_date'])->where('id', '!=', $new_holiday['id'])->first())
                return response()->json(['status' => 'failure', 'message' => 'Holidays Already Exists'], 200);
            $holiday = HolidaysMaster::find($new_holiday['id']);
            $holiday['holiday_date'] = $new_holiday['holiday_date'];
            $holiday['description'] = (array_key_exists('description', $new_holiday) && !is_null($new_holiday['description']))?$new_holiday['description']: $holiday['description'];
            $holiday['updated_at'] = Carbon::now();
            $holiday['updated_by'] = Auth::id();
            $holiday->update();

            return response()->json(['data' => $holiday , 'status' => 'success', 'message' => 'Holidays Updated Successfully'], 200);
        }
        else if(!array_key_exists('id', $new_holiday))
        {
            if(HolidaysMaster::where('holiday_date', $new_holiday['holiday_date'])->first())
                return response()->json(['status' => 'failure', 'message' => 'Holidays Already Exists'], 200);
            $holiday = new HolidaysMaster();
            $holiday['holiday_date'] = $new_holiday['holiday_date'];
            $holiday['description'] = (array_key_exists('description', $new_holiday) && !is_null($new_holiday['description']))?$new_holiday['description']: '';
            $holiday['created_at'] = Carbon::now();
            $holiday['created_by'] = Auth::id();
            $holiday->save();

            return response()->json(['data' => $holiday , 'status' => 'success', 'message' => 'Holidays Added Successfully'], 200);
        }
    }

    public function DeleteHoliday($id)
    {
        HolidaysMaster::destroy($id);
        return response()->json(['status' => 'success', 'message' => 'Holidays Deleted Successfully'], 200);
    }
}
