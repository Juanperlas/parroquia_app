<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegistroBautizoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'numero_registro' => $this->numero_registro ?? null,
            'nombre' => $this->nombre ?? null,
            'padre' => $this->padre ?? null,
            'madre' => $this->madre ?? null,
            'padrino' => $this->padrino ?? null,
            'madrina' => $this->madrina ?? null,
            'fecha_bautizo' => $this->fecha_bautizo ?? null,
            'lugar_bautizo' => $this->lugar_bautizo ?? null,
            'sacerdote' => $this->sacerdote ?? null,
        ];

    }
}
