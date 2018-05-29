<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    public $attributes = [ 'hits' => 0 ];
    public $timestamps = false;
    protected $fillable = [ 'ip', 'date' ];
    protected $table = 'tracker';
    public static function boot() {
        // When a new instance of this model is created...
        static::creating(function ($tracker) {
            $tracker->hits = 0;
        } );

        // Any time the instance is saved (create OR update)
        static::saving(function ($tracker) {
            $tracker->visit_date = date('Y-m-d');
            $tracker->visit_time = date('H:i:s');
            $tracker->hits++;
        } );
    }
    public function scopeCurrent($query) {
        return $query->where('ip', $_SERVER['REMOTE_ADDR'])
                     ->where('date', date('Y-m-d'));
    }

    public static function hit($pages=null) {
        static::firstOrCreate([
                  'ip'   => $_SERVER['REMOTE_ADDR'],
                  'date' => date('Y-m-d'),
                  'pages' => $pages
              ])->save();
    }
    // public static function boot() {
    //     // Any time the instance is updated (but not created)
    //     static::saving( function ($tracker) {
    //         $tracker->visit_time = date('H:i:s');
    //         $tracker->hits++;
    //     } );
    // }

    // public static function hit() {
    //     static::firstOrCreate([
    //               'ip'   => $_SERVER['REMOTE_ADDR'],
    //               'date' => date('Y-m-d'),
    //           ])->save();
    // }
}
