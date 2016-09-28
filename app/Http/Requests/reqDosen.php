<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class reqDosen extends FormRequest
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
            'kode_dosen' => 'required|unique:tbl_dosen,kode_dosen,'.$request->get('dosen_id'),
            'nidn' => 'unique:tbl_dosen,nidn,'.$request->get('dosen_id'),
            'nama_dosen' => 'required'
        ];
    }

    public function messages(){
        return [
            'kode_dosen.required' => 'Kode dosen harus diisi',
            'kode_dosen.unique' => 'kode dosen sudah terdaftar',
            'nidn.unique' => 'NIDN sudah terdaftar',
            'nama_dosen.required' => 'Nama dosen harus diisi'
        ];
    }
}
