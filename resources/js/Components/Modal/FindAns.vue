<script>

export default {
  props: {
    value: Object,
  },
  data() {
  },
  methods: {
    arrayData(min, max) {
      let loopResult = [];
      for (let i = min; i <= max; i++) {
        loopResult.push(i);
      }
      return loopResult;
    },
  },
};
</script>

<template>
  <section id="findans">
    <!-- 簡答 -->
    <div v-if="value.qus.type === 1">
      <div>
        {{ value.ans.answer }}
      </div>
    </div>
    <!-- 詳答 -->
    <div v-if="value.qus.type === 2">
      <div>
        {{ value.ans.answer }}
      </div>
    </div>
    <!-- 選擇題 -->
    <div v-if="value.qus.type === 3">
      <div class="questype-3">
        <div v-for="(choose) in value.qus.options" :key="choose.id" class="option">
          <input type="radio" id="choice-1" disabled v-if="choose.id === value.ans.answer" checked>
          <input type="radio" id="choice-1" disabled v-else>
          <label for="choice-1">{{ choose.value }}</label>
        </div>
      </div>
    </div>
    <!-- 核取方塊 -->
    <div v-if="value.qus.type === 4">
      <div class="questype-4">
        <div v-for="(choose) in value.qus.options" :key="choose.id" class="option">
          <input type="checkbox" class="choice-2" disabled v-if="value.ans.manyOptions.includes(choose.id)" checked>
          <input type="checkbox" class="choice-2" disabled v-else>
          <label for="choice-2">{{ choose.value }}</label>
        </div>
      </div>
    </div>
    <!-- 下拉式選單 -->
    <div v-if="value.qus.type === 5">
      <div class="questype-5">
        {{ value.ans.answer }}
      </div>
    </div>
    <!-- 檔案上傳 -->
    <div v-if="value.qus.type === 6" class="!block">
      <span class="text-[18px]">檔案上傳</span>
      <div class="questype-6">
        <label for=""></label>
        <input type="file" name="" id="">
      </div>
    </div>
    <!-- 線性刻度 -->
    <div v-if="value.qus.type === 7" class="!block">
      <div class="questype-7">
        <span>{{ value.qus.linear.minText }}</span>
        <div v-for="(i, index) in arrayData(parseInt(value.qus.linear.min), parseInt(value.qus.linear.max))" :key=index>
          <label> {{ i }}
          </label>
          <input type="radio" disabled v-if=" index === value.ans.manyOptions" checked>
          <input type="radio" disabled v-else>
        </div>
        <span class="w-[120px] truncate">{{ value.qus.linear.maxText }}</span>
      </div>
    </div>
    <!-- 單選方格 -->

    <div v-if="value.qus.type === 8">
      <div class="questype-8">
        <table>
          <thead>
            <tr>
              <th></th>
              <th v-for="choose in value.qus.square.column" :key="choose.id">{{ choose.text }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="choose in value.qus.square.row" :key="choose.id">
              <th>{{ choose.text }}</th>
              <td v-for="choosecol in value.qus.square.column" :key="choosecol.id">
                <th>{{ choosecol.text }}</th>
                <input v-if="value.ans.manyOptions.includes(`row${choose.id}col${choosecol.id}`)" type="radio" disabled checked>
                <input type="radio" disabled v-else>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- 核取方塊格 -->
    <div v-if="value.qus.type === 9" class="!block">
      <div class="questype-9">
        <table>
          <thead>
            <tr>
              <th></th>
              <th v-for="choose in value.qus.square.column" :key="choose.id">{{ choose.text }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="choose in value.qus.square.row" :key="choose.id">
              <th>{{ choose.text }}</th>
              <td v-for="choosecol in value.qus.square.column" :key="choosecol.id">
                <th>{{ choosecol.text }}</th>
                <input v-if="value.ans.manyOptions.includes(`row${choose.id}col${choosecol.id}`)" type="checkbox" disabled checked>
                <input type="checkbox" disabled v-else>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- 日期 -->
    <div v-if="value.qus.type === 10" class="!block">
      <div class="questype-10">
        <input type="date" :value="value.ans.answer">
      </div>

    </div>
    <!-- 時間 -->
    <div v-if="value.qus.type === 11" class="!block">
      <div class="questype-11">
        <input type="text" :value="value.ans.time.hour" readonly>
        <span>:</span>
        <input type="text" :value="value.ans.time.minute" readonly>
        <select name="" id="" disabled>
          <option value="a.m." v-if="value.ans.time.section === 'a.m.'" selected>上午</option>
          <option value="p.m." v-if="value.ans.time.section === 'p.m.'" selected>下午</option>
        </select>

      </div>
    </div>
    <!-- 影片 -->
    <div v-if="value.qus.type === 13" class="!block">
      <div class="p-5 flex justify-center">
        <iframe class="max-w-[600px] w-[90%] h-[400px]" :src="value.qus.video" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>

  </section>
</template>

<style lang="scss" scoped>
#findans {}
</style>
