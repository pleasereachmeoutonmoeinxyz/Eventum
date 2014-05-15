<?php

namespace Hydrators;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Hydrator\HydratorInterface;
use Doctrine\ODM\MongoDB\UnitOfWork;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ODM. DO NOT EDIT THIS FILE.
 */
class ModelMailHydrator implements HydratorInterface
{
    private $dm;
    private $unitOfWork;
    private $class;

    public function __construct(DocumentManager $dm, UnitOfWork $uow, ClassMetadata $class)
    {
        $this->dm = $dm;
        $this->unitOfWork = $uow;
        $this->class = $class;
    }

    public function hydrate($document, $data, array $hints = array())
    {
        $hydratedData = array();

        /** @Field(type="id") */
        if (isset($data['_id'])) {
            $value = $data['_id'];
            $return = $value instanceof \MongoId ? (string) $value : $value;
            $this->class->reflFields['id']->setValue($document, $return);
            $hydratedData['id'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['email'])) {
            $value = $data['email'];
            $return = (string) $value;
            $this->class->reflFields['email']->setValue($document, $return);
            $hydratedData['email'] = $return;
        }

        /** @Field(type="collection") */
        if (isset($data['locations'])) {
            $value = $data['locations'];
            $return = $value;
            $this->class->reflFields['locations']->setValue($document, $return);
            $hydratedData['locations'] = $return;
        }

        /** @Field(type="collection") */
        if (isset($data['types'])) {
            $value = $data['types'];
            $return = $value;
            $this->class->reflFields['types']->setValue($document, $return);
            $hydratedData['types'] = $return;
        }

        /** @Field(type="collection") */
        if (isset($data['categories'])) {
            $value = $data['categories'];
            $return = $value;
            $this->class->reflFields['categories']->setValue($document, $return);
            $hydratedData['categories'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['status'])) {
            $value = $data['status'];
            $return = (string) $value;
            $this->class->reflFields['status']->setValue($document, $return);
            $hydratedData['status'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['code'])) {
            $value = $data['code'];
            $return = (string) $value;
            $this->class->reflFields['code']->setValue($document, $return);
            $hydratedData['code'] = $return;
        }

        /** @Field(type="timestamp") */
        if (isset($data['critical_timestamp'])) {
            $value = $data['critical_timestamp'];
            $return = $value;
            $this->class->reflFields['critical_timestamp']->setValue($document, $return);
            $hydratedData['critical_timestamp'] = $return;
        }

        /** @Field(type="timestamp") */
        if (isset($data['subscribtion_timestamp'])) {
            $value = $data['subscribtion_timestamp'];
            $return = $value;
            $this->class->reflFields['subscribtion_timestamp']->setValue($document, $return);
            $hydratedData['subscribtion_timestamp'] = $return;
        }
        return $hydratedData;
    }
}