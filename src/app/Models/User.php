<?php

namespace App\Models;

use App\Mail\BareMail;
use App\Notifications\PasswordResetNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Article;
use App\Models\Comment;
use App\Models\SoundCategory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'age',
        'self_introduction',
        'gender_id',
        'pref_id',
        'prof_video_path',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //
    public function user_secondaryCategories()
    {
        return $this->belongsToMany(SecondaryCategory::class);
    }

    // 楽器名検索
    public function scopeSecondaryCategory($query, ?array $categoryIds)
    {
        if (is_null($categoryIds)) {
            return;
        }

        if(count($categoryIds) !== 0)
        {
            return $query->whereHas('user_secondaryCategories', function($query) use($categoryIds) {
                $query->whereIn('secondary_category_id', $categoryIds);
            });
        } else {
            return;
        }
    }

    public function user_soundCategories()
    {
        return $this->belongsToMany(SoundCategory::class);
    }

    // 音楽性検索
    public function scopeSoundCategoryFilter($query, ?array $soundCategoryIds)
    {
        if (is_null($soundCategoryIds)) {
            return;
        }
        
        if(count($soundCategoryIds) !== 0)
        {
            return $query->whereHas('user_soundCategories', function($query) use($soundCategoryIds) {
                $query->whereIn('sound_category_id', $soundCategoryIds);
            });
        } else {
            return;
        }
    }

    // 都道府県名を返す
    public function getPrefNameAttribute()
    {
        return config('pref.' .$this->pref_id);
    }

    // 都道府県検索
    public function scopePrefFilter($query, string $pref = null)
    {
        if (!$pref) {
            return $query;
        }

        return $query->where('pref_id', $pref);
    }

    public function getGenderNameAttribute()
    {
        return config('gender.' .$this->gender_id);
    }

    // 性別検索
    public function scopeGenderFilter($query, string $gender = null)
    {
        if (!$gender) {
            return $query;
        }

        return $query->where('gender_id', $gender);
    }

    // 年齢〇〇歳以上
    public function scopeAgeFromFilter($query, $age_from = null)
    {
        if(!$age_from) {
            return $query;
        }

        return $query->where('age', '>=', $age_from);
    }

    // 年齢〇〇歳以下
    public function scopeAgeToFilter($query, $age_to = null)
    {
        if(!$age_to) {
            return $query;
        }

        return $query->where('age', '<=', $age_to);
    }

    // 名前検索
    public function scopenameFilter($query, $name)
    {
        if(!$name){
            return $query;
        }
        return $query->where('name', 'like', '%'.$name.'%');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token, new BareMail()));
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'followee_id', 'follower_id')->withTimestamps();
    }

    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followee_id')->withTimestamps();
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'likes')->withTimestamps();
    }

    public function isFollowedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->followers->where('id', $user->id)->count()
            : false;
    }

    public function getCountFollowersAttribute(): int
    {
        return $this->followers->count();
    }

    public function getCountFollowingsAttribute(): int
    {
        return $this->followings->count();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
