<?php

namespace Luft;

use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class Serializer
{
    /**
     * @var
     */
    private static $instance;

    /**
     * @return \Symfony\Component\Serializer\Serializer
     */
    public static function getInstance(): \Symfony\Component\Serializer\Serializer
    {
        $phpDocExtractor = new PhpDocExtractor();
        $reflectionExtractor = new ReflectionExtractor();

        $listExtractors = [$reflectionExtractor];
        $typeExtractors = [$phpDocExtractor, $reflectionExtractor];
        $descriptionExtractors = [$phpDocExtractor];
        $accessExtractors = [$reflectionExtractor];
        $propertyInitializableExtractors = [$reflectionExtractor];

        $propertyInfo = new PropertyInfoExtractor(
            $listExtractors,
            $typeExtractors,
            $descriptionExtractors,
            $accessExtractors,
            $propertyInitializableExtractors
        );

        $normalizers = [
            new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter(), null, $propertyInfo),
            new ArrayDenormalizer(),
        ];

        if (static::$instance === null) {
            static::$instance = new \Symfony\Component\Serializer\Serializer($normalizers);
        }

        return static::$instance;
    }
}
