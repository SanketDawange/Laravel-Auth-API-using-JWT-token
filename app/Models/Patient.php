<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'patient_first_name',
        'patient_last_name',
        'patient_dob',
        'patient_gender',
        'city_id',
        'state_id',
        'zip_code_id',
        'country_id',
        'patient_phone',
        'address1',
        'apartment',
        'language_id',
        'last_login',
        'login_enable',
        'is_verified',
        'fpwd_flag',
        'sms_notification',
        'email_notification',
        'whatsapp_notification',
        'fcm_notification',
        'email_verified_at',
        'mkey',
        'msalt',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'admin_remark',
        'status',
        'created_by',
        'updated_by',
    ];
    /**
     * Define a relationship to the User model.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

