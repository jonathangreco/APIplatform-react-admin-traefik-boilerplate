<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 04/02/2019
 */
declare(strict_types=1);

namespace App\Domain\Share\Event;

/**
 * Define a message
 * Interface AMQPMessage
 * @package App\Domain\Share\Event
 */
interface AMQPMessage
{
    public function serialize(): array;
}