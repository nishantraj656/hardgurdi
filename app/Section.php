<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    static function getSection()
    {

   return array(["title"=>'English',"id"=>1],["title"=>'Maths',"id"=>2],["title"=>'Reasoning',"id"=>3],
        ["title"=>'General Science',"id"=>4],["title"=>'General Knowledge',"id"=>5],["title"=>'Letter/Essay',"id"=>7],
        ["title"=>'puzzle',"id"=>6],["title"=>'Computer Science',"id"=>8]);
    }
}
