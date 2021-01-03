<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 04/02/2019
 */
declare(strict_types=1);

namespace App\Domain\Share\Event;

/**
 * Allow us to define what should be used by Infrastructure layer to insert data into the ELK system or equivalent
 * Interface EventInterface
 * @package App\Domain\Share\Event
 */
interface AMQPInterface
{
    /**
     * @param array $query
     * @return array
     */
    public function search(array $query): array;

    /**
     * Refresh an index
     */
    public function refresh(): void;

    /**
     * Delete an entry in the index specified in the associated class
     */
    public function delete(): void;

    /**
     * Create an index and if not exist
     */
    public function boot(): void;

    /**
     * List documents
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function page(int $page = 1, int $limit = 50): array;
}