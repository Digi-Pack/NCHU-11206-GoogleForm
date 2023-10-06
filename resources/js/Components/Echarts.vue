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

import VChart, { THEME_KEY } from 'vue-echarts';
provide(THEME_KEY, 'light');

const props = defineProps({
  title: {
    default: '',
  },
  data: {
    default: [],
  },
  theme: {
    default: 'light',
  },
});

// const dataname = computed(() => {
//   return props.data.map((item) => item.name);
// });

const piedata = computed(() => {
  return props.data.flat().reduce((acc, obj) => {
    const { id, answer } = obj;
    acc[id] = [...(acc[id] || []), answer];
    return acc;
  }, {});
});

// const idToAnswerMap = data.flat()
//     .reduce((acc, obj) => {
//         const { id, answer } = obj;
//         acc[id] = [...(acc[id] || []), answer];
//         return acc;
//     }, {});
console.log(piedata);

// 圓餅圖
const pieOption = ref({
  title: {
    text: props.title,
    subtext: 'Fake Data',
    left: 'center',
  },
  tooltip: {
  },
  legend: {
    orient: 'vertical',
    left: 'left',
  },
  series: [
    {
    //   name: dataname,
      type: 'pie',
      radius: '50%',
      data: [
        { value: 1, name: 'piedata' },
      ],
      emphasis: {
        itemStyle: {
          shadowBlur: 10,
          shadowOffsetX: 0,
          shadowColor: 'rgba(0, 0, 0, 0.5)',
        },
      },
    },
  ],
});

// 柱狀圖
const barOption = ref({
  title: {
    text: props.title,
    subtext: 'Fake Data',
    left: 'center',
  },
  xAxis: {
    type: 'category',
    data: piedata,
  },
  yAxis: {
    type: 'value',
  },
  series: [
    {
      data: [120, 200, 150, 80, 70, 110, 1300],
      type: 'bar',
    },
  ],
});

// 橫的長條
const horizonOption = ref({
  title: {
    text: 'World Population',
  },
  tooltip: {
    trigger: 'axis',
    axisPointer: {
      type: 'shadow',
    },
  },
  legend: {},
  grid: {
    left: '3%',
    right: '4%',
    bottom: '3%',
    containLabel: true,
  },
  xAxis: {
    type: 'value',
    boundaryGap: [0, 0.01],
  },
  yAxis: {
    type: 'category',
    data: ['Brazil', 'Indonesia', 'USA', 'India', 'China', 'World'],
  },
  series: [
    {
      type: 'bar',
      data: [18203, 23489, 29034, 104970, 131744, 630230],
    },
  ],
});

// 數據集
const dataBase = ref({
  title: {
    text: props.title,
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
});

</script>

<template>
  <!-- {{ data }} -->
  <!-- {{ piedata[1] }} -->
  <div>
    <div class="text-area">
      <div class="que-top">
        <div class="title">題目</div>
        <div class="subtitle">1則回應</div>
      </div>
      <div class="px-5 py-3">
        <div class="text-answer">你好啊</div>
        <div class="text-answer">你好啊</div>
        <div class="text-answer">你好啊</div>
        <div class="text-answer">你好啊</div>
      </div>
    </div>
  </div>
  <div v-if="chartType === 1">
    <VChart class="chart" :option="pieOption" />
  </div>
  <div v-if="chartType === 2">
    <VChart class="chart" :option="barOption" />
  </div>
  <div v-if="chartType === 3">
    <VChart class="chart" :option="dataBase" />
  </div>
  <div v-if="chartType === 4">
    <VChart class="chart" :option="horizonOption" />
  </div>
</template>

<style lang="scss" scoped>
.chart {
  @apply w-full h-[500px];
}
.text-area {
    @apply w-full min-h-[80px] border rounded-[10px] border-gray-200 bg-white;
    .que-top {
        @apply p-5;
        .title {
            @apply w-full text-[16px] font-medium mb-1 px-3;
        }
        .subtitle{
            @apply text-sm px-3;
        }
    }
    .text-answer {
        @apply text-base mb-2 py-3 pl-3 bg-gray-50 rounded-md;
    }

}
</style>

