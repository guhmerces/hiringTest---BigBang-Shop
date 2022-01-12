<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Services\SpotifyService;

class ExampleTest extends TestCase
{

    public function testPushAndPop()
    {
        $stack = [];

        $this->assertSame(0, count($stack));

        array_push($stack, 'foo');
        $this->assertSame('foo', $stack[count($stack)-1]);
        $this->assertSame(1, count($stack));

        $this->assertSame('foo', array_pop($stack));
        $this->assertSame(0, count($stack));
    }




    /**
     * A basic test example.
     *
     * @return void
     */
//    public function testExample()
//    {
//        $this->get('/cities/parana');
//
//        $this->assertEquals(
//            $this->app->version(), $this->response->getContent()
//        );
//    }
}
