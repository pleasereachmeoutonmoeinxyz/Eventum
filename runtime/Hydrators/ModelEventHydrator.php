<?php

namespace Hydrators;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Hydrator\HydratorInterface;
use Doctrine\ODM\MongoDB\UnitOfWork;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ODM. DO NOT EDIT THIS FILE.
 */
class ModelEventHydrator implements HydratorInterface
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
        if (isset($data['name'])) {
            $value = $data['name'];
            $return = (string) $value;
            $this->class->reflFields['name']->setValue($document, $return);
            $hydratedData['name'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['email'])) {
            $value = $data['email'];
            $return = (string) $value;
            $this->class->reflFields['email']->setValue($document, $return);
            $hydratedData['email'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['site'])) {
            $value = $data['site'];
            $return = (string) $value;
            $this->class->reflFields['site']->setValue($document, $return);
            $hydratedData['site'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['tel'])) {
            $value = $data['tel'];
            $return = (string) $value;
            $this->class->reflFields['tel']->setValue($document, $return);
            $hydratedData['tel'] = $return;
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
        if (isset($data['subject'])) {
            $value = $data['subject'];
            $return = (string) $value;
            $this->class->reflFields['subject']->setValue($document, $return);
            $hydratedData['subject'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['content'])) {
            $value = $data['content'];
            $return = (string) $value;
            $this->class->reflFields['content']->setValue($document, $return);
            $hydratedData['content'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['status'])) {
            $value = $data['status'];
            $return = (string) $value;
            $this->class->reflFields['status']->setValue($document, $return);
            $hydratedData['status'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['confirmation'])) {
            $value = $data['confirmation'];
            $return = (string) $value;
            $this->class->reflFields['confirmation']->setValue($document, $return);
            $hydratedData['confirmation'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['code'])) {
            $value = $data['code'];
            $return = (string) $value;
            $this->class->reflFields['code']->setValue($document, $return);
            $hydratedData['code'] = $return;
        }

        /** @Field(type="timestamp") */
        if (isset($data['timestamp'])) {
            $value = $data['timestamp'];
            $return = $value;
            $this->class->reflFields['timestamp']->setValue($document, $return);
            $hydratedData['timestamp'] = $return;
        }
        return $hydratedData;
    }
}