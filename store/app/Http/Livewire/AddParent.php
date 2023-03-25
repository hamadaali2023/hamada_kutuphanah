<?php

namespace App\Http\Livewire;

use App\Category;
use App\Book;


use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;
    
    public $successMessage = '';

    public $catchError;

    public $currentStep = 1;

    public $updateMode = false;
    
    public  $name,$photo,$uid;  
    
    public $show_table=true;     






    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name' => 'required',
            
        ]);
    }


    public function render()
    {
        return view('livewire.add-parent', [
            'books' => Book::all(),
        ]);

    }

    //firstStepSubmit
    public function firstStepSubmit()
    {
       $this->validate([
            'name' => 'required',
          
        ]);

        $this->currentStep = 2;
    }

    //secondStepSubmit
    public function secondStepSubmit()
    {
    	$this->validate([
            'photo' => 'required',
            
        ]);
        $this->currentStep = 3;
    }


	public function submitForm(){
        // try {
        //     $My_Parent = new Book();
        //     $My_Parent->name = $this->name;
        //     if (!empty($this->photo)){
        //     	    $this->photo->storeAs("booksss", $this->photo->getClientOriginalName(), $disk = 'parent_attachments');
		//          $My_Parent->photo= $this->photo->getClientOriginalName();
        //    	}
        //     $My_Parent->save();
        //     $this->successMessage = trans('messages.success');
        //     $this->currentStep = 1;
        // }
        // catch (\Exception $e) {
        //     $this->catchError = $e->getMessage();
        // };

        try {
            $add = new Book();
            $add->name = $this->name;
            if (!empty($this->photo)){
                $this->photo->store('todos', 'public');
                $add->photo= $this->photo->getClientOriginalName();
            }
            $add->save();
            $this->successMessage = trans('messages.success');
            $this->currentStep = 1;
        }

        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };
    }

    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function showformadd(){
        $this->show_table = false;
    }



    public function edit($uid)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $books = Book::where('id',$uid)->first();
        $this->uid = $uid;
        $this->name = $books->name;    
    }

     public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 2;

    }

    //secondStepSubmit_edit
    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;

    }



    public function submitForm_edit(){

        if ($this->uid){
            $edit = Book::find($this->uid);
            $edit->name = $this->name;            
            $edit->save();
            // $parent->update([
            //     'Passport_ID_Father' => $this->Passport_ID_Father,
            //     'National_ID_Father' => $this->National_ID_Father,
            // ]);

        }

        return redirect()->to('/add_parent');
    }

    public function delete($uid){
        My_Parent::findOrFail($uid)->delete();
        return redirect()->to('/add_parent');
    }

}