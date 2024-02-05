<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('InvoiceCreatedChannel', function ($user) {
    return $user->roles_name == "superadmin";
});

Broadcast::channel('InvoiceArchivedChannel', function ($user) {
    return $user->roles_name == "superadmin";
});

