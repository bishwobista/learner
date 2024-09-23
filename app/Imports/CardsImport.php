<?php

namespace App\Imports;

use App\Models\Card;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CardsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Card([
            'question' => $row['question'],
            'answer' => $row['answer'],
            'deck_id' => $row['deck_id'],
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'required',
            '1' => 'required',
            '2' => 'required|integer',
        ];
    }
}
