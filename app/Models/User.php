<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Domain\Enum\AccountType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property \App\Models\InfoMaster infoMaster
 */
class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable
        = [
            'name',
            'surname',
            'account_type',
            'email',
            'password',
            'phone',
            'dop_phone',
            'telegram',
            'whatsapp',
        ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden
        = [
            'password',
            'remember_token',
        ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts
        = [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'account_type'      => AccountType::class,
        ];

    public function isSaloon(): bool
    {
        return $this->account_type === AccountType::Saloon;
    }

    public function isClient(): bool
    {
        return $this->account_type === AccountType::Client;
    }

    public function isMaster(): bool
    {
        return $this->account_type === AccountType::Master;
    }

    public function infoMaster(): HasOne
    {
        return $this->hasOne(InfoMaster::class);
    }

    public function workingLocations(): BelongsToMany
    {
        return $this->belongsToMany(
            YandexLocation::class,
            'master_working_locations',
            'user_id',
            'yandex_location_id'
        );
    }

    public function animalsMaster(): BelongsToMany
    {
        return $this->belongsToMany(
            Animal::class,
            'animals_masters',
            'user_id',
            'animal_id'
        );
    }

    public function masterServices(): HasMany
    {
        return $this->hasMany(ServiceMaster::class, 'user_id', 'id');
    }

}
