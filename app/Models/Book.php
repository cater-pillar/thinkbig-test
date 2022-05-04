<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Book extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
   /* protected $fillable = ["autor", "izdavac", "naziv_knjige", "godina_izdanja"]; */

    public function age() {
        return Carbon::parse($this->attributes['godina_izdanja'])->age;
    }

    protected function setGodinaIzdanjaAttribute($godina_izdanja) {
        $date_to_array = explode("/", $godina_izdanja);
        $new_date_format = $date_to_array[2] . "-" . $date_to_array[1] . "-" . $date_to_array[0];
        $this->attributes['godina_izdanja'] = $new_date_format;
    }

    protected function getGodinaIzdanjaAttribute($godina_izdanja) {
        $date_to_array = explode("-", $godina_izdanja);
        $new_date_format = $date_to_array[1] . "/" . $date_to_array[2] . "/" . $date_to_array[0];
        return $new_date_format;
    }

}
