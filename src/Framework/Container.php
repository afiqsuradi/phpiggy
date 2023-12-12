<?php

declare(strict_types=1);

namespace Framework;

use Framework\Exception\ContainerException;
use ReflectionClass, ReflectionNamedType;

include __DIR__ . "/function.php";


class Container
{
    private array $definitions = [];

    public function addDefinition(array $newDefinitions)
    {
        $this->definitions = [...$this->definitions, ...$newDefinitions];
    }

    public function resolve(string $className)
    {
        $reflection = new ReflectionClass($className);
        if (!$reflection->isInstantiable()) throw new ContainerException("Class {$className} is not instantiable");
        $constructor = $reflection->getConstructor();
        if (!$constructor) {
            return new $className;
        }
        $params = $constructor->getParameters();
        if (count($params) === 0) {
            return new $className;
        }

        $dependencies = [];

        foreach ($params as $param) {
            $name = $param->getName();
            $type = $param->getType();

            if (!$type) {
                throw new ContainerException("Failed to resolve {$className} as there is no type hint.");
            }

            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                throw new ContainerException("Failed to resolve {$className} as the parameter of {$name} is invalid.");
            }

            $dependencies[] = $this->get($type->getName());
        }

        return $reflection->newInstanceArgs($dependencies);
    }

    public function get(string $id)
    {
        if (!array_key_exists($id, $this->definitions)) {
            throw new ContainerException("Class {$id} does not exists within Container definition.");
        }
        $factory = $this->definitions[$id];
        return $factory();
    }
}
