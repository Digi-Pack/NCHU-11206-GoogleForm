<template>
  {{ arrayC }}
</template>

<script>
export default {
  data() {
    return {
      arrayA: [
        {
          'id': 1,
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
          'id': 2,
          'title': '第二個問題在這裡',
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
        [
          { 'id': 1, 'answer': 3, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 2, 'answer': 1, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
        ],
        [
          { 'id': 1, 'answer': 3, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 2, 'answer': 1, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
        ],
        [
          { 'id': 1, 'answer': 3, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
          { 'id': 2, 'answer': 1, 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
        ],
      ],
      arrayC: [],
      count: 0,
    };
  },
  mounted() {
    this.generateArrayC();
  },
  methods: {
    generateArrayC() {
      this.arrayC = this.arrayA
        .filter((question) => question.type === 3)
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
