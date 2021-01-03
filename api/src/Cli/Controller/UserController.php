<?php
/**
 * @author Jonathan Greco <jonathan@superextralab.com>
 * date 09/04/2019
 */
declare(strict_types=1);

namespace App\Cli\Controller;

use App\Cli\Service\UserCliService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserController extends Command
{
    /**
     * @var \App\Cli\Service\UserCliService
     */
    private $userCliService;

    protected function configure(): void
    {
        $this
            ->setName('app:create-user')
            ->setDescription('create a user')
            ->addArgument('email', InputArgument::REQUIRED, 'User email')
            ->addArgument('password', InputArgument::REQUIRED, 'User password')
            ->addArgument('username', InputArgument::REQUIRED, 'Username (can be full name)')
            ->addArgument('role', InputArgument::REQUIRED, 'User role ROLE_USER / ROLE_ADMIN / ROLE_SUPER_ADMIN')
            ->addArgument('locale', InputArgument::OPTIONAL, 'User locale default: fr possible : fr / en')
            ->addArgument('timezone', InputArgument::OPTIONAL, 'User timezone default: "Europe/Paris"')

            ->setHelp("
                Create a user by giving (order matter) {email} {password} {username} {role} {locale} and {timezone} space separated
            ")
        ;
    }

    public function __construct(UserCliService $userCliService)
    {
        parent::__construct();
        $this->userCliService = $userCliService;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @throws \Assert\AssertionFailedException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = $this->userCliService->create(
            $email = (string) $input->getArgument('email'),
            $password = (string) $input->getArgument('password'),
            $username = (string) $input->getArgument('username'),
            $role = (string) $input->getArgument('role'),
            $input->getArgument('locale'),
            $input->getArgument('timezone')
        );

        if (!$user) {
            return 0;
        }

        $output->writeln("<info> $username has been correctly created : </info>");
        $output->writeln("Email: $email");
        $output->writeln("role: $role");
        $output->writeln("locale: {$user->locale()}");
        $output->writeln("timezone: {$user->timezone()}");

        return 1;
    }

}
