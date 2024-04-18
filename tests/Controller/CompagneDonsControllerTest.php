<?php

namespace App\Test\Controller;

use App\Entity\CompagneDons;
use App\Repository\CompagneDonsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CompagneDonsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private CompagneDonsRepository $repository;
    private string $path = '/compagne/dons/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(CompagneDons::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('CompagneDon index');

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
            'compagne_don[date_d]' => 'Testing',
            'compagne_don[date_f]' => 'Testing',
            'compagne_don[montant_e]' => 'Testing',
            'compagne_don[descrip]' => 'Testing',
            'compagne_don[muni]' => 'Testing',
        ]);

        self::assertResponseRedirects('/compagne/dons/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new CompagneDons();
        $fixture->setDate_d('My Title');
        $fixture->setDate_f('My Title');
        $fixture->setMontant_e('My Title');
        $fixture->setDescrip('My Title');
        $fixture->setMuni('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('CompagneDon');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new CompagneDons();
        $fixture->setDate_d('My Title');
        $fixture->setDate_f('My Title');
        $fixture->setMontant_e('My Title');
        $fixture->setDescrip('My Title');
        $fixture->setMuni('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'compagne_don[date_d]' => 'Something New',
            'compagne_don[date_f]' => 'Something New',
            'compagne_don[montant_e]' => 'Something New',
            'compagne_don[descrip]' => 'Something New',
            'compagne_don[muni]' => 'Something New',
        ]);

        self::assertResponseRedirects('/compagne/dons/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDate_d());
        self::assertSame('Something New', $fixture[0]->getDate_f());
        self::assertSame('Something New', $fixture[0]->getMontant_e());
        self::assertSame('Something New', $fixture[0]->getDescrip());
        self::assertSame('Something New', $fixture[0]->getMuni());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new CompagneDons();
        $fixture->setDate_d('My Title');
        $fixture->setDate_f('My Title');
        $fixture->setMontant_e('My Title');
        $fixture->setDescrip('My Title');
        $fixture->setMuni('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/compagne/dons/');
    }
}
