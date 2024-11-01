<?php

namespace app\Traits\Mutators;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

trait HasImageTrait
{
    public function imageUrl() : Attribute
    {
        return new Attribute(
            get : fn() =>  is_null($this->image)
                ? $this->image
                : Storage::disk(config('filesystems.default'))->url($this->image)
        );
    }
}
