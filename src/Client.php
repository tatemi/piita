<?php

namespace Piita;

use Piita\Domains\UnpostedItem;
use Piita\Domains\PostedItem;


class Client
{
    /**
     * Qiita api client
     *
     * @var IQiitaAPI
     */
    private $api;

    public function __construct()
    {
        $this->api = new QiitaAPI();
    }

    /**
     * init access token
     *
     * @param string $accessToken
     * @return void
     */
    public function initAccessToken($accessToken)
    {
        $this->api->initAccessToken($accessToken);
    }

    /**
     * get authenticated user
     *
     * @return AuthenticatedUser
     */
    public function getAuthenticatedUser()
    {
        return $this->api->getAuthenticatedUser();
    }

    /**
     * get authenticated user items
     *
     * @param int $page
     * @param int $per_page
     * @return PostedItem[]
     */
    public function getAuthenticatedUserItems($page, $per_page)
    {
        return $this->api->getAuthenticatedUserItems();
    }

    /**
     * make item
     *
     * @param json|array $parameters
     * @return UnpostedItem
     */
    public function makeNewItem($parameters = null)
    {
        return new UnpostedItem($parameters);
    }

    /**
     * post Item
     *
     * @param UnpostedItem $item
     * @return PostedItem
     */
    public function postUnpostedItem(UnpostedItem $item)
    {
        return $this->api->postItem($item);
    }

    /**
     * get item
     *
     * @param string $item_id
     * @return PostedItem
     */
    public function getItem($item_id)
    {
        return $this->api->getItem($item_id);
    }

    /**
     * delete item
     *
     * @param PostedItem $item
     * @return void
     */
    public function deleteItem(PostedItem $item)
    {
        $this->api->deleteItem($item->getParameter('id'));
    }

    /**
     * update item
     *
     * @param PostedItem $item
     * @return PostedItem
     */
    public function updateItem(PostedItem $item)
    {
        return $this->api->updateItem($item);
    }
}