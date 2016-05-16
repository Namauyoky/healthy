<?php

use App\Category;
use Illuminate\Database\Seeder;
use App\Note;

class NoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Note::create(['note' => 'Note 1']);
//        Note::create(['note' => 'Note 2']);
//        Note::create(['note' => 'Note 3']);

        $categories= Category::all();

        //factory(Note::class)->times(100)->create();
        $notes = factory(Note::class)->times(100)->make();

        foreach ($notes as $note){
            $category= $categories ->random();

            //$note->category //categoria relacionada con esta nota
            //$category->notes // todas las notas relacionadas con una categoria
            //$category->notes() // nos devuelve la relacion

            //significado
            //$note->category_id= $category->id
            //$note->save()
            $category->notes()->save($note);


        }

    }
}
