<style>
    .chart-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 1rem; 
    }
</style>

<div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6 text-center">
    <div class="mb-4">
        <h5 class="text-xl font-bold text-gray-900 dark:text-white">Monthly Expenses</h5>
    </div>

    <div class="chart-wrapper">
        <div id="bar-chart" style="width: 100%; height: 320px;"></div>
    </div>

    <div class="flex justify-center space-x-4 mt-4">
        <div class="flex items-center">
            <span class="block w-4 h-4 mr-2 rounded-full bg-blue-500"></span>
            <span class="text-gray-700 dark:text-gray-300">Direct</span>
        </div>
        <div class="flex items-center">
            <span class="block w-4 h-4 mr-2 rounded-full bg-teal-500"></span>
            <span class="text-gray-700 dark:text-gray-300">Organic Search</span>
        </div>
        <div class="flex items-center">
            <span class="block w-4 h-4 mr-2 rounded-full bg-purple-500"></span>
            <span class="text-gray-700 dark:text-gray-300">Referrals</span>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    const fetchData = async () => {
        try {
            const response = await fetch('/bar-data'); 
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("Error fetching data:", error);
            return null;
        }
    };

    const getChartOptions = (data) => {
        return {
            series: [{
                name: 'Monthly Expenses',
                data: data.values
            }],
            chart: {
                height: 320,
                width: "100%",
                type: "bar",
            },
            xaxis: {
                categories: data.labels,
            },
            colors: ["#1C64F2"],
            dataLabels: {
                enabled: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                },
            },
            legend: {
                position: "bottom",
                fontFamily: "Inter, sans-serif",
            }
        };
    };

    const renderChart = async () => {
        const data = await fetchData();
        if (data) {
            const chartOptions = getChartOptions(data);

            const chart = new ApexCharts(document.getElementById("bar-chart"), chartOptions);
            chart.render();
        }
    };

    renderChart();
</script>
