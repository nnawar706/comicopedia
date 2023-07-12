// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

fetch('/api/genres')
    .then(response => response.json())
    .then(data => {
        const labels = data.map(category => category.name);
        const count = data.map(category => category.num_items);

        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: count,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    })
    .catch(error => {
        console.log('Error: ', error);
    })

function downloadPieChart()
{
    const link = document.createElement('a');
    const canvas = document.getElementById("myPieChart");
    link.download = 'genre_chart.png';
    link.href = canvas.toDataURL('image/png', 1);
    link.click();
}

function exportPieChartPDF()
{
    const canvas = document.getElementById("myPieChart");

    const canvasImg = canvas.toDataURL('image/jpeg', 1.0);

    let pdf = new jsPDF('landscape');
    pdf.setFontSize(20);
    pdf.addImage(canvasImg, 'JPEG', 15, 15, 280, 150);
    pdf.save("genre_chart.pdf");
}
