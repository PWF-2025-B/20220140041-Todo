<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Uploadfile;

class AppEnviromentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testAppEnv()
    {
        if(App::environment(['testing', 'prod', 'dev'])){
            // kode program kita
            self::assertTrue(true);
        }
    }
}
