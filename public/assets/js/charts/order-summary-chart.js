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

    fetch(`/api/order-summary?apiKey=${apiKey}`)
        .then((response) => response.json())
        .then((data) => {
            const labels = data['cart_data'].map((item) => item.month_name);
            const count_order_item = data["cart_data"].map((item) => item.total_orders);
            const count_cart_item = data["cart_data"].map((item) => item.total_carts);
            const count_wish_item = data["wish_data"].map((item) => item.total_wish);

            var ctx = document.getElementById("myComparisonChart");
            var myBarChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "Order Items",
                            data: count_order_item,
                            borderColor: "#dddfeb",
                            backgroundColor: "rgba(255, 99, 132, 0.2)",
                            hoverBackgroundColor: "rgba(255, 99, 132, 0.5)",
                            stack: "combined",
                            type: "bar",
                        },
                        {
                            label: "Cart Items",
                            data: count_cart_item,
                            borderColor: "#dddfeb",
                            stack: "combined",
                            fill: false,
                        },
                        {
                            label: "Wishlist Items",
                            data: count_wish_item,
                            borderColor: "rgba(255, 159, 64, 0.2)",
                            stack: "combined",
                            fill: false,
                        },
                    ],
                },
                options: {
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 0,
                            bottom: 40,
                        },
                    },
                    scales: {
                        y: {
                            stacked: true,
                        },
                        x: {
                            ticks: {
                                stepSize: 2, // Set the stepSize to 2 to show data for every 2 months
                            },
                        },
                    },
                },
            }).catch((error) => console.log(error));
        });
});
