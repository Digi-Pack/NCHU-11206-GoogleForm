<script>
// 簡答、詳答、選擇、下拉式選單、日期存 answer，
// 核取方塊存manyOptions，
// 時間存time

// 問題和答案混和結果(下拉式選單)
// export default {
//   data() {
//     return {
//       A: [{ name: 1, title: 4141 }, { name: 2, title: 4141 }, { name: 3, title: 4141 }],
//       B: [{ value: 100, title: 223 }, { value: 200, title: 225 }, { value: 300, title: 226 }],
//       C: [], // 初始化一个空数组
//     };
//   },
//   created() {
//     // 确保数组C的长度与数组A和数组B中的物件数量相等
//     const minLength = Math.min(this.A.length, this.B.length);
//     for (let i = 0; i < minLength; i++) {
//       const objA = this.A[i];
//       const objB = this.B[i];

//       // 合并objA和objB到数组C中
//       this.C.push({
//         nameA: objA.name,
//         valueB: objB.value,
//       });
//     }
//   },
// };

// 特定項目統計的結果
// export default {
//   props: {
//     flash: String,
//     response: Object,
//   },
//   data() {
//     const A = [
//       { a: 1, b: 1 },
//       { a: 2, b: 1 },
//       { a: 3, b: 2 },
//       { a: 1, b: 2 },
//       { a: 1, b: 3 },
//       { a: 1, b: 3 },
//     ];

//     // 创建一个空对象来保存每个不同值的个数
//     const countA = {};

//     // 遍历数组A并计算每个值的出现次数
//     for (const item of A) {
//       const value = item.a;
//       if (countA[value]) {
//         countA[value]++;
//       } else {
//         countA[value] = 1;
//       }
//     }

//     // 将对象的值转为数组B
//     const B = Object.values(countA);

//     return { A, B };
//   },
// };

// 核取方塊統計結果
// export default {
//   props: {
//     flash: String,
//     response: Object,
//   },
//   data() {
//     const A = [
//       { 'id': 1, 'answer': null, 'manyOptions': [2, 3], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
//       { 'id': 2, 'answer': null, 'manyOptions': [1, 2, 3], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
//       { 'id': 3, 'answer': null, 'manyOptions': [1, 3, 4, 2], 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
//     ];

//     // 创建一个空对象来保存每个不同值的个数
//     const countManyOptions = {};

//     // 遍历数组 A 并计算每个值的出现次数
//     for (const item of A) {
//       const manyOptions = item.manyOptions;
//       for (const option of manyOptions) {
//         if (countManyOptions[option]) {
//           countManyOptions[option]++;
//         } else {
//           countManyOptions[option] = 1;
//         }
//       }
//     }

//     // 将对象的值转为数组 B
//     const B = Object.values(countManyOptions);

//     return { A, B, countManyOptions };
//   },
// };

// 線性方塊統計結果
// export default {
//   props: {
//     flash: String,
//     response: Object,
//   },
//   data() {
//     const A = [
//       { 'id': 1, 'answer': null, 'manyOptions': 7, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
//       { 'id': 2, 'answer': null, 'manyOptions': 7, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
//       { 'id': 3, 'answer': null, 'manyOptions': 6, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
//       { 'id': 4, 'answer': null, 'manyOptions': 4, 'time': { 'hour': null, 'minute': null, 'section': 'a.m.' } },
//     ];

//     const B = {
//       'id': 1,
//       'title': '我是線性刻度第一題 範圍1-7',
//       'request': false,
//       'image': null,
//       'video': null,
//       'type': 7,
//       'options': [{ 'id': 1, 'value': null }],
//       'linear': {
//         'min': '1',
//         'max': '7',
//         'minText': '不快樂',
//         'maxText': '快樂',
//       },
//       'square': {
//         'row': [{ 'id': 1, 'text': null }],
//         'column': [{ 'id': 1, 'text': null }],
//       },
//     };

//     const min = parseInt(B.linear.min);
//     const max = parseInt(B.linear.max);

//     // 创建一个数组用于保存统计结果
//     const C = [];

//     // 初始化统计结果数组
//     for (let i = min; i <= max; i++) {
//       C.push(0);
//     }

//     // 遍历 A 数组，统计每个值的个数
//     for (const item of A) {
//       const value = parseInt(item.manyOptions);
//       if (value >= min && value <= max) {
//         C[value - min]++;
//       }
//     }

