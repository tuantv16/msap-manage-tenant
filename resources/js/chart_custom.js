document.addEventListener("DOMContentLoaded", function() {
    var xValues = ["Tenant1", "Tenant2", "Tenant3", "Tenant4", "Tenant5", "Tenant6", "Tenant7", "Tenant8", "Tenant9", "Tenant10"];
    var yValues1 = [55, 49, 84, 94, 100, 60, 30, 45, 70, 80];
    var yValues2 = [30, 70, 20, 90, 60, 40, 85, 25, 95, 50];
    var barColors = [
        "#94402B", "#9D5818", "#C5A454", "#DFD785", "#DEEAB1",
        "#B7E9DB", "#61BDD2", "#5987C0", "#376FB3", "#4055A9"
    ];

    var boxWidth = 20;
    var legendPadding = 20;
    var layoutPadding = { top: 40, left: 10, right: 10, bottom: 10 };
    var dataLabelConfig = {
        display: true,
        color: 'black',
        align: 'right',
        anchor: 'end'
    };
    var legendFontConfig = {
        fontColor: '#333',
        fontSize: 20
    };
    var cutoutPercentage = 50;
    var chartTitleDisplay = false;
    var xAxesConfig = {
        ticks: { beginAtZero: true },
        position: 'top'
    };
    var yAxesConfig = { display: false };
    var chartLegendPosition = 'right';
    var legendDisplay = false;

    var totalValue1 = yValues1.reduce((a, b) => a + b, 0);

    var ctx1 = document.getElementById("myChart1").getContext("2d");
    var myChart1 = new Chart(ctx1, {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues1
            }]
        },
        options: {
            onClick: function(evt) {
                evt.native.preventDefault();
            },
            cutoutPercentage: cutoutPercentage,
            legend: {
                labels: {
                    display: legendDisplay,
                    boxWidth: boxWidth,
                    padding: legendPadding,
                    ...legendFontConfig
                },
                position: chartLegendPosition
            }
        }
    });

    document.getElementById("totalValue").innerText = totalValue1 + ' JPY';

    var ctx2 = document.getElementById("myChart2").getContext("2d");
    var myChart2 = new Chart(ctx2, {
        type: "horizontalBar",
        data: {
            labels: xValues,
            datasets: [{
                label: '',
                backgroundColor: barColors,
                data: yValues2
            }]
        },
        options: {
            layout: {
                padding: layoutPadding
            },
            title: {
                display: chartTitleDisplay
            },
            legend: {
                display: legendDisplay
            },
            scales: {
                xAxes: [xAxesConfig],
                yAxes: [yAxesConfig]
            },
            plugins: {
                datalabels: dataLabelConfig
            }
        }
    });

    generateLegend(xValues, barColors);
});

function generateLegend(labels, colors) {
    var legendContainer = document.getElementById("legend2");
    legendContainer.innerHTML = "";
    labels.forEach(function(label, index) {
        var legendItemConfig = {
            display: "flex",
            alignItems: "center",
            margin: "5px",
            width: "calc(25% - 10px)"
        };

        var legendItem = document.createElement("div");
        Object.assign(legendItem.style, legendItemConfig);

        var colorBoxConfig = {
            width: "20px",
            height: "20px",
            backgroundColor: colors[index],
            marginRight: "10px"
        };

        var colorBox = document.createElement("div");
        Object.assign(colorBox.style, colorBoxConfig);

        var labelText = document.createElement("span");
        labelText.innerText = label;

        legendItem.appendChild(colorBox);
        legendItem.appendChild(labelText);
        legendContainer.appendChild(legendItem);
    });
}

function downloadChart(chartId) {
    var chart = document.getElementById(chartId);
    var url = chart.toDataURL('image/png');
    var link = document.createElement('a');
    link.href = url;
    link.download = chartId + '.png';
    link.click();
}
