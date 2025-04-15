<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'status' => 'boolean'
    ];

    public function scopeUnread($query)
    {
        return $query->where('status', false);
    }

    public function scopeRead($query)
    {
        return $query->where('status', true);
    }

    public function markAsRead()
    {
        $this->update(['status' => true]);
    }

    public function markAsUnread()
    {
        $this->update(['status' => false]);
    }
}
