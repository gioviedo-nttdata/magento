<?php

declare(strict_types=1);

namespace NTTData\Api\Service;

use GuzzleHttp\Client;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ResponseFactory;
use Magento\Framework\Webapi\Rest\Request;

class ApiService
{
    protected $responseFactory;
    protected $clientFactory;
    protected $response;

    public function __construct(
        ClientFactory $clientFactory,
        ResponseFactory $responseFactory
    ) {
        $this->clientFactory = $clientFactory;
        $this->responseFactory = $responseFactory;
    }

    public function getContent($apiRequestUri, $endpoint = '', $params = []){
        $this->doRequest($apiRequestUri, $endpoint, $params);
        $content = $this->response->getBody()->getContents();
        return json_decode($content, true);
    }

    public function getResponse(){
        return $this->response;
    }

    public function doRequest(
        $apiRequestUri,
        $endpoint = '',
        array $params = [],
        string $requestMethod = Request::HTTP_METHOD_GET
    ): Response {
        $client = $this->clientFactory->create(['config' => [
            'base_uri' => $apiRequestUri
        ]]);

        try {
            $this->response = $client->request(
                $requestMethod,
                $endpoint ?? '',
                $params
            );
        } catch (GuzzleException $exception) {
            $this->response = $this->responseFactory->create([
                'status' => 500,
                'reason' => $exception->getMessage()
            ]);
        }

        return $this->response;
    }
}
