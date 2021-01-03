<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 30/05/2018
 */
declare(strict_types = 1);

namespace App\Domain\User\ValueObject\Auth;

use Assert\Assertion;

/**
 * Class HashedPassword
 * @package App\Domain\User\ValueObject\Auth
 */
final class HashedPassword
{
    /**
     * @param string $plainPassword
     * @return \App\Domain\User\ValueObject\Auth\HashedPassword
     * @throws \Assert\AssertionFailedException
     */
    public static function encode(string $plainPassword): self
    {
        $pass = new self();

        $pass->hash($plainPassword);

        return $pass;
    }

    public static function fromHash(string $hashedPassword): self
    {
        $pass = new self;

        $pass->hashedPassword = $hashedPassword;

        return $pass;
    }

    public function match(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->hashedPassword);
    }

    /**
     * @param string $plainPassword
     * @throws \Assert\AssertionFailedException
     */
    private function hash(string $plainPassword): void
    {
        $this->validate($plainPassword);

        $this->hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT, ['cost' => self::COST]);
    }

    public function toString(): string
    {
        return $this->hashedPassword;
    }

    public function __toString(): string
    {
        return $this->hashedPassword;
    }

    /**
     * The password can't contain spaces, with at least 1 digit and can't be less thant 6 chars
     * @param string $raw
     * @throws \Assert\AssertionFailedException
     */
    private function validate(string $raw): void
    {
        Assertion::regex($raw, '/^(?=\D*\d)\S{6,}$/', "account.welcome.error.length_error");
    }

    /**
     * Private Constructor
     * HashedPassword constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param int $length
     * @return string
     */
    public static function generate($length = 20): string
    {
        $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`-=~#$%^&*()_+,.<>?;:[]{}';

        $str = '';
        $max = strlen($chars) - 1;

        for ($i=0; $i < $length; $i++)
            $str .= $chars[rand(0, $max)];

        return $str;
    }

    /** @var string */
    private $hashedPassword;

    public const COST = 12;
}
