<!-- <template>
  <div v-for="(option, index) in chartOptions"
    :key="index">
    {{ option }}
    <VChart v-if="option.type === 1" class="chart" :option="option" />
    <div v-if="option.type === 2"><br><br>哈囉哈囉<br><br></div>
  </div>
</template> -->
<template>
  <div v-for="(option, index) in chartOptions"
    :key="index">
    {{ option }}
    <VChart class="chart" :option="option" />
  </div>
</template>

<script setup>
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

const data = [
  { type: 1 /* 数据配置项用于生成圆饼图 */ },
  { type: 2 /* 数据配置项用于生成长条图 */ },
  { type: 1 /* 数据配置项用于生成圆饼图 */ },
  { type: 1 /* 数据配置项用于生成圆饼图 */ },
  { type: 2 /* 数据配置项用于生成长条图 */ },
];

const chartOptions = data.map(item => {
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
    // 生成长条图的配置项
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
  }
  return;

});
</script>

  <style scoped>
  .chart {
    width: 300px;
    height: 300px;
    margin: 20px;
  }
  </style>
