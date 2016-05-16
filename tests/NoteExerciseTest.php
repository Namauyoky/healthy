<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Note;

class NoteExerciseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    use DatabaseTransactions;

    public function test_example_detail()
    {
        //$this->assertTrue(true);
        $text = 'Consequuntur atque incidunt sed magnam sapiente molestiae odio molestiae. Voluptatum laudantium aperiam nobis aperiam qui eum ducimus. Debitis eligendi impedit quam aut.';
        $text .='End of the note';

        $note=Note::create(['note' => $text]);

        $this->visit('notes')
            ->seeInElement('.label','Others')
            //->see('Others')
            ->dontSee('End of the note')
            ->seeLink('View note')
            ->click('View note')
            ->see($text)
            ->seeLink('View all notes','notes');


    }
}
