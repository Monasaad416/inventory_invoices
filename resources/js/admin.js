import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? "mt1",
    wsHost: import.meta.env.VITE_PUSHER_HOST
        ? import.meta.env.VITE_PUSHER_HOST
        : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? "https") === "https",
    enabledTransports: ["ws", "wss"],
});


var channel1 = window.Echo.private("InvoiceCreatedChannel");
channel1.listen(".App\\Events\\NewInvoiceCreatedEvent", function (data) {
    // alert(JSON.stringify(data));
    $("#notificationIcon").load(" #notificationIcon > *");

});

var channel2 = window.Echo.private("InvoiceArchivedChannel");
channel2.listen(".App\\Events\\InvoiceArchivedEvent", function (data) {
    // alert(JSON.stringify(data));
    $("#notificationIcon").load(" #notificationIcon > *");

});

// channel.notification(function (data) {
//     console.log(data);
// });


