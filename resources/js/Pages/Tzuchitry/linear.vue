
<template>
  {{ arrayC }}
</template>

<script>
export default {
  data() {
    return {
      arrayA:
      [
        { 'id': 1, 'title': '我是線性刻度第一題    範圍1-7', 'request': false, 'image': null, 'video': null, 'type': 7, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': '1', 'max': '7', 'minText': '不快樂', 'maxText': '快樂' }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        { 'id': 2, 'title': '我是線性刻度第二題    範圍0-6', 'request': false, 'image': null, 'video': null, 'type': 7, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': '0', 'max': '6', 'minText': '不快樂', 'maxText': '快樂' }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        { 'id': 3, 'title': '我是線性刻度第三題    範圍0-10', 'request': false, 'image': null, 'video': null, 'type': 7, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': '0', 'max': '10', 'minText': '不快樂', 'maxText': '快樂' }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        { 'id': 4, 'title': '我是線性刻度第四題    範圍1-10', 'request': false, 'image': null, 'video': null, 'type': 7, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': '1', 'max': '10', 'minText': '不快樂', 'maxText': '快樂' }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },
      ],
      arrayB: [

        [{ 'id': 1, 'answer': null, 'manyOptions': 7, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 2, 'answer': null, 'manyOptions': 5, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': 6, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 4, 'answer': null, 'manyOptions': 4, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }],

        [{ 'id': 1, 'answer': null, 'manyOptions': 7, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 2, 'answer': null, 'manyOptions': 5, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': 6, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 4, 'answer': null, 'manyOptions': 4, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }],

        [{ 'id': 1, 'answer': null, 'manyOptions': 7, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 2, 'answer': null, 'manyOptions': 5, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': 6, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 4, 'answer': null, 'manyOptions': 4, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }],

      ],
      arrayC: [],
      count: 0,
    };
  },
  mounted() {
    this.linearData();
  },
  methods: {
    linearData() {
      this.arrayC = [];

      for (const question of this.arrayA) {
        if (question.type === 7) {
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

          const resultObject = {
            type: question.type,
            text: question.title,
            subtext: subtextCount,
            xAxis: xAxis,
            data: data,
          };

          this.arrayC.push(resultObject);
        }
      }
    },
  },
};
</script>
