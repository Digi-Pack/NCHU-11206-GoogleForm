
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
      //   arrayC: [],
      //   chartOptions: [],
      rowCount: 0,
      columnCount: 0,
      Results: [],
    };
  },
  mounted() {
    this.initializeC();
  },
  methods: {
    initializeC() {
      const Results = [];

      for (const question of this.questionNaire) {
        if (question.type === 9) {
          const objectX = {
            type: question.type,
            text: question.title,
            data: [],
          };

          const rowCount = question.square.row.length;
          const columnCount = question.square.column.length;

          // 初始化表头
          const headerRow = ['欄'];
          for (let col = 1; col <= columnCount; col++) {
            headerRow.push(question.square.column[col - 1].text);
          }
          objectX.data.push(headerRow);

          // 初始化行
          for (let row = 1; row <= rowCount; row++) {
            const rowData = [question.square.row[row - 1].text];

            // 初始化列
            for (let col = 1; col <= columnCount; col++) {
              const count = this.countOccurrences(question.id, row, col);
              rowData.push(count);
            }

            objectX.data.push(rowData);
          }

          Results.push(objectX);
        }
      }

      this.Results = Results;
    },
    countOccurrences(questionId, row, col) {
      // 计算在 this.Answers 中 questionId 对应的题目的 row 和 col 的 manyOptions 出现次数
      let count = 0;

      // 找到对应题目的答案
      const questionAnswers = this.Answers[questionId - 1];
      if (questionAnswers) {
        for (const answer of questionAnswers) {
          if (answer.manyOptions.includes(`row${row}col${col}`)) {
            count++;
          }
        }
      }

      return count;
    },
  },
};
</script>

  <style lang="scss" scoped>
  .chart {
    @apply w-full h-[500px];
  }
  </style>
