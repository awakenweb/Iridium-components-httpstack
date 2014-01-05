<?php

/*
 * The MIT License
 *
 * Copyright 2013 Mathieu.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Status: Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "Status: AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
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
interface StatusHeader
{

    // codes 1xx

    const STATUS_CONTINUE                      = "Status: 100 Continue";
    const STATUS_SWITCHING_PROTOCOLS           = "Status: 101 Switching Protocols";
    const STATUS_CONNECTION_TIMED_OUT          = "Status: 118 Connection Timed Out";
    // codes 2xx
    const STATUS_OK                            = "Status: 200 Ok";
    const STATUS_CREATED                       = "Status: 201 Created";
    const STATUS_ACCEPTED                      = "Status: 202 Accepted";
    const STATUS_NON_AUTHORITATIVE_INFORMATION = "Status: 203 Non-Authoritative Information";
    const STATUS_NO_CONTENT                    = "Status: 204 No Content";
    const STATUS_RESET_CONTENT                 = "Status: 205 Reset Content";
    const STATUS_PARTIAL_CONTENT               = "Status: 206 Partial Content";
    // codes 3xx
    const STATUS_MULTIPLE_CHOICE               = "Status: 300 Multiple Choice";
    const STATUS_MOVED_PERMANENTLY             = "Status: 301 Moved Permanently";
    const STATUS_MOVED_TEMPORARILY             = "Status: 302 Moved Temporarily";
    const STATUS_SEE_OTHER                     = "Status: 303 See Other";
    const STATUS_NOT_MODIFIED                  = "Status: 304 Not Modified";
    const STATUS_USE_PROXY                     = "Status: 305 Use Proxy";
    const STATUS_TEMPORARY_REDIRECT            = "Status: 307 Temporary Redirect";
    const STATUS_TOO_MANY_REDIRECTS            = "Status: 310 Too Many Redirects";
    // codes 4xx
    const STATUS_BAD_REQUEST                   = "Status: 400 Bad Request";
    const STATUS_UNAUTHORIZED                  = "Status: 401 Unauthorized";
    const STATUS_FORBIDDEN                     = "Status: 403 Forbidden";
    const STATUS_NOT_FOUND                     = "Status: 404 Not Found";
    const STATUS_METHOD_NOT_ALLOWED            = "Status: 405 Method Not Allowed";
    const STATUS_NOT_ACCEPTABLE                = "Status: 406 Not Acceptable";
    const STATUS_PROXY_AUTHENTICATION_REQUIRED = "Status: 407 Proxy Authentication Required";
    const STATUS_REQUEST_TIME_OUT              = "Status: 408 Request Time-out";
    const STATUS_CONFLICT                      = "Status: 409 Conflict";
    const STATUS_GONE                          = "Status: 410 Gone";
    const STATUS_LENGTH_REQUIRED               = "Status: 411 Length Required";
    const STATUS_PRECONDITION_FAILED           = "Status: 412 Precondition Failed";
    const STATUS_REQUEST_ENTITY_TOO_LARGE      = "Status: 413 Request Entity Too Large";
    const STATUS_REQUEST_URI_TOO_LONG          = "Status: 414 Request-URI Too Long";
    const STATUS_UNSUPPORTED_MEDIA_TYPE        = "Status: 415 Unsupported Media Type";
    const STATUS_REQUESTED_RANGE_UNSATISFIABLE = "Status: 416 Requested range unsatisfiable";
    const STATUS_EXPECTATION_FAILED            = "Status: 417 Expectation failed";
    // codes 5xx
    const STATUS_INTERNAL_SERVER_ERROR         = "Status: 500 Internal Server Error";
    const STATUS_NOT_IMPLEMENTED               = "Status: 501 Not Implemented";
    const STATUS_BAD_GATEWAY                   = "Status: 502 Bad Gateway";
    const STATUS_SERVICE_UNAVAILABLE           = "Status: 503 Service Unavailable";
    const STATUS_GATEWAY_TIME_OUT              = "Status: 504 Gateway Time-out";
    const STATUS_VERSION_NOT_SUPPORTED         = "Status: 505 Version not supported";
    const STATUS_UNKNOWN_ERROR                 = "Status: 520 Web server is returning an unknown error";

}
