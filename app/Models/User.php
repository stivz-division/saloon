<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Domain\Enum\AccountType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
            'uuid',
            'ref_id',
            'name',
            'surname',
            'account_type',
            'email',
            'password',
            'phone',
            'dop_phone',
            'telegram',
            'whatsapp',
            'avatar_path',
            'subscription_start_at',
            'subscription_end_at',
            'subscription_id',
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
            'email_verified_at'     => 'datetime',
            'password'              => 'hashed',
            'account_type'          => AccountType::class,
            'subscription_start_at' => 'datetime',
            'subscription_end_at'   => 'datetime',
        ];

    public function isSaloon(): bool
    {
        return $this->account_type === AccountType::Saloon;
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
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

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class, 'user_id', 'id');
    }

    public function ref(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isActiveSubscription(): bool
    {
        if ($this->infoMaster->is_subscription === false) {
            return false;
        }

        if ($this->infoMaster->subscription_end_at === null
            || $this->infoMaster->subscription_end_at->isPast() === true
        ) {
            return false;
        }

        return true;
    }

    public function masterAdvertisements(): HasMany
    {
        return $this->hasMany(MasterAdvertisement::class, 'user_id', 'id');
    }

}
