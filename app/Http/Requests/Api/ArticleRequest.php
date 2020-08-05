<?php

namespace App\Http\Requests\Api;

class ArticleRequest extends ApiRequests
{

    /**
     * @return array
     */

    public function rules()
    {
        return [
            'title' => 'required',
            'text' => 'required'
        ];

    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'title required',
            'text.required' => 'text required',
        ];
    }


}
