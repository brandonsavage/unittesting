<?php
/**
 * Created by PhpStorm.
 * User: brandon
 * Date: 1/11/18
 * Time: 12:27 PM
 */

namespace Masterclass\Model\Likes;


use Masterclass\Dbal\DbalInterface;
use Masterclass\Model\Likes\Exception\UserAlreadyLikedStory;

class LikeStorage
{
    protected $dbal;

    public function __construct(DbalInterface $dbal)
    {
        $this->dbal = $dbal;
    }

    public function checkIfUserLikedAStory($userId, $storyId)
    {
        $sql = 'SELECT * FROM likes WHERE user_id = ? AND story_id = ?';
        return $this->dbal->fetch($sql, [$userId, $storyId]);
    }

    public function getLikesForStory($storyId)
    {
        $sql = 'SELECT user_id, user.username, story_id FROM likes LEFT JOIN user ON user.id = user_id WHERE story_id = ?';
        return $this->dbal->fetchAll($sql, [$storyId]);
    }

    public function saveLikedPost($userId, $storyId)
    {
        if ($this->checkIfUserLikedAStory($userId, $storyId)) {
            throw new UserAlreadyLikedStory('User already liked story ' . $storyId);
        }
        $sql = 'INSERT INTO likes (user_id, story_id) VALUES (?, ?)';
        return $this->dbal->save($sql, [$userId, $storyId]);
    }
}