<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Greeting as GreetingResource;

class Writer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
		return [
			'name' => 'My name is: '.$this->name,
			'greeting' => new GreetingResource($this->greeting)
			
			//return new WriterResource(Writer::find(25));
		];
    }
}
