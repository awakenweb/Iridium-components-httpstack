<?php

namespace Iridium\Components\tests\units\HttpStack;

require_once __DIR__ . '/../../../vendor/autoload.php';

use atoum ,
    Iridium\Components\HttpStack\Cookie as IrCookie ,
    Iridium\Components\HttpStack\Header as IrHeader ,
    Iridium\Components\HttpStack\Response as IrResponse;

class Response extends atoum
{

    public function testResponseCreate()
    {
        $response = new IrResponse();
        $this->object( $response );
    }

    public function testToString()
    {
        $mockSendable = new \mock\Iridium\Components\HttpStack\Response\SendableInterface();

        $response = new IrResponse();
        $response->addHeader( new IrHeader( 'HTTP/1.1 200 OK' ) )
                ->addCookie( new IrCookie( 'hello Cookie' ) )
                ->addToBody( 'test' );

        $this->castToString( $response )
                ->isNotEmpty()
                ->contains( 'test' )
                ->contains( 'hello Cookie' )
                ->contains( 'HTTP/1.1 200 OK' );
    }

    public function testSend()
    {
        $response = (new IrResponse() )
                ->addCookie( (new IrCookie( 'blablabla' ) )
                        ->value( 'COOKIIIIIIEES' )
                        ->expire( 3 )
                        ->path( '/test' )
                        ->domain( 'test' )
                        ->secure( true )
                        ->httponly( true ) )
                ->addHeader( new IrHeader( 'HTTP/1.1 202 ACCEPTED' , true ) )
                ->addToBody( 'ceci est un test' );

        ob_start();
        $response->send();
        $result = ob_get_clean();

        $this->string( $result )
                ->contains( 'ceci est un test' );
    }

    public function testHeadOnly()
    {
        $response = new IrResponse();
        $response->addToBody( 'test' )
                ->addCookie( new IrCookie( 'meuh' ) )
                ->addHeader( new IrHeader( 'HTTP/1.1 200 OK' ) )
                ->headOnly( true );

        $this->castToString( $response )
                ->contains( 'Set-Cookie: meuh' )
                ->contains( 'HTTP/1.1 200 OK' )
                ->notContains( 'test' );
    }

}
