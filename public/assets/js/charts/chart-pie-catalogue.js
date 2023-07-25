// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

let apiKey = "c704212b54af40b3af542df235f28ac3";

fetch(`/api/catalogues?apiKey=${apiKey}`)
    .then(response => response.json())
    .then(data => {
        console.log(data);
        // const labels = data.map(catalogue => catalogue.name);
        // const count = data.map(catalogue => catalogue.volumes_count);
        //
        // var ctx = document.getElementById("cataloguePieChart");
        // var myPieChart = new Chart(ctx, {
        //     type: 'doughnut',
        //     data: {
        //         labels: labels,
        //         datasets: [{
        //             data: count,
        //             backgroundColor: ['#f23000', '#4e73df', '#1cc88a', '#36b9cc', '#B2BEB5', '#242424'],
        //             hoverBackgroundColor: ['#d30000', '#17a673', '#2c9faf', '#292929', '#171717'],
        //             hoverBorderColor: "rgba(234, 236, 244, 1)",
        //         }],
        //     },
        //     options: {
        //         maintainAspectRatio: false,
        //         tooltips: {
        //             backgroundColor: "rgb(255,255,255)",
        //             bodyFontColor: "#858796",
        //             borderColor: '#dddfeb',
        //             borderWidth: 1,
        //             xPadding: 15,
        //             yPadding: 15,
        //             displayColors: false,
        //             caretPadding: 10,
        //         },
        //         legend: {
        //             display: false
        //         },
        //         cutoutPercentage: 80,
        //     },
        // });
    })
    .catch(error => {
        console.log('Error: ', error);
    })
//
// function downloadPieChart()
// {
//     const link = document.createElement('a');
//     const canvas = document.getElementById("myPieChart");
//     link.download = 'genre_chart.png';
//     link.href = canvas.toDataURL('image/png', 1);
//     link.click();
// }
//
// function exportPieChartPDF()
// {
//     const canvas = document.getElementById("myPieChart");
//
//     const canvasImg = canvas.toDataURL('image/jpeg', 1.0);
//
//     let pdf = new jsPDF('landscape');
//     pdf.setFontSize(20);
//     pdf.addImage(canvasImg, 'JPEG', 15, 15, 280, 150);
//     pdf.save("genre_chart.pdf");
// }
