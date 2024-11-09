<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    public const TABLE = 'images';
    public const ID_COLUMN = 'id';
    public const PATH_COLUMN = 'path';
    public const RELATION_MORPH = 'imageable';

    public const CREATED_AT_COLUMN = 'created_at';
    public const UPDATED_AT_COLUMN = 'updated_at';
    public const DELETED_AT_COLUMN = 'deleted_at';

    protected $fillable = ['path'];

    protected $appends = ['url'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        self::ID_COLUMN,
        self::PATH_COLUMN,
        'imageable_id',
        'imageable_type',
        self::CREATED_AT_COLUMN,
        self::UPDATED_AT_COLUMN,
        self::DELETED_AT_COLUMN,
    ];

    /**
     * Get the image's ID.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    /**
     * Get the image's path.
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->getAttribute(self::PATH_COLUMN);
    }

    /**
     * imageable morphTo relationship
     * @return MorphTo
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the image's created at timestamp.
     *
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->getAttribute(self::CREATED_AT_COLUMN);
    }

    /**
     * Get the image's updated at timestamp.
     *
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->getAttribute(self::UPDATED_AT_COLUMN);
    }

    /**
     * Get the image's deleted at timestamp.
     *
     * @return Carbon|null
     */
    public function getDeletedAt(): ?Carbon
    {
        return $this->getAttribute(self::DELETED_AT_COLUMN);
    }

    /**
     * Get Product Url
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return Storage::url($this->path);
    }
}
