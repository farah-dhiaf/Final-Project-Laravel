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
        <h5 class="text-xl font-bold text-gray-900 dark:text-white">Budget Usage</h5>
    </div>

    <div class="chart-wrapper">
        <div id="pie-chart" style="width: 100%; height: 320px;"></div> 
    </div>

    <div class="flex justify-center space-x-4 mt-4">
        <div class="flex items-center">
            <span class="block w-4 h-4 mr-2 rounded-full bg-blue-500"></span>
            <span class="text-gray-700 dark:text-gray-300">Food</span>
        </div>
        <div class="flex items-center">
            <span class="block w-4 h-4 mr-2 rounded-full bg-teal-500"></span>
            <span class="text-gray-700 dark:text-gray-300">Groceries</span>
        </div>
        <div class="flex items-center">
            <span class="block w-4 h-4 mr-2 rounded-full bg-purple-500"></span>
            <span class="text-gray-700 dark:text-gray-300">Transportation</span>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    const fetchData = async () => {
        try {
            const response = await fetch('/chart-data');
            const data = await response.json();
            return data;
        } catch (error) {
            console.error("Error fetching data:", error);
            return null;
        }
    };


    const getChartOptions = (data) => {
        return {
            series: data.series,
            colors: ["#1C64F2", "#16BDCA", "#9061F9"],
            chart: {
                height: 420,
                width: "100%",
                type: "pie",
            },
            labels: data.labels,
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

            if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(document.getElementById("pie-chart"), chartOptions);
                chart.render();
            }
        }
    };

    renderChart();
</script>