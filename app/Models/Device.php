<?php
/**
 * Anna Shevchenko
 * xshevc02
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Device extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type_id',
        'studio_id',
        'user_id',
        'year_of_manufacture',
        'purchase_date',
        'max_loan_duration',
        'available',
        'photo',

    ];

    /**
     * Define the relationship with the DeviceType model.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(DeviceType::class, 'type_id');
    }

    /**
     * Define the relationship with the Studio model.
     */
    public function studio(): BelongsTo
    {
        return $this->belongsTo(Studio::class);
    }

    /**
     * Define the relationship with the User model.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the relationship with the Loan model.
     */
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Define the relationship with the Reservation model.
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }


}
