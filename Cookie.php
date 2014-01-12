<?php

/*
 * The MIT License
 *
 * Copyright 2013-2014 Mathieu SAVELLI <mathieu.savelli@awakenweb.fr>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Iridium\Components\HttpStack;

class Cookie implements Cookie\CookieInterface
{

    protected $name     = '';
    protected $value    = '';
    protected $expire   = 0;
    protected $path     = '/';
    protected $domain   = '';
    protected $secure   = false;
    protected $httponly = true;

    /**
     *
     * @param  string                    $name
     * @throws \InvalidArgumentException
     */
    public function __construct($name)
    {
        if ( empty( $name ) || $name === '' ) {
            throw new \InvalidArgumentException( 'Un nom de cookie ne peut pas être vide' );
        }
        $this->name = $name;

        $this->expire();
        $this->path();
        $this->domain();
        $this->secure();
        $this->httponly();
    }

    /**
     * define the value of the cookie
     *
     * @param  mixed                   $value
     * @return \Iridium\Request\Cookie
     */
    public function value($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * expire date of the cookie
     *
     * @param  int                     $expire
     * @return \Iridium\Request\Cookie
     */
    public function expire($expire = 0)
    {
        $this->expire = $expire;

        return $this;
    }

    /**
     * subdirectories allowed to access the cookie
     *
     * @param  string                  $path
     * @return \Iridium\Request\Cookie
     */
    public function path($path = '/')
    {
        $this->path = $path;

        return $this;
    }

    /**
     * domain and subdomains allowed to access the cookie
     *
     * @param  string                  $domain
     * @return \Iridium\Request\Cookie
     */
    public function domain($domain = '')
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * does the cookie be only transmitted using HTTPS ?
     *
     * @param  bool                    $secure
     * @return \Iridium\Request\Cookie
     */
    public function secure($secure = false)
    {
        $this->secure = $secure;

        return $this;
    }

    /**
     * is the cookie readable using javascript or only allowed on HTTP ?
     *
     * @param  bool                    $httponly
     * @return \Iridium\Request\Cookie
     */
    public function httponly($httponly = true)
    {
        $this->httponly = $httponly;

        return $this;
    }

    /**
     * sends the cookie
     *
     * @return bool true if success, false else
     */
    public function send()
    {
        return setcookie( $this->name , $this->value , $this->expire , $this->path , $this->domain , $this->secure , $this->httponly );
    }

    /**
     * returns the cookie as a header string
     *
     * @return string
     */
    public function __toString()
    {

        $date = new \DateTime( '@' . $this->expire , new \DateTimeZone( 'Europe/Paris' ) );
        $date = $date->format( \DateTime::COOKIE );

        $s = "Set-Cookie: {$this->name}={$this->value}; expires=$date";
        $s.= is_null( $this->path ) || empty( $this->path ) ? '' : "; path={$this->path}";
        $s.= is_null( $this->domain ) || empty( $this->domain ) ? '' : "; domain = {$this->domain}";
        $s.= $this->secure ? "; secure" : '';
        $s.= $this->httponly ? "; httponly" : '';

        return $s;
    }

}
