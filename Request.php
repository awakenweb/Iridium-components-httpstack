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

class Request implements Request\RequestInterface
{

    const METHOD_GET     = "GET";
    const METHOD_POST    = "POST";
    const METHOD_PUT     = "PUT";
    const METHOD_PATCH   = "PATCH";
    const METHOD_DELETE  = "DELETE";
    const METHOD_TRACE   = "TRACE";
    const METHOD_OPTIONS = "OPTIONS";
    const METHOD_HEAD    = "HEAD";

    protected $requestString = '';
    protected $post;
    protected $put;
    protected $patch;
    protected $delete;
    protected $head;
    protected $options;
    protected $trace;

    /**
     * saves the URI
     * If the HTTP Verb used to send the request is different from GET or POST,
     * stores the request data in corresponding array.
     *
     * @param string $reqstring
     */
    public function __construct()
    {
        switch ($this->getRequestMethod()) {
            case self::METHOD_POST:
                $input = file_get_contents('php://input');
                if (empty($_POST) && $this->isJson($input)) {
                    $this->post = json_decode($input, true);
                } else {
                    $this->input = $_POST;
                }
                if (is_null($this->post)) {
                    $this->post = array();
                }
                break;

            case self::METHOD_PUT :
                $input = file_get_contents('php://input');
                if ($this->isJson($input)) {
                    $this->put = json_decode($input, true);
                } elseif (is_string($input)) {
                    parse_str($input, $this->put);
                }
                if (is_null($this->put)) {
                    $this->put = array();
                }
                break;

            case self::METHOD_PATCH :
                $input = file_get_contents('php://input');
                if ($this->isJson($input)) {
                    $this->patch = json_decode($input, true);
                } elseif (is_string($input)) {
                    parse_str($input, $this->patch);
                }
                if (is_null($this->patch)) {
                    $this->patch = array();
                }
                break;

            case self::METHOD_DELETE :
                $input = file_get_contents('php://input');
                if ($this->isJson($input)) {
                    $this->delete = json_decode($input, true);
                } elseif (is_string($input)) {
                    parse_str($input, $this->delete);
                }
                if (is_null($this->delete)) {
                    $this->delete = array();
                }
                break;

            case self::METHOD_TRACE :
                $input = file_get_contents('php://input');
                if ($this->isJson($input)) {
                    $this->trace = json_decode($input, true);
                } elseif (is_string($input)) {
                    parse_str($input, $this->trace);
                }
                if (is_null($this->trace)) {
                    $this->trace = array();
                }
                break;

            case self::METHOD_HEAD :
                $input = file_get_contents('php://input');
                if ($this->isJson($input)) {
                    $this->head = json_decode($input, true);
                } elseif (is_string($input)) {
                    parse_str($input, $this->head);
                }
                if (is_null($this->head)) {
                    $this->head = array();
                }
                break;

            case self::METHOD_OPTIONS :
                $input = file_get_contents('php://input');
                if ($this->isJson($input)) {
                    $this->options = json_decode($input, true);
                } elseif (is_string($input)) {
                    parse_str($input, $this->options);
                }
                if (is_null($this->options)) {
                    $this->options = array();
                }
                break;
        }
    }

