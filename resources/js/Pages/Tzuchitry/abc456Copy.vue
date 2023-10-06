<template>
  <div v-for="(option, index) in chartOptions"
    :key="index">
    {{ option }}
    <VChart class="chart" :option="option" />
  </div>
</template>

<!-- <template>
<div v-for="(option, index) in chartOptions"
:key="index">
{{ option }}
<VChart v-if="option.type === 1 || 3" class="chart" :option="option" />
<VChart v-if="option.type === 1 || option.type === 3 " class="chart" :option="option" />
<div v-if="option.type === 2"><br><br>哈囉哈囉<br><br></div>
</div>
</template> -->

<script>
import * as echarts from 'echarts/core';
// 基礎柱狀、條形圖、柱狀圖標籤旋轉、按行按列分布、最簡單數據集
import {
  DatasetComponent,
  ToolboxComponent,
  TitleComponent,
  TooltipComponent,
  LegendComponent,
  GridComponent,
} from 'echarts/components';
import {
  PieChart,
  BarChart,
} from 'echarts/charts';
import { LabelLayout } from 'echarts/features';
import { CanvasRenderer } from 'echarts/renderers';

echarts.use([
  DatasetComponent,
  ToolboxComponent,
  TitleComponent,
  TooltipComponent,
  LegendComponent,
  GridComponent,
  BarChart,
  PieChart,
  CanvasRenderer,
  LabelLayout,
]);

import VChart from 'vue-echarts';

export default {
  components: {
    VChart,
  },
  data() {
    return {
      chartOptions: [],
    };
  },
  mounted() {
    const data = [
      { type: 1 /* 数据配置项用于生成圆饼图 */ },
      { type: 2 /* 数据配置项用于生成长条图 */ },
      { type: 4 /* 数据配置项用于生成圆饼图 */ },
      { type: 1 /* 数据配置项用于生成圆饼图 */ },
      { type: 3 /* 数据配置项用于生成长条图 */ },
    ];

    this.chartOptions = data.map(item => {
      if (item.type === 1) {
        // 生成圆饼图的配置项
        return {
          type: 1,
          title: {
            text: 'Pie Chart',
            left: 'center',
          },
          series: [
            {
              type: 'pie',
              radius: '50%',
              data: [
                { value: 100, name: 'Category A' },
                { value: 200, name: 'Category B' },
                // 添加更多数据...
              ],
            },
          ],
        };
      } else if (item.type === 2) {
        // 生成縱向长条图的配置项
        return {
          type: 2,
          title: {
            text: '長條圖',
            subtext: 'Fake Data',
            left: 'center',
          },
          xAxis: {
            type: 'category',
            data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
          },
          yAxis: {
            type: 'value',
          },
          series: [
            {
              data: [120, 200, 150, 80, 70, 110, 130],
              type: 'bar',
            },
          ],
        };
      } else if (item.type === 3) {
        // 生成縱向长条图的配置项
        return {
          type: 3,
          title: {
            text: 'ECharts横向柱状图 树懒课堂',
          },
          tooltip: {},
          legend: {
            data: ['一月销量', '二月销量'],
            right: '25%',
          },
          yAxis: {
            data: ['衬衫', '羊毛衫', '雪纺衫', '裤子', '高跟鞋', '袜子'],
          },
          xAxis: {},
          series: [{
            name: '一月销量',
            type: 'bar',
            stack: '业务',
            data: [5, 20, 36, 10, 10, 20],
          },
          ],
        };
      } else if (item.type === 4) {
        // 生成縱向长条图的配置项
        return {
          type: 4,
          title: {
            text: '核取方塊格',
            subtext: 'Fake Data',
            left: 'center',
          },
          legend: {},
          tooltip: {},
          dataset: {
            source: [
              ['product', '2015', '2016', '2017'],
              ['Matcha Latte', 43.3, 85.8, 93.7],
              ['Milk Tea', 83.1, 73.4, 55.1],
              ['Cheese Cocoa', 86.4, 65.2, 82.5],
              ['Walnut Brownie', 72.4, 53.9, 39.1],
            ],
          },
          xAxis: { type: 'category' },
          yAxis: {},
          // Declare several bar series, each will be mapped
          // to a column of dataset.source by default.
          series: [{ type: 'bar' }, { type: 'bar' }, { type: 'bar' }],
        };
      }
      return {};
    });
  },
};
</script>

  <style scoped>
  .chart {
    width: 300px;
    height: 300px;
    margin: 20px;
  }
  </style>
