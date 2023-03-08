<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $type = $this->getType();

        return [
            'title' => "$type تلگرام $this->name",
            'name' => "$type $this->name",
            'image' => $this->image,
            'slug' => $this->slug,
            'description' => nl2br($this->description),
            'link' => $this->link,
            'support_link' => $this->support_link,
            'members' => $this->members,
            'views' => $this->views,
            'diff' => $this->diff,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
        ];
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        $tags = $this->whenLoaded('tags')->pluck('slug')->toArray();

        $type = in_array('channel', $tags) ? 'کانال' : 'گروه'; // todo: refactor this.
        $type = in_array('bot', $tags) ? 'ربات' : $type;

        return $type;
    }
}
