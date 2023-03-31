<?php

namespace App\Command;

use App\Entity\Fruit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(name: 'fruits:fetch')]
class FruitsFetchCommand extends Command
{
    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly EntityManagerInterface $em,
        private readonly MailerInterface $mailer
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $response = $this->client->request(
            'GET',
            'https://fruityvice.com/api/fruit/all'
        );

        $content = $response->toArray();

        foreach ($content as $data) {
            $fruit = new Fruit();
            $fruit->setGenus($data['genus']);
            $fruit->setName($data['name']);
            $fruit->setExternalId($data['id']);
            $fruit->setFamily($data['family']);
            $fruit->setOrders($data['order']);
            $fruit->setCarbohydrates($data['nutritions']['carbohydrates']);
            $fruit->setProtein($data['nutritions']['protein']);
            $fruit->setFat($data['nutritions']['fat']);
            $fruit->setCalories($data['nutritions']['calories']);
            $fruit->setSugar($data['nutritions']['sugar']);

            $this->em->persist($fruit);
        }

        $this->em->flush();

        $output->writeln('<info>Fruits load to database</info>');

        $email = (new Email())
            ->from('gamusta@gmail.com')
            ->to('gamusta@hotmail.fr')
            ->subject('Fruits loaded !')
            ->text(count($content) . ' fruits data saved on database');

        $this->mailer->send($email);

        $output->writeln('<info>Mail sent</info>');

        return Command::SUCCESS;
    }
}
