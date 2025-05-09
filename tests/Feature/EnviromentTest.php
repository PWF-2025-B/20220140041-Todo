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
        $author = env("AUTHOR", "Eko");
        self::assertEquals("Eko", $author);
    }
}