    /**
     * check if a JSON string can be converted to a valid PHP Object
     *
     * @access protected
     *
     * @param string $json
     * @param bool $assoc_array
     * @return bool
     */
    protected function isJson($json, $assoc_array = FALSE)
    {
        // decode the JSON data
        $temp = json_decode($json, $assoc_array);

        // switch and check possible JSON errors
        if (json_last_error() === JSON_ERROR_NONE) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @return string
     */
    public function getPathInfo()
    {
        $path_info = '/';
        if (!empty($_SERVER['PATH_INFO'])) {
            $path_info = $_SERVER['PATH_INFO'];
        } elseif (!empty($_SERVER['ORIG_PATH_INFO']) && $_SERVER['ORIG_PATH_INFO'] !== '/index.php') {
            $path_info = $_SERVER['ORIG_PATH_INFO'];
        } else {
            if (!empty($_SERVER['REQUEST_URI'])) {
                $path_info = (strpos($_SERVER['REQUEST_URI'], '?') > 0) ? strstr($_SERVER['REQUEST_URI'], '?', true) : $_SERVER['REQUEST_URI'];
            }
        }

        return $path_info;
    }

    /**
     *
     * @return string|null
     */
    public function getRequestTime()
    {
        return (isset($_SERVER['REQUEST_TIME'])) ? $_SERVER['REQUEST_TIME'] : null;
    }

    /**
     *
     * @return string|null
     */
    public function getReferer()
    {
        return (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : null;
    }

    /**
     * retourne le user agent
     *
     * @return string|null
     */
    public function getUserAgent()
    {
        return (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : null;
    }

    /**
     * Gets the IP of the request sender.
     * If IP belongs to a proxy and http_x_forwarded_for IP address is set, returns
     * this address instead
     *
     * @return string
     */
    public function getIp()
    {
        if ($this->hasProxy()) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : null;
        }
    }

    /**
     * returns the language of the browser
     *
     * @return string|null
     */
    public function getLanguage()
    {
        return (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : null;
    }

    /**
     * true if a proxy is detected
     *
     * @return bool
     */
    public function hasProxy()
    {
        return isset($_SERVER['HTTP_X_FORWARDED_FOR']);
    }

    /**
     *
     * @return string|null
     */
    public function getProxyIp()
    {
        return (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['REMOTE_ADDR'] : null;
    }

    /**
     *
     * @return bool
     */
    public function isHttps()
    {
        return !(empty($_SERVER['HTTPS']) || ($_SERVER['HTTPS'] === 'off' ));
    }

    /**
     * true if request has been sent through AJAX
     *
     * @return bool
     */
    public function isXmlHttpRequest()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest');
    }

    /**
     * true if request has been sent through Flash
     *
     * @return bool
     */
    public function isFlash()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'Flash');
    }

    /**
     * gets the HTTP Verb used to send the request.
     * throws exception if the HTTP Verb is unknown
     *
     * @return string
     * @throws \UnexpectedValueException
     */
    public function getRequestMethod()
    {
        $accepted_methods = array(self::METHOD_DELETE, self::METHOD_GET, self::METHOD_HEAD, self::METHOD_OPTIONS, self::METHOD_PATCH, self::METHOD_POST, self::METHOD_PUT, self::METHOD_TRACE);
        if (\in_array($_SERVER['REQUEST_METHOD'], $accepted_methods)) {
            return $_SERVER['REQUEST_METHOD'];
        } else {
            throw new \UnexpectedValueException($_SERVER['REQUEST_METHOD'] . 'n\'est pas une méthode valide');
        }
    }

    /**
     *
     * @return bool
     */
    public function isGet()
    {
        return $this->getRequestMethod() === self::METHOD_GET;
    }

    /**
     *
     * @return bool
     */
    public function isPut()
    {
        return $this->getRequestMethod() === self::METHOD_PUT;
    }

    /**
     *
     * @return bool
     */
    public function isPost()
    {
        return $this->getRequestMethod() === self::METHOD_POST;
    }

    /**
     *
     * @return bool
     */
    public function isPatch()
    {
        return $this->getRequestMethod() === self::METHOD_PATCH;
    }

    /**
     * retourne vrai si la méthode de la requete est OPTIONS
     *
     * @return bool
     */
    public function isOptions()
    {
        return $this->getRequestMethod() === self::METHOD_OPTIONS;
    }

    /**
     *
     * @return bool
     */
    public function isHead()
    {
        return $this->getRequestMethod() === self::METHOD_HEAD;
    }

    /**
     *
     * @return TRACE
     */
    public function isTrace()
    {
        return $this->getRequestMethod() === self::METHOD_TRACE;
    }

    /**
     * retourne vrai si la méthode de la requete est DELETE
     *
     * @return bool
     */
    public function isDelete()
    {
        return $this->getRequestMethod() === self::METHOD_DELETE;
    }

    /**
     * gets the $name value from the GET array.
     * If $value is not null, sets the value instead
     * If no parameters are passed, returns all the values as an array
     * (alias for $_GET[$name])
     *
     * @param string $name
     * @param string $value
     *
     * @return string|null|array|Iridium\Request
     * @throws \BadMethodCallException
     */
    public function get($name = null, $value = null)
    {
        if (!$this->isGet()) {
            throw new \BadMethodCallException('calling get() while HTTP verb is not GET');
        }
        if (is_null($name)) {
            return $_GET;
        } elseif (is_null($value)) {
            return isset($_GET[$name]) ? $_GET[$name] : null;
        } else {
            $_GET[$name] = $value;

            return $this;
        }
    }

    /**
     * gets the $name value from the PUT array.
     * If $value is not null, sets the value instead
     * If no parameters are passed, returns all the values as an array
     * (can be seen as alias for $_PUT[$name])
     *
     * @param string $name
     * @param string $value
     *
     * @return string|null|array|Iridium\Request
     * @throws \BadMethodCallException
     */
    public function put($name = null, $value = null)
    {
        if (!$this->isPut()) {
            throw new \BadMethodCallException('calling put() while HTTP verb is not PUT');
        }
        if (is_null($name)) {
            return $this->put;
        } elseif (is_null($value)) {
            return isset($this->put[$name]) ? $this->put[$name] : null;
        } else {
            $this->put[$name] = $value;

            return $this;
        }
    }

    /**
     * gets the $name value from the POST array.
     * If $value is not null, sets the value instead
     * If no parameters are passed, returns all the values as an array
     * (can be seen as alias for $_POST[$name])
     *
     * @param string $name
     * @param string $value
     *
     * @return string|null|array|Iridium\Request
     * @throws \BadMethodCallException
     */
    public function post($name = null, $value = null)
    {
        if (!$this->isPost()) {
            throw new \BadMethodCallException('calling post() while HTTP verb is not POST');
        }
        if (is_null($name)) {
            return $this->post;
        } elseif (is_null($value)) {
            return isset($this->post[$name]) ? $this->post[$name] : null;
        } else {
            $this->post[$name] = $value;

            return $this;
        }
    }

    /**
     * gets the $name value from the PATCH array.
     * If $value is not null, sets the value instead
     * If no parameters are passed, returns all the values as an array
     * (can be seen as alias for $_PATCH[$name])
     *
     * @param string $name
     * @param string $value
     *
     * @return string|null|array|Iridium\Request
     * @throws \BadMethodCallException
     */
    public function patch($name = null, $value = null)
    {
        if (!$this->isPatch()) {
            throw new \BadMethodCallException('calling patch() while HTTP verb is not PATCH');
        }
        if (is_null($name)) {
            return $this->patch;
        } elseif (is_null($value)) {
            return isset($this->patch[$name]) ? $this->patch[$name] : null;
        } else {
            $this->patch[$name] = $value;

            return $this;
        }
    }

    /**
     * gets the $name value from the DELETE array.
     * If $value is not null, sets the value instead
     * If no parameters are passed, returns all the values as an array
     * (can be seen as alias for $_DELETE[$name])
     *
     * @param string $name
     * @param string $value
     *
     * @return string|null|array|Iridium\Request
     * @throws \BadMethodCallException
     */
    public function delete($name = null, $value = null)
    {
        if (!$this->isDelete()) {
            throw new \BadMethodCallException('calling delete() while HTTP verb is not DELETE');
        }
        if (is_null($name)) {
            return $this->delete;
        } elseif (is_null($value)) {
            return isset($this->delete[$name]) ? $this->delete[$name] : null;
        } else {
            $this->delete[$name] = $value;

            return $this;
        }
    }

    /**
     * rgets the $name value from the HEAD array.
     * If $value is not null, sets the value instead
     * If no parameters are passed, returns all the values as an array
     * (can be seen as alias for $_HEAD[$name])
     *
     * @param string $name
     * @param string $value
     *
     * @return string|null|array|Iridium\Request
     * @throws \BadMethodCallException
     */
    public function head($name = null, $value = null)
    {
        if (!$this->isHead()) {
            throw new \BadMethodCallException('calling head() while HTTP verb is not HEAD');
        }
        if (is_null($name)) {
            return $this->head;
        } elseif (is_null($value)) {
            return isset($this->head[$name]) ? $this->head[$name] : null;
        } else {
            $this->head[$name] = $value;

            return $this;
        }
    }

    /**
     * gets the $name value from the OPTIONS array.
     * If $value is not null, sets the value instead
     * If no parameters are passed, returns all the values as an array
     * (can be seen as alias for $_OPTIONS[$name])
     *
     * @param string $name
     * @param string $value
     *
     * @return string|null|array|Iridium\Request
     * @throws \BadMethodCallException
     */
    public function options($name = null, $value = null)
    {
        if (!$this->isOptions()) {
            throw new \BadMethodCallException('calling options() while HTTP verb is not OPTIONS');
        }
        if (is_null($name)) {
            return $this->options;
        } elseif (is_null($value)) {
            return isset($this->options[$name]) ? $this->options[$name] : null;
        } else {
            $this->options[$name] = $value;

            return $this;
        }
    }

    /**
     * gets the $name value from the TRACE array.
     * If $value is not null, sets the value instead
     * If no parameters are passed, returns all the values as an array
     * (can be seen as alias for $_TRACE[$name])
     *
     * @param string $name
     * @param string $value
     *
     * @return string|null|array|Iridium\Request
     * @throws \BadMethodCallException
     */
    public function trace($name = null, $value = null)
    {
        if (!$this->isTrace()) {
            throw new \BadMethodCallException('calling trace() while HTTP verb is not TRACE');
        }
        if (is_null($name)) {
            return $this->trace;
        } elseif (is_null($value)) {
            return isset($this->trace[$name]) ? $this->trace[$name] : null;
        } else {
            $this->trace[$name] = $value;

            return $this;
        }
    }

    /**
     * reads a value from a Cookie
     * If no parameters are passed, returns all the values as an array
     *
     * @param  string|array|null $name
     * @return type
     */
    public function cookie($name = null)
    {
        if (is_null($name)) {
            return $_COOKIE;
        }
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }

}
