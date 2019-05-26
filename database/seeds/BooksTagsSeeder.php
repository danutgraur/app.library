<?php

use App\Book;
use App\Tag;
use Illuminate\Database\Seeder;

class BooksTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book = factory(Book::class, 50)->create();
        $tag = factory(Tag::class, 100)->create();
        $book->each(function (\App\Book $b) use ($tag) {
            $b->tags()->attach(
                $tag->random(rand(5, 10))->pluck('id')->toArray()
            );
        });
    }
}
