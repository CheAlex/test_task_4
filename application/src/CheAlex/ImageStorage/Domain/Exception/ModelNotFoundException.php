<?php

namespace CheAlex\ImageStorage\Domain\Exception;

/**
 * Class ModelNotFoundException
 * @package CheAlex\ImageStorage\Domain\Exception
 */
class ModelNotFoundException extends \Exception
{
    /**
     * @param string $className
     * @return self
     */
    public static function fromClassName($className)
    {
        return new static(
            sprintf(
                'Model of type \'%s\' was not found',
                $className
            ),
            404
        );
    }

    /**
     * @param string $className
     * @param mixed  $id
     * @return self
     */
    public static function fromClassNameAndIdentifier($className, $id)
    {
        return new static(
            sprintf(
                'Model of type \'%s\' with id=\'%s\' was not found',
                $className,
                $id
            ),
            404
        );
    }
}
