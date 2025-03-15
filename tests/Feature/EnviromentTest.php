<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnviromentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testenv(): void
    {
       $appName = env("YOUTUBE");
         self::assertEquals("Programmer Zaman Now", $appName);
    }


    public function testDefaultValue(): void
    {
        $author = env("AUTHOR", "Ihsan");
        self::assertEquals("Ihsan", $author);
    }

    public function testEnviroment(): void
    {
        if(App::environment("testing")) {
            echo "LOGIC IN TESTING ENV" . PHP_EOL;
        }
        self::assertTrue(true);
    }

}
