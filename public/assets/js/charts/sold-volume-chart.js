// // // Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Nunito"),
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

// const { toInteger } = require("lodash");

// function number_format(number, decimals, dec_point, thousands_sep) {
//     // *     example: number_format(1234.56, 2, ',', ' ');
//     // *     return: '1 234,56'
//     number = (number + "").replace(",", "").replace(" ", "");
//     var n = !isFinite(+number) ? 0 : +number,
//         prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
//         sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
//         dec = typeof dec_point === "undefined" ? "." : dec_point,
//         s = "",
//         toFixedFix = function (n, prec) {
//             var k = Math.pow(10, prec);
//             return "" + Math.round(n * k) / k;
//         };
//     // Fix for IE parseFloat(0.55).toFixed(0) = 0;
//     s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
//     if (s[0].length > 3) {
//         s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
//     }
//     if ((s[1] || "").length < prec) {
//         s[1] = s[1] || "";
//         s[1] += new Array(prec - s[1].length + 1).join("0");
//     }
//     return s.join(dec);
// }

// Bar Chart Example
document.addEventListener("DOMContentLoaded", function () {
    // let apiKey = "c704212b54af40b3af542df235f28ac3";

    fetch(`/api/volumes/most-sold?apiKey=${apiKey}`)
        .then((response) => response.json())
        .then((data) => {
            const labels = data.map((volume) => volume.name);
            const count = data.map((volume) => volume.order_count);

            var ctx = document.getElementById("volumeChart");
            var myPieChart = new Chart(ctx, {
                type: "pie",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            data: count,
                            backgroundColor: [
                                // "#f23000",
                                // "#4e73df",
                                "#1cc88a",
                                "#36b9cc",
                                "#B2BEB5",
                                // "#242424",
                            ],
                            hoverBackgroundColor: [
                                // "#d30000",
                                // "#17a673",
                                "#2c9faf",
                                "#292929",
                                "#171717",
                            ],
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        },
                    ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "top",
                        },
                        title: {
                            display: true,
                            text: "Chart.js Pie Chart",
                        },
                    },
                },
            });
        }).catch((error) => console.log(error));
    });
// });
