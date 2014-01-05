<?php

namespace Iridium\Components\tests\units\HttpStack;

require_once __DIR__ . '/../../../vendor/autoload.php';

use \atoum ,
    \Iridium\Components\HttpStack\Request as IrRequest;

class Request extends atoum
{

    public function testRequestCreate()
    {

        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_GET;
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $request                     = new IrRequest();

        $this->string( $request->getPathInfo() )
                ->isEqualTo( '/index.php' );

        $_SERVER[ 'REQUEST_URI' ] = '/test/essai.php';
        $request                  = new IrRequest();
        $this->string( $request->getPathInfo() )
                ->isEqualTo( '/test/essai.php' );
    }

    public function testRequestCreateGetMethod()
    {
        // on teste la méthode GET
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_GET;
        $request                     = new IrRequest();
        $this->string( $request->getRequestMethod() )
                ->isEqualTo( IrRequest::METHOD_GET )
                ->boolean( $request->isGet() )
                ->isTrue();
    }

    public function testRequestCreatePostMethod()
    {
        // on teste la méthode POST
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_POST;
        $request                     = new IrRequest();
        $this->string( $request->getRequestMethod() )
                ->isEqualTo( IrRequest::METHOD_POST )
                ->boolean( $request->isPost() )
                ->isTrue();
    }

    public function testRequestCreatePutMethod()
    {
        // on teste la méthode PUT
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_PUT;
        $request                     = new IrRequest();
        $this->string( $request->getRequestMethod() )
                ->isEqualTo( IrRequest::METHOD_PUT )
                ->boolean( $request->isPut() )
                ->isTrue();
    }

    public function testRequestCreatePatchMethod()
    {
        // on teste la méthode PATCH
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_PATCH;
        $request                     = new IrRequest();
        $this->string( $request->getRequestMethod() )
                ->isEqualTo( IrRequest::METHOD_PATCH )
                ->boolean( $request->isPatch() )
                ->isTrue();
    }

    public function testRequestCreateDeleteMethod()
    {
        // on teste la méthode DELETE
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_DELETE;
        $request                     = new IrRequest();
        $this->string( $request->getRequestMethod() )
                ->isEqualTo( IrRequest::METHOD_DELETE )
                ->boolean( $request->isDelete() )
                ->isTrue();
    }

    public function testRequestCreateHeadMethod()
    {
        // on teste la méthode HEAD
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_HEAD;
        $request                     = new IrRequest();
        $this->string( $request->getRequestMethod() )
                ->isEqualTo( IrRequest::METHOD_HEAD )
                ->boolean( $request->isHead() )
                ->isTrue();
    }

    public function testRequestCreateOptionsMethod()
    {
        // on teste la méthode OPTIONS
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_OPTIONS;
        $request                     = new IrRequest();
        $this->string( $request->getRequestMethod() )
                ->isEqualTo( IrRequest::METHOD_OPTIONS )
                ->boolean( $request->isOptions() )
                ->isTrue();
    }

    public function testRequestCreateTraceMethod()
    {
        // on teste la méthode TRACE
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_TRACE;
        $request                     = new IrRequest();
        $this->string( $request->getRequestMethod() )
                ->isEqualTo( IrRequest::METHOD_TRACE )
                ->boolean( $request->isTrace() )
                ->isTrue();
    }

    public function testRequestCreateWrongMethod()
    {
        // on teste une méthode inconnue pour voir si elle lève une exception
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = 'METHODE_BLABLABLA';
        $this->exception( function()
                {
                    $req = new IrRequest();
                } )
                ->isInstanceOf( '\UnexpectedValueException' );
    }

    public function testRequestMetadataRequestTime()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_GET;
        $req                         = new IrRequest();

