<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Str;

class BookTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // ======================================== READ ========================================

    public function test_read_book_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);

        $response = $this->get('/dashboard');
        $response->assertStatus(200);

        $response->assertSeeText("Dashboard Admin");

        $response = $this->get('/kelolabuku');
        $response->assertStatus(200);

        $response->assertSeeText("List Data Buku");
        $response->assertSeeText("Tambah Data Buku");
    }

    // ======================================== CREATE ========================================

    public function test_create_book()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        Storage::fake('cover_test');
        $foto = UploadedFile::fake()->image('cover.jpg');

        $name = "Ternak Lele " . Str::random(4);
        $slug = str::slug($name, '-');

        $this->actingAs($user);
        $response = $this->post('/kelolabuku', [
            'category_id' => $category->id,
            'cover_photo' => $foto,
            'isbn' => Str::random(10),
            'title' => $name,
            'slug' => $slug,
            'author' => "Rafif " . Str::random(4),
            'publisher' => "Gramedia " . Str::random(4),
            'price' => random_int(10000, 500000),
            'stock' => random_int(1, 50),
            '_token' => csrf_token(),
        ]);

        $response->assertStatus(302); // karena di controller di redirect
        $response->assertSessionHas([
            'success' => 'buku berhasil ditambahkan',
        ]);
    }

    // ----------------============= create required ==========---------------

    public function test_create_book_cover_book_required()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $name = "Ternak Lele " . Str::random(4);
        $slug = str::slug($name, '-');

        $this->actingAs($user);
        $response = $this->post('/kelolabuku', [
            'category_id' => $category->id,
            'cover_photo' => '',
            'isbn' => Str::random(10),
            'title' => $name,
            'slug' => $slug,
            'author' => "Rafif " . Str::random(4),
            'publisher' => "Gramedia " . Str::random(4),
            'price' => random_int(10000, 500000),
            'stock' => random_int(1, 50),
            '_token' => csrf_token(),
        ]);

        $response->assertStatus(500);
    }

    public function test_create_book_category_id_required()
    {
        $user = User::factory()->create();

        Storage::fake('cover_test');
        $foto = UploadedFile::fake()->image('cover.jpg');

        $name = "Ternak Lele " . Str::random(4);
        $slug = str::slug($name, '-');

        $this->actingAs($user);
        $response = $this->post('/kelolabuku', [
            'category_id' => null,
            'cover_photo' => $foto,
            'isbn' => '',
            'title' => $name,
            'slug' => $slug,
            'author' => "Rafif " . Str::random(4),
            'publisher' => "Gramedia " . Str::random(4),
            'price' => random_int(10000, 500000),
            'stock' => random_int(1, 50),
            '_token' => csrf_token(),
        ]);

        $response->assertStatus(500);
    }

    public function test_create_book_isbn_required()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        Storage::fake('cover_test');
        $foto = UploadedFile::fake()->image('cover.jpg');

        $name = "Ternak Lele " . Str::random(4);
        $slug = str::slug($name, '-');

        $this->actingAs($user);
        $response = $this->post('/kelolabuku', [
            'category_id' => $category->id,
            'cover_photo' => $foto,
            'isbn' => '',
            'title' => $name,
            'slug' => $slug,
            'author' => "Rafif " . Str::random(4),
            'publisher' => "Gramedia " . Str::random(4),
            'price' => random_int(10000, 500000),
            'stock' => random_int(1, 50),
            '_token' => csrf_token(),
        ]);

        $response->assertStatus(500);
    }

    public function test_create_book_title_required()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        Storage::fake('cover_test');
        $foto = UploadedFile::fake()->image('cover.jpg');

        $name = "Ternak Lele " . Str::random(4);
        $slug = str::slug($name, '-');

        $this->actingAs($user);
        $response = $this->post('/kelolabuku', [
            'category_id' => $category->id,
            'cover_photo' => $foto,
            'isbn' => Str::random(10),
            'title' => '',
            'slug' => $slug,
            'author' => "Rafif " . Str::random(4),
            'publisher' => "Gramedia " . Str::random(4),
            'price' => random_int(10000, 500000),
            'stock' => random_int(1, 50),
            '_token' => csrf_token(),
        ]);

        $response->assertStatus(500);
    }

    public function test_create_book_author_required()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        Storage::fake('cover_test');
        $foto = UploadedFile::fake()->image('cover.jpg');

        $name = "Ternak Lele " . Str::random(4);
        $slug = str::slug($name, '-');

        $this->actingAs($user);
        $response = $this->post('/kelolabuku', [
            'category_id' => $category->id,
            'cover_photo' => $foto,
            'isbn' => Str::random(10),
            'title' => $name,
            'slug' => $slug,
            'author' => '',
            'publisher' => "Gramedia " . Str::random(4),
            'price' => random_int(10000, 500000),
            'stock' => random_int(1, 50),
            '_token' => csrf_token(),
        ]);

        $response->assertStatus(500);
    }

    public function test_create_book_publisher_required()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        Storage::fake('cover_test');
        $foto = UploadedFile::fake()->image('cover.jpg');

        $name = "Ternak Lele " . Str::random(4);
        $slug = str::slug($name, '-');

        $this->actingAs($user);
        $response = $this->post('/kelolabuku', [
            'category_id' => $category->id,
            'cover_photo' => $foto,
            'isbn' => Str::random(10),
            'title' => $name,
            'slug' => $slug,
            'author' => "Rafif " . Str::random(4),
            'publisher' => '',
            'price' => random_int(10000, 500000),
            'stock' => random_int(1, 50),
            '_token' => csrf_token(),
        ]);

        $response->assertStatus(500);
    }

    public function test_create_book_price_required()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        Storage::fake('cover_test');
        $foto = UploadedFile::fake()->image('cover.jpg');

        $name = "Ternak Lele " . Str::random(4);
        $slug = str::slug($name, '-');

        $this->actingAs($user);
        $response = $this->post('/kelolabuku', [
            'category_id' => $category->id,
            'cover_photo' => $foto,
            'isbn' => Str::random(10),
            'title' => $name,
            'slug' => $slug,
            'author' => "Rafif " . Str::random(4),
            'publisher' => "Gramedia " . Str::random(4),
            'price' => null,
            'stock' => random_int(1, 50),
            '_token' => csrf_token(),
        ]);

        $response->assertStatus(500);
    }

    public function test_create_book_stock_required()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        Storage::fake('cover_test');
        $foto = UploadedFile::fake()->image('cover.jpg');

        $name = "Ternak Lele " . Str::random(4);
        $slug = str::slug($name, '-');

        $this->actingAs($user);
        $response = $this->post('/kelolabuku', [
            'category_id' => $category->id,
            'cover_photo' => $foto,
            'isbn' => Str::random(10),
            'title' => $name,
            'slug' => $slug,
            'author' => "Rafif " . Str::random(4),
            'publisher' => "Gramedia " . Str::random(4),
            'price' => random_int(10000, 500000),
            'stock' => null,
            '_token' => csrf_token(),
        ]);

        $response->assertStatus(500);
    }


    // ======================================== UPDATE ========================================

    public function test_update_book()
    {

        Storage::fake('cover_test');
        $foto = UploadedFile::fake()->image('cover.jpg');

        $name = "Ternak Lele" . Str::random(10);
        $slug = str::slug($name, '-');

        $user = User::factory()->create();

        $book = Book::factory()->create();

        $book->category_id = 1;
        $book->cover_photo = $foto;
        $book->isbn = Str::random(10);
        $book->title = $name;
        $book->slug = $slug;
        $book->author = "Rafif edit" . Str::random(4);
        $book->publisher = "PT. Gramedia edit" . Str::random(4);
        $book->price =  random_int(10000, 500000);
        $book->stock = random_int(1, 50);

        $response = $this->actingAs($user)->put('/kelolabuku/' . $book->id, $book->toArray());

        $response->assertStatus(302); // karena di controller di redirect
        $response->assertSessionHas([
            'success' => 'buku berhasil diupdate',
        ]);
    }

    // ======================================== DELETE ========================================

    public function test_delete_book()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $response = $this->actingAs($user)->delete('/kelolabuku/' . $book->id);

        $response->assertStatus(302);
        $response->assertSessionHas([
            'success' => 'buku berhasil dihapus',
        ]);
    }
}
