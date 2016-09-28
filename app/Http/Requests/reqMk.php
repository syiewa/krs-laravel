<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class reqMk extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {

        return [
            //
            'kd_mk' => 'required|unique:tbl_mk,kd_mk,'.$request->input('mk_id'),
            'sks' => 'required|numeric',
            'nama_mk' => 'required',
            'semester' => 'required|numeric',
        ];
    }

    public function messages(){
        return [
            'kd_mk.required' => 'Kode Mata Kuliah harus diisi',
            'kd_mk.unique' => 'Kode Mata Kuliah sudah terdaftar',
            'sks.required' => 'SKS harus diisi',
            'sks.numeric' => 'SKS harus berupa angka',
            'nama_mk.required' => 'Nama mata kuliah harus diisi',
            'semester.required' => 'Semester harus diisi',
            'semester.numeric' => 'Semester harus berupa angka'
        ];
    }
}
