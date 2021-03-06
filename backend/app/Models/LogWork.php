<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LogWork extends Model
{
    //
    protected $fillable = ['user_id', 'user_name', 'ip', 'type', 'route_name', 'desc'];

    public function log($info)
    {
        $request = request();
        $time = Carbon::now();
        $strTime = $time->year.'年'.$time->month.'月'.$time->day.'日'.$time->hour.'时'.$time->minute.'分'.$time->second.'秒';
        $data = [
            'user_id' => isset(Auth::user()->id)?Auth::user()->id:9999,
            'user_name' => isset(Auth::user()->name)?Auth::user()->name:'微信端',
            'ip' => $request->ip(),
            'type' => $info['type'],
            'desc' => $info['desc'],
            'route_name' => $info['route_name'],
            'created_at' => $time,
            'updated_at' => $time
        ];
        $this->insert($data);
    }


}
