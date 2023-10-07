<template>
  <div v-for="(option, index) in chartOptions"
    :key="index">
    {{ option }}
    <VChart class="chart" :option="option" />
  </div>
</template>

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
      arrayA: [
        { 'id': 1, 'title': '我是下拉式選單第一題', 'request': false, 'image': null, 'video': null, 'type': 5, 'options': [{ 'id': 1, 'value': '下拉選項一' }, { 'id': 2, 'value': '下拉選項二' }, { 'id': 3, 'value': '下拉選項三' }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },
        { 'id': 2, 'title': '我是下拉式選單第二題', 'request': false, 'image': null, 'video': null, 'type': 5, 'options': [{ 'id': 1, 'value': '下拉選項一' }, { 'id': 2, 'value': '下拉選項二' }, { 'id': 3, 'value': '下拉選項三' }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },
        { 'id': 3, 'title': '我是下拉式選單第三題', 'request': false, 'image': null, 'video': null, 'type': 5, 'options': [{ 'id': 1, 'value': '下拉選項一' }, { 'id': 2, 'value': '下拉選項二' }, { 'id': 3, 'value': '下拉選項三' }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },
        {
          'id': 4,
          'title': '我是第一個選擇題',
          'request': false,
          'image': null,
          'video': null,
          'type': 3,
          'options': [
            { 'id': 1, 'value': '我選項1' },
            { 'id': 2, 'value': '我選項2' },
            { 'id': 3, 'value': '我選項3' },
          ],
          'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null },
          'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] },
        },
        {
          'id': 5,
          'title': '我是第二個選擇題',
          'request': false,
          'image': null,
          'video': null,
          'type': 3,
          'options': [
            { 'id': 1, 'value': '咖啡不要喝太多(改資料)' },
            { 'id': 2, 'value': '餅乾有吃就好(改資料)' },
          ],
          'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null },
          'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] },
        },
      ],
      arrayB: [
        [{ 'id': 1, 'answer': 3, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 2, 'answer': 2, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 3, 'answer': 3, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 4, 'answer': 3, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 5, 'answer': 1, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
        ]
        ,

        [{ 'id': 1, 'answer': 2, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 2, 'answer': 2, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 3, 'answer': 3, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 4, 'answer': 3, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 5, 'answer': 1, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
        ],

        [{ 'id': 1, 'answer': 1, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 2, 'answer': 3, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 3, 'answer': 3, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 4, 'answer': 1, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 5, 'answer': 2, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
        ],
      ],
      arrayC: [],
      chartOptions: [],
    };
  },
  mounted() {
    this.generateArrayC();
    this.chartOptions = this.arrayC.map(item => {
      if (item.type === 5 || item.type === 3) {
        // 生成圆饼图的配置项
        return {
          type: item.type,
          title: {
            text: item.text,
            left: 'center',
          },
          series: [
            {
              type: 'pie',
              radius: '50%',
              data: item.data,
            },
          ],
        };
      } else if (item.type === 2) {
        // 生成縱向长条图的配置项
        return {
          type: 2,
          title: {
            text: '長條圖',
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
      } else if (item.type === 18) {
        // 生成橫向长条图的配置项
        return {
          type: 3,
          title: {
            text: 'ECharts横向柱状图 树懒课堂',
          },
          yAxis: {
            data: ['衬衫', '羊毛衫', '雪纺衫', '裤子', '高跟鞋', '袜子'],
          },
          xAxis: {},
        };
      } else if (item.type === 4) {
        // 生成核取方塊格的配置项
        return {
          type: 4,
          title: {
            text: '核取方塊格',
            left: 'center',
          },
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
  methods: {
    // 寫法二
    generateArrayC() {
      this.arrayC = this.arrayA
        .filter((question) => question.type === 5 || question.type === 3)
        .map((question) => {
          return {
            type: question.type,
            text: question.title,
            data: question.options.map((option) => {
              this.count = 0; // 在這裡定義並初始化 count
              this.arrayB.forEach((answerSet) => {
                // console.log(answerSet);
                const answer = answerSet.find((answer) => answer.id === question.id);
                // console.log(answer);
                // console.log(13);
                if (answer && answer.answer === option.id) { // 比較 answer.answer 和 option.id
                  this.count++;
                }
              });
              return {
                value: this.count,
                name: option.value,
              };
            }),
          };
        });
    },
  },
};
</script>

  <style lang="scss" scoped>
  .chart {
    @apply w-full h-[500px];
  }
  </style>
