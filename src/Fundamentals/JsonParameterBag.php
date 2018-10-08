<?php

namespace Piita\Fundamentals;

/**
 * json data hold class
 */
class JsonParameterBag
{
    /**
     * json to array parameters
     *
     * @var array
     */
    private $parameters;

    public function __construct($json)
    {
        if (is_array($json)) {
            $this->parameters = $json;
            return;
        }
        $this->parameters = json_decode($json, $assoc = true);
    }

    public function getParameter($name)
    {
        return $this->parameters[$name];
    }

    public function setParameter($name, $value)
    {
        $this->parameters[$name] = $value;
    }
    public function getParameters($names = null)
    {
        if (is_null($names)) {
            return $this->parameters;
        }
        
        return array_intersect_key($this->parameters, array_fill_keys($names, ''));
    }

    public function toJson()
    {
        return json_encode($this->parameters);
    }
}