//     return { A, B, C };
//   },
// };
// 核取方塊格統計結果(問卷id21,亂數20231001061011f04bfff4cc0ba538124607b7c2c861)
// 失敗一
// export default {
//   props: {
//     flash: String,
//     response: Object,
//   },
//   data() {
//     const A = [
//       {
//         'id': 3,
//         'title': '我是核取方塊格第三題',
//         'request': false,
//         'image': null,
//         'video': null,
//         'type': 9,
//         'options': [{ 'id': 1, 'value': null }],
//         'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null },
//         'square': {
//           'row': [
//             { 'id': 1, 'text': '第一列' },
//             { 'id': 2, 'text': '第二列' },
//             { 'id': 3, 'text': '第三列' },
//             { 'id': 4, 'text': '第四列' },
//           ],
//           'column': [
//             { 'id': 1, 'text': '第一欄' },
//             { 'id': 2, 'text': '第二欄' },
//             { 'id': 3, 'text': '第三欄' },
//             { 'id': 4, 'text': '第四欄' },
//           ],
//         },
//       },
//     ];

//     const B = [
//       {
//         'id': 3,
//         'answer': null,
//         'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'],
//         'time': { 'hour': null, 'minute': null, 'section': 'a.m.' },
//       },
//       {
//         'id': 3,
//         'answer': null,
//         'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'],
//         'time': { 'hour': null, 'minute': null, 'section': 'a.m.' },
//       },
//       {
//         'id': 3,
//         'answer': null,
//         'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'],
//         'time': { 'hour': null, 'minute': null, 'section': 'a.m.' },
//       },
//     ];

//     // 初始化 C 数组
//     const rowCount = A[0].square.row.length;
//     const columnCount = A[0].square.column.length;
//     const C = new Array(rowCount + 1).fill(null).map(() => new Array(columnCount + 1).fill(0));

//     // 遍历 B 数组，统计每个值的个数
//     for (const item of B) {
//       for (const option of item.manyOptions) {
//         const matches = option.match(/row(\d+)col(\d+)/);
//         if (matches) {
//           const row = parseInt(matches[1]);
//           const col = parseInt(matches[2]);
//           C[row][col]++;
//         }
//       }
//     }

//     // 计算每行和每列的累计结果
//     for (let row = 1; row <= rowCount; row++) {
//       for (let col = 1; col <= columnCount; col++) {
//         C[row][col] += C[row][col - 1] + C[row - 1][col] - C[row - 1][col - 1];
//       }
//     }

//     return { A, B, C };
//   },
// };
// 失敗二
// export default {
//   props: {
//     flash: String,
//     response: Object,
//   },
//   data() {
//     const A = [
//       {
//         'id': 3,
//         'title': '我是核取方塊格第三題',
//         'request': false,
//         'image': null,
//         'video': null,
//         'type': 9,
//         'options': [{ 'id': 1, 'value': null }],
//         'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null },
//         'square': {
//           'row': [
//             { 'id': 1, 'text': '第一列' },
//             { 'id': 2, 'text': '第二列' },
//             { 'id': 3, 'text': '第三列' },
//             { 'id': 4, 'text': '第四列' },
//           ],
//           'column': [
//             { 'id': 1, 'text': '第一欄' },
//             { 'id': 2, 'text': '第二欄' },
//             { 'id': 3, 'text': '第三欄' },
//             { 'id': 4, 'text': '第四欄' },
//           ],
//         },
//       },
//     ];

//     const B = [
//       {
//         'id': 3,
//         'answer': null,
//         'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'],
//         'time': { 'hour': null, 'minute': null, 'section': 'a.m.' },
//       },
//       {
//         'id': 3,
//         'answer': null,
//         'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'],
//         'time': { 'hour': null, 'minute': null, 'section': 'a.m.' },
//       },
//       {
//         'id': 3,
//         'answer': null,
//         'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'],
//         'time': { 'hour': null, 'minute': null, 'section': 'a.m.' },
//       },
//     ];

//     // 初始化 C 数组
//     const rowCount = A[0].square.row.length;
//     const columnCount = A[0].square.column.length;
//     const C = new Array(rowCount + 1).fill(null).map(() => new Array(columnCount + 1).fill(0));

//     // 遍历 B 数组，统计每个值的个数
//     for (const item of B) {
//       for (const option of item.manyOptions) {
//         const matches = option.match(/row(\d+)col(\d+)/);
//         if (matches) {
//           const row = parseInt(matches[1]);
//           const col = parseInt(matches[2]);
//           C[row][col]++;
//         }
//       }
//     }

