<?php

namespace Core;

use App\Exceptions\PermissionDeniedException;
use DI\Container;
use DI\ContainerBuilder;
use Exception;
use Pecee\SimpleRouter\ClassLoader\IClassLoader;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;

class ClassLoader implements IClassLoader
{

    protected Container $container;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        // Create new php-di container
        $this->container = (new ContainerBuilder())
            ->useAutowiring(true)
            ->build();
    }

    /**
     * Load class
     *
     * @param string $class
     * @return object
     * @throws NotFoundHttpException
     */
    public function loadClass(string $class): object
    {
        if (class_exists($class) === false) {
            throw new NotFoundHttpException(sprintf('Class "%s" does not exist', $class), 404);
        }

        try {
            return $this->container->get($class);
        } catch (Exception $e) {
            throw new NotFoundHttpException($e->getMessage(), (int)$e->getCode(), $e->getPrevious());
        }
    }

    /**
     * Called when loading class method
     *
     * @param object $class
     * @param string $method
     * @param array $parameters
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function loadClassMethod($class, string $method, array $parameters): mixed
    {
        try {
            return $this->container->call([$class, $method], $parameters);
        } catch (PermissionDeniedException $exception) {
            die(json_encode(['message' =>$exception->getMessage()]));
        } catch (Exception $e) {
            throw new NotFoundHttpException($e->getMessage(), (int)$e->getCode(), $e->getPrevious());
        }
    }

    /**
     * Load closure
     *
     * @param Callable $closure
     * @param array $parameters
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function loadClosure(callable $closure, array $parameters): mixed
    {
        try {
            return $this->container->call($closure, $parameters);
        } catch (Exception $e) {
            throw new NotFoundHttpException($e->getMessage(), (int)$e->getCode(), $e->getPrevious());
        }
    }
}
