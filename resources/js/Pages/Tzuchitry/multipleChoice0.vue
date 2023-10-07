<template>
  {{ Results }}
</template>

<script>
export default {
  data() {
    return {
      questionNaire: [{ 'id': 1, 'title': '我是核取方塊格第一題', 'request': false, 'image': null, 'video': null, 'type': 9, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': '第一列' }, { 'id': 2, 'text': '第二列' }, { 'id': 3, 'text': '第三列' }, { 'id': 4, 'text': '第四列' }], 'column': [{ 'id': 1, 'text': '第一欄' }] } }, { 'id': 2, 'title': '我是核取方塊格第二題', 'request': false, 'image': null, 'video': null, 'type': 9, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': '第一列' }], 'column': [{ 'id': 1, 'text': '第一欄' }, { 'id': 2, 'text': '第二欄' }, { 'id': 3, 'text': '第三欄' }, { 'id': 4, 'text': '第四欄' }] } }, { 'id': 3, 'title': '我是核取方塊格第三題', 'request': false, 'image': null, 'video': null, 'type': 9, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': '第一列' }, { 'id': 2, 'text': '第二列' }, { 'id': 3, 'text': '第三列' }, { 'id': 4, 'text': '第四列' }], 'column': [{ 'id': 1, 'text': '第一欄' }, { 'id': 2, 'text': '第二欄' }, { 'id': 3, 'text': '第三欄' }, { 'id': 4, 'text': '第四欄' }] } }],
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
        //   console.log(9);
          const objectX = {
            type: question.type,
            text: question.title,
            data: [],
          };
          // 下面作放進data的東西
          const rowCount = question.square.row.length;
          const columnCount = question.square.column.length;

          // 初始化表头
          const headerRow = ['欄'];
          for (let col = 1; col <= columnCount; col++) {
            headerRow.push(question.square.column[col - 1].text);
          }
          objectX.data.push(headerRow);

          // 遍历行
          for (let row = 1; row <= rowCount; row++) {
            const rowData = [question.square.row[row - 1].text];
            console.log(row);
            for (let col = 1; col <= columnCount; col++) {
              console.log(col);
              const count = this.countOccurrences(row, col);
              rowData.push(count);
            }
            objectX.data.push(rowData);
          }

          Results.push(objectX);
        }
      }

      this.Results = Results ;
    },
    countOccurrences(row, col) {
      let count = 0;
      const targetKey = `row${row}col${col}`;

      for (const answers of this.Answers) {
        const firstAnswer = answers[row - 1]; // 获取每个子数组的第一个对象
        console.log(firstAnswer);
        if (firstAnswer && firstAnswer.manyOptions.includes(targetKey)) {
          count++;
        }
      }
      //   console.log(count);
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
