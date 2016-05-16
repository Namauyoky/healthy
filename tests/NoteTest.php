<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Note;

class NoteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use WithoutMiddleware;

    public function test_notes_list()
    {

        //Having
        //Condiciones
        Note::create(['note' => 'My first Note']);
        Note::create(['note' => 'My Second Note']);

        //When acciones que hacer
        $this->visit('notes')
            //then agregar comprobaciones
            ->see('My first Note')
            ->see('My Second Note');

    }

    public function test_create_note(){

        //Route::post('notes')
        //when
//        $this->post('notes')
//            ->see('Creating a Note');

        $this->visit('notes')
            ->click('Add a note')
            ->seePageIs('notes/create')
            ->see('Create a Note')
            ->type('A new note','note')
            ->press('Create a note')
            ->seePageIs('notes')
            ->see('A new note')
            ->seeInDatabase('notes',[
                'note' => 'A new note'
            ]);
    }
}
