<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\staff_permissions;
use App\Models\set_roles;
use App\Models\role_users;
use App\Models\companies;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
class Cmf
{
    public static function error_processor($validator)
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
        }
        return $err_keeper;
    }
    
    public static function sendimagetodirectory($imagename)
    {
        $file = $imagename;
        $filename = rand() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        return $filename;
    }
    
    public static function shorten_url($text)
    {
        $words = explode('-', $text);
        $five_words = array_slice($words,0,12);
        $String_of_five_words = implode('-',$five_words)."\n";

        $String_of_five_words = preg_replace('~[^\pL\d]+~u', '-', $String_of_five_words);
        $String_of_five_words = iconv('utf-8', 'us-ascii//TRANSLIT', $String_of_five_words);
        $String_of_five_words = preg_replace('~[^-\w]+~', '', $String_of_five_words);
        $String_of_five_words = trim($String_of_five_words, '-');
        $String_of_five_words = preg_replace('~-+~', '-', $String_of_five_words);
        $String_of_five_words = strtolower($String_of_five_words);
        if (empty($String_of_five_words)) {
          return 'n-a';
        }
        return $String_of_five_words;
    }
    public static function create_time_ago($time)
    {

        $year = date('Y', strtotime($time));
        $month = date('m', strtotime($time));
        $day = date('d', strtotime($time));
        $datetime = Carbon::parse($time);
        return $datetime->diffForHumans();
    }
    public static function date_format($data)
    {
        return date('d M Y', strtotime($data));
    }
}