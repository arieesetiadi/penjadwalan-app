$(function () {
    let countdowns = Array.from($("span.countdown"));
    let diff = 0;

    setInterval(() => {
        countdowns.forEach((countdown, i) => {
            let scheduleId = $(countdown).data("schedule-id");
            i = ++i % 4;
            let now = new Date().getTime();
            let then = new Date($(countdown).data("then")).getTime();
            let diff = then - now;

            let days = Math.floor(diff / (1000 * 60 * 60 * 24));
            let hours = Math.floor(
                (diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
            );
            let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((diff % (1000 * 60)) / 1000);

            let strCountdown = `
                ${days > 0 ? days + "d " : ""}
                ${hours > 0 ? hours + "h " : ""}
                ${minutes > 0 ? minutes + "m " : ""}
                ${seconds > 0 ? seconds + "s " : ""}
            `;

            if (diff <= 0) {
                strCountdown = "Sedang berjalan";
                $(".on-schedule-finish-" + scheduleId).removeClass("d-none");
            }

            $(countdown).text(strCountdown);
        });
    }, 1000);
});
