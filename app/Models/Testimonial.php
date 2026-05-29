<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'user_id', 'testimoni', 'rating', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope untuk mengambil testimonial yang sudah disetujui
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
