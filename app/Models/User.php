<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models
 * @property int $id
 * @property string $email
 * @property string $phone
 * @property string $image_path
 *
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'image_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $filePath
     * @param $fileExtension
     * @return void
     */
    public function updateAvatar($filePath, $fileExtension)
    {
        $storagePath = '/app/avatars';
        File::ensureDirectoryExists(storage_path($storagePath));
        $name = \Str::uuid() . '.' . $fileExtension;
        $fileTo = storage_path("$storagePath/{$name}");
        if(File::move($filePath, $fileTo)) {
            $this->update(['image_path' => "$storagePath/{$name}"]);
        }
    }

    /**
     * @param $url
     * @return void
     */
    public function updateAvatarFromUrl($url)
    {
        $ext = explode(".", $url);
        $fileExtension = end($ext);
        $name = \Str::uuid() . '.' . $fileExtension;
        $fileTmpPath = storage_path().'/'.$name;
        file_put_contents($fileTmpPath, file_get_contents($url));
        $this->updateAvatar($fileTmpPath, $fileExtension);
    }
}
