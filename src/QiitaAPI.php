<?php

namespace Piita;

use GuzzleHttp\Client;
use Piita\Domains\AuthenticatedUser;
use Piita\Domains\UnpostedItem;
use Piita\Domains\PostedItem;

/**
 * Qiita API v2 
 */
class QiitaAPI implements IQiitaAPI
{
    private $accessToken;

    /**
     * @var Client
     */
    private $httpClient;

    public function __construct($httpClient = null)
    {
        if (is_null($httpClient)) {
            $httpClient = new Client(['base_uri' => 'https://qiita.com']);
        }
        $this->httpClient = $httpClient;
    }

    public function initAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function isError() : bool
    {
        return false;
    }

    public function deleteItem($item_id) : void
    {
        $contentsJson = $this->httpClient->request('DELETE', "api/v2/items/$item_id",
            $this->_getAuthorizationHeader())
            ->getBody()->getContents();
    }

    public function updateItem(PostedItem $item) : PostedItem
    {
        $item_id = $item->getParameter('id');
        $contentsJson = $this->httpClient->request('PATCH', "api/v2/items/$item_id",
            $this->_getAuthorizationAndContentTypeHeaderWithBody($item->toPatchJson()))
            ->getBody()->getContents();
        return new PostedItem($contentsJson);
    }

    public function getItem($item_id) : PostedItem
    {
        $contentsJson = $this->httpClient->request('GET', "api/v2/items/$item_id",
            $this->_getAuthorizationHeader())
            ->getBody()->getContents();
        return new PostedItem($contentsJson);
    }

    public function getAuthenticatedUserItems($page, $per_page)
    {
        $contentsJson = $this->httpClient->request('GET', "api/v2/authenticated_user/items?page=$page&per_page=$per_page",
            $this->_getAuthorizationHeader())
            ->getBody()->getContents();
        $contentArray = json_decode($contentsJson, $assoc = true);
        $items = [];
        foreach ($contentArray as $content) {
            $items[] = new PostedItem($content);
        }
        return $items;
    }

    public function postItem(UnpostedItem $item) : PostedItem
    {
        $contentsJson = $this->httpClient->request('POST', 'api/v2/items',
            $this->_getAuthorizationAndContentTypeHeaderWithBody($item->toJson()))
            ->getBody()->getContents();
        return new PostedItem($contentsJson);
    }

    public function getAuthenticatedUser() : AuthenticatedUser
    {
        $contentsJson = $this->httpClient->request('GET', 'api/v2/authenticated_user',
            $this->_getAuthorizationHeader())
            ->getBody()->getContents();
        return new AuthenticatedUser($contentsJson);
    }

    private function _getAuthorizationHeader()
    {
        return ['headers' => ['Authorization' => 'Bearer '.$this->accessToken]];
    }

    private function _getAuthorizationAndContentTypeHeader()
    {
        $headers = $this->_getAuthorizationHeader();
        $headers['headers'] += ['Content-Type' => 'application/json'];
        return $headers;
    }

    private function _getAuthorizationAndContentTypeHeaderWithBody($body)
    {
        return array_merge(['body' => $body], $this->_getAuthorizationAndContentTypeHeader());
    }
}