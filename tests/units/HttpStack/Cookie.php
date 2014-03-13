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
    }}
