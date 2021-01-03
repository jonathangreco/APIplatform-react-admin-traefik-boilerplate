<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 08/03/2019
 */
declare(strict_types=1);

namespace App\Domain\Share\Event;

/**
 * Define a message
 * Interface AMQPMessage
 * @package App\Domain\Share\Event
 */
interface DynamicIndex
{
    public function index(): string;
}