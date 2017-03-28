<?php

namespace Yk\LaravelFiles\App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	protected $appends = ['path', 'link', 'download_link'];

    public function getPathAttribute()
    {
    	$path = 'files';

        for ($i=18; $i > 3; $i-=3) { 
            $path .= '/'.(floor($this->id/pow(10, $i))+1);
        }

        return $path;
    }

    public function getLinkAttribute()
    {
        return route('files.show', ['id' => $this->id, 'slug' => str_slug($this->name).'.'.$this->extension]);
    }

    public function getDownloadLinkAttribute()
    {
        return route('files.download', ['id' => $this->id, 'slug' => str_slug($this->name).'.'.$this->extension]);
    }
}
