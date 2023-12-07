<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class FormController extends Controller
{
    public function index() {
        try {
            $forms = Form::all();
            return response()->json($forms);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Öncelikle giriş yapmalısınız!'], 401);
        }
    }
    
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
        ]);
    
        $newForm = Form::create($data);
    
        if ($newForm) {
            return response()->json(['message' => 'Ürün başarıyla eklendi.'], 200);
        } else {
            return response()->json(['error' => 'Girilen bilgiler eksik veya hatalı'], 404);
        }
    }
    

    public function edit(Form $form) {
        return response()->json($form);
    }
    
    public function update(Form $form, Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
        ]);
    
        $update = $form->update($data);
    
        if ($update) {
            return response()->json(['message' => 'Ürün başarıyla güncellendi'], 200);
        } else {
            return response()->json(['error' => 'Girilen bilgiler eksik veya hatalı'], 404);
        }
    }
    

    public function destroy(Form $form) {
        $delete = $form->delete();
    
        if ($delete) {
            return response()->json(['message' => 'Ürün başarıyla silindi.'], 200);
        } else {
            return response()->json(['error' => 'Ürün bulunamadı.'], 404);
        }
    }
}