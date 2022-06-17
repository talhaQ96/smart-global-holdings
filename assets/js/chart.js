Chart.defaults.font.size = 16;
Chart.defaults.font.family = 'Manrope';
Chart.defaults.font.weight = 300;
Chart.defaults.font.lineHeight = 1.4;
Chart.defaults.plugins.legend = false;

/*
 * Chart Title inside Circle
 */
const chartTitle = {
    id: 'chartTitle',
    beforeDraw(chart, args, options){
        const {ctx, chartArea: {top, right, bottom, left, width, height}} = chart;

        ctx.save();
        ctx.fillStyle = '#535759';
        ctx.font = '600 30px Manrope';
        ctx.textAlign = 'center'

        let title = 'SGH\nOperating\nSystem';
        let lineHeight = 36;
        let lineBreak = title.split('\n');
        let x = (width/2);
        let y = (height/2) - 10;
        console.log(y)

        for (let i = 0; i < lineBreak.length; i++) {
            ctx.fillText(lineBreak[i], x, y  + (i*lineHeight));
        }
    }
}

let  chart = document.getElementById('doughnutChart').getContext('2d');
let  doughnutChart = new Chart(chart, {
        plugins: [ChartDataLabels, chartTitle],
        type: 'doughnut',

        data: {
            labels: [
                'Quality',
                'Supply Chain\nExcellence',
                'Global\nManufacturing\nScale/Efficiency',
                'Customer\nRelationship\nManagement',
                'Capital Efficient\nModel',
                'Corporate\nCultural/\nHuman\nCapital'
            ],
    
            datasets: [
                {
                    data: [100, 100, 100, 100, 100, 100],
                    spacing: 15,
                    hoverOffset: 20,
                    rotation: -31,
    
                    backgroundColor: [
                        'rgb(18, 50, 61)',
                        'rgb(41, 165, 167)',
                        'rgb(89, 129, 133)',
                        'rgb(18, 50, 61)',
                        'rgb(41, 165, 167)',
                        'rgb(89, 129, 133)'
                    ]
                }
            ]
        },

        options: {
            responsive: true,
            cutout: '40%',

            plugins: {
                tooltip: {
                    enabled: false
                },

                datalabels: {
                    color: 'white',
                    textAlign: 'center',
                    formatter: function (value, context) {
                        return context.chart.data.labels[
                            context.dataIndex
                        ];
                    }
                }
            },

            layout: {
                padding: {
                    top: 15,
                    bottom: 15
                }
            },
        }
});