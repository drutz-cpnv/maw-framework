<?php

namespace ORM;

use ORM\TypeResolver;
use ReflectionNamedType;

class SQLTypeResolver extends TypeResolver
{
    public function isTypeSupported(ReflectionNamedType $type): bool
    {
        if($type->isBuiltin()) return true;
        if(enum_exists($type)) return true;
        $stringType = $type->getName();
        return $stringType == "DateTime";
    }

    public function fromRawToPhpType($raw, $type): mixed
    {
        if($type->isBuiltin()) return $raw;
        $stringType = $type->getName();
        if(enum_exists($type)) return $stringType::from($raw);
        if($stringType == "DateTime") return strtotime($raw);
        return null;
    }

    public function fromPhpTypeToRaw($object, $type): mixed
    {
        if($type->isBuiltin()) return $object;
        if(enum_exists($type)) return $object->name;
        $stringType = $type->getName();
        if($stringType == "DateTime") return date("Y-m-d H:i:s", $object);
        return null;
    }
}