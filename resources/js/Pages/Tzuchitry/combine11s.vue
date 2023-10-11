<template>
  <div v-for="(option, index) in chartOptions"
    :key="index">
    <!-- Echart -->
    <VChart v-if="option.type !== 1 && option.type !== 2 && option.type !== 10 && option.type !== 11" class="chart" :option="option" />
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
        <div v-for="itemInDay in itemIn.day" :key="itemInDay.day" class="px-5 flex items-center py-3">
          <div class="day">{{ itemInDay.day }}日<div class="count">{{ itemInDay.count }}</div></div>

        </div>
      </div>
    </div>
    <!-- 時間 -->
    <div v-if="option.type === 11" class="text-area">
      <!-- { type: 11, text:'這是時間的題目', subtext: 3, zone: 10, time: '上午10點' } -->
      <div class="que-top">
        {{ option.item.text }}
        <div class="subtitle">{{ option.item.subtext }}則回應</div>
      </div>
      <div v-for="(itemIn, index) in option.item.timeAll" :key="index" class="px-5 flex items-center">
        <div class="flex gap-2 w-[100px] border-r border-black ml-5 py-3">
          <span class="text-bold">{{ itemIn.zone }} B</span>
          <div class="border-red-400 w-[30px] border-b-[3px]"></div>
        </div>
        <div v-for="(itemInTime, index) in itemIn.time" :key="index" class="px-5 flex items-center py-2">
          <div class="time">{{ itemInTime.time }}<div class="count">{{ itemInTime.count }}</div></div>
        </div>
      </div>
    </div>
  </div>

  <!-- {{ arrayC }} -->
  <!-- {{ chartOptions }} -->
  <!-- 簡答/詳答 -->

  <!-- {type:1,text:'我是第一題簡答',subtext:3,answer:'我是簡答第一題回答'} -->
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
    //   arrayD: [{ type: 1, text: '我是第一題簡答', subtext: 3, answer: ['我是簡答第一題回答', '我是簡答第一題回答2'] }, { type: 1, text: '我是第二題簡答', subtext: 3, answer: ['我是簡答第二題回答', '我是簡答第二題回答2', '我是簡答第二題回答3'] }],
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

        { 'id': 9, 'title': '我是核取方塊格第一題', 'request': false, 'image': null, 'video': null, 'type': 9, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': '第一列' }], 'column': [{ 'id': 1, 'text': '第一欄' }, { 'id': 2, 'text': '第二欄' }, { 'id': 3, 'text': '第三欄' }, { 'id': 4, 'text': '第四欄' }] } },

        { 'id': 10, 'title': '我是核取方塊格第二題', 'request': false, 'image': null, 'video': null, 'type': 9, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': '第一列' }, { 'id': 2, 'text': '第二列' }, { 'id': 3, 'text': '第三列' }, { 'id': 4, 'text': '第四列' }], 'column': [{ 'id': 1, 'text': '第一欄' }, { 'id': 2, 'text': '第二欄' }, { 'id': 3, 'text': '第三欄' }, { 'id': 4, 'text': '第四欄' }] } },

        { 'id': 11, 'title': '單選方格第一題', 'request': false, 'image': null, 'video': null, 'type': 8, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': '第一題第一列' }, { 'id': 2, 'text': '第一題第二列' }, { 'id': 3, 'text': '第一題第三列' }, { 'id': 4, 'text': '第一題第四列' }], 'column': [{ 'id': 1, 'text': '第一欄' }, { 'id': 2, 'text': '第二欄' }] } },

        { 'id': 12, 'title': '單選方格第二題', 'request': false, 'image': null, 'video': null, 'type': 8, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': '第一列' }, { 'id': 2, 'text': '第二列' }, { 'id': 3, 'text': '第三列' }], 'column': [{ 'id': 1, 'text': '第一欄' }, { 'id': 2, 'text': '第二欄' }, { 'id': 3, 'text': '第三欄' }, { 'id': 4, 'text': '第四欄' }, { 'id': 5, 'text': '第五欄' }] } },

        { 'id': 13, 'title': '這是日期第一題', 'request': false, 'image': null, 'video': null, 'type': 10, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        { 'id': 14, 'title': '這是日期第二題', 'request': false, 'image': null, 'video': null, 'type': 10, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },
        { 'id': 15, 'title': '我是時間第一題', 'request': false, 'image': null, 'video': null, 'type': 11, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        { 'id': 16, 'title': '我是時間第二題', 'request': false, 'image': null, 'video': null, 'type': 11, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },
        { 'id': 17, 'title': '設置3個以上簡答題1', 'request': false, 'image': null, 'video': null, 'type': 1, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },
        { 'id': 18, 'title': '我是詳答第一題', 'request': false, 'image': null, 'video': null, 'type': 2, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },
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
          { 'id': 9, 'answer': null, 'manyOptions': ['row1col2', 'row1col3'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 10, 'answer': null, 'manyOptions': ['row1col1', 'row2col1', 'row3col2', 'row4col3', 'row1col4', 'row2col4', 'row3col4'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 11, 'answer': null, 'manyOptions': ['row1col2', 'row2col2', 'row3col1', 'row4col1'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 12, 'answer': null, 'manyOptions': ['row1col5', 'row2col5', 'row3col1'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 13, 'answer': '2023-07-01', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 14, 'answer': '2024-10-03', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 15, 'answer': null, 'manyOptions': [], 'time': { 'hour': '02', 'minute': '02', 'section': 'p.m.' } },
          { 'id': 16, 'answer': null, 'manyOptions': [], 'time': { 'hour': '03', 'minute': '03', 'section': 'p.m.' } },
          { 'id': 17, 'answer': '我是簡答第一題回答', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 18, 'answer': '我是詳答第一題的回答', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
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
          { 'id': 9, 'answer': null, 'manyOptions': ['row1col4', 'row1col3'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 10, 'answer': null, 'manyOptions': ['row1col2', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 11, 'answer': null, 'manyOptions': ['row1col2', 'row2col2', 'row3col1', 'row4col1'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 12, 'answer': null, 'manyOptions': ['row1col5', 'row2col5', 'row3col1'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 13, 'answer': '2023-07-15', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 14, 'answer': '2023-09-03', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 15, 'answer': null, 'manyOptions': [], 'time': { 'hour': '02', 'minute': '15', 'section': 'p.m.' } },
          { 'id': 16, 'answer': null, 'manyOptions': [], 'time': { 'hour': '03', 'minute': '03', 'section': 'p.m.' } },
          { 'id': 17, 'answer': '我是簡答第一題回答2', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 18, 'answer': '我是詳答第一題的回答', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },

        ],

        [{ 'id': 1, 'answer': 1, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 2, 'answer': 3, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 3, 'answer': 1, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 4, 'answer': 2, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 5, 'answer': null, 'manyOptions': [1, 3], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 6, 'answer': null, 'manyOptions': [1, 3, 2], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 7, 'answer': null, 'manyOptions': 3, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 8, 'answer': null, 'manyOptions': 5, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 9, 'answer': null, 'manyOptions': ['row1col4', 'row1col3'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 10, 'answer': null, 'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 11, 'answer': null, 'manyOptions': ['row1col2', 'row2col2', 'row3col1', 'row4col1'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 12, 'answer': null, 'manyOptions': ['row1col5', 'row2col5', 'row3col1'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 13, 'answer': '2023-07-01', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 14, 'answer': '2024-09-03', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 15, 'answer': null, 'manyOptions': [], 'time': { 'hour': '04', 'minute': '02', 'section': 'p.m.' } },
          { 'id': 16, 'answer': null, 'manyOptions': [], 'time': { 'hour': '01', 'minute': '03', 'section': 'p.m.' } },
          { 'id': 17, 'answer': '我是簡答第一題回答3', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 18, 'answer': '我是詳答第一題的回答', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
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
          legend: {},
          tooltip: {},
          dataset: {
            source: item.data,
          },
          xAxis: { type: 'category' },
          yAxis: {},
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
            const answer = answerSet.find((answer) => answer.id === question.id);
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
        const manyOptionsValue = answerSet[this.arrayA.indexOf(question)].manyOptions; // 使用问题的索引获取manyOptions值
        if (manyOptionsValue >= min && manyOptionsValue <= max) {
          // 计算数据数组的索引
          const dataIndex = manyOptionsValue - min;
          data[dataIndex]++;
        }
        if (manyOptionsValue >= 0) {
          subtextCount++;
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

      // 初始化数据数组
      const data = [['欄', ...columnNames]];

      // 初始化时间统计对象
      const timeCounts = {};

      // 遍历数组B，统计各个row-col组合的出现次数
      for (const answers of arrayB) {
        for (const answer of answers) {
          if (answer.id === question.id) {
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
        subtext: arrayB.filter(answers => answers[question.id - 1].manyOptions.length > 0).length,
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
        const answer = answerSet.find((answer) => answer.id === questionId);
        if (answer && answer.answer !== null && answer.answer !== '') {
          subtextCount++;
        }
      }
      return subtextCount;
    },
    dateCalculate(questionId) {
      const dateData = [];
      for (const answerSet of this.arrayB) {
        const answer = answerSet.find((answer) => answer.id === questionId);
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

      // 在每个timeAll对象内对time进行排序
      timeAll.sort((a, b) => {
        // 比较ZONE值，愈小的排后面
        return a.zone.localeCompare(b.zone);
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
        const answer = answerSet.find((answer) => answer.id === questionId);
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
        const answer = answerSet.find((answer) => answer.id === questionId);
        if (answer && answer.time && (answer.time.hour !== null || answer.time.minute !== null)) {
          const zone = answer.time.hour || answer.time.minute;
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
      const hour = time.hour || '00';
      const minute = time.minute || '00';
      if (time.hour !== null && time.minute !== null) {
        return `凌晨${hour}:${minute}`;
      } else if (time.hour !== null) {
        return `上午${hour}:${minute}`;
      } else if (time.minute !== null) {
        return `凌晨${minute}`;
      }
      return '';
    },
    shortLongAnswer(question) {
      let subtext = 0;
      let answerArray = [];

      // 遍历数组B中的子数组
      for (let j = 0; j < this.arrayB.length; j++) {
        let answerSet = this.arrayB[j];
        let answer = answerSet[question.id - 1].answer; // 获取对应问题的答案

        // 检查答案是否不为 null 或空字符串
        if (answer !== null && answer.trim() !== '') {
          subtext++;
          answerArray.push(answer);
        }
      }

      return {
        type: question.type,
        text: question.title,
        subtext: subtext,
        answer: answerArray,
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
        }
      });
    },
  },

};
</script>

  <style lang="scss" scoped>
  .chart {
    @apply w-[700px] h-[400px] mt-[100px] m-auto;
  }
  .text-area {
    @apply w-full min-h-[80px] mt-5 border rounded-[10px] border-gray-200 bg-white py-5;
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
        @apply bg-purple-middle rounded-[20px] px-3 mr-2;
    }
    .time {
        @apply bg-purple-middle rounded-[20px] px-3 py-1 mr-2 text-sm;
    }
    .count {
        @apply bg-white rounded-[20px] px-3 py-1 mr-2 text-sm;
    }
}
  </style>
