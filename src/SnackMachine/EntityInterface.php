<?php
/**
 * Created by IntelliJ IDEA.
 * User: anael
 * Date: 07/05/2017
 * Time: 08:49
 */

namespace SnackMachine;


interface EntityInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @param EntityInterface $entity
     *
     * @return bool
     */
    public function equals(EntityInterface $entity): bool;
}
