<x-layout>
    <p>
        <a href={{ route('reports.products.index') }}>Назад</a>
    </p>
    <div>
        Название: {{ $product->name }}
    </div>
    <div>
        Описание: {{ $product->description }}
    </div>
    <!-- Chart's container -->
    <div id="chart" style="height: 300px;"></div>
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
      const chart = new Chartisan({
        el: '#chart',
        url: "@chart('sales_chart')" + "?product_id=" + {{ $product->id }},
        hooks: new ChartisanHooks()
            .title("Продажи продукта")
            .tooltip(true)
      });
    </script>
</x-layout>
