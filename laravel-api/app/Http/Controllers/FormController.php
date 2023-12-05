<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class FormController extends Controller
{
    public function index() {
        $forms = Form::all();
        return response()->json($forms);
    }
    
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
        ]);
    
        $newForm = Form::create($data);
    
        if ($newForm) {
            return response()->json(['message' => 'Form başarıyla oluşturuldu'], 200);
        }
        else{
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
            return response()->json(['message' => 'Form başarıyla güncellendi'], 200);
        }
        else{
            return response()->json(['error' => 'Girilen bilgiler eksik veya hatalı'], 404);
        }
    }

    public function destroy(Form $form) {
        $delete = $form->delete();

        if ($delete) {
            return response()->json(['message' => 'Kullanıcı başarıyla silindi.'], 200);
        }
        else{
            return response()->json(['message' => 'Kullanıcı bulunamadı.'], 404);
        }
    }
}