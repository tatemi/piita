# piita
php qiita api client

## 事前準備

Qiitaの設定>アプリケーションより、個人用アクセストークンを作成してください

## 使い方

```
require_once __DIR__ . "/piita/vendor/autoload.php";

use Piita\Client;

$client = new Client;

// put your access token
$client->initAccessToken('put your access token');

// create new item
$unpostedItem = $client->makeNewItem();
$unpostedItem->setTitle('dummy title')
    ->setBody('dummy body')
    ->setCoediting(false)
    ->setGist(false)
    ->setGoupUrlName('')
    ->setPrivate(true)
    ->setTags([['name' => 'test', 'versions' => ["0.0.1"]]])
    ->setTweet(false);
$postedItem = $client->postUnpostedItem($unpostedItem);

// get item
$item = $client->getItem($postedItem->getParameter('id'));

// update item
$item->setParameter('title', 'updated title');
$client->updateItem($item);

// delete item
$client->deleteItem($item);
```

## Licence
MIT