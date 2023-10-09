
<template>
  {{ arrayD }}
  <!-- 時間 -->
  <div v-for="(item, index) in arrayD"
    :key="index" class="text-area">
    <!-- { type: 11, text:'這是時間的題目', subtext: 3, zone: 10, time: '上午10點' } -->
    <div class="que-top">
      {{ item.text }}
      <div class="subtitle">{{ item.subtext }}則回應</div>
    </div>
    <div v-for="(itemIn, index) in item.timeAll" :key="index" class="px-5 flex items-center">
      <div class="flex gap-2 w-[100px] border-r border-black ml-5 py-3">
        <span class="text-bold">{{ itemIn.zone }} B</span>
        <div class="border-red-400 w-[30px] border-b-[3px]"></div>
      </div>
      <div v-for="(itemInTime, index) in itemIn.time" :key="index" class="px-5 flex items-center py-2">
        <div class="time">{{ itemInTime.time }}<div class="count">{{ itemInTime.count }}</div></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      arrayD: [],
      arrayA: [{ 'id': 1, 'title': '設置3個以上簡答題1', 'request': false, 'image': null, 'video': null, 'type': 1, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        { 'id': 2, 'title': '設置3個以上簡答題2', 'request': false, 'image': null, 'video': null, 'type': 1, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        { 'id': 3, 'title': '設置3個以上簡答題3', 'request': false, 'image': null, 'video': null, 'type': 1, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } }],
      arrayB: [
        [{ 'id': 1, 'answer': '我是簡答第一題回答', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 2, 'answer': '我是簡答第二題回答', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': '我是簡答第三題回答', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }],

        [{ 'id': 1, 'answer': '1111-2', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 2, 'answer': '2222-2', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': '3333-2', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }],

        [{ 'id': 1, 'answer': '1111-3', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 2, 'answer': '2222-3', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }, { 'id': 3, 'answer': '我是簡答第三題回答', 'manyOptions': [], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } }]],

    };
  },
  mounted() {
    // 在mounted生命周期中调用generateArrayD方法
    this.arrayD = this.generateArrayD();
  },

  methods: {
    generateArrayD(question) {
      let questionText = question.title;
      let subtext = 0;
      let answerArray = [];

      // 遍历数组B中的子数组
      for (let j = 0; j < this.arrayB.length; j++) {
        let answerSet = arrayB[j];
        let answer = answerSet[i].answer;

        // 检查答案是否为空字符串
        if (answer.trim() !== '') {
          subtext++;
          answerArray.push(answer);
        }
      }

      // 创建对象X并添加到数组D中
      let objectX = {
        type: 1,
        text: questionText,
        subtext: subtext,
        answer: answerArray,
      };
      arrayD.push(objectX);

      // 返回结果数组D
      return arrayD;
    },
  },
};
</script>
