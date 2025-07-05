/*
Template Name: PDSI - Admin & Dashboard Template
Author: ICT PDSI
Website: https://ICT PDSI.com/
Contact: ICT PDSI@gmail.com
File: Widgets init js
*/

// get colors array from the string
function getChartColorsArray(chartId) {
    if (document.getElementById(chartId) !== null) {
        var colors = document.getElementById(chartId).getAttribute("data-colors");
        if (colors) {
            colors = JSON.parse(colors);
            return colors.map(function (value) {
                var newValue = value.replace(" ", "");
                if (newValue.indexOf(",") === -1) {
                    var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                    if (color) return color;
                    else return newValue;;
                } else {
                    var val = value.split(',');
                    if (val.length == 2) {
                        var rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0]);
                        rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                        return rgbaColor;
                    } else {
                        return newValue;
                    }
                }
            });
        } else {
            console.warn('data-colors Attribute not found on:', chartId);
        }
    }
}

// Total Portfolio Donut Charts
var donutchartportfolioColors = getChartColorsArray("portfolio_donut_charts");
if (chart) chart.destroy();
if (donutchartportfolioColors) {
    // Debug: periksa data yang tersedia
    console.log('window.doctorChartData:', window.doctorChartData);
    
    var chartData = window.doctorChartData || {
        series: [320, 250, 130, 5],
        labels: ["Dr. Umum", "Dr. Gigi", "Dr. Spesialist", "Dr. Sub Spesialist"]
    };
    
    // Debug: periksa chartData yang akan digunakan
    console.log('chartData.series:', chartData.series);
    console.log('chartData.labels:', chartData.labels);
    
    var options = {
        series: chartData.series,
        labels: chartData.labels,
        chart: {
            type: "donut",
            height: 210,
        },
        plotOptions: {
            pie: {
                size: 100,
                offsetX: 0,
                offsetY: 0,
                donut: {
                    size: "70%",
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontSize: '18px',
                            offsetY: -5,
                        },
                        value: {
                            show: true,
                            fontSize: '20px',
                            color: '#343a40',
                            fontWeight: 500,
                            offsetY: 5,
                            formatter: function (val) {
                                return val; // Hilangkan " Dokter" dulu untuk debug
                            }                            
                        },
                        total: {
                            show: true,
                            fontSize: '13px',
                            label: 'Total Doctors',
                            color: '#9599ad',
                            fontWeight: 500,
                            formatter: function (w) {
                                return w.globals.seriesTotals.reduce(function (a, b) {
                                    return a + b
                                }, 0); // Hilangkan " Dokter" dulu untuk debug
                            }                            
                        }
                    }
                },
            },
        },
        dataLabels: {
            enabled: false, // Set false dulu untuk melihat chart dasarnya
        },
        legend: {
            show: false,
        },
        stroke: {
            lineCap: "round",
            width: 2
        },
        colors: donutchartportfolioColors,
    };

    var chart = new ApexCharts(document.querySelector("#portfolio_donut_charts"), options);
    chart.render();
}

var linechartcustomerColors = getChartColorsArray("customer_impression_charts");
if (linechartcustomerColors) {
    
    // Ambil data dari window object
    var impressionData = window.impressionChartData || {
        daftar: [34, 65, 46, 68, 49, 61, 42, 44, 78, 52, 63, 67],
        aktif: [89, 98, 68, 108, 77, 84, 51, 28, 92, 42, 88, 36],
        non_aktif: [8, 12, 7, 17, 21, 11, 5, 9, 7, 29, 12, 35]
    };
    
    var options = {
        series: [{
            name: "Daftar",
            type: "area",
            data: impressionData.daftar,
        },
        {
            name: "Aktif",
            type: "bar",
            data: impressionData.aktif,
        },
        {
            name: "Non Aktif",
            type: "line",
            data: impressionData.non_aktif,
        }],
        chart: {
            height: 310,
            type: "line",
            toolbar: {
                show: false,
            },
        },
        stroke: {
            curve: "straight",
            dashArray: [0, 0, 8],
            width: [0.1, 0, 2],
        },
        fill: {
            opacity: [0.03, 0.9, 1],
        },
        markers: {
            size: [0, 0, 0],
            strokeWidth: 2,
            hover: {
                size: 4,
            },
        },
        xaxis: {
            categories: [
                "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
            ],
            axisTicks: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
        },
        grid: {
            show: true,
            xaxis: {
                lines: {
                    show: true,
                },
            },
            yaxis: {
                lines: {
                    show: false,
                },
            },
            padding: {
                top: 0,
                right: -2,
                bottom: 15,
                left: 10,
            },
        },
        legend: {
            show: true,
            horizontalAlign: "center",
            offsetX: 0,
            offsetY: -5,
            markers: {
                width: 9,
                height: 9,
                radius: 6,
            },
            itemMargin: {
                horizontal: 10,
                vertical: 0,
            },
        },
        plotOptions: {
            bar: {
                columnWidth: "20%",
                barHeight: "100%",
                borderRadius: [8],
            },
        },
        colors: linechartcustomerColors,
        tooltip: {
            shared: true,
            y: [{
                formatter: function (y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(0) + " Dokter";
                    }
                    return y;
                },
            },
            {
                formatter: function (y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(0) + " Dokter";
                    }
                    return y;
                },
            },
            {
                formatter: function (y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(0) + " Dokter";
                    }
                    return y;
                },
            }],
        },
    };
    
    var chart = new ApexCharts(
        document.querySelector("#customer_impression_charts"),
        options
    );
    chart.render();
}