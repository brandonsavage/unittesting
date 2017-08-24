<?php

namespace Masterclass\Config;

use Aura\Di\Config;
use Aura\Di\Container;

class Controllers extends Config
{
    public function define(Container $di)
    {
        $di->params[\Masterclass\Controller\Index::class] = [
            'storyModel' => $di->lazyNew(\Masterclass\Model\Story::class),
            'view' => $di->lazyGet('View'),
        ];

        $di->params[\Masterclass\Controller\Story::class] = [
            'storyModel' => $di->lazyNew(\Masterclass\Model\Story::class),
            'commentModel' => $di->lazyNew(\Masterclass\Model\Comment::class),
            'request' => $di->lazyGet('Request'),
            'session' => $di->lazyGet('Session'),
            'view' => $di->lazyGet('View'),
        ];

        $di->params[\Masterclass\Controller\Comment::class] = [
            'commentModel' => $di->lazyNew(\Masterclass\Model\Comment::class),
            'request' => $di->lazyGet('Request'),
            'session' => $di->lazyGet('Session'),
        ];

        $di->params[\Masterclass\Controller\User::class] = [
            'request' => $di->lazyGet('Request'),
            'pdo' => $di->lazyGet('Pdo'),
            'session' => $di->lazyGet('Session'),
        ];
    }
}