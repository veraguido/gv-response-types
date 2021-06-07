<?php

namespace Gvera\Helpers\transformers;

use Gvera\Exceptions\NotImplementedMethodException;

abstract class TransformerAbstract
{
    protected $object;
    protected $context;

    public function __construct($object, $context = null)
    {
        $this->object = $object;
        $this->context = $context;
    }

    /**
     * always override this method to implement your own transformation
     * @return array
     * @throws NotImplementedMethodException
     */
    public function transform():array
    {
        throw new NotImplementedMethodException(
            "the transformer object should implement the transform method",
            ['class' => self::class, 'object' => $this->object, 'context' => $this->context]
        );
    }
}
