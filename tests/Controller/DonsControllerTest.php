<?php

namespace App\Test\Controller;

use App\Entity\Dons;
use App\Repository\DonsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DonsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private DonsRepository $repository;
    private string $path = '/dons/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Dons::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Don index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'don[montant_don]' => 'Testing',
            'don[mail_don]' => 'Testing',
            'don[CIN_don]' => 'Testing',
            'don[virement_img]' => 'Testing',
            'don[compagne]' => 'Testing',
        ]);

        self::assertResponseRedirects('/dons/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Dons();
        $fixture->setMontant_don('My Title');
        $fixture->setMail_don('My Title');
        $fixture->setCIN_don('My Title');
        $fixture->setVirement_img('My Title');
        $fixture->setCompagne('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Don');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Dons();
        $fixture->setMontant_don('My Title');
        $fixture->setMail_don('My Title');
        $fixture->setCIN_don('My Title');
        $fixture->setVirement_img('My Title');
        $fixture->setCompagne('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'don[montant_don]' => 'Something New',
            'don[mail_don]' => 'Something New',
            'don[CIN_don]' => 'Something New',
            'don[virement_img]' => 'Something New',
            'don[compagne]' => 'Something New',
        ]);

        self::assertResponseRedirects('/dons/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getMontant_don());
        self::assertSame('Something New', $fixture[0]->getMail_don());
        self::assertSame('Something New', $fixture[0]->getCIN_don());
        self::assertSame('Something New', $fixture[0]->getVirement_img());
        self::assertSame('Something New', $fixture[0]->getCompagne());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Dons();
        $fixture->setMontant_don('My Title');
        $fixture->setMail_don('My Title');
        $fixture->setCIN_don('My Title');
        $fixture->setVirement_img('My Title');
        $fixture->setCompagne('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/dons/');
    }
}
