
<template>
  {{ arrayD }}
</template>

<script>
export default {
  data() {
    return {
      arrayD: [],
      arrayA: [

        { 'id': 1, 'title': '我是時間第一題', 'request': false, 'image': null, 'video': null, 'type': 11, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        { 'id': 2, 'title': '我是時間第二題', 'request': false, 'image': null, 'video': null, 'type': 11, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        { 'id': 3, 'title': '我是時間第三題', 'request': false, 'image': null, 'video': null, 'type': 11, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

      ],
      arrayB: [

        [{ 'id': 1, 'answer': null, 'manyOptions': [], 'time': { 'hour': '10', 'minute': '00', 'section': 'a.m.' } }, { 'id': 2, 'answer': null, 'manyOptions': [], 'time': { 'hour': '02', 'minute': '02', 'section': 'p.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': [], 'time': { 'hour': '03', 'minute': '03', 'section': 'p.m.' } }],

        [{ 'id': 1, 'answer': null, 'manyOptions': [], 'time': { 'hour': '10', 'minute': '05', 'section': 'a.m.' } }, { 'id': 2, 'answer': null, 'manyOptions': [], 'time': { 'hour': '02', 'minute': '02', 'section': 'p.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': [], 'time': { 'hour': '04', 'minute': '04', 'section': 'p.m.' } }],

        [{ 'id': 1, 'answer': null, 'manyOptions': [], 'time': { 'hour': '07', 'minute': '15', 'section': 'a.m.' } }, { 'id': 2, 'answer': null, 'manyOptions': [], 'time': { 'hour': '02', 'minute': '15', 'section': 'p.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': [], 'time': { 'hour': '05', 'minute': '05', 'section': 'p.m.' } }],

        [{ 'id': 1, 'answer': null, 'manyOptions': [], 'time': { 'hour': '07', 'minute': '15', 'section': 'a.m.' } }, { 'id': 2, 'answer': null, 'manyOptions': [], 'time': { 'hour': '02', 'minute': '45', 'section': 'p.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': [], 'time': { 'hour': '06', 'minute': '06', 'section': 'p.m.' } }],

      ],

    };
  },
  mounted() {
    this.generateArrayD();
  },

  methods: {
    generateArrayD() {
      this.arrayD = this.arrayA.map((question) => {
        if (question.type === 11) {
          const subtext = this.calculateSubtext(question.id);
          const timeAll = this.calculateTimeAll(question.id);
          return {
            type: question.type,
            text: question.title,
            subtext: subtext,
            timeAll: timeAll,
          };
        }
        return {};
      });
    },
    calculateSubtext(questionId) {
      let subtextCount = 0;
      for (const answerSet of this.arrayB) {
        const answer = answerSet.find((answer) => answer.id === questionId);
        if (answer && answer.time && (answer.time.hour !== null || answer.time.minute !== null)) {
          subtextCount++;
        }
      }
      return subtextCount;
    },
    calculateTimeAll(questionId) {
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
  },
};
</script>
