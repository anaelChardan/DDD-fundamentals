<?php

namespace SnackMachine;

class AbstractEntity implements EntityInterface
{
    /**
     * @var string
     */
    protected $id;

    /**
     * {@inheritdoc}
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function equals(EntityInterface $entity): bool
    {
        return (
            self::class == get_class($entity) &&
            $this->getId() === $entity->getId()
        );
    }
}