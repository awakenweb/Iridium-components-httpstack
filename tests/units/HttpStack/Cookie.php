<?php

namespace Iridium\Components\tests\units\HttpStack;

require_once __DIR__ . '/../../../vendor/autoload.php';

use \atoum,
    \Iridium\Components\HttpStack\Cookie as IrCookie;

class Cookie extends atoum
{

    public function testCookieCreate()
    {
        $this->exception(function () {
                    $cookie = new IrCookie('');
                })
                ->isInstanceOf('\InvalidArgumentException');

        $cookie = new IrCookie('test');
        $cookie->value('test');

        $this->boolean($cookie->send())
                ->isTrue();
    }

    /**
     * @dataProvider toStringProvider
     */
    public function testToString($name, $value, $expire, $path, $domain, $secure, $httponly, $finalstring)
    {
        $cook = new IrCookie($name, $expire, $path, $domain, $secure, $httponly);

        $cook->value($value);
        $this->castToString($cook)
                ->isEqualTo($finalstring);
    }

    /**
     * fournisseur de données pour testToString
     */
    public function toStringProvider()
    {
        $date3  = date(DATE_COOKIE, 3);
        $date10 = date(DATE_COOKIE, 10);

        return array(
            array('blablabla', 'COOKIIIIIIEES', 3, '/test', '.test', true, true, 'Set-Cookie: blablabla=COOKIIIIIIEES; expires=' . $date3 . '; path=/test; domain = .test; secure; httponly'),
            array('blablabla', 'COOKIIIIIIEES', 3, '/test', '.test', true, false, 'Set-Cookie: blablabla=COOKIIIIIIEES; expires=' . $date3 . '; path=/test; domain = .test; secure'),
            array('blablabla', 'COOKIIIIIIEES', 3, '/test', '.test', false, true, 'Set-Cookie: blablabla=COOKIIIIIIEES; expires=' . $date3 . '; path=/test; domain = .test; httponly'),
            array('blablabla', 'COOKIIIIIIEES', 3, '/test', '', true, true, 'Set-Cookie: blablabla=COOKIIIIIIEES; expires=' . $date3 . '; path=/test; secure; httponly'),
            array('blablabla', 'COOKIIIIIIEES', 3, '', '.test', true, true, 'Set-Cookie: blablabla=COOKIIIIIIEES; expires=' . $date3 . '; domain = .test; secure; httponly'),
            array('blablabla', 'COOKIIIIIIEES', 10, '/test', '.test', true, true, 'Set-Cookie: blablabla=COOKIIIIIIEES; expires=' . $date10 . '; path=/test; domain = .test; secure; httponly'),
            array('blablabla', 'COOKIIIIIIEES', 10, '', '', false, false, 'Set-Cookie: blablabla=COOKIIIIIIEES; expires=' . $date10)
        );
    }

}
