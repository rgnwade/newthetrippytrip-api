<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class AccessToken {

    /**
     * Access Token
     *
     * @var string
     */
    private $accessToken = '';

    /**
     * Refresh Token
     *
     * @var string
     */
    private $refreshToken = '';

    /**
     * Logged in user
     *
     * @var null
     */
    private $user = null;

    /**
     * Minutes to expired
     *
     * @var int
     */
    private $minutesToExpired = 10080; // 7 days

    /**
     * AccessToken constructor.
     *
     * @param $user
     * @param $accessToken
     * @param $refreshToken
     */
    public function __construct($user = null, $accessToken = null, $refreshToken = null)
    {
        $this->user = $user;

        if( ! $user && Auth::check()) {
            $this->user = Auth::user();
        }

        if( ! $accessToken) {
            $accessToken = Hash::make(uniqid(15));
        }

        if( ! $refreshToken) {
            $refreshToken = Hash::make(uniqid(15));
        }

        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
    }

    /**
     * Retrieve access token
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Set access token
     *
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * Retrieve refresh token
     *
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Set refresh token
     *
     * @param string $refreshToken
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * Get user
     *
     * @return null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param null $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Store access token
     */
    public function storeAccessToken()
    {
        Redis::set('api.token.' .  $this->getAccessToken(), $this->getUser()->id);

        $this->extendAccessToken();

        return $this;
    }

    /**
     * Store refresh token
     */
    public function storeRefreshToken()
    {
        Redis::set('api.refresh.' .  $this->getRefreshToken(), $this->getUser()->id);

        $this->extendRefreshToken();

        return $this;
    }

    /**
     * Extend access token
     */
    public function extendAccessToken()
    {
        $now = Carbon::now();

        Redis::expireAt('api.token.' . $this->getAccessToken(), $now->addMinutes($this->minutesToExpired)->timestamp);

        return $this;
    }

    /**
     * Extend refresh token
     */
    public function extendRefreshToken()
    {
        $now = Carbon::now();

        Redis::expireAt('api.refresh.' . $this->getRefreshToken(), $now->addMinutes($this->minutesToExpired * 2)->timestamp);

        return $this;
    }

    /**
     * Exists access token
     *
     * @return mixed
     */
    public function existsAccessToken()
    {
        return Redis::exists('api.token.' . $this->getAccessToken());
    }

    /**
     * Exists refresh token
     *
     * @return mixed
     */
    public function existsRefreshToken()
    {
        return Redis::exists('api.refresh.' . $this->getRefreshToken());
    }

    /**
     * Get User ID
     *
     * @return mixed
     */
    public function getUserByAccessToken()
    {
        return Redis::get('api.token.' . $this->getAccessToken());
    }

    /**
     * Get User ID
     *
     * @return mixed
     */
    public function getUserByRefreshToken()
    {
        return Redis::get('api.refresh.' . $this->getRefreshToken());
    }
}