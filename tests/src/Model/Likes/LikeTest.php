<?php
/**
 * Created by PhpStorm.
 * User: brandon
 * Date: 1/11/18
 * Time: 11:12 AM
 */

use Masterclass\Model\Likes\Like;

class LikeTest extends PHPUnit_Framework_TestCase
{

    public function testCreatingLikeAssignsValues()
    {
        $user_id = 1;
        $username = 'brandon';
        $story_id = 5;

        $headline = "should not be populated";

        $like = new Like([
            'user_id' => $user_id,
            'username' => $username,
            'story_id' => $story_id,
            'headline' => $headline,
        ]);

        $this->assertEquals($user_id, $like->user_id);
        $this->assertEquals($username, $like->username);
        $this->assertEquals($story_id, $like->story_id);
        $this->assertObjectNotHasAttribute('headline', $like);
    }

    public function testGettingArrayReturnsOnlyUserAndStory()
    {
        $user_id = 1;
        $username = 'brandon';
        $story_id = 5;

        $expected = [
            'user_id' => 1,
            'story_id' => 5,
        ];

        $like = new Like([
            'user_id' => $user_id,
            'username' => $username,
            'story_id' => $story_id,
        ]);

        $array = $like->toArray();

        $this->assertEquals($expected, $array);
    }
}
