<?php

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Vacancy;

class VacancyTest extends ApiTestCase
{
    public function testCreateVacancy()
    {
        $client = self::createClient();
        $client->request('POST', '/api/vacancies', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                "name"=> "test create",
                "description"=>  "description test create",
                "isPublished"=>  true,
            ]
        ]);
        $this->assertResponseStatusCodeSame(201);
    }

    /**
     * @throws \Exception
     */
    public function testUpdateVacancy()
    {

        $client = self::createClient();
        $em = self::$container->get('doctrine')->getManager();

        $vacancy = new Vacancy();
        $vacancy->setName('test update');
        $vacancy->setDescription('description test update');
        $vacancy->setIsPublished(true);

        $em->persist($vacancy);
        $em->flush();

        $client->request('PUT', '/api/vacancies/'.$vacancy->getId(), [
            'json' => ['name' => 'update']
        ]);
        $this->assertResponseStatusCodeSame(200);
    }

    /**
     * @throws \Exception
     */
    public function testDeleteVacancy()
    {
        $client = self::createClient();
        $em = self::$container->get('doctrine')->getManager();

        $vacancy = new Vacancy();
        $vacancy->setName('test delete');
        $vacancy->setDescription('description test delete');
        $vacancy->setIsPublished(true);

        $em->persist($vacancy);
        $em->flush();

        $client->request('DELETE', '/api/vacancies/'.$vacancy->getId());
        $this->assertResponseStatusCodeSame(204);
    }


    public function testGetAllVacancy()
    {
        $client = self::createClient();
        $client->request('GET', '/api/vacancies');
        $this->assertResponseStatusCodeSame(200);
    }

    /**
     * @throws \Exception
     */
    public function testGetVacancy()
    {
        $client = self::createClient();
        $em = self::$container->get('doctrine')->getManager();

        $vacancy = new Vacancy();
        $vacancy->setName('test get one');
        $vacancy->setDescription('description test get one');
        $vacancy->setIsPublished(true);

        $em->persist($vacancy);
        $em->flush();

        $client->request('GET', '/api/vacancies/'.$vacancy->getId());
        $this->assertResponseStatusCodeSame(200);
    }
}