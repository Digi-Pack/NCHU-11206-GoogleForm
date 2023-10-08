
<template>
  {{ arrayD }}
</template>

<script>
export default {
  data() {
    return {
      arrayA: [

        { 'id': 1, 'title': '這是日期第一題', 'request': false, 'image': null, 'video': null, 'type': 10, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        { 'id': 2, 'title': '這是日期第二題', 'request': false, 'image': null, 'video': null, 'type': 10, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        { 'id': 3, 'title': '這是日期第三題', 'request': false, 'image': null, 'video': null, 'type': 10, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

      ],
      arrayB: [

        [{ 'id': 1, 'answer': '2023-07-01', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 2, 'answer': '2023-08-02', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': '2024-09-03', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }],

        [{ 'id': 1, 'answer': '2023-07-15', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 2, 'answer': '2023-08-02', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': '2023-09-03', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }],

        [{ 'id': 1, 'answer': '2023-08-01', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 2, 'answer': '2023-08-01', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': '2024-10-03', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }],

        [{ 'id': 1, 'answer': '2023-08-01', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 2, 'answer': '2023-08-01', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': '2023-09-04', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }],

      ],
      arrayD: [],
      count: 0,
    };
  },

  mounted() {
    this.dateTotal();
  },
  methods: {
    dateTotal() {
      const subtext = this.calculateSubtext(question.id);
      const date = this.calculateDate(question.id);
      return {
        type: question.type,
        title: question.title,
        subtext: subtext,
        date: date,
      };
    },
    calculateSubtext(questionId) {
      let subtextCount = 0;
      for (const answerSet of this.arrayB) {
        const answer = answerSet.find((answer) => answer.id === questionId);
        if (answer && answer.answer !== null && answer.answer !== '') {
          subtextCount++;
        }
      }
      return subtextCount;
    },
    calculateDate(questionId) {
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
  },
};
</script>
