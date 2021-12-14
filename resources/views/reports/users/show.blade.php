<x-layout>
    <p>
        <a href={{ route('reports.users.index') }}>Назад</a>
    </p>
    <div>
        Имя: {{ $user->name }}
    </div>
    <!-- Chart's container -->
    <div id="chart_sales" style="height: 300px;"></div>
    <div id="sales_recommendations"></div>
    <div id="chart_routes" style="height: 300px;"></div>
    <div id="routes_recommendations"></div>
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
        const chart_sales = new Chartisan({
            el: '#chart_sales',
            url: "@chart('user_sales_chart')" + "?user_id=" + {{ $user->id }},
            hooks: new ChartisanHooks()
                .title("Продажи продукта")
                .tooltip(true)
                .custom(({ data, merge, server }) => {
                    for (let i in server.chart.extra) {
                        let text = server.chart.extra[i]
                        document.getElementById("sales_recommendations").innerHTML += "<div>" + text + "</div>"
                    }
                    return data
                })
        });

        const chart_routes = new Chartisan({
            el: '#chart_routes',
            url: "@chart('user_route_chart')" + "?user_id=" + {{ $user->id }},
            hooks: new ChartisanHooks()
                .title("Наиболее популярные страницы")
                .tooltip(true)
                .custom(({ data, merge, server }) => {
                    for (let i in server.chart.extra) {
                        let text = server.chart.extra[i]
                        document.getElementById("routes_recommendations").innerHTML += "<div>" + text + "</div>"
                    }
                    return data
                })
        });
    </script>
</x-layout>
