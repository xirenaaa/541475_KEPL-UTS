<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private string $token;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user  = User::factory()->create();
        $this->token = $this->user->createToken('test_token')->plainTextToken;
    }

    /**
     * Test authenticated user can create a book (201).
     */
    public function test_authenticated_user_can_create_book(): void
    {
        $bookData = [
            'title'       => 'Laravel untuk Pemula',
            'author'      => 'John Doe',
            'isbn'        => '978-3-16-148410-0',
            'publisher'   => 'Penerbit Tech',
            'year'        => 2024,
            'description' => 'Buku panduan Laravel lengkap.',
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                         ->postJson('/api/books', $bookData);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'Laravel untuk Pemula']);

        $this->assertDatabaseHas('books', ['isbn' => '978-3-16-148410-0']);
    }

    /**
     * Test creating a book without required fields returns 422.
     */
    public function test_create_book_validation_fails(): void
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                         ->postJson('/api/books', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['title', 'author', 'isbn']);
    }

    /**
     * Test authenticated user can list all books.
     */
    public function test_authenticated_user_can_list_books(): void
    {
        Book::factory()->count(3)->create();

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                         ->getJson('/api/books');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    /**
     * Test authenticated user can view a single book.
     */
    public function test_authenticated_user_can_view_book(): void
    {
        $book = Book::factory()->create(['title' => 'Test Book']);

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                         ->getJson('/api/books/' . $book->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Test Book']);
    }

    /**
     * Test authenticated user can update a book.
     */
    public function test_authenticated_user_can_update_book(): void
    {
        $book = Book::factory()->create();

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                         ->putJson('/api/books/' . $book->id, [
                             'title' => 'Updated Title',
                         ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Updated Title']);
    }

    /**
     * Test authenticated user can delete a book.
     */
    public function test_authenticated_user_can_delete_book(): void
    {
        $book = Book::factory()->create();

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                         ->deleteJson('/api/books/' . $book->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
