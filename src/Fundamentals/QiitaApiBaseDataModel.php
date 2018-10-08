<?php

namespace Piita\Fundamentals;

/**
 * Qiita API basic data model
 */
abstract class QiitaApiBaseDataModel
{

    /**
     * @var JsonParameterBag
     */
    private $parameterBag;

    public function __construct($parameters)
    {
        if (is_array($parameters)) {
            $parameters = \json_encode($parameters);
        }
        $this->_setParametersFromJson($parameters);
    }

    private function _setParametersFromJson($json)
    {
        $this->parameterBag = new JsonParameterBag($json);
    }

    public function getParameter($name)
    {
        return $this->parameterBag->getParameter($name);
    }
    public function getParameters($names = null)
    {
        return $this->parameterBag->getParameters($names);
    }

    public function setParameter($name, $value)
    {
        $this->parameterBag->setParameter($name, $value);
    }

    public function toJson()
    {
        return $this->parameterBag->toJson();
    }
}