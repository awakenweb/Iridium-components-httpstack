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

namespace Iridium\Components\HttpStack\Header;

/**
 * Description of Status
 *
 * @author Mathieu
 */
interface StatusCodeHeader
{

    // codes 1xx

    const STATUSCODE_CONTINUE                      = 'HTTP/1.1 100';
    const STATUSCODE_SWITCHING_PROTOCOLS           = 'HTTP/1.1 101';
    const STATUSCODE_CONNECTION_TIMED_OUT          = 'HTTP/1.1 118';
    // codes 2xx
    const STATUSCODE_OK                            = 'HTTP/1.1 200';
    const STATUSCODE_CREATED                       = 'HTTP/1.1 201';
    const STATUSCODE_ACCEPTED                      = 'HTTP/1.1 202';
    const STATUSCODE_NON_AUTHORITATIVE_INFORMATION = 'HTTP/1.1 203';
    const STATUSCODE_NO_CONTENT                    = 'HTTP/1.1 204';
    const STATUSCODE_RESET_CONTENT                 = 'HTTP/1.1 205';
    const STATUSCODE_PARTIAL_CONTENT               = 'HTTP/1.1 206';
    // codes 3xx
    const STATUSCODE_MULTIPLE_CHOICE               = 'HTTP/1.1 300';
    const STATUSCODE_MOVED_PERMANENTLY             = 'HTTP/1.1 301';
    const STATUSCODE_MOVED_TEMPORARILY             = 'HTTP/1.1 302';
    const STATUSCODE_SEE_OTHER                     = 'HTTP/1.1 303';
    const STATUSCODE_NOT_MODIFIED                  = 'HTTP/1.1 304';
    const STATUSCODE_USE_PROXY                     = 'HTTP/1.1 305';
    const STATUSCODE_TEMPORARY_REDIRECT            = 'HTTP/1.1 307';
    const STATUSCODE_TOO_MANY_REDIRECTS            = 'HTTP/1.1 310';
    // codes 4xx
    const STATUSCODE_BAD_REQUEST                   = 'HTTP/1.1 400';
    const STATUSCODE_UNAUTHORIZED                  = 'HTTP/1.1 401';
    const STATUSCODE_FORBIDDEN                     = 'HTTP/1.1 403';
    const STATUSCODE_NOT_FOUND                     = 'HTTP/1.1 404';
    const STATUSCODE_METHOD_NOT_ALLOWED            = 'HTTP/1.1 405';
    const STATUSCODE_NOT_ACCEPTABLE                = 'HTTP/1.1 406';
    const STATUSCODE_PROXY_AUTHENTICATION_REQUIRED = 'HTTP/1.1 407';
    const STATUSCODE_REQUEST_TIME_OUT              = 'HTTP/1.1 408';
    const STATUSCODE_CONFLICT                      = 'HTTP/1.1 409';
    const STATUSCODE_GONE                          = 'HTTP/1.1 410';
    const STATUSCODE_LENGTH_REQUIRED               = 'HTTP/1.1 411';
    const STATUSCODE_PRECONDITION_FAILED           = 'HTTP/1.1 412';
    const STATUSCODE_REQUEST_ENTITY_TOO_LARGE      = 'HTTP/1.1 413';
    const STATUSCODE_REQUEST_URI_TOO_LONG          = 'HTTP/1.1 414';
    const STATUSCODE_UNSUPPORTED_MEDIA_TYPE        = 'HTTP/1.1 415';
    const STATUSCODE_REQUESTED_RANGE_UNSATISFIABLE = 'HTTP/1.1 416';
    const STATUSCODE_EXPECTATION_FAILED            = 'HTTP/1.1 417';
    // codes 5xx
    const STATUSCODE_INTERNAL_SERVER_ERROR         = 'HTTP/1.1 500';
    const STATUSCODE_NOT_IMPLEMENTED               = 'HTTP/1.1 501';
    const STATUSCODE_BAD_GATEWAY                   = 'HTTP/1.1 502';
    const STATUSCODE_SERVICE_UNAVAILABLE           = 'HTTP/1.1 503';
    const STATUSCODE_GATEWAY_TIME_OUT              = 'HTTP/1.1 504';
    const STATUSCODE_VERSION_NOT_SUPPORTED         = 'HTTP/1.1 505';
    const STATUSCODE_UNKNOWN_ERROR                 = 'HTTP/1.1 520';

}
