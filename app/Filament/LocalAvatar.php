<?php
namespace App\Filament;

use Filament\AvatarProviders\Contracts;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LocalAvatar implements Contracts\AvatarProvider
{
    public function get(Model | Authenticatable $record): string
    {
       
        $avatar = Auth::user()->avatar;

       if($avatar != null){
        return asset('storage/'.$avatar);
       }
        return $this->getDefault();
    }

    protected function getDefault(): string
    {
        return asset('storage/avatars/simple.jpg');
    }
}