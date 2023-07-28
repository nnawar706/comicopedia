// // // Set new default font family and font color to mimic Bootstrap's default styling
// (Chart.defaults.global.defaultFontFamily = "Nunito"),
//     '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
// Chart.defaults.global.defaultFontColor = "#858796";

const { toInteger } = require("lodash");

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

    fetch(`/api/order-summary?apiKey=${apiKey}`)
        .then((response) => response.json())
        .then((data) => {
            const labels = data['cart_data'].map((item) => item.month);
            const count_order_item = data["cart_data"].map((item) => item.total_orders);
            const count_cart_item = data["cart_data"].map((item) => item.total_carts);
            const count_wish_item = data["wish_data"].map((item) => item.total_wish);
            const cart_to_order = data["cart_data"].map((item) => item.cart_to_order_ratio * 100);
            const wish_to_cart = data["wiah_data"].map((item) => item.wish_to_cart_ratio * 100);

            var ctx = document.getElementById("myOrderChart");
            var myBarChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            axis: "x",
                            label: "Order Status",
                            backgroundColor: [
                                "rgba(255, 99, 132, 0.2)",
                                "rgba(255, 159, 64, 0.2)",
                                "rgba(255, 205, 86, 0.2)",
                                "rgba(75, 192, 192, 0.2)",
                            ],
                            hoverBackgroundColor: [
                                "rgba(255, 99, 132, 0.5)",
                                "rgba(255, 159, 64, 0.5)",
                                "rgba(255, 205, 86, 0.5)",
                                "rgba(75, 192, 192, 0.5)",
                            ],
                            borderColor: "#4e73df",
                            data: count,
                        },
                    ],
                },
                options: {
                    indexAxis: "y",
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0,
                        },
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    color: "rgb(234, 236, 244)",
                                    zeroLineColor: "rgb(234, 236, 244)",
                                    drawBorder: false,
                                    borderDash: [2],
                                    zeroLineBorderDash: [2],
                                },
                            },
                        ],
                        yAxes: [
                            {
                                gridLines: {
                                    display: false,
                                    drawBorder: false,
                                },
                                maxBarThickness: 25,
                            },
                        ],
                    },
                    legend: {
                        display: false,
                    },
                    tooltips: {
                        titleMarginBottom: 10,
                        titleFontColor: "#6e707e",
                        titleFontSize: 14,
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: "#dddfeb",
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function (tooltipItem, chart) {
                                return number_format(tooltipItem.xLabel);
                            },
                        },
                    },
                },
            }).catch((error) => console.log(error));
        });
});
