<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
     public function Dashboard()
    {
        return view('dashboard');
    }

    public function index()
    {
       $title='Task list';
       return view('task.list',compact('title')); 
    }

   
    public function create()
    {
        
    }

  
    public function store(Request $request)
    {
        
    }


    public function show(string $id)
    {
        
    }


    public function edit(string $id)
    {
        
    }

    public function update(Request $request, string $id)
    {
        
    }

    public function destroy(string $id)
    {
        
    }
}
