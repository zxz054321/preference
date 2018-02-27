<?php

namespace AbelHalo\Preference;

use Illuminate\Cache\CacheManager;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class Preference
{
    /**
     * @var CacheManager
     */
    protected $cache;

    /**
     * @var Model
     */
    protected $model;

    protected $id;

    public function __construct($id = null)
    {
        $this->id    = $id ?: Auth::id();
        $this->cache = app('cache');
        $this->model = new Model();
    }

    public static function viaUser(User $user)
    {
        return static::useId($user->id);
    }

    public static function useId($id)
    {
        return new static($id);
    }

    /**
     * @return array|null
     */
    public function load()
    {
        return $this->cache->rememberForever($this->cacheKey(), function () {
            $preferences = $this->model->find($this->databaseKey());

            return $preferences ? unserialize($preferences->value) : null;
        });
    }

    public function set(array $values)
    {
        $this->model->destroy($this->databaseKey());

        return $this->model->create([
            'key'   => $this->databaseKey(),
            'value' => serialize($values),
        ]);
    }

    public function reset()
    {
        // Cache will be cleaned by model events
        return $this->model->destroy($this->databaseKey());
    }

    public function clearCache()
    {
        return $this->cache->forget($this->cacheKey());
    }

    public function databaseKey()
    {
        return 'user:' . $this->id;
    }

    public function cacheKey()
    {
        return 'preference:' . $this->id;
    }
}
