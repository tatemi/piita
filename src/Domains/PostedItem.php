<?php

namespace Piita\Domains;

use Piita\Fundamentals\QiitaApiBaseDataModel;
use Piita\Fundamentals\JsonParameterBag;

/**
 * Qiita posted item domain class
 */
class PostedItem extends QiitaApiBaseDataModel
{
    public function toPatchJson()
    {
        $parameters = new JsonParameterBag($this->getParameters([
            'body','coediting','group_url_name','private','tags','title']));
        return $parameters->toJson();
    }
}