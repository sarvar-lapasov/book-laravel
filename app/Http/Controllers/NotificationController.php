<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Notifications\DatabaseNotification;
use App\Http\Resources\NotificationResource;



class NotificationController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        return $this->response(['read'=>auth()->user()->notifications()->latest()->paginate(6),
         'unread'=>auth()->user()->unreadNotifications()->count()]);
    }

      public function read(DatabaseNotification $notification)
    {
        $notification->markAsRead();

        return $this->success('post read', $notification);

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();

        return $this->success('notification deleted', $notification);

    }
}
