<?php namespace App\Transformers;

class CourseTransformer extends Transformer {

    private $schoolTransformer;
    private $timeTransformer;

    public function __construct(SchoolTransformer $schoolTransformer, TimeTransformer $timeTransformer)
    {
        $this->schoolTransformer = $schoolTransformer;
        $this->timeTransformer = $timeTransformer;
    }

    public function transform($course)
    {
        $images = [];
        foreach ( $course->photos as $photo ) {
            $images[] = $photo->path;
        }

        $categories = [];
        foreach ( $course->categories as $category ) {
            $categories[] = $category->text;
        }

        return [
            'id'          => (int)$course['id'],
            'name'        => $course['name'],
            'school'      => $this->schoolTransformer->transform($course->school),
            'description' => $course->description,
            'featured'    => (boolean)$course->featured,
            'active'      => (boolean)$course->active,
            'min_age'     => (int)$course->min_age,
            'max_age'     => (int)$course->max_age,
            'price'       => (double)$course->price,
            'times'       => $this->timeTransformer->transform($course->times),
            'images'      => $images,
            'categories'  => $categories
        ];
    }
}