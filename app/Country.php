<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasTranslations;
    public $translatable = ['name'];

    // in the get two way to work:
 	// {{ $_item->name }}										    	
	// {{$_item->getTranslation('name','ar')}} 
}
