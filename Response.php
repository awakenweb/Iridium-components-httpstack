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

namespace Iridium\Components\HttpStack;

class Response implements Response\ResponseInterface
{

    /**
     *
     * @var \SplObjectStorage
     */
    protected $headers;

    /**
     *
     * @var \SplObjectStorage
     */
    protected $cookies;

    /**
     *
     * @var array
     */
    protected $body;

    /**
     *
     * @var bool
     */
    protected $headOnly;

    public function __construct()
    {
        $this->headers = array();
        $this->cookies = array();
        $this->body    = array();
        $this->headOnly( false );
    }

    /**
     * gets the response as string
     *
     * @return type
     */
    public function __toString()
    {
        $s = '';

        foreach ($this->headers as $header) {
            $s .= $header;
        }

        foreach ($this->cookies as $cookie) {
            $s .= $cookie;
        }

        if (! $this->headOnly) {
            foreach ($this->body as $bodyPart) {
                $s .= $bodyPart;
            }
        }

        return $s;
    }

    /**
     * send the response through HTTP
     */
    public function send()
    {
        foreach ($this->headers as $header) {
            $header->send();
        }

        foreach ($this->cookies as $cookie) {
            $cookie->send();
        }

        if (! $this->headOnly) {
            foreach ($this->body as $bodyPart) {
                echo $bodyPart;
            }
        }
    }

    /**
     * add a cookie to the response
     *
     * @param  \Iridium\Components\HttpStack\Cookie\CookieInterface $cookie
     * @return \Iridium\Components\HttpStack\Response
     */
    public function addCookie(Cookie\CookieInterface $cookie)
    {
        $this->cookies[] = $cookie;

        return $this;
    }

    /**
     * add a header to the response
     *
     * @param  \Iridium\Components\HttpStack\Header\HeaderInterface $header
     * @return \Iridium\Components\HttpStack\Response
     */
    public function addHeader(Header\HeaderInterface $header)
    {
        $this->headers[] = $header;

        return $this;
    }

    /**
     * add text to the response body
     *
     * @param  string                 $text
     * @return \Iridium\Components\HttpStack\Response
     */
    public function addToBody($text)
    {
        $this->body[] = $text;

        return $this;
    }

    /**
     * send only headers and cookies (for HEAD requests)
     *
     * @param bool $active
     */
    public function headOnly($active = true)
    {
        $this->headOnly = $active;

        return $this;
    }

}
