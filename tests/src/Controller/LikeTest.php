<?php
/**
 * Created by PhpStorm.
 * User: brandon
 * Date: 1/11/18
 * Time: 1:48 PM
 */

namespace src\Controller;

use Aura\Session\Segment;
use Aura\Session\Session;
use Aura\Web\Response;
use Aura\Web\WebFactory;
use Masterclass\Controller\Like;

use Masterclass\Model\Likes\LikeGateway;
use Masterclass\Request;
use Mockery as m;

class LikeTest extends m\Adapter\Phpunit\MockeryTestCase
{
    /**
     * @var Like
     */
    protected $controller;

    protected function setUp()
    {
        $this->session = m::mock(Session::class);
        $this->request = m::mock(Request::class);
        $this->gateway = m::mock(LikeGateway::class);
        $web_factory = new WebFactory($GLOBALS);
        $this->response = $web_factory->newResponse();

        $this->controller = new Like(
            $this->session,
            $this->request,
            $this->gateway,
            $this->response
        );
    }

    public function testLikeControllerMethodWorks()
    {
        $this->markTestIncomplete();
        $segment = m::mock(Segment::class);
        $segment->shouldReceive('get')->once()->with('user_id')->andReturn(1);
        $this->session->shouldReceive('getSegment')->andReturn($segment);

        $this->request->shouldReceive('getQuery')->once()->andReturn(5);

        $this->gateway->shouldReceive('likeStory')->once()->with(1, 5)->andReturn(true);

        $this->controller->processStoryPreference();

    }
}