//     // 计算每行和每列的累计结果
//     for (let row = 1; row <= rowCount; row++) {
//       for (let col = 1; col <= columnCount; col++) {
//         C[row][col] += C[row][col - 1] + C[row - 1][col] - C[row - 1][col - 1];
//       }
//     }

//     // 将首行和首列的数据设置为列的标题和行的标题
//     C[0][0] = '欄';
//     for (let col = 1; col <= columnCount; col++) {
//       C[0][col] = A[0].square.column[col - 1].text;
//     }
//     for (let row = 1; row <= rowCount; row++) {
//       C[row][0] = A[0].square.row[row - 1].text;
//     }

//     return { A, B, C };
//   },
// };
// 失敗三
// export default {
//   props: {
//     flash: String,
//     response: Object,
//   },
//   data() {
//     const A = [
//       {
//         'id': 3,
//         'title': '我是核取方塊格第三題',
//         'request': false,
//         'image': null,
//         'video': null,
//         'type': 9,
//         'options': [{ 'id': 1, 'value': null }],
//         'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null },
//         'square': {
//           'row': [
//             { 'id': 1, 'text': '第一列' },
//             { 'id': 2, 'text': '第二列' },
//             { 'id': 3, 'text': '第三列' },
//             { 'id': 4, 'text': '第四列' },
//           ],
//           'column': [
//             { 'id': 1, 'text': '第一欄' },
//             { 'id': 2, 'text': '第二欄' },
//             { 'id': 3, 'text': '第三欄' },
//             { 'id': 4, 'text': '第四欄' },
//           ],
//         },
//       },
//     ];

//     const B = [
//       {
//         'id': 3,
//         'answer': null,
//         'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'],
//         'time': { 'hour': null, 'minute': null, 'section': 'a.m.' },
//       },
//       {
//         'id': 3,
//         'answer': null,
//         'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'],
//         'time': { 'hour': null, 'minute': null, 'section': 'a.m.' },
//       },
//       {
//         'id': 3,
//         'answer': null,
//         'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'],
//         'time': { 'hour': null, 'minute': null, 'section': 'a.m.' },
//       },
//     ];

//     // 初始化 C 数组
//     const rowCount = A[0].square.row.length;
//     const columnCount = A[0].square.column.length;
//     const C = new Array(rowCount + 1).fill(null).map(() => new Array(columnCount + 1).fill(0));

//     // 遍历 B 数组，统计每个值的个数
//     for (const item of B) {
//       for (const option of item.manyOptions) {
//         const matches = option.match(/row(\d+)col(\d+)/);
//         if (matches) {
//           const row = parseInt(matches[1]);
//           const col = parseInt(matches[2]);
//           C[row][col]++;
//         }
//       }
//     }

//     // 计算每行的累计结果
//     for (let row = 1; row <= rowCount; row++) {
//       for (let col = 1; col <= columnCount; col++) {
//         C[row][col] += C[row][col - 1];
//       }
//     }

//     // 将首行和首列的数据设置为列的标题和行的标题
//     C[0][0] = '欄';
//     for (let col = 1; col <= columnCount; col++) {
//       C[0][col] = A[0].square.column[col - 1].text;
//     }
//     for (let row = 1; row <= rowCount; row++) {
//       C[row][0] = A[0].square.row[row - 1].text;
//     }

//     return { A, B, C };
//   },
// };
// 失敗四
// export default {
//   props: {
//     flash: String,
//     response: Object,
//   },
//   data() {
//     const A = [
//       {
//         'id': 3,
//         'title': '我是核取方塊格第三題',
//         'request': false,
//         'image': null,
//         'video': null,
//         'type': 9,
//         'options': [{ 'id': 1, 'value': null }],
//         'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null },
//         'square': {
//           'row': [
//             { 'id': 1, 'text': '第一列' },
//             { 'id': 2, 'text': '第二列' },
//             { 'id': 3, 'text': '第三列' },
//             { 'id': 4, 'text': '第四列' },
//           ],
//           'column': [
//             { 'id': 1, 'text': '第一欄' },
//             { 'id': 2, 'text': '第二欄' },
//             { 'id': 3, 'text': '第三欄' },
//             { 'id': 4, 'text': '第四欄' },
//           ],
//         },
//       },
//     ];

