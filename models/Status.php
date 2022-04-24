<?php


namespace App\Models;


class Status
{
    const STATUS_TODO = 1;
    const STATUS_INPROGRESS = 2;
    const STATUS_DONE = 3;

    public static array $statuses = [
        self::STATUS_TODO => 'To Do',
        self::STATUS_INPROGRESS => 'In Progress',
        self::STATUS_DONE => 'Done',
    ];
}