<?php

namespace Tests;

class TestTransformer extends \Gvera\Helpers\transformers\TransformerAbstract
{
    public function transform(): array
    {
        $response = [];
        foreach ($this->object as $key => $value) {
            $response[$key] = $value;
        }

        return $response;
    }

    /**
     * @throws \Gvera\Exceptions\NotImplementedMethodException
     */
    public function testException()
    {
        parent::transform();
    }
}