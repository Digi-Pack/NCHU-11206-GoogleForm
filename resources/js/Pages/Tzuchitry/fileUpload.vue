
<template>
  {{ arrayD }}

</template>

<script>
export default {
  data() {
    return {
      arrayD: [],
      arrayA: [

        { 'id': 1, 'title': '問題', 'request': false, 'image': null, 'video': null, 'type': 6, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        { 'id': 2, 'title': '問題', 'request': false, 'image': null, 'video': null, 'type': 6, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

      ],
      arrayB: [

        [

          { 'id': '1', 'answer': null, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' }, 'file': { 'name': '研究工具-症狀困擾.docx', 'path': '/upload/FillerName/1697164532-研究工具-症狀困擾.docx' } },

          { 'id': '2', 'answer': null, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' }, 'file': { 'name': '症狀困擾.docx', 'path': '/upload/FillerName/1697164532-症狀困擾.docx' } },

        ],

        [

          { 'id': '1', 'answer': null, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' }, 'file': { 'name': '研究工具.docx', 'path': '/upload/FillerName/1697164532-研究工具.docx' } },

          { 'id': '2', 'answer': null, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' }, 'file': { 'name': '症狀.docx', 'path': '/upload/FillerName/1697164532-症狀.docx' } },

        ],

      ],

    };
  },
  mounted() {
    // 在组件挂载到 DOM 后调用处理数据的方法
    this.processArray();
  },
  methods: {
    processArray() {
      // 遍历arrayA
      this.arrayA.forEach((questionA, indexA) => {
        if (questionA.type === 6) {
          let subtextCount = 0;
          let files = [];

          // 遍历arrayB的各个数组
          for (let j = 0; j < this.arrayB.length; j++) {
            let answerSet = this.arrayB[j];
            let answer = answerSet[indexA]; // 获取对应问题的答案

            // 检查答案是否不为 null 或空字符串
            if (answer && answer.file && answer.file.path && answer.file.path.trim() !== '') {
              subtextCount++;
              files.push({ name: answer.file.name, path: answer.file.path });
            }
          }

          // 创建arrayD中的对象
          let objectX = {
            type: questionA.type,
            text: questionA.title,
            subtext: subtextCount,
            files: files,
          };

          // 添加到arrayD
          this.arrayD.push(objectX);
        }
      });
    },
  },
};
</script>
