<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'is_completed',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @return array
     */
    protected function casts(): array
    {
        return [
            'is_completed' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Scope a query to only include completed tasks.
     */
    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    /**
     * Scope a query to only include pending tasks.
     */
    public function scopePending($query)
    {
        return $query->where('is_completed', false);
    }



    /**
     * Mark the task as completed.
     */
    public function markAsCompleted()
    {
        $this->update(['is_completed' => true]);
    }

    /**
     * Mark the task as pending.
     */
    public function markAsPending()
    {
        $this->update(['is_completed' => false]);
    }



    /**
     * Get the status label.
     */
    public function getStatusLabelAttribute(): string
    {
        return $this->is_completed ? 'Completed' : 'Pending';
    }
}
