<?php

namespace Yk\LaravelFiles\App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	protected $appends = ['path', 'url'];

    public function getPathAttribute()
    {
    	$path = 'files';

        for ($i=18; $i > 3; $i-=3) { 
            $path .= '/'.(floor($this->id/pow(10, $i))+1);
        }

        return $path;
    }

    public function getUrlAttribute()
    {
        return route('files.show', $this->id);
    }
}
