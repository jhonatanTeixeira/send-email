<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'subject' => $this->subject,
            'recipients' => $this->recipients,
            'params' => $this->params,
            'theme_id' => $this->theme_id,
            'sent_date' => $this->sent_date,
        ];
    }
}
