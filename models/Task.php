<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function assignee()
    {
        return $this->hasOne(User::class);
    }

    public function statusName()
    {
        return Status::$statuses[$this->status_id];
    }
}