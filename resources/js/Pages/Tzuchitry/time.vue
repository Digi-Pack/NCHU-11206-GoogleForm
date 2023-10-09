
<template>
  {{ arrayD }}
</template>

<script>
export default {
  data() {
    return {
      arrayA: [

        { 'id': 1, 'title': '我是時間第一題', 'request': false, 'image': null, 'video': null, 'type': 11, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        { 'id': 2, 'title': '我是時間第二題', 'request': false, 'image': null, 'video': null, 'type': 11, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

        { 'id': 3, 'title': '我是時間第三題', 'request': false, 'image': null, 'video': null, 'type': 11, 'options': [{ 'id': 1, 'value': null }], 'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null }, 'square': { 'row': [{ 'id': 1, 'text': null }], 'column': [{ 'id': 1, 'text': null }] } },

      ],
      arrayB: [

        [{ 'id': 1, 'answer': null, 'manyOptions': [], 'time': { 'hour': '01', 'minute': '01', 'section': 'a.m.' } }, { 'id': 2, 'answer': null, 'manyOptions': [], 'time': { 'hour': '02', 'minute': '02', 'section': 'p.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': [], 'time': { 'hour': '03', 'minute': '03', 'section': 'p.m.' } }],

        [{ 'id': 1, 'answer': null, 'manyOptions': [], 'time': { 'hour': '01', 'minute': '01', 'section': 'a.m.' } }, { 'id': 2, 'answer': null, 'manyOptions': [], 'time': { 'hour': '02', 'minute': '02', 'section': 'p.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': [], 'time': { 'hour': '03', 'minute': '03', 'section': 'p.m.' } }],

        [{ 'id': 1, 'answer': null, 'manyOptions': [], 'time': { 'hour': '01', 'minute': '01', 'section': 'a.m.' } }, { 'id': 2, 'answer': null, 'manyOptions': [], 'time': { 'hour': '02', 'minute': '02', 'section': 'p.m.' } }, { 'id': 3, 'answer': null, 'manyOptions': [], 'time': { 'hour': '03', 'minute': '03', 'section': 'p.m.' } }],

      ],

    };
  },

  mounted() {

  },
  methods: {

  },
};
</script>
