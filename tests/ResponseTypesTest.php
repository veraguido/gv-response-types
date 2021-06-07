<?php

namespace Tests;

use Gvera\Exceptions\NotImplementedMethodException;
use Gvera\Helpers\http\JSONResponse;
use Gvera\Helpers\http\PrintErrorResponse;
use Gvera\Helpers\http\Response;
use Gvera\Helpers\http\TransformerResponse;
use PHPUnit\Framework\TestCase;

class ResponseTypesTest extends TestCase
{
    /**
     * @test
     */
    public function testJSONResponse()
    {
        $response = new JSONResponse(["asd" => "qwe"], Response::HTTP_RESPONSE_OK, Response::BASIC_AUTH_ACCESS_DENIED);
        $this->assertTrue($response->getContentType() === Response::CONTENT_TYPE_JSON);
        $this->assertTrue($response->getCode() === Response::HTTP_RESPONSE_OK);
        $jsonToObject = json_decode($response->getContent());
        $this->assertTrue($jsonToObject->asd === 'qwe');
        $this->assertTrue($response->getAuth() === REsponse::BASIC_AUTH_ACCESS_DENIED);

        $response->setContent('meh');
        $this->assertTrue($response->getContent() === 'meh');
    }

    /**
     * @test
     * @throws NotImplementedMethodException
     */
    public function testTransformerResponse()
    {
        $transformer = new TestTransformer(["asd" => "qwe", "zxc" => "ert"]);
        $response = new TransformerResponse($transformer,Response::HTTP_RESPONSE_BAD_REQUEST);
        $jsonToObject = json_decode($response->getContent());
        $this->assertTrue($jsonToObject->zxc === 'ert');

        $this->expectException(NotImplementedMethodException::class);
        $transformer->testException();
    }

    /**
     * @test
     */
    public function testPrintErrorResponse()
    {
        $response = new PrintErrorResponse(
            "2334",
            "unauthorized",
            Response::HTTP_RESPONSE_BAD_REQUEST
        );

        $this->assertTrue($response->getCode() === Response::HTTP_RESPONSE_BAD_REQUEST);
    }
}