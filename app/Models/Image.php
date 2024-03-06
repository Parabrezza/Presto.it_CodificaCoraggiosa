<?php

namespace App\Models;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
   
    use HasFactory;
    protected $casts=['labels'=>'array'];
    protected $fillable = ['path'];
    public function announcement():BelongsTo
    {
        return $this->belongsTo(Announcement::class);
    }
    public static function getUrlByFilePath($filePath,$w=null,$h=null){
         if(!$w &&!$h){
            return Storage::url($filePath);
         }
        $path=dirname($filePath);
        $fileName=basename($filePath);
        $file="{$path}/crop_{$w}x{$h}_{$fileName}";
        return Storage::url($file);
    }
    public function getUrl($w=null,$h=null){
        return Image::getUrlByFilePath($this->path,$w,$h);
    }
}