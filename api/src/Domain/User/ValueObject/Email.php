<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 29/05/2018
 */
declare(strict_types = 1);

namespace App\Domain\User\ValueObject;

use Assert\Assertion;

/**
 * Design pattern ValueObject, test and validate an email.
 * This is part of Domain.
 * Class Email
 * @package App\Domain\UAC\User\ValueObject
 */
class Email
{
    /**
     * @var string
     */
    private $email;

    /**
     * @param string $email
     * @return \App\Domain\User\ValueObject\Email
     * @throws \Assert\AssertionFailedException
     */
    public static function fromString(string $email): self
    {
        Assertion::email($email, 'Not a valid email');
        $mail = new self();
        $mail->email = $email;

        return $mail;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return (string) $this->email;
    }

    /**
     * Full compatibility when you want to cast this valueObject in string by (string) $myObject
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }
}
