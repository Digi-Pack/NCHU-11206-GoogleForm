
<template>
  {{ Results }}
</template>

<script>
export default {
  data() {
    return {
      questionNaire: [
        { 'id': 1, 'title': '我是核取方塊格第一題', 'request': false, 'image': null, 'video': null, 'type': 9, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': '第一列' }, { 'id': 2, 'text': '第二列' }, { 'id': 3, 'text': '第三列' }, { 'id': 4, 'text': '第四列' }], 'column': [{ 'id': 1, 'text': '第一欄' }] } },
        { 'id': 2, 'title': '我是核取方塊格第二題', 'request': false, 'image': null, 'video': null, 'type': 9, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': '第一列' }], 'column': [{ 'id': 1, 'text': '第一欄' }, { 'id': 2, 'text': '第二欄' }, { 'id': 3, 'text': '第三欄' }, { 'id': 4, 'text': '第四欄' }] } },
        { 'id': 3, 'title': '我是核取方塊格第三題', 'request': false, 'image': null, 'video': null, 'type': 9, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': '第一列' }, { 'id': 2, 'text': '第二列' }, { 'id': 3, 'text': '第三列' }, { 'id': 4, 'text': '第四列' }], 'column': [{ 'id': 1, 'text': '第一欄' }, { 'id': 2, 'text': '第二欄' }, { 'id': 3, 'text': '第三欄' }, { 'id': 4, 'text': '第四欄' }] } },
      ],
      Answers: [
        [{ 'id': 1, 'answer': null, 'manyOptions': ['row3col1', 'row4col1'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 2, 'answer': null, 'manyOptions': ['row1col4', 'row1col3'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }],
        [{ 'id': 1, 'answer': null, 'manyOptions': ['row3col1', 'row4col1'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 2, 'answer': null, 'manyOptions': ['row1col4', 'row1col3'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }],
        [{ 'id': 1, 'answer': null, 'manyOptions': ['row3col1', 'row4col1'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 2, 'answer': null, 'manyOptions': ['row1col4', 'row1col3'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }],
      ],
      rowCount: 0,
      columnCount: 0,
      Results: [],
    };
  },
  mounted() {
    this.generateResults();
  },
  methods: {
    choiceSquare(arrayA, arrayB) {
      // 初始化数组C
      const arrayC = [];

      // 遍历数组A，筛选出type === 9的问题
      for (const question of arrayA) {
        if (question.type === 9) {
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

          // 构建对象X并加入数组C
          const objectX = {
            type: question.type,
            text: question.title,
            subtext: arrayB.filter(answers => answers[question.id - 1].manyOptions.length > 0).length,
            data: data,
          };

          arrayC.push(objectX);
        }
      }

      return arrayC;
    },

    generateResults() {
      // 调用 choiceSquare 方法生成统计结果
      this.Results = this.choiceSquare(this.questionNaire, this.Answers);
    },
  },
};
</script>

  <style lang="scss" scoped>
  .chart {
    @apply w-full h-[500px];
  }
  </style>
