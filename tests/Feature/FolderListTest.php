<?php

namespace Tests\Feature;

use App\Folder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FolderListTest extends TestCase
{
  use RefreshDatabase;

  /**
   * @test
   */
  public function basic_フォルダ一覧の取得()
  {
    // フォルダーを5つ生成
    factory(Folder::class, 5)->create();

    // 一番初めに生成されたフォルダーのインスタンスを取得
    $folder_first = Folder::first();

    // 一番初めに生成されたフォルダーのidを取得
    $id = $folder_first->id;

    // フォルダ一覧表示のパスにアクセス、TaskControllerのindexメソッド
    $response = $this->get("/folders/$[$id]/tasks");

    $response
          ->assertStatus(200)
          ->assertSee($folder_first->title);
  }
}
