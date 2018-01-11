<?php
/**
 * Created by PhpStorm.
 * User: brandon
 * Date: 1/11/18
 * Time: 12:41 PM
 */

namespace Masterclass\Model\Likes;


class LikeGateway
{
    protected $storage;

    public function __construct(LikeStorage $storage)
    {
        $this->storage = $storage;
    }

    public function getLikesForStory($storyId)
    {
        $likes = $this->storage->getLikesForStory($storyId);

        $likesCollection = new Likes();

        foreach ($likes as $like) {
            $likesCollection->addEntity(new Like($like));
        }

        return $likesCollection;
    }

    public function likeStory($userId, $storyId)
    {
        return $this->storage->saveLikedPost($userId, $storyId);
    }
}