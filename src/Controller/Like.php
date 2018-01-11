<?php
/**
 * Created by PhpStorm.
 * User: brandon
 * Date: 1/11/18
 * Time: 1:47 PM
 */

namespace Masterclass\Controller;


use Aura\Session\Session;
use Aura\Web\Response;
use Masterclass\Model\Likes\LikeGateway;
use Masterclass\Request;

class Like
{
    private $session;

    private $request;

    private $gateway;

    public function __construct(
        Session $session,
        Request $request,
        LikeGateway $gateway
    ) {
        $this->session = $session;
        $this->request = $request;
        $this->gateway = $gateway;
    }

    public function processStoryPreference()
    {
        $segment = $this->session->getSegment('Masterclass');
        $userId = $segment->get('user_id');

        $storyId = $this->request->getQuery('story');

        $result = $this->gateway->likeStory($userId, $storyId);

        header('Location: /story?id=' . $storyId);
    }
}