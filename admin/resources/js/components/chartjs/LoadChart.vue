<template>
    <canvas :id="id" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
</template>

<script>

    export default {

        props: ['id'],

        data: function(){
            return {

                Chart: '',

                areaChartData: {
                    labels  : ['.', '10s', '.', '20s', '.', '30s', '.', '40s', '.', '50s', '.', '60s'],
                    datasets: [
                        {
                        label               : 'Load Average 1m',
                        backgroundColor     : 'rgba(60,141,188,0.9)',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : []
                        },
                        {
                        label               : 'Load Average 5m',
                        backgroundColor     : 'rgba(210, 214, 222, 1)',
                        borderColor         : 'rgba(210, 214, 222, 1)',
                        pointRadius         : false,
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : []
                        },
                        {
                        label               : 'Load Average 15m',
                        backgroundColor     : 'rgba(255, 0, 13, 0.8)',
                        borderColor         : 'rgba(255, 0, 13, 0.7)',
                        pointRadius         : false,
                        pointColor          : 'rgba(255, 0, 13, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(255, 0, 13, 1)',
                        data                : []
                        },
                    ]
                },

                areaChartOptions: {
                    maintainAspectRatio : false,
                    responsive : true,
                    legend: {
                        display: true
                    },
                    scales: {
                        xAxes: [{
                        gridLines : {
                            display : false,
                        }
                        }],
                        yAxes: [{
                        gridLines : {
                            display : true,
                        }
                        }]
                    }
                }
            }
        },

        mounted(){

            const areaChartCanvas = $('#' + this.id).get(0).getContext('2d')

            this.Chart = new Chart(areaChartCanvas, {
                type: 'line',
                data: this.areaChartData,
                options: this.areaChartOptions
            })

            this.updateData('seconds');
            this.updateData('minutes');
            this.updateData('hours');

            setInterval(() => {
                this.updateData('seconds')
            }, 5000)

            setInterval(() => {
                this.updateData('minutes')
            }, 5000)

            setInterval(() => {
                this.updateData('hours')
            }, 5000)
        },

        methods: {
            updateData: async function(arrToUpdate){

                const date = new Date();

                if(arrToUpdate === 'seconds'){

                    let data = this.areaChartData.datasets[0].data;

                    if(data.length >= 12){

                        data.shift()
                    }

                    let response = await axios.get('/api/system/loadavg1m');

                    data.push(response.data);
                    this.areaChartData.datasets[0].data = data;

                    // console.log(this.areaChartData.datasets[0].data);
                } else if(arrToUpdate === 'minutes'){

                    let data = this.areaChartData.datasets[1].data;

                    if(data.length >= 12){

                        data.shift()
                    }

                    let response = await axios.get('/api/system/loadavg5m');

                    data.push(response.data);
                    this.areaChartData.datasets[1].data = data;

                    // console.log(this.areaChartData.datasets[1].data);
                } else if(arrToUpdate === 'hours'){

                    let data = this.areaChartData.datasets[2].data;

                    if(data.length >= 12){

                        data.shift()
                    }

                    let response = await axios.get('/api/system/loadavg15m');

                    data.push(response.data);
                    this.areaChartData.datasets[2].data = data;

                    // console.log(this.areaChartData.datasets[2].data);
                }

                this.Chart.update()
            }
        }
    }
</script>
