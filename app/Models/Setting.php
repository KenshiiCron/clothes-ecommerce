<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    public static function get($key)
    {
        $entry = self::where('key', $key)->first();
        if (!$entry) {
            return;
        }
        return $entry->value;
    }


    public static function set($key, $value = null): bool
    {
        $entry = self::where('key', $key)->firstOrFail();
        $entry->update(['value'=>$value]);
        Config::set('key', $value);
        return Config::get($key) === $value;
    }
}
