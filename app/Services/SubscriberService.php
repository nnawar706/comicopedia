<?php

namespace App\Services;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberService
{
    private $subscriber;

    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function store(Request $request)
    {
        $this->subscriber->newQuery()->create([
            'email' => $request->email,
        ]);
    }
}
