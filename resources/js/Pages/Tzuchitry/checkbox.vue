
<template>
  {{ arrayC }}
</template>

<script>
export default {
  data() {
    return {
      arrayA:
        [

          { 'id': 1, 'title': '我是核取方塊第一題', 'request': false, 'image': null, 'video': null, 'type': 4, 'options': [{ 'id': 1, 'value': '核取選項一' }, { 'id': 2, 'value': '核取選項二' }, { 'id': 3, 'value': '核取選項三' }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

          { 'id': 2, 'title': '我是核取方塊第二題', 'request': false, 'image': null, 'video': null, 'type': 4, 'options': [{ 'id': 1, 'value': '核取選項一' }, { 'id': 2, 'value': '核取選項二' }, { 'id': 3, 'value': '核取選項三' }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

          { 'id': 3, 'title': '我是核取方塊第三題', 'request': false, 'image': null, 'video': null, 'type': 4, 'options': [{ 'id': 1, 'value': '核取選項一' }, { 'id': 2, 'value': '核取選項二' }, { 'id': 3, 'value': '核取選項三' }, { 'id': 4, 'value': '核取選項四' }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        ],
      arrayB: [

        [
          { 'id': 1, 'answer': null, 'manyOptions': [2, 3], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 2, 'answer': null, 'manyOptions': [1, 3], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': [1, 3, 2], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }],

        [
          { 'id': 1, 'answer': null, 'manyOptions': [2, 3], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 2, 'answer': null, 'manyOptions': [1, 3], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': [1, 3, 2], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
        ],

        [
          { 'id': 1, 'answer': null, 'manyOptions': [2, 3], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 2, 'answer': null, 'manyOptions': [1, 3], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': [1, 3, 2], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
        ],

      ],
      arrayC: [],
      count: 0,
    };
  },
  mounted() {
    this.checkboxSum();
  },
  methods: {
    checkboxSum() {
      this.arrayC = this.arrayA
        .filter((question) => question.type === 4)
        .map((question) => {
          const data = question.options.map((option) => {
            const count = this.checkboxCount(question.id, option.id);
            return count;
          });
          let subtextCount = 0; // 初始化 subtext 计数

          this.arrayB.forEach((answerSet, index) => {
            const thirdAnswer = answerSet[index];
            if (thirdAnswer && Array.isArray(thirdAnswer.manyOptions) && thirdAnswer.manyOptions.length > 0) {
              subtextCount++;
            }
          });
          return {
            type: question.type,
            text: question.title,
            subtext: subtextCount,
            yAxis: question.options.map((option) => option.value),
            data: data,
          };
        });
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
  },
};
</script>
