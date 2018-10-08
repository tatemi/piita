<?php

namespace Piita\Test;

use PHPUnit\Framework\TestCase;
use Piita\QiitaAPI;
use Piita\Domains\AuthenticatedUser;
use function GuzzleHttp\json_decode;
use Piita\Domains\UnpostedItem;
use Piita\Domains\PostedItem;

class QiitaAPITest extends TestCase
{

    /**
    * @test
    * @expectedException \Exception
    * @expectedExceptionMessage dummy
    */
    public function testDeleteItem()
    {
        $postedItemJson = file_get_contents(__DIR__. '/dummy_data/posted_item.json');
        $httpClientMock = \Mockery::mock();
        $httpClientMock->shouldReceive('request->getBody->getContents')
            ->andReturn(null)->once();

        $api = new QiitaAPI($httpClientMock);
        $api->initAccessToken('dummy token');
        $item_id = '85bbc9549d647ff120d6';
        $api->deleteItem($item_id);

        $httpClientMock->shouldReceive('request->getBody->getContents')
            ->andThrow(new \Exception('dummy'));
        $deletedItem = $api->getItem($item_id);
        // must be throw exception
    }

    public function testUpdateItem()
    {
        $postedItemJson = file_get_contents(__DIR__. '/dummy_data/posted_item.json');
        $item = new PostedItem($postedItemJson);
        $item->setParameter('id', '85bbc9549d647ff120d6');
        $item->setParameter('title', 'updated title');

        $httpClientMock = \Mockery::mock();
        $httpClientMock->shouldReceive('request->getBody->getContents')
            ->andReturn($item->toJson());

        $api = new QiitaAPI($httpClientMock);
        $api->initAccessToken('a3b795c1fc7bf7b95c95330640622292775f4c39');

        $updatedItem = $api->updateItem($item);

        $this->assertSame($expected = 'updated title', $updatedItem->getParameter('title'));
    }

    public function testGetItem()
    {
        $postedItemJson = file_get_contents(__DIR__. '/dummy_data/posted_item.json');

        $httpClientMock = \Mockery::mock();
        $httpClientMock->shouldReceive('request->getBody->getContents')
            ->andReturn($postedItemJson);

        $api = new QiitaAPI($httpClientMock);
        $api->initAccessToken('a3b795c1fc7bf7b95c95330640622292775f4c39');
        $item = $api->getItem($item_id = '85bbc9549d647ff120d6');

        $this->assertSame($expected = 'dummy title', $actual = $item->getParameter('title'));
    }

    public function testGetAuthenticatedUserItems()
    {
        $postedItemJson = file_get_contents(__DIR__. '/dummy_data/posted_item.json');
        $postedItemsJson = "[$postedItemJson,$postedItemJson]";
        /**
         * @var \Mockery\MockInterface
         */
        $httpClientMock = \Mockery::mock();
        $httpClientMock->shouldReceive('request->getBody->getContents')
            ->andReturn($postedItemsJson);

        $api = new QiitaAPI($httpClientMock);
        $api->initAccessToken('a3b795c1fc7bf7b95c95330640622292775f4c39');
        $items = $api->getAuthenticatedUserItems($page = 1, $per_page = 10);
        foreach ($items as $item) {
            $title = $item->getParameter('title');
            $this->assertEquals($expected = 'dummy title', $actual = $title);
        }

    }

    public function testGetAuthenticatedUser()
    {
        // Mock to not use http
        /**
         * @var \Mockery\MockInterface
         */
        $httpClientMock = \Mockery::mock();
        $httpClientMock->shouldReceive('request->getBody->getContents')
            ->andReturn(json_encode(['name' => 'dummy']));


        $api = new QiitaAPI($httpClientMock);
        $api->initAccessToken('a3b795c1fc7bf7b95c95330640622292775f4c39');
        $authenticatedUser = $api->getAuthenticatedUser();
        $this->assertInstanceOf($expected = AuthenticatedUser::class, $actual = $authenticatedUser);
        $this->assertSame($expected = 'dummy', $actual = $authenticatedUser->getParameter('name'));
    }

    public function testPostItem()
    {
        $itemJson = file_get_contents(__DIR__. '/dummy_data/unposted_item.json');
        $postedItemJson = file_get_contents(__DIR__. '/dummy_data/posted_item.json');

        $item = new UnpostedItem($itemJson);
        /**
         * @var \Mockery\MockInterface
         */
        $httpClientMock = \Mockery::mock();
        $httpClientMock->shouldReceive('request->getBody->getContents')
            ->andReturn($postedItemJson);

        $api = new QiitaAPI($httpClientMock);
        // $api = new QiitaAPI();
        $api->initAccessToken('a3b795c1fc7bf7b95c95330640622292775f4c39');
        $postedItem = $api->postItem($item);

        $this->assertSame($expected = 'dummy title', $actual = $postedItem->getParameter('title'));
    }
}

?>