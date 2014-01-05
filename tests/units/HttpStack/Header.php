<?php

namespace Iridium\Components\tests\units\HttpStack;

require_once __DIR__ . '/../../../vendor/autoload.php';

use \atoum ,
    \Iridium\Components\HttpStack\Header as IrHeader;

class Header extends atoum
{

    public function testHeaderCreate()
    {
        $this->object( new IrHeader( 'HTTP/1.1 404 Not Found' ) )
                ->isInstanceOf( '\Iridium\Components\HttpStack\Header' );
    }

    public function testToString()
    {
        $this->castToString( new IrHeader( 'HTTP/1.1 404 Not Found' ) )
                ->isEqualTo( 'HTTP/1.1 404 Not Found' );
    }

    public function testNameAndContent()
    {
        $this->castToString( new IrHeader( 'Location: http://www.example.com' ) )
                ->isEqualTo( 'Location: http://www.example.com' );
    }

    public function testMultiLineHeaderThrowsError()
    {
        $this->when( (new IrHeader( "HTTP/1.1 404 Not Found\nStatus: test" ) )->send() )
                ->error()
                ->exists();
    }

    public function testRemove()
    {
        $this->when( $head = new IrHeader( "HTTP/1.1 200 Ok" ) )
                ->object( $head->remove() )
                ->isIdenticalTo( $head );
    }

}
