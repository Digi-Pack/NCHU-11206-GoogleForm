<template>
  <div v-for="(option, index) in chartOptions"
    :key="index">
    <!-- Echart -->
    <VChart v-if="option.type !== 1 && option.type !== 2 && option.type !== 10 && option.type !== 11 && option.type !== 12 && option.type !== 13 && option.type !== 6" class="chart" :option="option" />
    <!-- 簡答 -->
    <div v-if="option.type === 1 || option.type === 2" class="text-area">
      <div class="que-top">
        <div class="title">{{ option.item.text }}</div>
        <div class="subtitle">{{ option.item.subtext }}則回應</div>
      </div>
      <div v-for="(optionIn, index) in option.item.answer"
        :key="index" class="px-5 py-3">
        <div class="text-answer">{{ optionIn }}</div>
      </div>
    </div>
    <!-- 日期 -->
    <div v-if="option.type === 10" class="text-area">
      <div class="que-top">
        {{ option.item.text }} <!-- 这里使用 option.item.title -->
        <div class="subtitle">{{ option.item.subtext }}則回應</div> <!-- 这里使用 option.item.subtext -->
      </div>
      <div v-for="itemIn in option.item.date" :key="itemIn.id" class="px-5 flex items-center">
        <div class="w-[100px] border-r border-black ml-5 py-3">
          <span class="text-bold">{{ itemIn.year }}年</span>
          <span class="text-bold">{{ itemIn.month }}月</span>
        </div>
        <div v-for="itemInDay in itemIn.day" :key="itemInDay.day" class="pl-5 flex items-center py-3">
          <div class="flex bg-purple-middle rounded-[20px] justify-between items-center py-1 ">
            <div class="day">{{ itemInDay.day }}日</div>
            <div class="count">{{ itemInDay.count }}</div>
          </div>
        </div>
      </div>
    </div>
    <!-- 時間 -->
    <div v-if="option.type === 11" class="text-area">
      <div class="que-top">
        {{ option.item.text }}
        <div class="subtitle">{{ option.item.subtext }}則回應</div>
      </div>
      <div v-for="(itemIn, index) in option.item.timeAll" :key="index" class="px-5 flex items-center">
        <div class="flex gap-2 w-[100px] border-r border-black ml-5 py-4">
          <span class="text-bold">{{ itemIn.zone }} B</span>
          <div class="border-red-400 w-[30px] border-b-[3px]"></div>
        </div>
        <div v-for="(itemInTime, index) in itemIn.time" :key="index" class="px-5 flex items-center py-2">
          <div class="bg-purple-middle flex justify-between items-center rounded-[20px] py-1">
            <div class="time">{{ itemInTime.time }}</div>
            <div class="count">{{ itemInTime.count }}</div>
          </div>
        </div>
      </div>
    </div>
    <!-- 檔案上傳 -->
    <div v-if="option.type === 6" class="text-area">
      <div class="que-top">
        <div class="title">{{ option.item.text }}</div>
        <div class="subtitle">{{ option.item.subtext }}則回應</div>
      </div>
      <div v-for="(optionIn, index) in option.item.files " class="mx-5 py-3 rounded bg-gray-50 border mb-[15px]"
        :key="index">
        <a :href=" optionIn.path " :download=" optionIn.name " class="text-answer">{{ optionIn.name }}下載</a>
      </div>
    </div>
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
  props: {
    chartdata: Object,
  },
  data() {
    return {
      arrayA: this.chartdata?.questionNaires ?? [],
      arrayB: this.chartdata?.results ?? [],
      arrayC: [],
      chartOptions: [],
      arrayD: [
        { type: 6, text: 'id-188未命名表單', subtext: 3, files: [{ name: '資料處理與分析.docx', path: '/upload/FillerName/1697162832-資料處理與分析.docx' }, { name: '研究工具-症狀困擾.docx', path: '/upload/FillerName/1697164532-研究工具-症狀困擾.docx' }] }, { type: 6, text: 'id-189未命名表單', subtext: 3, files: [{ name: '資料處理與分析.docx', path: '/upload/FillerName/1697162832-資料處理與分析.docx' }, { name: '研究工具-症狀困擾.docx', path: '/upload/FillerName/1697164532-研究工具-症狀困擾.docx' }] },
      ],
    };
  },
  mounted() {
    this.generateArrayC(),
    this.chartOptions = this.arrayC.map(item => {
      if (item.type === 5 || item.type === 3) {
        // 生成圆饼图的配置项
        return {
          type: item.type,
          title: {
            text: item.text,
            subtext: `${item.subtext}則回覆`,
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
        return {
          type: item.type,
          title: {
            text: item.text,
            subtext: `${item.subtext}則回覆`,
            left: 'center',
          },
          legend: {},
          tooltip: {},
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
              itemStyle: {
                color: '#AA90D3', // 在这里设置bar的颜色
              },
            },
          ],
        };
      } else if (item.type === 4) {
        // 生成橫向长条图的配置项
        return {
          type: item.type,
          title: {
            text: item.text,
            left: 'center',
          },
          legend: {},
          tooltip: {},
          yAxis: {
            data: item.yAxis,
          },
          xAxis: {},
          series: [{
            name: '',
            type: 'bar',
            stack: '',
            data: item.data,
            itemStyle: {
              color: '#AA90D3', // 在这里设置bar的颜色
            },
          },
          ],
        };
      } else if (item.type === 8 || item.type === 9) {
        // 生成核取方塊格的配置项
        return {
          type: item.type,
          title: {
            text: item.text,
            subtext: `${item.subtext}則回覆`,
            left: 'center',
          },
          legend: {
            orient: 'vertical',
            left: 'right',
          },
          tooltip: {},
          dataset: {
            source: item.data,
          },
          xAxis: { type: 'category' },
          yAxis: {
            axisLabel: {
              formatter: '{value}',
              align: 'center',
            },
          },
          series: item.series,
        };
      } else if (item.type === 10) {
        return { type: 10, item };
      } else if (item.type === 11) {
        return { type: 11, item };
      } else if (item.type === 1) {
        return { type: 1, item };
      } else if (item.type === 2) {
        return { type: 2, item };
      } else if (item.type === 12) {
        return { type: 12 };
      } else if (item.type === 13) {
        return { type: 13 };
      } else if (item.type === 6) {
        return { type: 6, item };
      }
      return {};
    });
  },
  methods: {
    pieSum(question) {
      let count = 0;
      let subtextCount = 0;
      return {
        type: question.type,
        text: question.title,
        data: question.options.map((option) => {
          count = 0; // 在這裡定義並初始化 count
          this.arrayB.forEach((answerSet) => {
            const answer = answerSet.find((answer) => parseInt(answer.id) === question.id);
            if (answer && answer.answer !== 'null') {
              // 比較 answer.answer 和 option.id
              if (answer && parseInt(answer.answer) === option.id) {
                count++;
                subtextCount++;
              }
            }

          });
          return {
            value: count,
            name: option.value,
          };
        }),
        subtext: subtextCount,
      };
    },
    checkboxSum(question) {
      const data = question.options.map((option) => {
        const count = this.checkboxCount(question.id, option.id);
        return count;
      });

      return {
        type: question.type,
        // subtext:
        text: question.title,
        yAxis: question.options.map((option) => option.value),
        data: data,
      };
    },
    checkboxCount(questionId, optionId) {
      let count = 0;
      this.arrayB.forEach((answerSet) => {
        answerSet.forEach((answer) => {
          if (parseInt(answer.id) === questionId && answer.manyOptions && answer.manyOptions.includes(optionId.toString())) {
            count++;
          }
        });
      });
      return count;
    },
    linearData(question) {
      const xAxis = [];
      const data = [];
      const min = parseInt(question.linear.min);
      const max = parseInt(question.linear.max);

      for (let i = min; i <= max; i++) {
        xAxis.push(i);
        data.push(0); // 初始化数据数组
      }
      let subtextCount = 0; // 初始化 subtext 计数
      for (const answerSet of this.arrayB) {
        const answer = answerSet.find((answer) => parseInt(answer.id) === question.id);
        if (answer) {
          const manyOptionsValue = answer.manyOptions;
          if (manyOptionsValue >= min && manyOptionsValue <= max) {
          // 计算数据数组的索引
            const dataIndex = manyOptionsValue - min;
            data[dataIndex]++;
          }
          if (manyOptionsValue.length > 0) {
            subtextCount++;
          }
        }
      }

      return {
        type: question.type,
        text: question.title,
        subtext: subtextCount,
        xAxis: xAxis,
        data: data,
      };
    },
    choiceSquare(question) {
      const { arrayB } = this;
      // 初始化行和列名
      const rowNames = question.square.row.map(row => row.text);
      const columnNames = question.square.column.map(col => col.text);
      let subtextCount = 0;

      // 初始化数据数组
      const data = [['欄', ...columnNames]];

      // 初始化时间统计对象
      const timeCounts = {};

      // 遍历数组B，统计各个row-col组合的出现次数
      for (const answers of arrayB) {

        for (const answer of answers) {
          if (parseInt(answer.id) === question.id) {
            if (answer.manyOptions && answer.manyOptions.length > 0) {
              subtextCount++;
            }
            for (const option of answer.manyOptions) {
              const [row, col] = option.match(/row(\d+)col(\d+)/).slice(1); // 解析row和col
              if (!timeCounts[row]) {
                timeCounts[row] = {};
              }
              if (!timeCounts[row][col]) {
                timeCounts[row][col] = 0;
              }
              timeCounts[row][col]++;
            }
          }
        }
      }

      // 构建数据数组
      for (let i = 1; i <= rowNames.length; i++) {
        const rowData = [rowNames[i - 1]];
        for (let j = 1; j <= columnNames.length; j++) {
          rowData.push(timeCounts[i] && timeCounts[i][j] ? timeCounts[i][j] : 0);
        }
        data.push(rowData);
      }
      const series = [];
      for (let i = 0; i < columnNames.length; i++) {
        series.push({ type: 'bar' });
      }

      // 构建对象X并加入数组C
      return {
        type: question.type,
        text: question.title,
        subtext: subtextCount,
        data: data,
        series: series,
      };

    },
    dateTotal(question) {
      const subtext = this.dateSubtext(question.id);
      const date = this.dateCalculate(question.id);
      return {
        type: question.type,
        text: question.title,
        subtext: subtext,
        date: date,
      };
    },
    dateSubtext(questionId) {
      let subtextCount = 0;
      for (const answerSet of this.arrayB) {
        const answer = answerSet.find((answer) => parseInt(answer.id) === questionId);
        // console.log(parseInt(answer.id), questionId);
        if (answer && answer.answer !== null && answer.answer !== '') {
          subtextCount++;
        }
      }
      return subtextCount;
    },
    dateCalculate(questionId) {
      const dateData = [];
      for (const answerSet of this.arrayB) {
        const answer = answerSet.find((answer) => parseInt(answer.id) === questionId);
        if (answer && answer.answer !== null && answer.answer !== '') {
          const [year, month, day] = answer.answer.split('-').map(Number);
          const existingDate = dateData.find((dateItem) => dateItem.year === year && dateItem.month === month);
          if (existingDate) {
            const existingDay = existingDate.day.find((dayItem) => dayItem.day === day);
            if (existingDay) {
              existingDay.count++;
            } else {
              existingDate.day.push({ day, count: 1 });
            }
          } else {
            dateData.push({
              year,
              month,
              day: [{ day, count: 1 }],
            });
          }
        }
      }
      return dateData;
    },
    timeTotal(question) {
      const subtext = this.timeSubtext(question.id);
      const timeAll = this.timeAll(question.id);
      //   console.log(timeAll);
      // 在每个timeAll对象内对time进行排序
      timeAll.sort((a, b) => {
        // 比较ZONE值，愈小的排后面
        // console.log(a, b);
        return a.zone.toString().localeCompare(b.zone.toString());
      });

      return {
        type: question.type,
        text: question.title,
        subtext: subtext,
        timeAll: timeAll,
      };

    },
    timeSubtext(questionId) {
      let subtextCount = 0;
      for (const answerSet of this.arrayB) {
        const answer = answerSet.find((answer) => parseInt(answer.id) === questionId);
        if (answer && answer.time && (answer.time.hour !== null || answer.time.minute !== null)) {
          subtextCount++;
        }
      }
      return subtextCount;
    },
    timeAll(questionId) {
    //   const timeAll = [];
      const zoneMap = new Map();
      for (const answerSet of this.arrayB) {
        const answer = answerSet.find((answer) => parseInt(answer.id) === questionId);
        if (answer && answer.time && (answer.time.hour !== null || answer.time.minute !== null)) {
          let zone;
          if (answer.time.section === 'p.m.') {
            if (answer.time.hour === 12) {
              zone = 0;
            } else if (answer.time.hour === 0) {
              zone = 12;
            } else {
              zone = 12 + answer.time.hour;
            }
          } else {
            zone = answer.time.hour || answer.time.minute;
          }

          if (!zoneMap.has(zone)) {
            zoneMap.set(zone, { zone: zone, time: [] });
          }

          const existingZone = zoneMap.get(zone);
          const formattedTime = this.formatTime(answer.time);
          const existingTime = existingZone.time.find((item) => item.time === formattedTime);
          if (existingTime) {
            existingTime.count++;
          } else {
            existingZone.time.push({ time: formattedTime, count: 1 });
          }
        }
      }
      return Array.from(zoneMap.values());
    },
    formatTime(time) {
      const section = time.section || '';
      const hour = time.hour || '00';
      const minute = time.minute || '00';
      if (section === 'a.m.') {
        if (hour >= 0 && hour <= 5) {
          return `凌晨${hour}:${minute}`;
        } else if (hour >= 6 && hour <= 11) {
          return `早上${hour}:${minute}`;
        }
        return `中午${hour}:${minute}`;

      } else if (section === 'p.m.') {
        if (hour === 0) {
          return `中午12:${minute}`;
        } else if (hour >= 1 && hour <= 5) {
          return `下午${hour}:${minute}`;
        } else if (hour >= 6 && hour <= 11) {
          return `晚上${hour}:${minute}`;
        }
        return `凌晨00:${minute}`;

      }
    },
    shortLongAnswer(question) {
      let subtext = 0;
      let answerArray = [];

      this.arrayB.forEach((answerSet) => {
        const answer = answerSet.find((answer) => parseInt(answer.id) === question.id);
        if (answer && answer.answer !== null) {
          // 比較 answer.answer 和 option.id
          answerArray.push(answer.answer);
          subtext++;
        }
      });

      return {
        type: question.type,
        text: question.title,
        subtext: subtext,
        answer: answerArray,
      };
    },
    fileUpload(question) {
      let subtextCount = 0;
      let files = [];

      this.arrayB.forEach((answerSet) => {
        const answer = answerSet.find((answer) => parseInt(answer.id) === question.id);
        if (answer && answer.file && answer.file.path && answer.file.path.trim() !== '') {
          subtextCount++;
          files.push({ name: answer.file.name, path: answer.file.path });
        }

      });

      // 返回生成的对象
      return {
        type: question.type,
        text: question.title,
        subtext: subtextCount,
        files: files,
      };
    },
    generateArrayC() {
      this.arrayC = this.arrayA.map((question) => {
        if (question.type === 3 || question.type === 5) {
          return this.pieSum(question);
        } else if (question.type === 4) {
          return this.checkboxSum(question);
        } else if (question.type === 7) {
          return this.linearData(question);
        } else if (question.type === 8 || question.type === 9) {
          return this.choiceSquare(question);
        } else if (question.type === 10) {
          return this.dateTotal(question);
        } else if (question.type === 11) {
          return this.timeTotal(question);
        } else if (question.type === 1 || question.type === 2) {
          return this.shortLongAnswer(question);
        } else if (question.type === 12) {
          return { type: 12 };
        } else if (question.type === 13) {
          return { type: 13 };
        } else if (question.type === 6) {
          return this.fileUpload(question);
        }
      });
    },
  },

};
</script>

  <style lang="scss" scoped>
  .chart {
    @apply w-[770px] h-[350px] mt-5 border rounded-[10px] border-gray-200 bg-white pt-10 flex justify-center items-center px-3;
  }
  .text-area {
    @apply w-full min-h-[80px] mt-5 border rounded-[10px] border-gray-200 bg-white py-2;
    .que-top {
        @apply p-5;
        .title {
            @apply w-full text-lg font-semibold mb-1 px-3;
        }
        .subtitle{
            @apply text-sm px-3;
        }
    }
    .text-answer {
        @apply text-base mb-2 py-3 pl-3 bg-gray-50 rounded-md;
    }
    .day {
        @apply rounded-[20px] pl-3 pr-2;
    }
    .time {
        @apply rounded-[20px] pl-3 pr-2 text-sm;
    }
    .count {
        @apply bg-purple-light rounded-full px-3 py-1 mr-2 text-sm;
    }
}
  </style>
