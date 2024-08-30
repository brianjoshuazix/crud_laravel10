<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prefixname',
        'firstname',
        'middlename',
        'lastname',
        'suffixname',
        'username',
        'email',
        'password',
        'photo',
        'type',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function getAvatarAttribute(): string
    {
        // Check if the user has a photo
        if ($this->photo) {
            // Return the URL of the user's photo
            return Storage::url($this->photo);
        }

        // Default image (base64 encoded PNG)
        $defaultImage = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAB0lEQVR42mP8/wcAAwAB/7MWAAAAABJRU5ErkJggg==';

        return $defaultImage;
    }
    public function getFullnameAttribute(): string
    {
        // Initialize an array to hold parts of the full name
        $nameParts = [];

        // Add the first name
        $nameParts[] = $this->firstname;

        // Add the middle initial if present
        if (!empty($this->middlename)) {
            $nameParts[] = strtoupper(substr($this->middlename, 0, 1)) . '.';
        }

        // Add the last name
        $nameParts[] = $this->lastname;

        // Concatenate parts with a space in between and return
        return implode(' ', $nameParts);
    }
}
