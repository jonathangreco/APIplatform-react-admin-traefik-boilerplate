<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 07/02/2019
 */
declare(strict_types=1);

namespace App\Domain\Share\DTO;

interface DTOInterface
{
    /**
     * Set the Entity object in order to be mapped to the DTO
     * @param $object
     */
    public function setObject($object);

    /**
     * valid that $object is correctly instanciated
     * @return mixed
     */
    public function checkObject();

    /**
     * @return mixed
     */
    public function assemble();
}