<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value',
        'attachment'
    ];

    /**
     * @param $key
     */
    public static function get($key)
    {
        $setting = new self();
        $entry = $setting->where('key', $key)->first();

        if(!$entry){
            return;
        }

        return $entry->value;
    }

    /**
     * @param $key
     * @param null $value
     * @return bool
     */
    public static function set($key, $value=null): bool
    {
        $setting = new self();
        $entry = $setting->where('key', $key)->first();

        $entry->value = $value;
        $entry->saveOrFail();

        Config::set($key, $value);
        if(Config::get($key) == $value){
            return true;
        }

        return false;
    }


}