//     const B = [
//       {
//         'id': 3,
//         'answer': null,
//         'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'],
//         'time': { 'hour': null, 'minute': null, 'section': 'a.m.' },
//       },
//       {
//         'id': 3,
//         'answer': null,
//         'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'],
//         'time': { 'hour': null, 'minute': null, 'section': 'a.m.' },
//       },
//       {
//         'id': 3,
//         'answer': null,
//         'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'],
//         'time': { 'hour': null, 'minute': null, 'section': 'a.m.' },
//       },
//     ];

//     // 初始化 C 数组
//     const rowCount = A[0].square.row.length;
//     const columnCount = A[0].square.column.length;
//     const C = new Array(rowCount).fill(null).map(() => new Array(columnCount).fill(0));

//     // 遍历 B 数组，统计每个值的个数
//     for (const item of B) {
//       for (const option of item.manyOptions) {
//         const matches = option.match(/row(\d+)col(\d+)/);
//         if (matches) {
//           const row = parseInt(matches[1]) - 1; // 减 1 以匹配数组索引
//           const col = parseInt(matches[2]) - 1; // 减 1 以匹配数组索引
//           C[row][col]++;
//         }
//       }
//     }

//     return { A, B, C };
//   },
// };
export default {
  props: {
    flash: String,
    response: Object,
  },
  data() {
    const A = [
      {
        'id': 3,
        'title': '我是核取方塊格第三題',
        'request': false,
        'image': null,
        'video': null,
        'type': 9,
        'options': [{ 'id': 1, 'value': null }],
        'linear': { 'min': 1, 'max': 10, 'minText': null, 'maxText': null },
        'square': {
          'row': [
            { 'id': 1, 'text': '第一列' },
            { 'id': 2, 'text': '第二列' },
            { 'id': 3, 'text': '第三列' },
            { 'id': 4, 'text': '第四列' },
          ],
          'column': [
            { 'id': 1, 'text': '第一欄' },
            { 'id': 2, 'text': '第二欄' },
            { 'id': 3, 'text': '第三欄' },
            { 'id': 4, 'text': '第四欄' },
          ],
        },
      },
    ];

    const B = [
      {
        'id': 3,
        'answer': null,
        'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'],
        'time': { 'hour': null, 'minute': null, 'section': 'a.m.' },
      },
      {
        'id': 3,
        'answer': null,
        'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'],
        'time': { 'hour': null, 'minute': null, 'section': 'a.m.' },
      },
      {
        'id': 3,
        'answer': null,
        'manyOptions': ['row1col3', 'row2col3', 'row3col3', 'row4col3', 'row1col4', 'row2col4', 'row3col4'],
        'time': { 'hour': null, 'minute': null, 'section': 'a.m.' },
      },
    ];

    // 初始化 C 数组
    const rowCount = A[0].square.row.length;
    const columnCount = A[0].square.column.length;
    const C = new Array(rowCount + 1).fill(null).map(() => new Array(columnCount + 1).fill(0));

    // 将首行和首列的数据设置为列的标题和行的标题
    C[0][0] = '欄';
    for (let col = 1; col <= columnCount; col++) {
      C[0][col] = A[0].square.column[col - 1].text;
    }
    for (let row = 1; row <= rowCount; row++) {
      C[row][0] = A[0].square.row[row - 1].text;
    }

    // 遍历 B 数组，统计每个值的个数
    for (const item of B) {
      for (const option of item.manyOptions) {
        const matches = option.match(/row(\d+)col(\d+)/);
        if (matches) {
          const row = parseInt(matches[1]); // 不再需要减 1
          const col = parseInt(matches[2]); // 不再需要减 1
          C[row][col]++;
        }
      }
    }

    return { A, B, C };
  },
};
</script>

<template>
  <!-- <section id=""> -->
  <!-- 打印問題和答案混和結果 -->
  <!-- {{ C }} -->
  <!-- 打印特定項目統計的結果 -->
  <!-- {{ B }} -->
  <!-- 打印核取方塊統計的結果 -->
  <!-- {{ countManyOptions }} -->
  <!-- {{ B }} -->
  <!-- 打印線性方塊統計結果 -->
  <!-- {{ C }} -->
  <!-- 打印核取方塊格統計結果 -->
  {{ C }}

  <!-- </section> -->
</template>

<style lang="scss" scoped>
</style>
