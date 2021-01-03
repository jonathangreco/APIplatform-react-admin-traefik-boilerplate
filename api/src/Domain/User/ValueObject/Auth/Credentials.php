<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 30/01/2019
 */

declare(strict_types=1);

namespace App\Domain\User\ValueObject\Auth;

use App\Domain\User\ValueObject\Email;


/**
 * Credentials are a set of Email/HashedPassword. It's a ValueObject element that is allowed to be passed to the
 * authenticator
 * Class Credentials
 * @see LoginAuthenticator
 * @package App\Domain\UAC\User\ValueObject
 */
final class Credentials
{
    /**
     * @var Email
     */
    public $email;

    /**
     * @var HashedPassword
     */
    public $password;

    public function __construct(Email $email, HashedPassword $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
}
