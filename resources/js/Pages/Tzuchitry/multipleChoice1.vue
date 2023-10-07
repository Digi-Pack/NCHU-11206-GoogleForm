<template>
  {{ resultArray }}
</template>

<script>
export default {
  data() {
    return {
      arrayA: [{ 'id': 1, 'title': '我是核取方塊格第一題', 'request': false, 'image': null, 'video': null, 'type': 9, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': '第一列' }, { 'id': 2, 'text': '第二列' }, { 'id': 3, 'text': '第三列' }, { 'id': 4, 'text': '第四列' }], 'column': [{ 'id': 1, 'text': '第一欄' }] } }, { 'id': 2, 'title': '我是核取方塊格第二題', 'request': false, 'image': null, 'video': null, 'type': 9, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': '第一列' }], 'column': [{ 'id': 1, 'text': '第一欄' }, { 'id': 2, 'text': '第二欄' }, { 'id': 3, 'text': '第三欄' }, { 'id': 4, 'text': '第四欄' }] } }, { 'id': 3, 'title': '我是核取方塊格第三題', 'request': false, 'image': null, 'video': null, 'type': 4, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': '第一列' }, { 'id': 2, 'text': '第二列' }, { 'id': 3, 'text': '第三列' }, { 'id': 4, 'text': '第四列' }], 'column': [{ 'id': 1, 'text': '第一欄' }, { 'id': 2, 'text': '第二欄' }, { 'id': 3, 'text': '第三欄' }, { 'id': 4, 'text': '第四欄' }] } }],
      arrayB: [
        [{ 'id': 1, 'answer': null, 'manyOptions': ['row3col1', 'row4col1'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 2, 'answer': null, 'manyOptions': ['row1col4', 'row1col3'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }],
        [{ 'id': 1, 'answer': null, 'manyOptions': ['row3col1', 'row4col1'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 2, 'answer': null, 'manyOptions': ['row1col4', 'row1col3'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }],
        [{ 'id': 1, 'answer': null, 'manyOptions': ['row3col1', 'row4col1'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 2, 'answer': null, 'manyOptions': ['row1col4', 'row1col3'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }],
      ],
      resultArray: [],
      C: [],
    };
  },
  mounted() {
    this.initializeC();
    this.calculateStatistics();
  },
  methods: {
    initializeC() {
      for (const itemA of this.arrayA) {
        // 如果type为9
        if (itemA.type === 9) {
          // 获取id值
          const idA = itemA.id;

          // 在arrayB中查找相同id值的对象数组
          for (const itemB of this.arrayB) {
            for (const subItemB of itemB) {
              if (subItemB.id === idA) {
                // 找到匹配的对象，将其添加到结果数组
                this.resultArray.push(subItemB);

              }
            }
          }
        }
      }
    },
  },

};
</script>

    <style lang="scss" scoped>
    .chart {
      @apply w-full h-[500px];
    }
    </style>
