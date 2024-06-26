<?php

namespace spec\District09\BackupManager\Filesystems;

use BackblazeB2\Http\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PhpSpec\Exception\Example\SkippingException;
use PhpSpec\ObjectBehavior;

class BackblazeFilesystemSpec extends ObjectBehavior
{
    public function let(): void
    {
        if (!class_exists('MarcAndreAppel\FlysystemBackblaze\BackblazeAdapter')) {
            throw new SkippingException('Requires Backblaze');
        }
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('District09\BackupManager\Filesystems\BackblazeFilesystem');
    }

    public function it_should_recognize_its_type_with_case_insensitivity()
    {
        foreach (['b2', 'B2'] as $type) {
            $this->handles($type)->shouldBe(true);
        }

        foreach ([null, 'foo'] as $type) {
            $this->handles($type)->shouldBe(false);
        }
    }

    public function getConfig()
    {
        return [
            'key'       => 'test_key',
            'accountId' => 'test_id',
            'bucket'    => 'bucket',
            'options'   => ['client' => $this->getMockClient()]
        ];
    }

    public function getMockClient()
    {
        $handler = new HandlerStack(new MockHandler([$this->getMockAuthorizationResponse()]));

        return new Client(['handler' => $handler]);
    }

    public function getMockAuthorizationResponse()
    {
        $body = '{
                    "accountId: "test_id",
                    "apiUrl": "https://api900.backblaze.com",
                    "authorizationToken": "testAuthToken,
                    "downloadUrl": "https://f900.backblaze.com"
                }';

        return new Response(200, [], $body);
    }
}
