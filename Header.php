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

/**
 * Description of Header
 *
 * @author Mathieu
 */
class Header implements Header\HeaderInterface , Header\StatusHeader , Header\StatusCodeHeader
{

    protected $content = '';
    protected $replace = true;

    /**
     *
     * @param string $content
     * @param bool   $replace
     */
    public function __construct($content , $replace = true)
    {
        $this->content = $content;
        $this->replace = $replace;
    }

    /**
     * sends the header
     */
    public function send()
    {
        header( $this->content , $this->replace );
    }

    /**
     * gets the header as a string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->content;
    }

    /**
     * removes the header from headers to send list
     *
     * @return Iridium\Components\HttpStack\Header\HeaderInterface
     */
    public function remove()
    {
        header_remove( $this->content );

        return $this;
    }

}
