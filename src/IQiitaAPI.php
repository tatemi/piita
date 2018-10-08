<?php

namespace Piita;

use Piita\Domains\AuthenticatedUser;
use Piita\Domains\UnpostedItem;
use Piita\Domains\PostedItem;

/**
 * Qiita API v2 Interface
 */
interface IQiitaAPI
{
    public function initAccessToken($accessToken);

    public function isError() : bool;

    // DELETE /api/v2/comments/:comment_id

    // GET /api/v2/comments/:comment_id

    // PATCH /api/v2/comments/:comment_id

    // GET /api/v2/items/:item_id/comments

    // POST /api/v2/items/:item_id/comments

    // GET /api/v2/tags

    // GET /api/v2/tags/:tag_id

    // GET /api/v2/users/:user_id/following_tags

    // DELETE /api/v2/tags/:tag_id/following

    // GET /api/v2/tags/:tag_id/following

    // PUT /api/v2/tags/:tag_id/following

    // GET /api/v2/items/:item_id/stockers
    
    // GET /api/v2/users

    // GET /api/v2/users/:user_id
    
    // GET /api/v2/users/:user_id/followees

    // GET /api/v2/users/:user_id/followers

    // DELETE /api/v2/users/:user_id/following

    // GET /api/v2/users/:user_id/following

    // PUT /api/v2/users/:user_id/following

    /**
     * Get AuthenticatedUser Items
     * GET /api/v2/authenticated_user/items
     *
     * @param int $page
     * @param int $per_page
     * @return PostedItem[]
     */
    public function getAuthenticatedUserItems($page, $per_page);

    // GET /api/v2/items

    /**
     * Post item
     * POST /api/v2/items
     *
     * @param UnpostedItem $item
     * @return PostedItem
     */
    public function postItem(UnpostedItem $item) : PostedItem;

    /**
     * UDelete Item
     * DELETE /api/v2/items/:item_id
     *
     * @param string $item_id
     * @return void
     */
    public function deleteItem($item_id) : void;

    /**
     * Get Item
     * GET /api/v2/items/:item_id
     *
     * @param string $item_id
     * @return void
     */
    public function getItem($item_id) : PostedItem;

    /**
     * Update Item
     * PATCH /api/v2/items/:item_id
     *
     * @param PostedItem $item
     * @return PostedItem
     */
    public function updateItem(PostedItem $item) : PostedItem;

    // PUT /api/v2/items/:item_id/stock

    // DELETE /api/v2/items/:item_id/stock
    
    // GET /api/v2/items/:item_id/stock

    // PUT /api/v2/items/:item_id/stock

    // GET /api/v2/tags/:tag_id/items

    // GET /api/v2/users/:user_id/items

    // GET /api/v2/users/:user_id/stocks

    /**
     * Get authenticated usesr
     * GET /api/v2/authenticated_user
     *
     * @return AuthenticatedUser
     */
    public function getAuthenticatedUser() : AuthenticatedUser;
}