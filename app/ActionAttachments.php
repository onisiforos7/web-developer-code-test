<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ActionAttachments extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attachment_path','action_item_id','user_id'
    ];

    public function getUser()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }

    public function getActionItem()
    {
        return $this->hasOne(ActionItems::class, 'id','action_item_id');

    }
}
