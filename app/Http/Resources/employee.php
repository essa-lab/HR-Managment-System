<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class employee extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     *
     */
    public function toArray($request){
        return [
            'id' => $this->id,
            'name'=> $this->name,
            'age'=>$this->age,
            'email'=>$this->email,
            'gender'=>$this->gender,
            'hire_date'=>$this->hire_date
        ];
    }
}
