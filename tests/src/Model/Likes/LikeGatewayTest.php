<?php
/**
 * Created by PhpStorm.
 * User: brandon
 * Date: 1/11/18
 * Time: 12:40 PM
 */

namespace src\Model\Likes;

use Masterclass\Model\Likes\LikeGateway;
use Masterclass\Model\Likes\Likes;
use Masterclass\Model\Likes\LikeStorage;
use Mockery as m;

class LikeGatewayTest extends \PHPUnit_Framework_TestCase
{
    public function testGetLikesForStory()
    {
        $storage = m::mock(LikeStorage::class);

        $expectedLike = [
            'user_id' => 1,
            'username' => 'brandon',
            'story_id' => 5,
        ];

        $storage->shouldReceive('getLikesForStory')->andReturn([$expectedLike]);

        $likeGateway = new LikeGateway($storage);
        $likes = $likeGateway->getLikesForStory(5);

        $this->assertInstanceOf(Likes::class, $likes);



        $current = $likes->current();

        $this->assertEquals($expectedLike['user_id'],$current->user_id);
    }
}
