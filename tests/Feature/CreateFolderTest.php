<?php

namespace Tests\Feature;

use App\Folder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateFolderTest extends TestCase
{
  use RefreshDatabase;
  /**
   * @test
   */
  public function Basic_フォルダ追加ページの表示()
  {
    $response = $this->get('/folders/create');

    $response->assertStatus(200);
  }

  /**
   * @test
   */
  public function Basic_フォルダ追加()
  {
    $response = $this->json('POST','/folders/create',
      [
        'title' => 'test',
      ]);

    $folder = Folder::first();
    $this->assertEquals('test', $folder->title);

    $response
          ->assertRedirect('/folders/'.$folder->id.'/tasks');
  }

}
