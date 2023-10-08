<template>
  <div v-for="(option, index) in chartOptions"
    :key="index">
    {{ option }}
    <VChart class="chart" :option="option" />
  </div>
  {{ arrayC }}
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
        {
          'id': 3,
          'title': '我是第一個選擇題',
          'request': false, 'image': null, 'video': null, 'type': 3, 'options': [{ 'id': 1, 'value': '我選項1' }, { 'id': 2, 'value': '我選項2' }, { 'id': 3, 'value': '我選項3' }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] },
        },
        {
          'id': 4,
          'title': '我是第二個選擇題',
          'request': false, 'image': null, 'video': null, 'type': 3, 'options': [{ 'id': 1, 'value': '咖啡不要喝太多(改資料)' }, { 'id': 2, 'value': '餅乾有吃就好(改資料)' },
          ], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] },
        },
        { 'id': 5,
          'title': '我是核取方塊第一題',
          'request': false, 'image': null, 'video': null, 'type': 4, 'options': [{ 'id': 1, 'value': '核取選項一' }, { 'id': 2, 'value': '核取選項二' }, { 'id': 3, 'value': '核取選項三' }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        { 'id': 6,
          'title': '我是核取方塊第二題', 'request': false, 'image': null, 'video': null, 'type': 4, 'options': [{ 'id': 1, 'value': '核取選項一' }, { 'id': 2, 'value': '核取選項二' }, { 'id': 3, 'value': '核取選項三' }, { 'id': 4, 'value': '核取選項四' }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        { 'id': 7, 'title': '我是線性刻度第一題    範圍1-7', 'request': false, 'image': null, 'video': null, 'type': 7, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': '1', 'max': '7', 'minText': '不快樂', 'maxText': '快樂' }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        { 'id': 8, 'title': '我是線性刻度第二題    範圍0-6', 'request': false, 'image': null, 'video': null, 'type': 7, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': '0', 'max': '6', 'minText': '不快樂', 'maxText': '快樂' }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },
      ],
      arrayB: [
        [{ 'id': 1, 'answer': 3, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 2, 'answer': 2, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 3, 'answer': 3, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 4, 'answer': 1, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 5, 'answer': null, 'manyOptions': [1, 3], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 6, 'answer': null, 'manyOptions': [1, 3, 2], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 7, 'answer': null, 'manyOptions': 7, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 8, 'answer': null, 'manyOptions': 5, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },

        ]
        ,

        [{ 'id': 1, 'answer': 2, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 2, 'answer': 2, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 3, 'answer': 3, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 4, 'answer': 1, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 5, 'answer': null, 'manyOptions': [1, 3], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 6, 'answer': null, 'manyOptions': [1, 3, 2], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 7, 'answer': null, 'manyOptions': 7, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 8, 'answer': null, 'manyOptions': 1, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
        ],

        [{ 'id': 1, 'answer': 1, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 2, 'answer': 3, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 3, 'answer': 1, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 4, 'answer': 2, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 5, 'answer': null, 'manyOptions': [1, 3], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 6, 'answer': null, 'manyOptions': [1, 3, 2], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 7, 'answer': null, 'manyOptions': 3, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 8, 'answer': null, 'manyOptions': 5, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
        ],
      ],
      arrayC: [],
      chartOptions: [],
    };
  },
  mounted() {
    this.generateArrayC(),
    this.chartOptions = this.arrayC.map(item => {
      if (item.type === 5 || item.type === 3) {
        // 生成圆饼图的配置项
        console.log('我是type3或5');
        return {
          type: item.type,
          title: {
            text: item.text,
            left: 'center',
          },
          tooltip: {
            trigger: 'item',
          },
          legend: {
            orient: 'vertical',
            left: 'left',
          },
          series: [
            {
              type: 'pie',
              radius: '50%',
              data: item.data,
            },
          ],
        };
      } else if (item.type === 7) {
        // 生成縱向长条图的配置项
        console.log('我是type7');
        return {
          type: item.type,
          title: {
            text: item.text,
            left: 'center',
          },
          xAxis: {
            type: 'category',
            data: item.xAxis,
          },
          yAxis: {
            type: 'value',
          },
          series: [
            {
              data: item.data,
              type: 'bar',
            },
          ],
        };
      } else if (item.type === 4) {
        // 生成橫向长条图的配置项
        console.log('我是type4');
        return {
          type: item.type,
          title: {
            text: item.text,
            left: 'center',
          },
          yAxis: {
            data: item.yAxis,
          },
          xAxis: {},
          series: [{
            name: '',
            type: 'bar',
            stack: '',
            data: item.data,
          },
          ],
        };
      } else if (item.type === 8 || item.type === 9) {
        // 生成核取方塊格的配置项
        return {
          type: item.type,
          title: {
            text: item.text,
            subtext: item.subtext,
            left: 'center',
          },
          legend: {},
          tooltip: {},
          dataset: {
            source: item.source,
          },
          xAxis: { type: 'category' },
          yAxis: {},
          series: [{ type: 'bar' }, { type: 'bar' }, { type: 'bar' }],
        };
      }
      return {};
    });
  },
  methods: {
    pieSum(question) {
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
    },
    checkboxSum(question) {
      const data = question.options.map((option) => {
        const count = this.checkboxCount(question.id, option.id);
        return count;
      });

      return {
        type: question.type,
        text: question.title,
        yAxis: question.options.map((option) => option.value),
        data: data,
      };
    },
    checkboxCount(questionId, optionId) {
      let count = 0;
      this.arrayB.forEach((answerSet) => {
        answerSet.forEach((answer) => {
          if (answer.id === questionId && answer.manyOptions.includes(optionId)) {
            count++;
          }
        });
      });
      return count;
    },
    linearData(question) {
      console.log('我是線性刻度function的頭');
      const xAxis = [];
      const data = [];

      const min = parseInt(question.linear.min);
      const max = parseInt(question.linear.max);

      for (let i = min; i <= max; i++) {
        xAxis.push(i);
        data.push(0); // 初始化数据数组
      }

      for (const answerSet of this.arrayB) {
        const manyOptionsValue = answerSet[this.arrayA.indexOf(question)].manyOptions; // 使用问题的索引获取manyOptions值
        if (manyOptionsValue >= min && manyOptionsValue <= max) {
          // 计算数据数组的索引
          const dataIndex = manyOptionsValue - min;
          data[dataIndex]++;
        }
      }

      return {
        type: question.type,
        text: question.title,
        xAxis: xAxis,
        data: data,
      };
    },
    generateArrayC() {
      this.arrayC = this.arrayA.map((question) => {
        if (question.type === 3 || question.type === 5) {
        //   this.count = 0;
          console.log(123);
          return this.pieSum(question);
        } else if (question.type === 4) {
          console.log(456);
          return this.checkboxSum(question);
        } else if (question.type === 7) {
          console.log(789);
          return this.linearData(question);
        }
        console.log('陣列結束了');
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
