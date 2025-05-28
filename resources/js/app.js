import "./bootstrap";

import Alpine from "alpinejs";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import axios from "axios";

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");
    var calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        dateClick: function (info) {
            var title = prompt("Event Title:");
            if (title) {
                axios
                    .post("/store-event", {
                        title: title,
                        start: info.dateStr,
                    })
                    .then((response) => {
                        calendar.addEvent({
                            id: response.data.id,
                            title: response.data.title,
                            start: response.data.start,
                            allDay: true,
                        });
                    });
            }
        },
        events: "/fetch-events",
    });
    calendar.render();
});
