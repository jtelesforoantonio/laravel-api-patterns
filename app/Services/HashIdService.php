<?php

namespace App\Services;

use App\Exceptions\HashIdException;
use Hashids\Hashids;

class HashIdService
{
    /**
     * HashIds.
     */
    private Hashids $hashids;

    public function __construct()
    {
        $this->hashids = new Hashids(config('app.hashids.salt'), config('app.hashids.length'));
    }

    /**
     * Encode Id.
     */
    public static function encode(int $id): string
    {
        return (new static())->hashids->encode($id);
    }

    /**
     * Decode hash.
     */
    public static function decode(string $hash): int
    {
        if ($decode = (new static())->hashids->decode($hash)) {
            return $decode[0];
        } else {
            throw new HashIdException($hash);
        }
    }
}