        // REQUEST_TIME
        $this->integer( $req->getRequestTime() )
                ->isEqualTo( $_SERVER[ 'REQUEST_TIME' ] );
    }

    public function testRequestMetadataReferer()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_GET;
        $req                         = new IrRequest();


        // HTTP_REFERER
        $this->variable( $req->getReferer() )
                ->isNull();
        $_SERVER[ 'HTTP_REFERER' ] = "/goubiboulga.php";
        $this->string( $req->getReferer() )
                ->isEqualTo( $_SERVER[ 'HTTP_REFERER' ] );
    }

    public function testRequestMetadataUserAgent()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_GET;
        $req                         = new IrRequest();

        // USER_AGENT
        $this->variable( $req->getUserAgent() )
                ->isNull();
        $_SERVER[ 'HTTP_USER_AGENT' ] = "Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36";
        $this->string( $req->getUserAgent() )
                ->isEqualTo( 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.62 Safari/537.36' );
    }

    public function testRequestMetadataLanguage()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_GET;
        $req                         = new IrRequest();


        // HTTP_ACCEPT_LANGUAGE
        $this->variable( $req->getLanguage() )
                ->isNull();
        $_SERVER[ 'HTTP_ACCEPT_LANGUAGE' ] = "fr";
        $this->string( $req->getLanguage() )
                ->isEqualTo( 'fr' );
    }

    public function testRequestIpWithoutProxy()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_GET;
        $req                         = new IrRequest();

        $this->variable( $req->getIp() )
                ->isNull();

        $_SERVER[ 'REMOTE_ADDR' ] = "127.0.0.1";
        $this->boolean( $req->hasProxy() )
                ->isFalse()
                ->variable( $req->getProxyIp() )
                ->isNull()
                ->string( $req->getIp() )
                ->isEqualTo( "127.0.0.1" );
    }

    public function testRequestIpWithProxy()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_GET;
        $req                         = new IrRequest();

        $_SERVER[ 'HTTP_X_FORWARDED_FOR' ] = '10.0.0.1';
        $_SERVER[ 'REMOTE_ADDR' ]          = "192.168.212.129";

        $this->boolean( $req->hasProxy() )
                ->isTrue()
                ->string( $req->getIp() )
                ->isEqualTo( '10.0.0.1' )
                ->string( $req->getProxyIp() )
                ->isEqualTo( '192.168.212.129' );
    }

    public function testRequestRequestVariantsHttps()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_GET;
        $req                         = new IrRequest();

        //HTTPS
        $this->boolean( $req->isHttps() )
                ->isFalse();

        $_SERVER[ 'HTTPS' ] = true;
        $this->boolean( $req->isHttps() )
                ->isEqualTo( 'fr' );
    }

    public function testRequestRequestVariantsXhr()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_GET;
        $req                         = new IrRequest();

        $this->boolean( $req->isXmlHttpRequest() )
                ->isFalse();

        $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] = 'XMLHttpRequest';
        $this->boolean( $req->isXmlHttpRequest() )
                ->isTrue()
                ->boolean( $req->isFlash() )
                ->isFalse();
    }

    public function testRequestRequestVariantsFlash()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_GET;
        $req                         = new IrRequest();

        $this->boolean( $req->isFlash() )
                ->isFalse();

        $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] = 'Flash';
        $this->boolean( $req->isFlash() )
                ->isTrue()
                ->boolean( $req->isXmlHttpRequest() )
                ->isFalse();
    }

    public function testRequestGettersSettersGet()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_GET;
        $req                         = new IrRequest();

        $this->variable( $req->get( 'test' ) )
                ->isNull();

        $req->get( 'test' , 'meuh' );
        $this->string( $req->get( 'test' ) )
                ->isEqualTo( 'meuh' );
    }

    public function testRequestGettersSettersGetThrowsException()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_POST;
        $req                         = new IrRequest();

        $this->exception( function() use ($req)
                {
                    $req->get( 'test' );
                } )
                ->isInstanceOf( '\BadMethodCallException' )
                ->hasMessage( 'calling get() while HTTP verb is not GET' );
    }

    public function testRequestGettersSettersPut()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_PUT;
        $req                         = new IrRequest();

        $this->variable( $req->put( 'test' ) )
                ->isNull();

        $req->put( 'test' , 'meuh' );
        $this->string( $req->put( 'test' ) )
                ->isEqualTo( 'meuh' );
    }

    public function testRequestGettersSettersPutThrowsException()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_POST;
        $req                         = new IrRequest();

        $this->exception( function() use ($req)
                {
                    $req->put( 'test' );
                } )
                ->isInstanceOf( '\BadMethodCallException' )
                ->hasMessage( 'calling put() while HTTP verb is not PUT' );
    }

    public function testRequestGettersSettersPost()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_POST;
        $req                         = new IrRequest();

        $this->variable( $req->post( 'test' ) )
                ->isNull();

        $req->post( 'test' , 'meuh' );
        $this->string( $req->post( 'test' ) )
                ->isEqualTo( 'meuh' );
    }

    public function testRequestGettersSettersPostThrowsException()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_GET;
        $req                         = new IrRequest();

        $this->exception( function() use ($req)
                {
                    $req->post( 'test' );
                } )
                ->isInstanceOf( '\BadMethodCallException' )
                ->hasMessage( 'calling post() while HTTP verb is not POST' );
    }

    public function testRequestGettersSettersPatch()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_PATCH;
        $req                         = new IrRequest();

        $this->variable( $req->patch( 'test' ) )
                ->isNull();

        $req->patch( 'test' , 'meuh' );
        $this->string( $req->patch( 'test' ) )
                ->isEqualTo( 'meuh' );
    }

    public function testRequestGettersSettersPatchThrowsException()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_POST;
        $req                         = new IrRequest();

        $this->exception( function() use ($req)
                {
                    $req->patch( 'test' );
                } )
                ->isInstanceOf( '\BadMethodCallException' )
                ->hasMessage( 'calling patch() while HTTP verb is not PATCH' );
    }

    public function testRequestGettersSettersDelete()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_DELETE;
        $req                         = new IrRequest();

        $this->variable( $req->delete( 'test' ) )
                ->isNull();

        $req->delete( 'test' , 'meuh' );
        $this->string( $req->delete( 'test' ) )
                ->isEqualTo( 'meuh' );
    }

    public function testRequestGettersSettersDeleteThrowsException()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_POST;
        $req                         = new IrRequest();

        $this->exception( function() use ($req)
                {
                    $req->delete( 'test' );
                } )
                ->isInstanceOf( '\BadMethodCallException' )
                ->hasMessage( 'calling delete() while HTTP verb is not DELETE' );
    }

    public function testRequestGettersSettersHead()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_HEAD;
        $req                         = new IrRequest();

        $this->variable( $req->head( 'test' ) )
                ->isNull();

        $req->head( 'test' , 'meuh' );
        $this->string( $req->head( 'test' ) )
                ->isEqualTo( 'meuh' );
    }

    public function testRequestGettersSettersHeadThrowsException()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_POST;
        $req                         = new IrRequest();

        $this->exception( function() use ($req)
                {
                    $req->head( 'test' );
                } )
                ->isInstanceOf( '\BadMethodCallException' )
                ->hasMessage( 'calling head() while HTTP verb is not HEAD' );
    }

    public function testRequestGettersSettersOptions()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_OPTIONS;
        $req                         = new IrRequest();

        $this->variable( $req->options( 'test' ) )
                ->isNull();

        $req->options( 'test' , 'meuh' );
        $this->string( $req->options( 'test' ) )
                ->isEqualTo( 'meuh' );
    }

    public function testRequestGettersSettersOptionsThrowsException()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_POST;
        $req                         = new IrRequest();

        $this->exception( function() use ($req)
                {
                    $req->options( 'test' );
                } )
                ->isInstanceOf( '\BadMethodCallException' )
                ->hasMessage( 'calling options() while HTTP verb is not OPTIONS' );
    }

    public function testRequestGettersSettersTrace()
    {
        $_SERVER[ 'REQUEST_URI' ] = '/index.php';

        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_TRACE;
        $req                         = new IrRequest();

        $this->variable( $req->trace( 'test' ) )
                ->isNull();

        $req->trace( 'test' , 'meuh' );
        $this->string( $req->trace( 'test' ) )
                ->isEqualTo( 'meuh' );
    }

    public function testRequestGettersSettersTraceThrowsException()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_POST;
        $req                         = new IrRequest();

        $this->exception( function() use ($req)
                {
                    $req->trace( 'test' );
                } )
                ->isInstanceOf( '\BadMethodCallException' )
                ->hasMessage( 'calling trace() while HTTP verb is not TRACE' );
    }

    public function testRequestGetterCookie()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_GET;
        $req                         = new IrRequest();

        $this->variable( $req->cookie( 'test' ) )
                ->isNull();

        $_COOKIE[ 'test' ] = 'meuh';
        $this->string( $req->cookie( 'test' ) )
                ->isEqualTo( 'meuh' );
    }

    public function testGetPathInfo()
    {
        $_SERVER[ 'REQUEST_URI' ]    = '/index.php';
        $_SERVER[ 'REQUEST_METHOD' ] = IrRequest::METHOD_GET;
        unset( $_SERVER[ 'PATH_INFO' ] );
        unset( $_SERVER[ 'ORIG_PATH_INFO' ] );

        $req = new IrRequest();

        $this->string( $req->getPathInfo() )
                ->isEqualTo( '/index.php' );

        unset( $_SERVER[ 'PATH_INFO' ] );
        unset( $_SERVER[ 'REQUEST_URI' ] );

        $_SERVER[ 'ORIG_PATH_INFO' ] = '/test/index.php';

        $this->string( $req->getPathInfo() )
                ->isEqualTo( '/test/index.php' );

        $_SERVER[ 'PATH_INFO' ] = '/test2/index.php';

        $this->string( $req->getPathInfo() )
                ->isEqualTo( '/test2/index.php' );
    }

}
