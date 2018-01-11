<?php
/**
 * Created by PhpStorm.
 * User: brandon
 * Date: 1/11/18
 * Time: 12:25 PM
 */

namespace src\Model\Likes;

use Masterclass\Model\Likes\Exception\UserAlreadyLikedStory;
use Mockery as m;
use Masterclass\Model\Likes\LikeStorage;

class LikeStorageTest extends m\Adapter\Phpunit\MockeryTestCase
{
    protected $dbal;

    protected $likeStorage;

    protected function setUp()
    {
        $this->dbal = m::mock('Masterclass\Dbal\DbalInterface');
        $this->likeStorage = new LikeStorage($this->dbal);
    }

    public function testSelectLikesForStory()
    {
        $dbal = $this->dbal;
        $likeStorage = $this->likeStorage;

        $expected = [
            [
                'user_id' => 1,
                'username' => 'brandon',
                'story_id' => 5,
            ],
            [
                'user_id' => 2,
                'username' => 'freddie',
                'story_id' => 5,
            ]
        ];

        $dbal->shouldReceive('fetchAll')->andReturn($expected);

        $likesForStory = $likeStorage->getLikesForStory(5);

        $this->assertEquals($expected, $likesForStory);
    }

    public function testLikingAStoryLikesIt()
    {
        $user_id = 1;
        $story_id = 5;

        $storage = $this->likeStorage;

        $this->dbal->shouldReceive('fetch')->once()->andReturn(null);
        $this->dbal->shouldReceive('save')->andReturn(true);
        $result = $storage->saveLikedPost($user_id, $story_id);
        $this->assertTrue($result);
    }

    /**
     * @expectedException \Masterclass\Model\Likes\Exception\UserAlreadyLikedStory
     */
    public function testLikingAStoryTwiceFails()
    {
        $user_id = 1;
        $story_id = 5;

        $storage = $this->likeStorage;

        $this->dbal->shouldReceive('fetch')->once()->andReturn(['a' => 'b']);
        $this->likeStorage->saveLikedPost($user_id, $story_id);
    }

    public function testCheckForUserAlreadyLikingStory()
    {
        $userId = 1;
        $storyId = 5;

        $expected = [
            'user_id' => 1,
            'username' => 'brandon',
            'story_id' => 5,
        ];

        $storage = $this->likeStorage;
        $this->dbal->shouldReceive('fetch')->andReturn($expected);

        $result = $storage->checkIfUserLikedAStory($userId, $storyId);
        $this->assertEquals($expected, $result);

    }

    public function testLikingAStoryASecondTimeDislikesIt()
    {
        $this->markTestIncomplete();
    }
}
