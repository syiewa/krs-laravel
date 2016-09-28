<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class reqTA extends FormRequest
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
    public function rules()
    {
        return [
            //
            'kd_tahun' => 'required',
            'keterangan' => 'required',
            'tgl_kuliah' => 'required|date_format:"Y-m-d"',
            'tgl_awal_perwalian' => 'required|date_format:"Y-m-d"',
            'tgl_akhir_perwalian' => 'required|date_format:"Y-m-d"',
        ];
    }
}
