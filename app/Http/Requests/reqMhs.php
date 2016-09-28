<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class reqMhs extends FormRequest
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
            'nim' => 'required|unique:tbl_mahasiswa,nim,'.$request->input('mhs_id'),
            'angkatan' => 'required|date_format:"Y"',
            'nama_mahasiswa' => 'required'
        ];
    }

    public function messages(){
        return [
            'nim.required' => 'NIM harus diisi',
            'nim.unique' => 'NIM sudah terdaftar',
            'angkatan.required' => 'Angkatan harus diisi',
            'angkatan.date_format' => 'Format angkatan harus berupa tahun',
            'nama_mahasiswa.required' => 'Nama mahasiswa harus diisi'

        ];
    }
}
