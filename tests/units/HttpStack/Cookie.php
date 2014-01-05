<?php

namespace Iridium\Components\tests\units\HttpStack;

require_once __DIR__ . '/../../../vendor/autoload.php';

use \atoum ,
    \Iridium\Components\HttpStack\Cookie as IrCookie;

class Cookie extends atoum
{

    public function testCookieCreate()
    {
        $this->exception( function()
                {
                    $cookie = new IrCookie( '' );
                } )
                ->isInstanceOf( '\InvalidArgumentException' );

        $cookie = new IrCookie( 'test' );
        $cookie->value( 'test' );

        $this->boolean( $cookie->send() )
                ->isTrue();
    }

    /**
     * @dataProvider toStringProvider
     */
    public function testToString( $name , $value , $expire , $path , $domain , $secure , $httponly , $finalstring )
    {
        $cookie = new IrCookie( $name );

        $cookie->value( $value )
                ->expire( $expire )
                ->path( $path )
                ->domain( $domain )
                ->secure( $secure )
                ->httponly( $httponly )
        ;
        $this->castToString( $cookie )
                ->isEqualTo( $finalstring );
    }

    /**
     * fournisseur de données pour testToString
     */
    public function toStringProvider()
    {
        return array(
            array( 'blablabla' , 'COOKIIIIIIEES' , 3 , '/test' , '.test' , true , true , 'Set-Cookie: blablabla=COOKIIIIIIEES; expires=Thursday, 01-Jan-70 00:00:03 GMT+0000; path=/test; domain = .test; secure; httponly' ) ,
            array( 'blablabla' , 'COOKIIIIIIEES' , 3 , '/test' , '.test' , true , false , 'Set-Cookie: blablabla=COOKIIIIIIEES; expires=Thursday, 01-Jan-70 00:00:03 GMT+0000; path=/test; domain = .test; secure' ) ,
            array( 'blablabla' , 'COOKIIIIIIEES' , 3 , '/test' , '.test' , false , true , 'Set-Cookie: blablabla=COOKIIIIIIEES; expires=Thursday, 01-Jan-70 00:00:03 GMT+0000; path=/test; domain = .test; httponly' ) ,
            array( 'blablabla' , 'COOKIIIIIIEES' , 3 , '/test' , '' , true , true , 'Set-Cookie: blablabla=COOKIIIIIIEES; expires=Thursday, 01-Jan-70 00:00:03 GMT+0000; path=/test; secure; httponly' ) ,
            array( 'blablabla' , 'COOKIIIIIIEES' , 3 , '' , '.test' , true , true , 'Set-Cookie: blablabla=COOKIIIIIIEES; expires=Thursday, 01-Jan-70 00:00:03 GMT+0000; domain = .test; secure; httponly' ) ,
            array( 'blablabla' , 'COOKIIIIIIEES' , 10 , '/test' , '.test' , true , true , 'Set-Cookie: blablabla=COOKIIIIIIEES; expires=Thursday, 01-Jan-70 00:00:10 GMT+0000; path=/test; domain = .test; secure; httponly' ) ,
            array( 'blablabla' , 'COOKIIIIIIEES' , 10 , '' , '' , false , false , 'Set-Cookie: blablabla=COOKIIIIIIEES; expires=Thursday, 01-Jan-70 00:00:10 GMT+0000' )
        );
    }

}
