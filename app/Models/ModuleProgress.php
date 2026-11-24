<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModuleProgress extends Model
{
    protected $table = 'module_progress';

    protected $fillable = ['user_id', 'level', 'activity_done', 'quiz_best', 'quiz_attempts', 'completed', 'completed_at'];

    protected function casts(): array
    {
        return [
            'activity_done' => 'boolean',
            'completed' => 'boolean',
            'completed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Mark the level complete once the activity is done and the quiz is passed. */
    public function refreshCompletion(): void
    {
        $passed = $this->quiz_best !== null && $this->quiz_best >= config('ecoquest.quiz_pass_mark');

        if (! $this->completed && $this->activity_done && $passed) {
            $this->completed = true;
            $this->completed_at = now();
        }
    }
}
