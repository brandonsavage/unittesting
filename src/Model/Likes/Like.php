<?php
/**
 * Created by PhpStorm.
 * User: brandon
 * Date: 1/11/18
 * Time: 11:14 AM
 */

namespace Masterclass\Model\Likes;


class Like
{
    public $user_id;
    public $username;
    public $story_id;

    protected $excluded = ['excluded', 'username'];

    public function __construct(array $args = [])
    {
        foreach ($args as $key => $property) {
            if (property_exists($this, $key)) {
                $this->$key = $property;
            }
        }
    }

    public function toArray()
    {
        $data = [];

        foreach($this as $key => $value) {
            if (!in_array($key, $this->excluded)) {
                $data[$key] = $value;
            }
        }


        return $data;
    }
}