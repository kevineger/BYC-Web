<?php namespace App\Transformers;

class SchoolTransformer extends Transformer
{

    public function transform($school)
    {
        return [
            'id'          => (int)$school['id'],
            'name'        => $school['name'],
            'address'     => $school['address'],
            'description' => $school['description']
        ];
    }
}