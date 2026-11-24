<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'is_admin', 'eco_points'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function progress(): HasMany
    {
        return $this->hasMany(ModuleProgress::class);
    }

    public function tests(): HasMany
    {
        return $this->hasMany(TestAttempt::class);
    }

    public function survey(): HasOne
    {
        return $this->hasOne(SurveyResponse::class);
    }

    public function levelProgress(int $level): ?ModuleProgress
    {
        return $this->progress->firstWhere('level', $level);
    }

    public function isLevelComplete(int $level): bool
    {
        return (bool) optional($this->levelProgress($level))->completed;
    }

    public function completedLevels(): int
    {
        return $this->progress->where('completed', true)->count();
    }

    /** A level opens after the pre-test and after the previous level is complete. */
    public function isLevelUnlocked(int $level): bool
    {
        if (! $this->testScore('pre')) {
            return false;
        }

        return $level === 1 || $this->isLevelComplete($level - 1);
    }

    public function testScore(string $type): ?TestAttempt
    {
        return $this->tests->firstWhere('type', $type);
    }

    public function addPoints(int $points): void
    {
        if ($points > 0) {
            $this->increment('eco_points', $points);
        }
    }

    /** 0 = polluted planet, 4 = fully healed planet. */
    public function planetStage(): int
    {
        return $this->completedLevels();
    }

    /** @return array<int, array{name:string, earned:bool, hint:string}> */
    public function badges(): array
    {
        $levels = config('ecoquest.levels');
        $badges = [[
            'name' => 'Eco Starter',
            'earned' => (bool) $this->testScore('pre'),
            'hint' => 'Complete the pre-test',
        ]];

        foreach ($levels as $n => $level) {
            $badges[] = [
                'name' => $level['badge'],
                'earned' => $this->isLevelComplete($n),
                'hint' => "Complete Level {$n}: {$level['title']}",
            ];
        }

        $badges[] = [
            'name' => 'Eco Hero',
            'earned' => $this->completedLevels() === count($levels) && (bool) $this->testScore('post'),
            'hint' => 'Finish all levels and the post-test',
        ];

        return $badges;
    }
}
