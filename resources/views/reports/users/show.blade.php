
<x-layout>
    <div class="m-auto text-center space-y-4 w-full max-w-4xl">
        <div class="bg-white p-4 rounded-xl space-y-4">
            <div class="text-4xl">
                {{ $user->name }}
            </div>
            <div class="text-normal">
                {{ $user->description }}
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl space-y-4">
            <div id="chart_sales" style="height: 300px;"></div>
            <div id="sales_recommendations"></div>
        </div>
        <div class="bg-white p-4 rounded-xl space-y-4">
            <div id="chart_routes" style="height: 300px;"></div>
            <div id="routes_recommendations"></div>
        </div>

        <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>

        <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>

        <script>
            const chart_sales = new Chartisan({
                el: '#chart_sales',
                url: "@chart('user_sales_chart')" + "?user_id=" + {{ $user->id }},
                hooks: new ChartisanHooks()
                    .title("Покупки пользователя")
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
        <p class="text-lg mt-8 uppercase">
            <a href="{{ route('reports.users.index') }}">Назад</a>
        </p>
    </div>
</x-layout>
