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
    protected $deckId;

    public function __construct($deckId)
    {
        $this->deckId = $deckId;
    }

    public function model(array $row)
    {
        return new Card([
            'question' => $row['question'],
            'answer' => $row['answer'],
            'deck_id' => $this->deckId,
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'required',
            '1' => 'required',
        ];
    }
}
