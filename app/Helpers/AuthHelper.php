<?php

if (! function_exists('api_token')) {
    /**
     * Get the API access token from the session.
     *
     * @return string|null
     */
    function api_token()
    {
        return session()->get('api_token');
    }
}

if (! function_exists('api_is_authenticated')) {
    /**
     * Check if a user is authenticated via the API session.
     *
     * @return bool
     */
    function api_is_authenticated()
    {
        return session()->has('api_token');
    }
}
