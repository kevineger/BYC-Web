<?php namespace App\Transformers;

class CourseTransformer extends Transformer
{
    private $schoolTransformer;

    public function __construct(SchoolTransformer $schoolTransformer)
    {
        $this->schoolTransformer = $schoolTransformer;
    }

    public function transform($course)
    {
        return [
            'id'          => (int)$course['id'],
            'name'        => $course['name'],
            'school'      => $this->schoolTransformer->transform($course->school),
            'description' => $course->description,
            'active'      => (boolean)$course->active,
            'min_age'     => (int)$course->min_age,
            'max_age'     => (int)$course->max_age,
            'price'       => (double)$course->price,
        ];
    }
}