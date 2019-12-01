<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 01.12.2019
 * Time: 20:02
 */

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Vacancy;

class VacancyTest extends ApiTestCase
{

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function testCreateVacancy()
    {
        $client = self::createClient();
        $client->request('POST', '/api/vacancies', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                "name"=> "TEST",
                "description"=>  "TEST",
                "isPublished"=>  true,
            ]
        ]);
        $this->assertResponseStatusCodeSame(201);
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function testUpdateVacancy()
    {
        /*
        $vacancy = new Vacancy();
        $vacancy->setName('testName');
        $vacancy->setDescription('testDescription');
        $vacancy->setIsPublished(true);


        $em = self::$container->get('doctrine')->getManager();
        $this->$em->persist($vacancy);
        $this->$em->flush();*/

        $client = self::createClient();
        $client->request('PUT', '/api/vacancies/2', [
            'json' => ['name' => 'update']
        ]);
        $this->assertResponseStatusCodeSame(200);
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function testDeleteVacancy()
    {
        $client = self::createClient();
        $client->request('DELETE', '/api/vacancies/1');
        $this->assertResponseStatusCodeSame(204);
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function testGetAllVacancy()
    {
        $client = self::createClient();
        $client->request('GET', '/api/vacancies');
        $this->assertResponseStatusCodeSame(200);
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function testGetVacancy()
    {
        $client = self::createClient();
        $client->request('GET', '/api/vacancies/2');
        $this->assertResponseStatusCodeSame(200);
    }
}