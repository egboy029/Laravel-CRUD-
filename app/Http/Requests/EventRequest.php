<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'event_date' => 'required|date|after_or_equal:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The event title is required.',
            'title.max' => 'The event title cannot exceed 255 characters.',
            'description.required' => 'The event description is required.',
            'description.max' => 'The description cannot exceed 1000 characters.',
            'event_date.required' => 'The event date is required.',
            'event_date.date' => 'Please provide a valid date.',
            'event_date.after_or_equal' => 'The event date must be today or a future date.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 2MB.'
        ];
    }
}
