<?php

/*
 * The MIT License
 *
 * Copyright 2013 Mathieu.
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

namespace Iridium\Components\HttpStack\Request;

/**
 *
 */
interface RequestInterface
{

    public function __construct();

    public function getPathInfo();

    public function getRequestTime();

    public function getReferer();

    public function getUserAgent();

    public function getIp();

    public function hasProxy();

    public function getProxyIp();

    public function isHttps();

    public function isXmlHttpRequest();

    public function isFlash();

    public function getRequestMethod();

    public function isGet();

    public function isPut();

    public function isPost();

    public function isPatch();

    public function isOptions();

    public function isHead();

    public function isTrace();

    public function isDelete();

    public function get( $name , $value = null );

    public function put( $name , $value = null );

    public function post( $name , $value = null );

    public function patch( $name , $value = null );

    public function delete( $name , $value = null );

    public function head( $name , $value = null );

    public function trace( $name , $value = null );

    public function options( $name , $value = null );

    public function cookie( $name );

    public function getLanguage();
}
