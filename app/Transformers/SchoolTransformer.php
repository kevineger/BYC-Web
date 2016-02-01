<?php namespace App\Transformers;

class SchoolTransformer extends Transformer {

    public function transform($school)
    {
        $images = [];
        foreach($school->photos as $photo) {
            $images[] = $photo->path;
        }
        return [
            'id'          => (int)$school['id'],
            'name'        => $school['name'],
            'address'     => $school['address'],
            'description' => $school['description'],
            'images'      => $images
        ];
    }
}