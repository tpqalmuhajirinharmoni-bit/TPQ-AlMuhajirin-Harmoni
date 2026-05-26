<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'body',
        'data',
        'read_at',
    ];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function createForUser(User $user, string $type, string $title, ?string $body = null, array $data = []): self
    {
        return self::create([
            'user_id' => $user->id,
            'type' => $type,
            'title' => $title,
            'body' => $body,
            'data' => $data,
        ]);
    }

    public static function createForAdmins(string $type, string $title, ?string $body = null, array $data = []): void
    {
        $adminRole = Role::where('slug', 'admin')->first();
        if (! $adminRole) {
            return;
        }

        foreach ($adminRole->users as $admin) {
            self::createForUser($admin, $type, $title, $body, $data);
        }
    }
}
