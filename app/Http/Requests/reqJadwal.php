<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class reqJadwal extends FormRequest
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
            'waktu_mulai' => 'required|date_format:"H:i"',
            'waktu_selesai' => 'required|date_format:"H:i"',
            'kapasitas' => 'required|numeric',
            'kelas' => 'required'
        ];
    }

    public function messages(){
        return [
            'waktu_mulai.required' => 'Jam Mulai Diperlukan',
            'waktu_mulai.date_format' => 'Format Jam Mulai salah',
            'waktu_selesai.required' => 'Jam Selesai Diperlukan',
            'waktu_selesai.date_format' => 'Format Jam Selesai salah',
            'kapasitas.required' => 'Kapasitas diperlukan',
            'kapasitas.numeric' => 'Kapasitas harus berupa angka',
            'kelas.required' => 'Kelas diperlukan'
        ];
    }
}
