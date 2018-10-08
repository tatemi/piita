<?php

namespace Piita\Domains;

use Piita\Fundamentals\QiitaApiBaseDataModel;

/**
 * Qiita unposted item domain class
 */
class UnpostedItem extends QiitaApiBaseDataModel
{
    /**
     * Set title
     * 
     * @param string $title
     * @return UnpostedItem
     */
    public function setTitle($title)
    {
        $this->setParameter('title', $title);
        return $this;
    }

    /**
     * Set body
     * 
     * @param string $body
     * @return UnpostedItem
     */
    public function setBody($body)
    {
        $this->setParameter('body', $body);
        return $this;
    }

    /**
     * Set coediting
     * 
     * @param bool $coediting
     * @return UnpostedItem
     */
    public function setCoediting($coediting)
    {
        $this->setParameter('coediting', $coediting);
        return $this;
    }

    /**
     * Set gist
     * 
     * @param bool $gist
     * @return UnpostedItem
     */
    public function setGist($gist)
    {
        $this->setParameter('gist', $gist);
        return $this;
    }

    /**
     * Set group_url_name
     * 
     * @param string $group_url_name
     * @return UnpostedItem
     */
    public function setGoupUrlName($group_url_name)
    {
        $this->setParameter('group_url_name', $group_url_name);
        return $this;
    }

    /**
     * Set private
     * 
     * @param bool $private
     * @return UnpostedItem
     */
    public function setPrivate($private)
    {
        $this->setParameter('private', $private);
        return $this;
    }

    /**
     * Set tags
     * 
     * @param string $tags
     * @return UnpostedItem
     */
    public function setTags($tags)
    {
        $this->setParameter('tags', $tags);
        return $this;
    }

    /**
     * Set tags
     * 
     * @param array $tags
     * @return UnpostedItem
     */
    public function setTweet($tweet)
    {
        $this->setParameter('tweet', $tweet);
        return $this;
    }
}